<?php
/**
 * File name: RegisterController.php
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use App\Repositories\MarketRepository;
use App\Repositories\LoyalityPointsRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use CustomHelper;
use App\Mail\UserRegisterationMail;
use Str;
use Auth;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $userRepository;
    private $uploadRepository;
    private $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, MarketRepository $marketRepository, LoyalityPointsRepository $loyalityPointsRepo)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->marketRepository = $marketRepository;
        $this->loyalityPointsRepository = $loyalityPointsRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        $message = array(
            'email.unique' => 'Email already used!!',
            'password.min' => 'Password Length Should Be More Than 8 Character Or Digit Or Mix'
        );

        if(Cookie::get('referral')!='') {
            $refree_mobile = 'required';
        } else {
            $refree_mobile = '' ;
        }

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => $refree_mobile,
            'gender' => 'required|string',
            'date_of_birth' => 'required|date'
            /*'address_line_1' => 'string',
            'address_line_2' => 'string',
            'city' => 'string',
            'state' => 'string',
            'pincode' => 'string'*/
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return
     */
    protected function create(array $data)
    {   
        //Store referred person affiliate in variable
        $referred_by = Cookie::get('referral');
        
        //Create User
        $user = new User;
        $user->name =  $data['name'];
        $user->email =  $data['email'];
        $user->password = Hash::make($data['password']);
        $user->gender = $data['gender'];
        $user->date_of_birth = date('Y-m-d',strtotime($data['date_of_birth']));
        $user->api_token = Str::random(60);
        $user->affiliate_id = Str::random(6);
        $user->referred_by  = $referred_by ? $referred_by : null;
        $user->save();
        
        //Assign user role
        $defaultRoles = $this->roleRepository->findByField('default', '1');
        $defaultRoles = $defaultRoles->pluck('name')->toArray();
        $user->assignRole($defaultRoles);

        if($user->id > 0) {
            if($data['email']!=null && $data['email']!='') {
            
                
                if($referred_by!='') {
                  
                  //Validate user affilaite id    
                  $validate = $this->userRepository->where('affiliate_id',$referred_by)->get();
                  if(count($validate) > 0) {  } else { $referred_by=''; }

                   $input['user_id']        = $user->id;
                   $input['affiliate_id']   = $referred_by;
                   $input['point_type']     = 'referral';
                   $input['points']         = setting('app_referal_reward_points');
                   $input['referee_mobile'] = $data['mobile'];
                   $loyalityPoints          = $this->loyalityPointsRepository->create($input);
                   
                   //Update Points
                        CustomHelper::calculateRewards($referred_by); 
                   //Update Points 
                }

                $user_data['name']           = $data['name'];
                $user_data['code']           = CustomHelper::unique_code_generate('markets','GGPLPY');
                $user_data['email']          = $data['email'];
                $user_data['mobile']         = $data['mobile_no'];
                $user_data['date_of_birth']  = date('Y-m-d',strtotime($data['date_of_birth']));
                $user_data['gender']         = $data['gender'];
                $user_data['type']           = 1;//'Customer'

                $user_data['address_line_1'] = $data['address_line_1'];
                $user_data['address_line_2'] = $data['address_line_2'];
                $user_data['city']           = $data['city'];
                $user_data['state']          = $data['state'];
                $user_data['pincode']        = $data['pincode'];
                
                $user_data['active']         = 1;
                
                $user_data['created_via']    = 'website';
                
                //Create user market
                $market = $this->marketRepository->create($user_data);

                if($user->id > 0) {
                    $market_user['user_id']   = $user->id;
                    $market_user['market_id'] = $market->id;
                    $update_user = DB::table('user_markets')->insert($market_user);
                    
                    //Notification mail sent
                    $details = ['title' => 'Registeration Successfull','body' => 'Your account has been created.','customer_name' =>$data['name'],'customer_mail' =>$data['email']];
                    \Mail::to($data['email'])->send(new UserRegisterationMail($details));
            
                }

                //Remove Cookie
                    Cookie::queue(Cookie::forget('referral'));
                //Remove Cookie    
            }
        }
        
        //Auth::loginUsingId($user->id);
        //return redirect('/');

        return $user;
    }
}
