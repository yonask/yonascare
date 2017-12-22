<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyAdminController extends Controller
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('companyadmin',['except'=>'test']);
    }
   
   public function index()
   {
   	return view('admin.companyadmin');
   }

   public function test(){
    return view('admin.test');
   }

   public function test2(){
     return view('admin.test2');
   }
}
