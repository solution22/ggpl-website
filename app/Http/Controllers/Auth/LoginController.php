<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;

use App\Repositories\MarketRepository;
use App\Repositories\LoyalityPointsRepository;

use Socialite;
use Illuminate\Http\Request;
use Redirect;
use View;
use Hash;
use App\Models\User;
use DB;
use Auth;
use Cookie;
use Str;
use CustomHelper;

//use App\Mail\UserRegisterationMail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->userRepository   = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository   = $roleRepository;
        $this->marketRepository = $marketRepository;
        $this->loyalityPointsRepository = $loyalityPointsRepo;
    }
    
    
    //Facebook Redirect

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //Facebook Redirect


    //Facebook Callback

    public function handleFacebookCallback()
    {
        try {
            $facebook_login = Socialite::driver('facebook')->user();
            $validateLogin = DB::table('users')->orWhere('social_login_id',$facebook_login->getId())->orWhere('email',$facebook_login->email)->get();
            if(count($validateLogin) > 0) {
                //Initiate login attempt
                Auth::loginUsingId($validateLogin[0]->id);
                return redirect('/');
            } else {                              

                $referred_by = Cookie::get('referral');

                $user = new User;
                $user->name             = $facebook_login->name;
                $user->email            = $facebook_login->email;
                $user->password         = '';
                $user->gender           = '';
                $user->date_of_birth    = date('d-m-Y');
                $user->api_token        = Str::random(60);
                $user->affiliate_id     = Str::random(6);
                $user->referred_by      = $referred_by ? $referred_by : null;
                $user->social_login_id  = $facebook_login->id;
                $user->save();
                
                //Assign user rol
                $defaultRoles = $this->roleRepository->findByField('default', '1');
                $defaultRoles = $defaultRoles->pluck('name')->toArray();
                $user->assignRole($defaultRoles);
        
                if($user->id > 0) {
                    if($facebook_login->email!=null && $facebook_login->email!='') {
                        
                        if($referred_by!='') {
        
                          $validate = $this->userRepository->where('affiliate_id',$referred_by)->get();
                          if(count($validate) > 0) {  } else { $referred_by=''; }
        
                           $input['user_id']        = $user->id;
                           $input['affiliate_id']   = $referred_by;
                           $input['point_type']     = 'referral';
                           $input['points']         = setting('app_referal_reward_points');
                           $input['referee_mobile'] = '';
                           $loyalityPoints          = $this->loyalityPointsRepository->create($input);
                           
                           //Update Points
                                CustomHelper::calculateRewards($referred_by); 
                           //Update Points 
                        }
        
                        $user_data['name']           = $user->name;
                        $user_data['code']           = CustomHelper::unique_code_generate('markets','GGPLPY');
                        $user_data['email']          = $user->email;
                        $user_data['mobile']         = '';
                        $user_data['date_of_birth']  = date('Y-m-d',strtotime($user->date_of_birth));
                        $user_data['gender']         = '';
                        $user_data['type']           = 1;//'Customer'
        
                        $user_data['active']         = 1;                
                        $user_data['created_via']    = 'website';
        
                        $market = $this->marketRepository->create($user_data);
        
                        if($user->id > 0) {
                            $market_user['user_id']   = $user->id;
                            $market_user['market_id'] = $market->id;
                            $update_user = DB::table('user_markets')->insert($market_user);
                            
                            //Notification mail sent
                            $details = ['title' => 'Registeration Successfull','body' => 'Your account has been created.','customer_name' =>$user->name,'customer_mail' =>$user->email];
                            //\Mail::to($user->email)->send(new UserRegisterationMail($details));
                    
                        }
        
                        //Remove Cookie
                            Cookie::queue(Cookie::forget('referral'));
                        //Remove Cookie    
                    }
                }
                
                Auth::loginUsingId($user->id);
                return redirect('/');
                //return $user;

            }

        } catch (Exception $e) {
            return redirect('login/facebook');
        }
    }

    //Facebook Callback
    
    //Google Redirect

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //Google Redirect
    
    //Google Callback

    public function handleGoogleCallback()
    {
        try {
            $google_login = Socialite::driver('google')->user();
            $validateLogin = DB::table('users')->orWhere('social_login_id',$google_login->getId())->orWhere('email',$google_login->email)->get();
            if(count($validateLogin) > 0) {
                //Initiate login attempt
                Auth::loginUsingId($validateLogin[0]->id);
                return redirect('/');
            } else {                              

                $referred_by = Cookie::get('referral');

                $user = new User;
                $user->name             = $google_login->name;
                $user->email            = $google_login->email;
                $user->password         = '';
                $user->gender           = '';
                $user->date_of_birth    = date('d-m-Y');
                $user->api_token        = Str::random(60);
                $user->affiliate_id     = Str::random(6);
                $user->referred_by      = $referred_by ? $referred_by : null;
                $user->social_login_id  = $google_login->id;
                $user->save();
                
                //Assign user role
                $defaultRoles = $this->roleRepository->findByField('default', '1');
                $defaultRoles = $defaultRoles->pluck('name')->toArray();
                $user->assignRole($defaultRoles);
        
                if($user->id > 0) {
                    if($google_login->email!=null && $google_login->email!='') {
                        
                        if($referred_by!='') {
        
                          $validate = $this->userRepository->where('affiliate_id',$referred_by)->get();
                          if(count($validate) > 0) {  } else { $referred_by=''; }
        
                           $input['user_id']        = $user->id;
                           $input['affiliate_id']   = $referred_by;
                           $input['point_type']     = 'referral';
                           $input['points']         = setting('app_referal_reward_points');
                           $input['referee_mobile'] = '';
                           $loyalityPoints          = $this->loyalityPointsRepository->create($input);
                           
                           //Update Points
                                CustomHelper::calculateRewards($referred_by); 
                           //Update Points 
                        }
        
                        $user_data['name']           = $user->name;
                        $user_data['code']           = CustomHelper::unique_code_generate('markets','GGPLPY');
                        $user_data['email']          = $user->email;
                        $user_data['mobile']         = '';
                        $user_data['date_of_birth']  = date('Y-m-d',strtotime($user->date_of_birth));
                        $user_data['gender']         = '';
                        $user_data['type']           = 1;//'Customer'
        
                        $user_data['active']         = 1;                
                        $user_data['created_via']    = 'website';
        
                        $market = $this->marketRepository->create($user_data);
        
                        if($user->id > 0) {
                            $market_user['user_id']   = $user->id;
                            $market_user['market_id'] = $market->id;
                            $update_user = DB::table('user_markets')->insert($market_user);
                            
                            //Notification mail sent
                            $details = ['title' => 'Registeration Successfull','body' => 'Your account has been created.','customer_name' =>$user->name,'customer_mail' =>$user->email];
                            //\Mail::to($user->email)->send(new UserRegisterationMail($details));
                    
                        }
        
                        //Remove Cookie
                            Cookie::queue(Cookie::forget('referral'));
                        //Remove Cookie    
                    }
                }
                
                Auth::loginUsingId($user->id);
                return redirect('/');
                //return $user;

            }

        } catch (Exception $e) {
            return redirect('login/google');
        }
    }

    //Google Callback
    
}
