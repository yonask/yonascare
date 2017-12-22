<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Company;
//use App\Role;


class adminRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {

        //$rolename=Role::find();
        $companyname=Company::find($request->company_id);
        return $this->markdown('adminemail',['name'=>$request->name,'password'=>$request->password,'email'=>$request->email,'companyname'=> $companyname->company_name,])->to($request->email)->from('do-not-reply@yonas.care');
    }
}
