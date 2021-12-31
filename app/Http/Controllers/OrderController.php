<?php
/**
 * File name: OrderController.php
 * Last modified: 2020.05.05 at 16:55:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Criteria\Users\ClientsCriteria;
use App\Criteria\Users\DriversCriteria;
use App\Criteria\Users\DriversOfMarketCriteria;
use App\DataTables\OrderDataTable;
use App\DataTables\ProductOrderDataTable;
use App\Events\OrderChangedEvent;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\AssignedOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\NotificationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Repositories\MarketRepository;
use App\Repositories\DeliveryAddressRepository;
use App\Repositories\ProductOrderRepository;
use App\Repositories\InventoryRepository;
use App\Models\Order;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Stripe\Token;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Stripe_CardError;
use Stripe\Stripe_InvalidRequestError;

use CustomHelper;
use Cookie;
use Cart;
use Auth;
use DB;
use App\Mail\UserRegisterationMail;
use App\Mail\OrdersMail;
use Str;

class OrderController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderStatusRepository
     */
    private $orderStatusRepository;
    /** @var  NotificationRepository */
    private $notificationRepository;
    /** @var  PaymentRepository */
    private $paymentRepository;
    /** @var  MarketRepository */
    private $marketRepository;
    /** @var  DeliveryAddressRepository */
    private $deliveryAddressRepository;
    /** @var  ProductOrderRepository */
    private $productOrderRepository;
    /** @var  InventoryRepository */
    private $inventoryRepository;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo
        , OrderStatusRepository $orderStatusRepo, NotificationRepository $notificationRepo, PaymentRepository $paymentRepo, MarketRepository $marketRepo, DeliveryAddressRepository $deliveryAddressRepo, ProductOrderRepository $productOrderRepo, InventoryRepository $inventoryRepo)
    {
        //parent::__construct();
        $this->orderRepository        = $orderRepo;
        $this->userRepository         = $userRepo;
        $this->orderStatusRepository  = $orderStatusRepo;
        $this->notificationRepository = $notificationRepo;
        $this->paymentRepository      = $paymentRepo;
        $this->marketRepository       = $marketRepo;
        $this->deliveryAddressRepository = $deliveryAddressRepo;
        $this->productOrderRepository    = $productOrderRepo;
        $this->inventoryRepository       = $inventoryRepo; 
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {   
        if(auth()->user()) {

            $validator = $request->validate([
                'delivery_address'      => 'required',
                'payment_type'          => 'required'
            ]);

            if($validator) {

                $user_market = DB::table('user_markets')->where('user_id',auth()->id())->first();
                //Create Order

                    //Amount Calcaulation
                    $totalWithoutTax = [];
                    $totalTaxPercent = [];
                    foreach(Cart::getContent() as $cart_item) {
                        $totalWithoutTax[] = $cart_item->getPriceSum();
                        $totalTaxPercent[] = substr($cart_item->conditions->getValue(), 1, -1);
                    }
                    $tax_amount  = Cart::getSubTotal() - array_sum($totalWithoutTax);
                    $totalAmount = array_sum($totalWithoutTax);
                    $taxPercent  = ($tax_amount / $totalAmount * 100);
                    //Amount Calcaulation

                    //Redeem values
                    $redeemValue[] = '';
                    foreach(Cart::getConditionsByType('redeem') as $redeem) {
                        $redeemValue[] = $redeem->parsedRawValue;
                    }
                    //Redeem values
                    
                    //Coupon values
                    $couponValue[] = '';
                    foreach(Cart::getConditionsByType('coupon') as $coupon) {
                        $couponValue[] = $coupon->parsedRawValue;
                    }
                    //Coupon values
                    
                    //Contribution values
                    $contributionValue[] = '';
                    foreach(Cart::getConditionsByType('contribution') as $contribution) {
                        $contributionValue[] = $contribution->parsedRawValue;
                    }
                    //Contribution values
                    
                    //Delivery charge
                    $deliveryCharge[] = '';
                    $deliveryDistance[] = '';
                    foreach(Cart::getConditionsByType('delivery') as $delivery) {
                        $deliveryCharge[] = $delivery->parsedRawValue;
                        $deliveryDistance[] = $delivery->getAttributes()['distance'];
                    }
                    //Delivery charge
                    

                    $max_id = Order::max('id') + 1;
                    $order_code_prefix = "GGPL" . date('y') . (date('y') + 1) . "ID";
                     $order_code = null;
                    if ($max_id <= 9) {
                        $order_code = $order_code_prefix . "000000" . $max_id;
                    } else if ($max_id <= 99) {
                        $order_code = $order_code_prefix . "00000" . $max_id;
                    } else if ($max_id <= 999) {
                        $order_code = $order_code_prefix . "0000" . $max_id;
                    } else if ($max_id <= 9999) {
                        $order_code = $order_code_prefix . "000" . $max_id;
                    } else if ($max_id <= 99999) {
                        $order_code = $order_code_prefix . "00" . $max_id;
                    } else if ($max_id <= 999999) {
                        $order_code = $order_code_prefix . "0" .$max_id;
                    } else {
                        $order_code = $order_code_prefix . $max_id;
                    }

                    if($request->payment_type == 'CARD') {

                        $token = $request->stripeToken;
                        
                        //Stripe Charge
                        Stripe::setApiKey(setting('stripe_secret'));
                        $charge = Charge::create([
                            'amount'        => number_format(Cart::getTotal(),setting('app_price_format'),'.','')*100,
                            'currency'      => 'inr',
                            'description'   => config('app.name', 'Laravel'),
                            'source'        => $token,
                            'metadata'      => array('chargetype'=>'ORDERPAYMENT','chargeref'=>$order_code)
                        ]);
                        //Stripe Charge
                        $transactionId = 'Transaction ID : '.$charge->id;

                    } elseif($request->payment_type == 'CASH') {

                        $charge = true;
                        $transactionId = '';

                    }

                    if($charge) {

                        //Create Payment  
                        $payment = $this->paymentRepository->create([
                          "user_id"     => auth()->id(),
                          "description" => trans("lang.payment_order_waiting").' '.$transactionId,
                          "price"       => Cart::getTotal(),
                          "status"      => 'Paid',
                          "method"      => $request->payment_type,
                        ]);
                        //Create Payment

                        //Insert Order
                        $order_data = array(
                          'order_code'          => $order_code,
                          'user_id'             => auth()->id(),
                          'order_status_id'     => 1,
                          'tax'                 => $taxPercent,
                          'payment_id'          => $payment->id,
                          'delivery_address_id' => $request->delivery_address,
                          'delivery_fee'        => array_sum($deliveryCharge),
                          'delivery_distance'   => array_sum($deliveryDistance),
                          'redeem_amount'       => array_sum($redeemValue),
                          'coupon_amount'       => array_sum($couponValue),
                          'contribution_amount' => array_sum($contributionValue),
                          'order_amount'        => Cart::getTotal()
                        );
                        $order = $this->orderRepository->create($order_data);
                        //Insert Order

                        //Insert Order Product
                        foreach (Cart::getContent() as $productOrder) {
                            $poData['price']       = $productOrder->price;
                            $poData['quantity']    = $productOrder->quantity;
                            $poData['product_id']  = $productOrder->attributes->id;
                            $poData['tax_percent'] = substr($productOrder->conditions->getValue(),1,-1);
                            $poData['tax_amount']  = $productOrder->conditions->parsedRawValue;
                            $poData['order_id']    = $order->id;
                            $poData['unit']        = $productOrder->attributes['unit'];
                            $proOrderdetails       = $this->productOrderRepository->create($poData);

                            //Insert Inventory item
                            $inventory_item   = array(
                                'purchase_invoice_id'               => $proOrderdetails->id,
                                'inventory_track_category'          => 'online_stock',
                                'inventory_track_type'              => 'reduce',
                                'inventory_track_date'              => date('Y-m-d'),
                                'inventory_track_product_id'        => $productOrder->attributes->id,
                                'inventory_track_product_quantity'  => $productOrder->quantity,
                                'inventory_track_product_uom'       => $productOrder->attributes['unit']
                            );
                            $insert_inventory = $this->inventoryRepository->create($inventory_item);
                            //Insert Inventory item

                            //Update Product Stock
                                CustomHelper::productCurrentstockupdate($productOrder->attributes->id,0,'0',$productOrder->quantity,$productOrder->attributes['unit'],'remove','insert');
                            //Update Product Stock
                        }
                        //Insert Order Product

                        //Reward Details
                        if($user_market->market_id && $user_market->market_id > 0) :
                            foreach(Cart::getConditionsByType('redeem') as $redeem) {
                                //Add Rewards Usage
                                    if($redeem->getAttributes()['redeem_points'] > 0 && $redeem->parsedRawValue > 0) {
                                        CustomHelper::addRewardusage(
                                            $user_market->market_id,
                                            $order->id,
                                            $redeem->parsedRawValue,
                                            $redeem->getAttributes()['redeem_points']
                                        );
                                    }
                                //Add Rewards Usage
                            }

                            //Update Rewards
                                //CustomHelper::purchaseRewards($user_market->market_id,Cart::getTotal(),$order->id);
                            //Update Rewards
                        endif;
                        //Reward Details    


                        if($order) {
                            
                          //Mail send
                             $users = DB::table('users')->where('id',auth()->id())->first();
                             $customer_mail = $users->email;
                             $customer_name = $users->name;
                            
                              $product_orders = DB::table('product_orders')->leftJoin('products', 'product_orders.product_id', '=', 'products.id')->where('order_id',$order->id)->get();
                              $order_delivery_address = DB::table('delivery_addresses')->where('id',$order->delivery_address_id)->first();
                             
                             $details = ['title' => 'Order Placed Notification Mail','body' => 'Order has been placed.','product_orders' => $product_orders,'order' => $order,'order_delivery_address' => $order_delivery_address,'customer_name' =>  $customer_name];
                            
                            \Mail::to($customer_mail)->send(new OrdersMail($details));
                            
                            //Notification::send($order->productOrders[0]->product->market->users, new NewOrder($order));
                            Cart::clear();
                            Cart::clearCartConditions();
                            return redirect(route('order-complete',$order->id));
                        }

                    } else {
                        $this->errors = 'Payment Failed';
                        return redirect(route('checkout'));
                    }    

                //Create Order

            } else {
                $this->errors = $validation->messages();
                return redirect(route('checkout'));
            }

        } else {

            $validator = $request->validate([
                'name'                  => 'required',
                'email'                 => 'required|unique:users,email',
                'gender'                => 'required',
                'date_of_birth'         => 'required',
                'mobile_no'             => 'required|numeric|digits:10',
                'password'              => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'description'           => 'required',
                'address_line_1'        => 'required',
                //'address_line_2'        => 'required',
                'city'                  => 'required',
                'state'                 => 'required',
                'pincode'               => 'required',
                'payment_type'          => 'required'

            ]); 
            if($validator) { 

                $referred_by = Cookie::get('referral');
                
                $user_data['name']          = $request->name;
                $user_data['email']         = $request->email;
                $user_data['roles']         = 'client';
                $user_data['password']      = Hash::make($request->password);
                $user_data['api_token']     = Str::random(60);
                $user_data['gender']        = $request->gender;
                $user_data['date_of_birth'] = date('Y-m-d',strtotime($request->date_of_birth));
                $user_data['affiliate_id']  = Str::random(6);
                $user_data['referred_by']   = $referred_by ? $referred_by : null;

                $user = $this->userRepository->create($user_data);

                if($user->id > 0) :
                    if($request->email!=null && $request->email!='') :
                    
                        
                        if($referred_by!='') {

                          $validate = $this->userRepository->where('affiliate_id',$referred_by)->get();
                          if(count($validate) > 0) {  } else { $referred_by=''; }

                           $input['user_id']        = $user->id;
                           $input['affiliate_id']   = $referred_by;
                           $input['point_type']     = 'referral';
                           $input['points']         = 1000;
                           $input['referee_mobile'] = $request->mobile;
                           $loyalityPoints          = $this->loyalityPointsRepository->create($input);
                           
                           //Update Points
                                CustomHelper::calculateRewards($referred_by); 
                           //Update Points 
                        }

                        $market_data['name']           = $request->name;
                        $market_data['code']           = CustomHelper::unique_code_generate('markets','GGPLPY');
                        $market_data['email']          = $request->email;
                        $market_data['mobile']         = $request->mobile_no;
                        $market_data['date_of_birth']  = date('Y-m-d',strtotime($request->date_of_birth));
                        $market_data['gender']         = $request->gender;
                        $market_data['type']           = 4;//'Reseller'
                        $market_data['address_line_1'] = $request->address_line_1;
                        $market_data['address_line_2'] = $request->address_line_2;
                        $market_data['city']           = $request->city;
                        $market_data['state']          = $request->state;
                        $market_data['pincode']        = $request->pincode;
                        $market_data['active']         = 1;

                        $market = $this->marketRepository->create($market_data);

                        if($user->id > 0) {
                            
                            $max_id = Order::max('id') + 1;
                            $order_code_prefix = "GGPL" . date('y') . (date('y') + 1) . "ID";
                             $order_code = null;
                            if ($max_id <= 9) {
                                $order_code = $order_code_prefix . "000000" . $max_id;
                            } else if ($max_id <= 99) {
                                $order_code = $order_code_prefix . "00000" . $max_id;
                            } else if ($max_id <= 999) {
                                $order_code = $order_code_prefix . "0000" . $max_id;
                            } else if ($max_id <= 9999) {
                                $order_code = $order_code_prefix . "000" . $max_id;
                            } else if ($max_id <= 99999) {
                                $order_code = $order_code_prefix . "00" . $max_id;
                            } else if ($max_id <= 999999) {
                                $order_code = $order_code_prefix . "0" .$max_id;
                            } else {
                                $order_code = $order_code_prefix . $max_id;
                            }

                            if($request->payment_type == 'CARD') {

                                $token = $request->stripeToken;
                                
                                //Stripe Charge
                                Stripe::setApiKey(setting('stripe_secret'));
                                $charge = Charge::create([
                                    'amount'        => number_format(Cart::getTotal(),setting('app_price_format'),'.','')*100,
                                    'currency'      => 'inr',
                                    'description'   => config('app.name', 'Laravel'),
                                    'source'        => $token,
                                    'metadata'      => array('chargetype'=>'ORDERPAYMENT','chargeref'=>$order_code)
                                ]);
                                //Stripe Charge
                                $transactionId = 'Transaction ID : '.$charge->id;

                            } elseif($request->payment_type == 'CASH') {

                                $charge = true;
                                $transactionId = '';

                            }

                            if($charge) {

                                $market_user['users'] = array($user->id);
                                $update_user          = $this->marketRepository->update($market_user, $market->id);
                                
                                //Notification mail sent
                                    $details = [
                                        'title' => 'Registeration Successfull',
                                        'body' => 'Your account has been created.',
                                        'customer_name' =>$request->name,
                                        'customer_mail' =>$request->email
                                    ];
                                    \Mail::to($request->email)->send(new UserRegisterationMail($details));
                                //Notification mail sent

                                //Create Delivery Address
                                    $addressData['description']    = $request->description;
                                    $addressData['address_line_1'] = str_replace(",", " ",$request->address_line_1);
                                    $addressData['address_line_2'] = str_replace(",", " ",$request->address_line_2);
                                    $addressData['city']           = str_replace(",", " ",$request->city);
                                    $addressData['pincode']        = $request->pincode;
                                    $addressData['state']          = str_replace(",", " ",$request->state);
                                    $addressData['latitude']       = $request->lat;
                                    $addressData['longitude']      = $request->lon;
                                    $addressData['user_id']        = $user->id;
                                    $deliveryAddress = $this->deliveryAddressRepository->create($addressData);
                                //Create Delivery Address

                                //Create Order

                                //$amount       += $order->delivery_fee;
                                //$amountWithTax = $amount + ($amount * $order->tax / 100);

                                //Amount Calcaulation    
                                $totalWithoutTax = [];
                                $totalTaxPercent = [];
                                foreach(Cart::getContent() as $cart_item) {
                                    $totalWithoutTax[] = $cart_item->getPriceSum();
                                    $totalTaxPercent[] = substr($cart_item->conditions->getValue(), 1, -1);
                                }
                                $tax_amount  = Cart::getSubTotal() - array_sum($totalWithoutTax);
                                $totalAmount = array_sum($totalWithoutTax);
                                if($totalAmount>0){
                                $taxPercent  = ($tax_amount / $totalAmount * 100);
                                }else{
                                 $taxPercent  = 0;    
                                }
                                //Amount Calcaulation
                                
                                //Coupon values
                                $couponValue[] = '';
                                foreach(Cart::getConditionsByType('coupon') as $coupon) {
                                    $couponValue[] = $coupon->parsedRawValue;
                                }
                                //Coupon values
                                
                                
                                //Contribution values
                                $contributionValue[] = '';
                                foreach(Cart::getConditionsByType('contribution') as $contribution) {
                                    $contributionValue[] = $contribution->parsedRawValue;
                                }
                                //Contribution values
                                
                                //Delivery charge
                                $deliveryCharge[] = '';
                                $deliveryDistance[] = '';
                                foreach(Cart::getConditionsByType('delivery') as $delivery) {
                                    $deliveryCharge[] = $delivery->parsedRawValue;
                                    $deliveryDistance[] = $delivery->getAttributes()['distance'];
                                }
                                //Delivery charge
                                
                                //Create Payment  
                                $payment = $this->paymentRepository->create([
                                  "user_id"     => $user->id,
                                  "description" => trans("lang.payment_order_waiting").' '.$transactionId,
                                  "price"       => Cart::getTotal(),
                                  "status"      => 'Paid',
                                  "method"      => $request->payment_type,
                                ]);
                                //Create Payment

                                //Insert Order Data
                                $order_data = array(
                                  'order_code'          => $order_code,    
                                  'user_id'             => $user->id,
                                  'order_status_id'     => 1,
                                  'tax'                 => $taxPercent,
                                  'payment_id'          => $payment->id,
                                  'delivery_address_id' => $deliveryAddress->id,
                                  'delivery_fee'        => array_sum($deliveryCharge),
                                  'delivery_distance'   => array_sum($deliveryDistance),
                                  'redeem_amount'       => 0,
                                  'coupon_amount'       => array_sum($couponValue),
                                  'contribution_amount' => array_sum($contributionValue),
                                  'order_amount'        => Cart::getTotal()
                                );
                                $order = $this->orderRepository->create($order_data);
                                //Insert Order Data

                                //Insert Order Products
                                foreach (Cart::getContent() as $productOrder) {
                                    $poData['price']       = $productOrder->price;
                                    $poData['quantity']    = $productOrder->quantity;
                                    $poData['product_id']  = $productOrder->attributes->id;
                                    $poData['tax_percent'] = substr($productOrder->conditions->getValue(),1,-1);
                                    $poData['tax_amount']  = $productOrder->conditions->parsedRawValue;
                                    $poData['order_id']    = $order->id;
                                    $poData['unit']        = $productOrder->attributes['unit'];
                                    $proOrderdetails       = $this->productOrderRepository->create($poData);

                                    //Insert Product Inventory
                                    $inventory_item   = array(
                                        'purchase_invoice_id'               => $proOrderdetails->id,
                                        'inventory_track_category'          => 'online_stock',
                                        'inventory_track_type'              => 'reduce',
                                        'inventory_track_date'              => date('Y-m-d'),
                                        'inventory_track_product_id'        => $productOrder->attributes->id,
                                        'inventory_track_product_quantity'  => $productOrder->quantity,
                                        'inventory_track_product_uom'       => $productOrder->attributes['unit']
                                    );
                                    $insert_inventory = $this->inventoryRepository->create($inventory_item);
                                    //Insert Product Inventory

                                    //Update Product Stock
                                        CustomHelper::productCurrentstockupdate($productOrder->attributes->id,0,'0',$productOrder->quantity,$productOrder->attributes['unit'],'remove','insert');
                                    //Update Product Stock
                                }
                                //Insert Order Products


                                //Reward Details
                                if($market->id && $market->id > 0) :
                                    //Update Rewards
                                        //CustomHelper::purchaseRewards($market->id,Cart::getTotal(),$order->id);
                                    //Update Rewards
                                endif;
                                //Reward Details


                                if($order) {
                                    
                                    //Mail send
                                     $customer_mail = $user_data['email'];
                                     $customer_name = $user_data['name'];

                                      $product_orders = DB::table('product_orders')->leftJoin('products', 'product_orders.product_id', '=', 'products.id')->where('order_id',$order->id)->get();
                                      $order_delivery_address = DB::table('delivery_addresses')->where('id',$order->delivery_address_id)->first();
                                     
                                     $details = ['title' => 'Order Placed Notification Mail','body' => 'Order has been placed.','product_orders' => $product_orders,'order' => $order,'order_delivery_address' => $order_delivery_address,'customer_name' =>  $customer_name];
                                    
                                    \Mail::to($customer_mail)->send(new OrdersMail($details));
                                    
                                    //Notification::send($order->productOrders[0]->product->market->users, new NewOrder($order));
                                    Cart::clear();
                                    Cart::clearCartConditions();
                                    Auth::attempt(
                                        ['email' => $user_data['email'], 'password' => $user_data['password']]
                                    );
                                    return redirect(route('order-complete',$order->id));
                                }
                                //Create Order

                            } else {
                                $this->errors = 'Payment Failed';
                                return redirect(route('checkout'));
                            }
                    
                        }
                        //Remove Cookie
                            Cookie::queue(Cookie::forget('referral'));
                        //Remove Cookie    
                    endif;
                endif;

            } else {
                $this->errors = $validation->messages();
                return redirect(route('checkout'));
            }
        }

        /**/

        /*$email = $request->email;
        if($email)*/

        //dd($request);
        /*$input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderRepository->model());
        try {
            $order = $this->orderRepository->create($input);
            $order->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.order')]));

        return redirect(route('orders.index'));*/
    }

    public function complete(Request $request,$id) {
        //$this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $order = $this->orderRepository->findWithoutFail($id);
        return view('checkout.success')->with('order', $order);
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     * @param ProductOrderDataTable $productOrderDataTable
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function show(ProductOrderDataTable $productOrderDataTable, $id)
    {
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));

            return redirect(route('orders.index'));
        }
        $subtotal = 0;

        foreach ($order->productOrders as $productOrder) {
            foreach ($productOrder->options as $option) {
                $productOrder->price += $option->price;
            }
            $subtotal += $productOrder->price * $productOrder->quantity;
        }

        $total = $subtotal + $order['delivery_fee'];
        $taxAmount = $total * $order['tax'] / 100;
        $total += $taxAmount;
        $productOrderDataTable->id = $id;

        return $productOrderDataTable->render('orders.show', ["order" => $order, "total" => $total, "subtotal" => $subtotal,"taxAmount" => $taxAmount]);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));

            return redirect(route('orders.index'));
        }

        $market = $order->productOrders()->first();
        $market = isset($market) ? $market->product['market_id'] : 0;

        $user = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('name', 'id');
        //$driver = $this->userRepository->getByCriteria(new DriversOfMarketCriteria($market))->pluck('name', 'id');
        $driver = $this->userRepository->getByCriteria(new DriversCriteria($market))->pluck('name', 'id');
        $orderStatus = $this->orderStatusRepository->pluck('status', 'id');


        $customFieldsValues = $order->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderRepository->model());
        $hasCustomField = in_array($this->orderRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('orders.edit')->with('order', $order)->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("driver", $driver)->with("orderStatus", $orderStatus);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));
            return redirect(route('orders.index'));
        }
        $oldStatus = $oldOrder->payment->status;
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderRepository->model());
        try {

            $order = $this->orderRepository->update($input, $id);

            if (setting('enable_notifications', false)) {
                if (isset($input['order_status_id']) && $input['order_status_id'] != $oldOrder->order_status_id) {
                    Notification::send([$order->user], new StatusChangedOrder($order));
                }

                if (isset($input['driver_id']) && ($input['driver_id'] != $oldOrder['driver_id'])) {
                    $driver = $this->userRepository->findWithoutFail($input['driver_id']);
                    if (!empty($driver)) {
                        Notification::send([$driver], new AssignedOrder($order));
                    }
                }
            }

            $this->paymentRepository->update([
                "status" => $input['status'],
            ], $order['payment_id']);
            //dd($input['status']);

            event(new OrderChangedEvent($oldStatus, $order));

            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $order->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.order')]));

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        if (!env('APP_DEMO', false)) {
            $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
            $order = $this->orderRepository->findWithoutFail($id);

            if (empty($order)) {
                Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));

                return redirect(route('orders.index'));
            }

            $this->orderRepository->delete($id);

            Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.order')]));


        } else {
            Flash::warning('This is only demo app you can\'t change this section ');
        }
        return redirect(route('orders.index'));
    }

    /**
     * Remove Media of Order
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $order = $this->orderRepository->findWithoutFail($input['id']);
        try {
            if ($order->hasMedia($input['collection'])) {
                $order->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
