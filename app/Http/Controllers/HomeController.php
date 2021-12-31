<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WebToPay;
use WebToPayException;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\WebsiteSlideRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\ProductReviewRepository;
use App\Repositories\CouponRepository;
use App\Repositories\LoyalityPointsRepository;
use App\Repositories\DeliveryAddressRepository;
use App\Repositories\WebsiteTestimonialsRepository;
use App\Repositories\SpecialOffersRepository;
use App\Repositories\DeliveryZonesRepository;
use App\Repositories\SubscriptionRepository;
use Session;
use Cart;
use DB;
use Cookie;
use App\Models\Product;
use App\Models\Favorite;
use App\Mail\ContactEnquiryMail;
use App\Mail\VolunteerSubscribeMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var WebsiteSlideRepository
     */
    private $websiteSlideRepository;
    /**
     * @var FavoriteRepository
     */
    private $favoriteRepository;
    /**
     * @var ProductReviewRepository
     */
    private $productReviewRepository;
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var LoyalityPointsRepository
     */
    private $loyalityPointsRepository;

    /**
     * @var DeliveryAddressRepository
     */
    private $deliveryAddressRepository;

    /**
     * @var WebsiteTestimonialsRepository
     */
    private $websiteTestimonialsRepository;

    /**
     * @var SpecialOffersRepository
     */
    private $specialOffersRepository;
    
    /**
     * @var DeliveryZonesRepository
     */
    private $deliveryZonesRepository;
    
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepo, ProductRepository $productRepo, WebsiteSlideRepository $websiteSlideRepo, FavoriteRepository $favoriteRepo, ProductReviewRepository $productReviewRepo, CouponRepository $couponRepo, LoyalityPointsRepository  $loyalityPointsRepo, DeliveryAddressRepository $deliveryAddressRepo, WebsiteTestimonialsRepository $websiteTestimonialsRepo, SpecialOffersRepository $specialOffersRepo, DeliveryZonesRepository $deliveryZonesRepo, SubscriptionRepository $subscriptionRepo)
    {
        $this->categoryRepository       = $categoryRepo;
        $this->productRepository        = $productRepo;
        $this->websiteSlideRepository   = $websiteSlideRepo;
        $this->favoriteRepository       = $favoriteRepo;
        $this->productReviewRepository  = $productReviewRepo;
        $this->couponRepository         = $couponRepo;
        $this->loyalityPointsRepository = $loyalityPointsRepo;
        $this->deliveryAddressRepository= $deliveryAddressRepo;
        $this->websiteTestimonialsRepository = $websiteTestimonialsRepo;
        $this->specialOffersRepository  = $specialOffersRepo; 
        $this->deliveryZonesRepository  = $deliveryZonesRepo;
        $this->subscriptionRepository   = $subscriptionRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $products           = $this->productRepository
                                ->where('deliverable','1')
                                ->where('online_store','1')
                                ->where('stock','>','0')
                                ->limit(8)->get();
        $deals              = $this->productRepository
                                ->where('deliverable','1')
                                ->where('online_store','1')
                                ->where('stock','>','0')
                                ->where('discount_price','>','0')
                                ->limit(20)->get();                        
                                
        //foreach($products as $product) {
            //$selectedCategory  = $this->categoryRepository->findWithoutFail($product->category_id);
            //$product->category = ($selectedCategory) ? $selectedCategory->name : '' ;
            //$product->favorite = $this->favoriteRepository->where('product_id',$product->id)->where('user_id',auth()->id())->first();
        //}
        $recommend_products = $this->productRepository->where('deliverable','1')->where('online_store','1')->get();
        $slides             = $this->websiteSlideRepository->where('enabled','1')->get();
        $testimonial        = $this->websiteTestimonialsRepository->get();
        return view('home')
                ->with('products',$products)
                ->with('deals',$deals)
                ->with('recommend_products',$recommend_products)
                ->with('testimonials',$testimonial)
                ->with('slides',$slides);
    }

    public function about()
    {
        return view('about.index');
    }

    public function contact()
    {                     
        return view('contact.index');
    }

    public function products()
    {   
        $search      = isset($_GET['search']) ? $_GET['search'] : '' ;
        $price       = isset($_GET['price']) ? $_GET['price'] : '' ;
        $category    = isset($_GET['category']) ? $_GET['category'] : '' ;
        if($price!='') {
            $datas = explode('-', $price);
            $from  = $datas[0];
            $to    = $datas[1];
        } else {
            $from  = 0;
            $to    = 0;
        }
        

        $data    = $this->productRepository
                            ->where('deliverable','1')
                            ->where('online_store','1')
                            ->where('stock','>','0')
                            ->where('name', 'like', '%' . $search . '%');
        
        if($category > 0) {
            //Select product by category
            $data->where('category_id',$category);
        }
        if($from > 0 && $to > 0) {
            //Select product by discount price
            $data->whereBetween('discount_price',[$from, $to]);
        }
        $products = $data->paginate(4);

        foreach($products as $product) {
            //Add Category by product
            $selectedCategory = $this->categoryRepository->findWithoutFail($product->category_id);
            $product->category = ($selectedCategory) ? $selectedCategory->name : '' ;
            $product->favorite = $this->favoriteRepository->where('product_id',$product->id)->where('user_id',auth()->id())->first();
        }
        $max_price = $this->productRepository->max('discount_price');
        $min_price = $this->productRepository->min('discount_price');
        return view('product.index')
                ->with('max_price',$max_price)
                ->with('min_price',$min_price)
                ->with('products',$products);
    }

    public function wishlist(Request $request) {
        $favourites    = $this->favoriteRepository->where('user_id',auth()->user()->id)->get();      
        if(count($favourites) > 0) {
            //Add Product favorites cookie
            Cookie::queue('favourites', count($favourites), 60);
        }
        return view('wishlist.index')->with('favourites',$favourites);
    }
    
    public function checkout(Request $request) {
        $deliveryAddress = $this->deliveryAddressRepository->where('user_id',auth()->id())->get();
        return view('checkout.index')
                ->with('deliveryAddress',$deliveryAddress);
    }

    public function apply_coupon(Request $request) {
        $coupon_code = $request->coupon_code;
        $coupon = $this->couponRepository->where('code',$coupon_code)->where('enabled','1')->first();
        if($coupon_code!='') {    
            if(Cart::getTotalQuantity() > 0) {
                //Check coupon true
                if($coupon) {
                   //Validate Coupon expiry date
                   if(strtotime($coupon->expires_at) > strtotime(date('Y-m-d H:i:s'))) {
                       //Discount type validation
                       if($coupon->discount_type=='percent' && $coupon->discount > 0) {

                            $coupon_data = new \Darryldecode\Cart\CartCondition(array(
                                'name'   => $coupon->code,
                                'type'   => 'coupon',
                                'target' => 'total',
                                'value'  => '-'.$coupon->discount.'%',
                                'order'  => 1,
                                'attributes' => array (
                                    'discount' => $coupon->discount.'%'    
                                )
                            ));
                            //Apply the coupon
                            Cart::condition($coupon_data);
                            $message = 'Coupon Applied'; 

                       } elseif($coupon->discount_type=='fixed' && $coupon->discount > 0) {

                            $coupon_data = new \Darryldecode\Cart\CartCondition(array(
                                'name'   => $coupon->code,
                                'type'   => 'coupon',
                                'target' => 'total',
                                'value'  => '-'.$coupon->discount,
                                'order'  => 1,
                                'attributes' => array (
                                    'discount' => number_format($coupon->discount,'2','.','')    
                                )
                            ));
                            //Apply the coupon
                            Cart::condition($coupon_data);
                            $message = 'Coupon Applied';      

                       } else {
                          $message = 'Invalid Coupon';  
                       }
                   } else {
                      $message = 'Coupon Expired';  
                   }
                } else {
                   $message = 'Invalid Coupon Code';     
                }
            } else {
                $message = 'Please add the Products to basket!';
            }
        } else {
            $message = 'Please Enter the Coupon code!';
        }
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$coupon]);//$this->sendResponse($coupon, $message);   
    }  


    public function redeemPoints(Request $request) {
        $points       = $request->redeem;
        $reedem_value = $points / 100;
        if($points > 0) {
            //Validate user points with available points
            if(auth()->user()->points >= $points) {
                if($points >= 100) {

                        $redeem_data = new \Darryldecode\Cart\CartCondition(array(
                            'name'   => 'Redeem Points',
                            'type'   => 'redeem',
                            'target' => 'total',
                            'value'  => '-'.$reedem_value,
                            'order'  => 1,
                            'attributes' => array (
                                'discount' => setting('default_currency').''.number_format($reedem_value,'2','.',''),
                                'redeem_points' => $points 
                            )
                        ));
                        //Apply Redeem
                        Cart::condition($redeem_data);
                        $data    = $reedem_value;
                        $message = 'Redeem points applied!';

                } else {
                    $data    = 0;
                    $message = 'Please enter the points above 100';
                }
            } else {
                $data    = 0;
                $message = "Please enter Points below ".auth()->user()->points."";
            }
            
        } else {
            $data    = 0;
            $message = 'Invalid Points';
        }
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$data]);//return $this->sendResponse($data, $message);
    }  

    public function remove_coupon() {
        $coupon  = Cart::removeConditionsByType('coupon');
        $message = 'Coupon Removed!!';
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$coupon]);//return $this->sendResponse($coupon, $message);
    }

    public function remove_redeem() {
        $redeem  = Cart::removeConditionsByType('redeem');
        $message = 'Redeem Points Removed!!';
        return $this->sendResponse($redeem, $message);
    }    
    
    public function showCategoryProduct($category_id,$category_slug) {

        $price       = isset($_GET['price']) ? $_GET['price'] : '' ;
        if($price!='') {
            $datas = explode('-', $price);
            $from  = $datas[0];
            $to    = $datas[1];
        } else {
            $from  = 0;
            $to    = 0;
        }

        $data        = $this->productRepository
                            ->where('deliverable','1')
                            ->where('online_store','1')
                            ->where('stock','>','0')
                            ->where('category_id',$category_id);
        if($from > 0 && $to > 0) {
            $data->whereBetween('discount_price',[$from, $to]);
        } 
        $products    = $data->paginate(4);

        foreach($products as $product) {
            $selectedCategory = $this->categoryRepository->findWithoutFail($product->category_id);
            $product->category = ($selectedCategory) ? $selectedCategory->name : '' ;
            $product->favorite = $this->favoriteRepository->where('product_id',$product->id)->where('user_id',auth()->id())->first();
        }
        $max_price = $this->productRepository->where('category_id',$category_id)->max('discount_price');
        $min_price = $this->productRepository->where('category_id',$category_id)->min('discount_price');
        return view('category.index')
                ->with('products',$products)
                ->with('max_price',$max_price)
                ->with('min_price',$min_price)
                ->with('category',$this->categoryRepository->findWithoutFail($category_id))
                ->with('category_name',ucfirst(str_replace('_', ' ', $category_slug)));
    }
    
    
    public function showProduct($product_id,$product_slug) {
        $product           = $this->productRepository->findWithoutFail($product_id);
        $selectedCategory  = $this->categoryRepository->findWithoutFail($product->category_id);
        $product->category = ($selectedCategory) ? $selectedCategory->name : '' ;
        $product->favorite = $this->favoriteRepository->where('product_id',$product->id)->where('user_id',auth()->id())->first();
        $product_review    = $this->productReviewRepository
                                ->join('users','users.id','=','product_reviews.user_id')
                                ->where('product_id',$product->id)
                                ->where('active',1)
                                ->select('product_reviews.*','users.name')
                                ->get();
        $rating            = $this->productReviewRepository
                                ->join('users','users.id','=','product_reviews.user_id')
                                ->where('product_id',$product->id)
                                ->select('product_reviews.*','users.name')
                                ->sum('product_reviews.rate');
        
        $related           = $this->productRepository
                                ->where('deliverable','1')
                                ->where('online_store','1')
                                ->where('stock','>','0')
                                ->where('category_id',$product->category_id)
                                ->where('id','!=',$product->id)
                                ->limit(10)->get();                        

        return view('product.single_product')
                ->with('product',$product)
                ->with('rating',$rating)
                ->with('related',$related)
                ->with('product_review',$product_review);
    }

    public function socialResponsibility() {
        return view('social_responsibility.index'); 
    }

    public function specialOffers() {

        $data    = $this->productRepository
                            ->where('deliverable','1')
                            ->where('online_store','1')
                            ->where('stock','>','0')
                            ->where('discount_price','>','0');
        $products = $data->get();
        $specialOffers = $this->specialOffersRepository->get();
        foreach($products as $product) {
            $selectedCategory  = $this->categoryRepository->findWithoutFail($product->category_id);
            $product->category = ($selectedCategory) ? $selectedCategory->name : '' ;
            $product->favorite = $this->favoriteRepository->where('product_id',$product->id)->where('user_id',auth()->id())->first();
        }
        return view('special_offers.index')
                ->with('deals',$products)
                ->with('specialoffers',$specialOffers);
    }

    public function volunteerWithus() {
        return view('volunteer_withus.index'); 
    }

    public function volunteerForm(Request $request) {

         $validator = $request->validate([
            'name'                  => 'required',
            'email'                 => 'required',
            'gender'                => 'required',
            'date_of_birth'         => 'required',
            'mobile_no'             => 'required',
            'address_line_1'        => 'required',
            'address_line_2'        => 'required',
            'city'                  => 'required',
            'state'                 => 'required',
            'pincode'               => 'required'
        ]); 
        if($validator) { 
            
            $details = [
                'title' => 'New Volunteer Subscription ',
                'body' => 'New Volunteer Subscription.',
                'name' => $request->name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'email' =>  $request->email,
                'mobile_no' =>  $request->mobile_no,
                'address_line_1' =>  $request->address_line_1,
                'address_line_2' =>  $request->address_line_2,
                'city' =>  $request->city,
                'state' =>  $request->state,
                'pincode' =>  $request->pincode
            ];
            \Mail::to('docllp.gowtham@gmail.com')->send(new VolunteerSubscribeMail($details));
            return redirect(route('volunteer-with-us'))->with('message', 'Thank you for Subscribe!!. We will get back to you soon.');
                
        } else {
            $this->errors = $validation->messages();
            return redirect(route('volunteer-with-us'));
        }   
    } 

    public function contactForm(Request $request) {
        $validator = $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email',
            'mobile_no'             => 'required',
            'message'               => 'required'
        ]); 
        if($validator) { 
            
            $details = ['title' => 'New Contact Enquiry','body' => 'New Enquiry.','name' => $request->name,'mobile_no' => $request->mobile_no,'email' => $request->email,'message' =>  $request->message];
            \Mail::to('docllp.gowtham@gmail.com')->send(new ContactEnquiryMail($details));
            return redirect(route('contact-us'))->with('message', 'Your enquired has been submitted sucessfully. We will get back to you soon.');
            
        } else {
            $this->errors = $validation->messages();
            return redirect(route('contact-us'));
        }            
    } 
    
    public function subscribeForm(Request $request) {
        $validator = $request->validate([
            'email' => 'required|email',
        ]); 
        if($validator) { 
            $validate = $this->subscriptionRepository->where('email',$request->email)->get();
            if(count($validate) == 0) {
                $subscription = $this->subscriptionRepository->create(['email'=>$request->email]);
                return redirect()->back()->with('message', 'Thank you for Subscription!!');
            } else {
                return redirect()->back()->with('message', 'Already Subscribed!!');
            }
            /*$details = [
                'title' => 'New Contact Enquiry',
                'body' => 'New Enquiry.',
                'email' => $request->ema,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'message' =>  $request->message
            ];
            \Mail::to('docllp.gowtham@gmail.com')->send(new ContactEnquiryMail($details));*/
            //return redirect()->back()->with('message', 'Thank you for Subscription!!');
            
        } else {
            $this->errors = $validation->messages();
            return redirect()->back();
        }            
    } 

    public function faq() {
        return view('faq.index'); 
    }  

    public function privacyPolicy() {
        return view('privacy_policy.index'); 
    }

    public function termsConditions() {
        return view('terms_and_conditions.index'); 
    }  
    
    public function calculateDeliveryCharge(Request $request) {
        
        $distance_result   = $request->data['rows'][0]['elements'][0];
        $distance_in_meter = $distance_result['distance']['value'];
        $distance_duration = $distance_result['duration']['text'];
        $distance_in_km    = $distance_in_meter / 1000;
        //$delivery_charge   = $distance_in_km * 2; 
        $deliveryZones     = $this->deliveryZonesRepository->get();
        
        $delivery_charge   = 0;
        if(count($deliveryZones) > 0) {
            foreach ($deliveryZones as $key1 => $value) {
                if($distance_in_km >= $value->distance) {
                   $delivery_charge = $value->delivery_charge;
                }
            }                
        }
        if($distance_result) {
            if($distance_in_km > 0 && $distance_in_km <= 150) {
                
                
                $delivery_charge_data = new \Darryldecode\Cart\CartCondition(array(
                    'name'   => 'Delivery Charge',
                    'type'   => 'delivery',
                    'target' => 'total',
                    'value'  => '+'.$delivery_charge,
                    'order'  => 1,
                    'attributes' => array (
                        'delivery' => setting('default_currency').''.number_format($delivery_charge,'2','.',''),
                        'duration' => $distance_duration,
                        'distance' => $distance_in_km,
                        'id'       => $request->id
                    )
                ));
                Cart::condition($delivery_charge_data);
                $data    = $delivery_charge;
                $message = 'Delivery charge applied!';
                
            } else {
                
                Cart::removeCartCondition('Delivery Charge');
                $data    = 0;
                $message = 'Delivery Not Available on selected location. Please Select or Add the address below 150 KM'; 
                
            }
        } else {
            Cart::removeCartCondition('Delivery Charge');
            $data    = 0;
            $message = 'Delivery Not Available on selected location'; 
        }
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$data]);
        
    }


    public function cart() {
        return view('cart.index');
    }

    public function paymentGateway() {
        return view('layouts.stripe');
    }

    public function cartTotals() {
        return view('layouts.checkout_total');
    }

    public function cartUpdate(Request $request) {
        $count = count($request->product_id);
        for($i=0; $i<$count; $i++) :

            $datas   = explode('-', $request->product_id[$i]);
            $product = $this->productRepository->where('id',$datas[0])->first();
            if($product->stock >= $request->quantity[$i]) {
                Cart::update($request->product_id[$i], array( 
                    'quantity' => array(
                      'relative' => false,
                      'value' => $request->quantity[$i]
                    ),
                ));    
            } else {

            }
        endfor;
        
        if(Cart::getTotalQuantity() > 0) {
            //Contribution
                $contribution_data = new \Darryldecode\Cart\CartCondition(array(
                    'name'   => 'Charity Contribution',
                    'type'   => 'contribution',
                    'target' => 'total',
                    'value'  => '+'.(setting('app_charity_contribution') * count(Cart::getContent()) ),
                    'order'  => 2
                ));
                Cart::condition($contribution_data);
            //Contribution
        }
        return redirect()->back();
    }
    
    public function remove_contribution() {
        $contribution  = Cart::removeConditionsByType('contribution');
        $message       = 'Contribution Removed!!';
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$contribution]);//return $this->sendResponse($coupon, $message);
    }

}
