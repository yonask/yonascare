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

                <form method="POST" action="/superadmin/administrators/{{$admin->id}}">
                {{csrf_field()}}
                 {{method_field('PUT')}}

                   
                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="formAdminName" class="col-md-2 control-label">Admin Name</label>
                        
                        <div class="col-md-9">  
                          <input type="text" class="form-control" id="formAdminName" name="name" placeholder="Admin Name" value="{{$admin->name}}" >
                          
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
                            <input type="email" class="form-control" id="foremail" name="email" placeholder="Admin Email" value="{{$admin->email}}" >
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                       </div>

               

                       <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }} row">
                        <label for="formcompanyname" class="col-md-2 control-label"> Company Name</label>
                        
                        <div class="col-md-9 radio">  
                        @foreach($company as $value)  
                             <label class="radio-inline">
                              <input type="radio" name="company_id" value="{{$value->id}}" 
                              @if($admin->company_id == $value->id)
                               checked="checked"
                              @endif
                             >
                           
                              {{$value->company_name}}</label>
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
                              <input type="checkbox" name="roleadmin[]" value="{{$value->id}}" 
                               @foreach($adminroles as $adminvalue)
                                  @if($adminvalue->id == $value->id)
                                   checked
                                  @endif  
                               @endforeach
                              >{{$value->name}}</label>
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
                                  Update
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
