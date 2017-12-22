@extends('layouts.superadmin.superadmin-template')
@section('action-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Email Domain</div>
                <div class="panel-body">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <form method="POST" action="/superadmin/emaildomain">
                {{csrf_field()}}
                 

                      

                 <div class="form-group{{ $errors->has('emaildomain') ? ' has-error' : '' }} row">
                   <label for="formEmailDomain" class="col-md-2 control-label"> Email Domain</label>
                 
                   <div class="col-md-9">  
                     <input type="text" class="form-control" id="formName" name="emaildomain" placeholder="Email Domain" value="{{ old('emaildomain') }}" required>
                     
                     @if ($errors->has('emaildomain'))
                         <span class="help-block">
                             <strong>{{ $errors->first('emaildomain') }}</strong>
                         </span>
                     @endif
                   </div>
                </div>



                 <div class="form-group{{ $errors->has('companyname') ? ' has-error' : '' }} row">
                   <label for="formcompanyname" class="col-md-2 control-label"> Company Name</label>
                   
                   <div class="col-md-9 radio">  
                   @foreach($company as $value)  
                        <label class="radio-inline">
                         <input type="radio" name="companyname" value="{{$value->id}}" required>{{$value->company_name}}</label>
                   @endforeach 

                     @if ($errors->has('companyname'))
                         <span class="help-block">
                             <strong>{{ $errors->first('companyname') }}</strong>
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
