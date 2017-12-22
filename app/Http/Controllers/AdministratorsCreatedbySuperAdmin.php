<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Company;
use App\Role;
use Illuminate\Http\Request;
use Mail;
use App\mail\adminRegisterMail;
use Illuminate\Validation\Rule;

class AdministratorsCreatedbySuperAdmin extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth:superadmin');
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators=Admin::all();
         return view('superadmin.administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $company=Company::all();
         $role=Role::all();
         return view('superadmin.administrators.create', compact('company','role'));
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
           'name'=>'required|string|max:255',
           'email'=>'required|string|email|max:255|unique:admins',
           'password'=>'required|string|min:6|confirmed',
           'company_id'=>'required',
           'roleadmin'=>'required'
         ]);
      
      $adminrole=Admin::create([
          'name'=>request('name'),
          'email'=>request('email'),
          'password'=> bcrypt(request('password')),
          'company_id'=>request('company_id')
          ]);
      $adminrole->save();    

        $roles=request('roleadmin');
        $adminrole->role()->attach($roles);

        Mail::send(new adminRegisterMail());
        return redirect('/superadmin/administrators');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=Admin::find($id);
        $company=Company::all();
        $role=Role::all();
        $adminroles=$admin->role;
        return view('superadmin.administrators.edit', compact('admin','company','role','adminroles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   

        $admin=Admin::find($id);

        $role=Role::all();
        $this->validate($request,[
           'name'=>'required|string|max:255',
           'email'=>['required','string','email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
           'company_id'=>'required',
           'roleadmin'=>'required'
         ]);
        
       $admin->name=$request->name;
       $admin->company_id=$request->company_id;
       $admin->email=$request->email;
       
       $admin->save();  
       
       foreach($role as $value){
          $roleid[]=$value->id;
        }
       
        $admin->role()->detach($roleid);
        $roles=request('roleadmin');
        $admin->role()->attach($roles);

      return redirect('/superadmin/administrators');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $admin=Admin::find($id);
         $admin->delete();
         return redirect('/superadmin/administrators');
    }
}
