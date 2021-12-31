<?php
/**
 * File name: UserController.php
 * Last modified: 2020.05.04 at 12:15:13
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\DataTables\StaffsDataTable;
use App\Events\UserRoleChangedEvent;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use App\Repositories\LoyalityPointsRepository;
use App\Repositories\CustomerGroupsRepository;
use App\Repositories\DeliveryAddressRepository;
use App\Repositories\MarketRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\ProductOrderRepository;
use App\Repositories\PaymentRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use Cookie;
use DB;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    private $loyalityPointsRepository;

    private $CustomerGroupsRepository;

    private $uploadRepository;

    private $deliveryAddressRepository;

    /** @var  MarketRepository */
    private $marketRepository;

    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderStatusRepository */
    private $orderStatusRepository;

    /** @var  ProductOrderRepository */
    private $productOrderRepository;

    /** @var  PaymentRepository */
    private $paymentRepository;
    

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, UploadRepository $uploadRepo, CustomerGroupsRepository $CustomerGroupsRepo, LoyalityPointsRepository $loyalityPointsRepo, DeliveryAddressRepository $deliveryAddressRepo, MarketRepository $marketRepo, OrderRepository $orderRepo, OrderStatusRepository $orderStatusRepo, ProductOrderRepository $productOrderRepo, PaymentRepository $paymentRepo)
    {
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->CustomerGroupsRepository = $CustomerGroupsRepo;
        $this->loyalityPointsRepository = $loyalityPointsRepo;
        $this->uploadRepository = $uploadRepo;
        $this->deliveryAddressRepository = $deliveryAddressRepo;
        $this->marketRepository = $marketRepo;
        $this->orderRepository = $orderRepo;
        $this->orderStatusRepository = $orderStatusRepo;
        $this->productOrderRepository = $productOrderRepo;
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a user profile.
     *
     * @param
     * @return Response
     */
    public function profile()
    {
        $user = $this->userRepository->findWithoutFail(auth()->id());
        unset($user->password);
        $customFields = false;
        $role = $this->roleRepository->pluck('name', 'name');

        $customer_groups        = $this->CustomerGroupsRepository->pluck('name', 'id');
        $CustomerGroupsSelected = [];

        $user_markets = DB::table('user_markets')
                            ->join('markets','user_markets.market_id','=','markets.id')
                            ->where('user_markets.user_id',$user->id)
                            ->first();
        if($user_markets) {
            auth()->user()->address_line_1 = $user_markets->address_line_1;
            auth()->user()->address_line_2 = $user_markets->address_line_2;
            auth()->user()->city           = $user_markets->city;
            auth()->user()->state          = $user_markets->state;
            auth()->user()->pincode        = $user_markets->pincode;
            auth()->user()->mobile         = $user_markets->mobile;
        }

        $rolesSelected = $user->getRoleNames()->toArray();
        
        return view('settings.users.profile', compact(['user', 'role', 'rolesSelected', 'customer_groups','CustomerGroupsSelected']));
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $role = $this->roleRepository->pluck('name', 'name');
        $customer_groups = $this->CustomerGroupsRepository->pluck('name', 'id');

        $rolesSelected = [];
        $CustomerGroupsSelected = [];
        $hasCustomField = in_array($this->userRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
            $html = generateCustomField($customFields);
        }

        return view('settings.users.create')
            ->with("role", $role)
            ->with("customer_groups", $customer_groups)
            ->with("customFields", isset($html) ? $html : false)
            ->with("rolesSelected", $rolesSelected)
            ->with("CustomerGroupsSelected", $CustomerGroupsSelected);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if (env('APP_DEMO', false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('users.index'));
        }

        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());

        $input['roles'] = isset($input['roles']) ? $input['roles'] : [];
        $input['password'] = Hash::make($input['password']);
        $input['api_token'] = str_random(60);

        try {
            $user = $this->userRepository->create($input);
            $user->syncRoles($input['roles']);
            $user->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

            if (isset($input['avatar']) && $input['avatar']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['avatar']);
                $mediaItem = $cacheUpload->getMedia('avatar')->first();
                $mediaItem->copy($user, 'avatar');
            }
            event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success('saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('settings.users.profile')->with('user', $user);
    }

    public function loginAsUser(Request $request, $id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        auth()->login($user, true);
        if (auth()->id() !== $user->id) {
            Flash::error('User not found');
        }
        return redirect(route('users.profile'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasRole('admin') && $id != auth()->id()) {
            Flash::error('Permission denied');
            return redirect(route('users.index'));
        }
        $user = $this->userRepository->findWithoutFail($id);
        unset($user->password);
        $html = false;
        $role = $this->roleRepository->pluck('name', 'name');
        $customer_groups = $this->CustomerGroupsRepository->pluck('name', 'id');
        $CustomerGroupsSelected = $user['customer_group_id'];
        $rolesSelected = $user->getRoleNames()->toArray();
        $customFieldsValues = $user->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
        $hasCustomField = in_array($this->userRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        return view('settings.users.edit')
            ->with('user', $user)->with("role", $role)
            ->with("rolesSelected", $rolesSelected)
            ->with("customer_groups", $customer_groups)
            ->with("CustomerGroupsSelected", $CustomerGroupsSelected)
            ->with("customFields", $html);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        if (!auth()->user()->hasRole('admin') && $id != auth()->id()) {
            Flash::error('Permission denied');
            return redirect(route('users.profile'));
        }

        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.profile'));
        }
        //$customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());

        $input = $request->all();
        if (!auth()->user()->can('permissions.index')) {
            unset($input['roles']);
        } else {
            $input['roles'] = isset($input['roles']) ? $input['roles'] : [];
        }
        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        try {
            $user = $this->userRepository->update($input, $id);

            $user_market = DB::table('user_markets')->where('user_id',$id)->first();
            if($user_market) {
               $market_data = array(
                    'name'              => $input['name'],
                    'email'             => $input['email'],
                    'gender'            => $input['gender'],
                    'date_of_birth'     => $input['date_of_birth'],
                    'address_line_1'    => $input['address_line_1'],
                    'address_line_2'    => $input['address_line_2'],
                    'city'              => $input['city'],
                    'state'             => $input['state'],
                    'pincode'           => $input['pincode'],
                    'mobile'            => $input['mobile']
               ); 
               $update_market = $this->marketRepository->update($market_data,$user_market->market_id);
            }   

            if (empty($user)) {
                Flash::error('User not found');
                return redirect(route('users.profile'));
            }
            if (isset($input['avatar']) && $input['avatar']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['avatar']);
                $mediaItem = $cacheUpload->getMedia('avatar')->first();
                $mediaItem->copy($user, 'avatar');
            }
            if (auth()->user()->can('permissions.index')) {
                $user->syncRoles($input['roles']);
            }
            /*foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $user->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }*/
            //event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }


        Flash::success('Profile updated successfully.');

        return redirect()->back();

    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (env('APP_DEMO', false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('users.index'));
        }
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove Media of User
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        if (env('APP_DEMO', false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
        } else {
            if (auth()->user()->can('medias.delete')) {
                $input = $request->all();
                $user = $this->userRepository->findWithoutFail($input['id']);
                try {
                    if ($user->hasMedia($input['collection'])) {
                        $user->getFirstMedia($input['collection'])->delete();
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
    }

    public function changePassword() {
        return view('settings.users.change_password');
    }

    public function validateReferralLink($code) {
        $validate = $this->userRepository->where('affiliate_id',$code)->get();
        if(count($validate) > 0) {
            Cookie::queue('referral', $code, 60);
            return redirect()->route('register');
        } else {
            Cookie::queue(Cookie::forget('referral'));
            return redirect()->route('register');
        }
    }

    public function rewards() {
        //$rewards = $this->loyalityPointsRepository->where('affiliate_id',Auth()->user()->affiliate_id)->get();
        
        $t_datas  = DB::table('loyality_points_tracker')
                        ->where('affiliate_id',Auth()->user()->affiliate_id)
                        ->select(
                            'user_id',
                            'point_type',
                            'points',
                            'purchase_id as sales_code',
                            'created_at'
                        );
        $rewards  = DB::table('loyality_point_usage')
                        ->where('user_id',Auth()->id())
                        ->select(
                            'user_id',
                            'point_type',
                            'usage_points as points',
                            'order_id as sales_code',
                            'created_at'
                        )
                        ->union($t_datas)
                        ->orderBy('created_at','asc')
                        ->get();
        
        return view('settings.users.rewards')->with('rewards',$rewards);
    }

    public function deliveryAddress() {
        $deliveryAddress = $this->deliveryAddressRepository->where('user_id',auth()->id())->get();
        return view('settings.users.delivery_address')
                    ->with('deliveryAddress',$deliveryAddress);
    }

    public function orders() {
        $orders   = $this->orderRepository
                        ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
                        ->where('user_id',auth()->id())
                        ->orderBy('orders.id','desc')
                        ->select('orders.*','order_statuses.status')
                        ->get();
        foreach($orders as $key => $value) {
            $dAddress              = $this->deliveryAddressRepository->findWithoutFail($orders[$key]->delivery_address_id);
            $orders[$key]->address = $dAddress;
            $orders[$key]->items   = $this->productOrderRepository->where('order_id',$orders[$key]->id)->count();
            //$orders[$key]->totalAmount = $this->paymentRepository->
        }
        $order_status              = $this->orderStatusRepository->get();              
        return view('settings.users.orders')
                    ->with('order_statuses',$order_status)
                    ->with('orders',$orders);
    }

    public function orderDetail($order_id) { 
        $order    = $this->orderRepository
                        ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
                        ->where('user_id',auth()->id())
                        ->where('orders.id',$order_id)
                        ->select('orders.*','order_statuses.status')
                        ->first();
        $dAddress = $this->deliveryAddressRepository->findWithoutFail($order->delivery_address_id);
        $order->address = $dAddress;
        $order_status   = $this->orderStatusRepository->get();

        $product_orders = $this->productOrderRepository
                            ->join('products','product_orders.product_id','=','products.id')
                            ->where('product_orders.order_id',$order->id)
                            ->select(
                                'product_orders.*',
                                'products.name as name',
                                'products.bar_code as code',
                                'products.unit as unit',
                                'products.hsn_code as hsn_code'
                            )
                            ->get();
        return view('settings.users.order')
                    ->with('order',$order)
                    ->with('order_statuses',$order_status)
                    ->with('product_orders',$product_orders);
    }
    
    public function orderTracking() {
        return view('settings.users.order_tracking');
    }
    
    public function orderTrack() {
        
        $order_id = $_GET['order_id'];
        $order    = $this->orderRepository
                        ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
                        ->where('orders.order_code',$order_id)
                        ->select('orders.*','order_statuses.status')
                        ->first();
        if($order) {                
                        
            $dAddress = $this->deliveryAddressRepository->findWithoutFail($order->delivery_address_id);
            $order->address = $dAddress;
            $order_status   = $this->orderStatusRepository->get();

            $product_orders = $this->productOrderRepository
                            ->join('products','product_orders.product_id','=','products.id')
                            ->where('product_orders.order_id',$order->id)
                            ->select(
                                'product_orders.*',
                                'products.name as name',
                                'products.bar_code as code',
                                'products.unit as unit',
                                'products.hsn_code as hsn_code'
                            )->get();
                            
            return view('settings.users.order_track')
                    ->with('order',$order)
                    ->with('order_statuses',$order_status)
                    ->with('product_orders',$product_orders);
                    
        } else {
           return redirect()->back()->with('message','Invalid Order ID'); 
        }
    }

}
