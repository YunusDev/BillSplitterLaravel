@component('mail::message')
{{--    Hello {{$user->name}}--}}

    {{--@component('mail::panel')--}}
        {{--Hello {{$user->name}}--}}
        {{--<div>--}}
            {{--<p>Welcome to our platform click the link below to register your email address.</p>--}}

        {{--</div>--}}
    {{--@endcomponent--}}


    @component('mail::button', ['url' => $user->frontend_url])
        Confirm Email
    @endcomponent

    {{--Welcome, <br>--}}

{{--    {{ config('app.name') }}--}}

@endcomponent