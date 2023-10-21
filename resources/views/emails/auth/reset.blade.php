<x-mail::message>
Blood-Bank reset password <br>
Hello {{ $name }},

<p>Your Reset password is <b style="color: green"> {{ $code }} </b></p>

Thanks,
{{ config('app.name') }}
</x-mail::message>
