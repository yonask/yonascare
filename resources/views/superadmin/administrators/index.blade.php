@extends('layouts.superadmin.superadmin-template')
@section('action-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Administrators</div>
                 <div class="text-right"> 
                 <a class="block" href="/superadmin/administrators/create"> Add Item </a>
              </div>
                <div class="panel-body">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

             <p class="left col-md-3"><strong>Admin Name</strong></p>
             <p class="left col-md-3"><strong>Admin Email</strong></p>
             <p class="left col-md-2"><strong>Company Name</strong></p>
             <p class="left col-md-2">&nbsp;</p>
             <p class="left col-md-2">&nbsp;</p>
        @foreach($administrators as $value)
             <div class="clear">
             <p class="left col-md-3">{{$value->name}} </p>
             <p class="left col-md-3">{{$value->email}} </p>
             <p class="left col-md-2">{{$value->companies->company_name}} </p>
             <p class="left col-md-2"> <a href="/superadmin/administrators/{{$value->id}}/edit "> Edit </a> </p>
             <form class="left col-md-2"  method="POST" action="/superadmin/administrators/{{$value->id}}">
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
