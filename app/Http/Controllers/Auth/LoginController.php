<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\CompanyEmailDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/home';

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('guest')->except('logout');
        }

        protected function validator(array $data)
            {
              return Validator::make($data, [
                         'name' => 'required|max:255',
                         'email' => 'required|email|max:255',
                         'password' => 'required|confirmed|min:6',
                     ]);

            }
        protected function create(array $data)
            {
                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                ]);
            }

        public function createUser($user)
        {
             $authUser = User::where('google_id', $user->id)->first(); //check if user login using google account
             $useremail = User::where('email', $user->email)->first(); // check if login using email and password 
             
            if($authUser)
            {
                return $authUser;
            }
            if($useremail){
                $useremail->name =$user->name;
                $useremail->email = $user->email;
                $useremail->google_id = $user->id;
                $useremail->avatar = $user->avatar;
                $useremail->save();
                return $useremail;
            }
            return User::create([
                 'name'=>$user->name,
                 'google_id'=>$user->id,
                 'email'=>$user->email,
                 'avatar'=>$user->avatar,
                ]);
        }


        /**
         * Redirect the user to the google authentication page.
         *
         * @return \Illuminate\Http\Response
         */
        public function redirectToProvider()
        {
            return Socialite::driver('google')->redirect();
        }

        /**
         * Obtain the user information from google.
         *
         * @return \Illuminate\Http\Response
         */
        public function handleProviderCallback()
        {
            try {
               $user = Socialite::driver('google')->stateless()->user();
            } catch(Exception $e){
                return redirect('auth.google');
            }
                $domain = $domain_name = substr(strrchr($user->email, "@"), 1);
                $domainexist = CompanyEmailDomain::where('emaildomain', $domain)->first();
            if($domainexist)
            {
                $authUser=$this->createUser($user);
                Auth::login($authUser, true);
                return redirect()->route('home');
            }
            return redirect('/login')->with('status', 'Sorry, the company not register!');
             //$domain = $domain_name = substr(strrchr($user->email, "@"), 1);
             //return $domain;
        }


 /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');

        return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];
    }



}
