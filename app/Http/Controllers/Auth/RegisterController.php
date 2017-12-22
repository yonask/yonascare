<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\CompanyEmailDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyUserRegisterEmailnew;
use Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data , CompanyEmailDomain $domainexist)
    {
        Session::flash('status', 'Registered! But verify your email to activate your account');
         $useremail = User::where('email', $data['email'])->first();
         if($useremail){
          
          if($useremail->registrationflag == 1){
             return redirect('/login')->with('status', 'The user is already exist!');
          }
            $useremail->name =$data['name'];
            $useremail->email = $data['email'];
            $useremail->password = bcrypt($data['password']);
            $useremail->status = 0;
            $useremail->verifyToken = Str::random(40);
            $useremail->company_id=$domainexist->company_id;
            $useremail->registrationflag = 1;
            $useremail->save();
            $user= $useremail;
       
         }
        else{
              
        $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->verifyToken = Str::random(40);
                $user->company_id = $domainexist->company_id;
                $user->registrationflag = 1;
                $user->save();
        }
        
        $thisUser=User::findOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
    }



    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $domain = $domain_name = substr(strrchr($request->email, "@"), 1);
        $domainexist = CompanyEmailDomain::where('emaildomain', $domain)->first();
        //dd($domainexist->company_id);
        if($domainexist){
        event(new Registered($user = $this->create($request->all(), $domainexist)));

        //$this->guard()->login($user);
        return redirect(route('login'));



        return $this->registered($request, $user) ?: redirect($this->redirectPath());
        }

        return redirect('/register')->with('status', 'Sorry, the company not register!');
    }


    public function sendEmail($thisUser)
    {
         Mail::to($thisUser['email'])->send(new verifyUserRegisterEmailnew($thisUser));
    }

    public function verifyEmailFirst()
    {
        return view('verifyemail');
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email'=> $email, 'verifyToken' => $verifyToken]) ->first();
        //return $user;
       if($user){
          User::where(['email'=> $email, 'verifyToken' => $verifyToken])->update(['status'=>'1','verifyToken'=>NULL]);
          
          return redirect('/login')->with('status', 'Thank you for confirming your account, you can login now !');

       }
       else {
        return "user not found"; 
       }
    }


}
