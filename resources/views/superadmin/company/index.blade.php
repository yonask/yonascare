@extends('layouts.superadmin.superadmin-template')
@section('action-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Company Page</div>
                 <div class="text-right"> 
                 <a class="block" href="/superadmin/company/create"> Add Item </a>
              </div>
                <div class="panel-body">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            
             <p class="left col-md-4"><strong>Company Name</strong></p>
             <p class="left col-md-4"><strong>Phone Number</strong></p>
             <p class="left col-md-2">&nbsp;</p>
             <p class="left col-md-2">&nbsp;</p>             
        @foreach($company as $value)
             <div class="clear">
             <p class="left col-md-4">{{$value->company_name}} </p>
             <p class="left col-md-4">{{$value->phone_number}} </p>
             <p class="left col-md-2"> <a href="/superadmin/company/{{$value->id}}/edit "> Edit </a> </p>
             <form class="left col-md-2"  method="POST" action="/superadmin/company/{{$value->id}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
              <button type="submit" value="delete"> delete</button> 
            </form>
            </div>
          @endforeach
                
               
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
