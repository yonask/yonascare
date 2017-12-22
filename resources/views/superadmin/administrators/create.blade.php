@extends('layouts.superadmin.superadmin-template')
@section('action-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Creating Administrators</div>
                <div class="panel-body">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <form method="POST" action="/superadmin/administrators">
                {{csrf_field()}}
                 

                   
                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="formAdminName" class="col-md-2 control-label">Admin Name</label>
                        
                        <div class="col-md-9">  
                          <input type="text" class="form-control" id="formAdminName" name="name" placeholder="Admin Name" value="{{ old('name') }}" >
                          
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                     </div>


                     <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                          <label for="formemail" class="col-md-2 control-label">Admin Email</label>
                          
                          <div class="col-md-9">  
                            <input type="email" class="form-control" id="foremail" name="email" placeholder="Admin Email" value="{{ old('email') }}" >
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                       </div>

                     

                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                         <label for="password" class="col-md-2 control-label">Password</label>

                         <div class="col-md-9">
                             <input id="password" type="password" class="form-control" name="password" >

                             @if ($errors->has('password'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

                         <div class="col-md-9">
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                         </div>
                     </div>

                       <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }} row">
                        <label for="formcompanyname" class="col-md-2 control-label"> Company Name</label>
                        
                        <div class="col-md-9 radio">  
                        @foreach($company as $value)  
                             <label class="radio-inline">
                              <input type="radio" name="company_id" value="{{$value->id}}" >{{$value->company_name}}</label>
                        @endforeach 

                          @if ($errors->has('company_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('company_id') }}</strong>
                              </span>
                          @endif
                        </div>
                     </div> 

                       <div class="form-group{{ $errors->has('roleadmin') ? ' has-error' : '' }} row">
                        <label for="formroleadmin" class="col-md-2 control-label">Admin Role</label>
                        
                        <div class="col-md-9 checkbox">  
                        @foreach($role as $value)  
                             <label class="checkbox-inline">
                              <input type="checkbox" name="roleadmin[]" value="{{$value->id}}" >{{$value->name}}</label>
                        @endforeach 

                          @if ($errors->has('roleadmin'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('roleadmin') }}</strong>
                              </span>
                          @endif
                        </div>
                     </div> 

                      <div class="form-group row">
                          <div class="col-md-9 col-md-offset-2">
                              <button type="submit" class="btn btn-primary">
                                  Register
                              </button>
                          </div>
                     </div>                   
                </form>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
