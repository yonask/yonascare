<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class SuperAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
         $company=Company::all();
       return view('superadmin.company.index', compact('company'));
        //return view('superadmin.home');
    }

    public function create()
    {
        // return view('superadmin.company.create');
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'company_nam'=>'required',
        //     'email_domain'=>'required',
        //     'phone_number'=>'required'

        //     ]);

        // $name= request('company_nam');

        //  Company::create([
        //         'company_name'=>$name,
        //         'email_domain'=>request('email_domain'),
        //         'phone_number'=>request('phone_number')

        //     ]);

        //   return redirect('/superadmin');
    }

}
