<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
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
       return view('superadmin.company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name'=>'required|string|max:255|unique:companies',
            'phone_number'=>'required|numeric'

            ]);

        Company::create([
                'company_name'=>request('company_name'),
                'phone_number'=>request('phone_number')

            ]);

          return redirect('/superadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $company = Company::find($id);
      return view('superadmin.company.edit', compact('company'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         $company= Company::find($id);
          // dd( $company);
        $this->validate($request, [
            'company_name'=> ['required','string','max:255', Rule::unique('companies')->ignore($company->company_name,'company_name')],
            'phone_number'=>'required'
            ]);
        
      

       $company->company_name=$request->company_name;
       $company->phone_number=$request->phone_number;
      
       $company->save();
       return redirect('/superadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::find($id);
        $company->delete();
        return redirect('/superadmin');
    }
}
