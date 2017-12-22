@component('mail::message')
# Welcome 

Dear {{$name}}, we register you as admin in YonasCare System for {{$companyname}} company. <br>

You user name is:{{$email}} <br>
You current password is :{{$password}} <br>

Please set a new password by loging to your account.


@component('mail::button', ['url' => 'http://127.0.0.1:8000/admin'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
