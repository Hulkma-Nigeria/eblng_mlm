@component('vendor.mail.html.layout')
@if ($type == 'approved')
## Application Approved

Your application to become a **General** on emosbest.com has been approved
Below are you account logon credentials.{{'   '}}
Username : {{$data['username']}}{{'   '}}
Password : {{$data['password']}}

@component('vendor.mail.html.button', ['url' => 'http://emosbest.com/user/login'])
Click here to login
@endcomponent
@else
## Application Declined

Your application to become a **General** on emosbest.com has been declined.
You can continue with a **member** account, click link below to register
@component('vendor.mail.html.button', ['url' => 'http://emosbest.com/user/register'])
Register now
@endcomponent
@endif



Thanks,<br>
{{config('app.name')}}
@endcomponent
