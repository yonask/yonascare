@extends('layouts.superadmin.superadmin-template')
@section('action-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Creating a Company</div>
                <div class="panel-body">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <form method="POST" action="/superadmin/company">
                {{csrf_field()}}
              
               <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }} row">
                    <label for="formCompanyName" class="col-md-2 control-label"> Company Name</label>
                    
                    <div class="col-md-9">  
                      <input type="text" class="form-control" id="formName" name="company_name" placeholder="Compnay Name" value="{{ old('company_name') }}" required>
                      
                      @if ($errors->has('company_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('company_name') }}</strong>
                          </span>
                      @endif
                    </div>
                 </div>
                   
                  
                  <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} row">
                    <label for="formPhoneNumber" class="col-md-2 control-label"> Phone Number</label>
                    
                    <div class="col-md-9">  
                      <input type="text" class="form-control" id="formName" name="phone_number" placeholder="phone_number" value="{{ old('phone_number') }}" required>
                      
                      @if ($errors->has('phone_number'))
                          <span class="help-block">
                              <strong>{{ $errors->first('phone_number') }}</strong>
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
