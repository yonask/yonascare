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

              
       <form method="POST" action="/superadmin/company/{{$company->id}}">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                     
                
                     <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }} row">
                          <label for="formcompany_name" class="col-md-2 control-label">Company Name</label>
                          
                          <div class="col-md-9">  
                            <input type="text" class="form-control" id="forcompany_name" name="company_name" value="{{$company->company_name}}" >
                            
                            @if ($errors->has('company_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                            @endif
                          </div>
                   </div>

                    
                     <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }} row">
                          <label for="formphone_number" class="col-md-2 control-label">Phone Number</label>
                          
                          <div class="col-md-9">  
                            <input type="number" class="form-control" id="forphone_number" name="phone_number" value="{{$company->phone_number}}" >
                            
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
