<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyEmailDomain;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyEmailDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:superadmin');
       
    }
    public function index()
    {
        $company=Company::all();
        $companyemaildomain=CompanyEmailDomain::all();
       return view('superadmin.emaildomain.index', compact('company', 'companyemaildomain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $company=Company::all();
         return view('superadmin.emaildomain.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
           'emaildomain'=>'required|string|max:255|unique:company_email_domains',
           'companyname'=>'required|string|max:255'   
        ]);

        $comapnyemaildomain=CompanyEmailDomain::create([
          'emaildomain'=>request('emaildomain'),
          'company_id'=>request('companyname')
          
        ]);
        $comapnyemaildomain->save();
        return redirect('/superadmin/emaildomain');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompnayEmailDomain  $compnayEmailDomain
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEmailDomain $companyEmailDomain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompnayEmailDomain  $compnayEmailDomain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyemaildomain=CompanyEmailDomain::find($id);
        $company=Company::all();
         return view('superadmin.emaildomain.edit', compact('companyemaildomain','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompnayEmailDomain  $compnayEmailDomain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $companyemaildomain=CompanyEmailDomain::find($id);
          $this->validate($request,[
           'emaildomain'=>['required','string','max:255', Rule::unique('company_email_domains')->ignore($companyemaildomain->emaildomain,'emaildomain')],
           'company_name'=>'required'   
        ]);



          $companyemaildomain->emaildomain=request('emaildomain');
          $companyemaildomain->company_id=request('company_name');
          $companyemaildomain->save();
          return redirect('/superadmin/emaildomain');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompnayEmailDomain  $compnayEmailDomain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyemaildomain=CompanyEmailDomain::find($id);
        $companyemaildomain->delete();
        return redirect('/superadmin/emaildomain');
    }
}
