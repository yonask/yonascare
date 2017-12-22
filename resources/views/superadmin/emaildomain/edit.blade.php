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

           <form method="POST" action="/superadmin/emaildomain/{{$companyemaildomain->id}}">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
              
                 
                 <div class="form-group{{ $errors->has('emaildomain') ? ' has-error' : '' }} row">
                          <label for="formemaildomain" class="col-md-2 control-label">Email Domain</label>
                          
                          <div class="col-md-9">  
                            <input type="text" class="form-control" id="foremaildomain" name="emaildomain" value="{{$companyemaildomain->emaildomain}}" >
                            
                            @if ($errors->has('emaildomain'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emaildomain') }}</strong>
                                </span>
                            @endif
                          </div>
                   </div>


                     <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }} row">
                      <label for="formcompanyname" class="col-md-2 control-label"> Company Name</label>
                      
                      <div class="col-md-9 radio">  
                      @foreach($company as $value)    
                         <label class="radio-inline"><input type="radio" name="company_name" 
                          value="{{$value->id}}"
                            @if($companyemaildomain->company_id == $value->id)
                                   checked="checked" 
                            @endif

                          > 
                          {{$value->company_name}} </label>
                       @endforeach 

                        @if ($errors->has('company_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_name') }}</strong>
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
