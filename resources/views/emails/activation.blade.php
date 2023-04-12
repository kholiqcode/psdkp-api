@component('mail::message')
    # Activation Email

    Hi {{ $user->name }}

    Your OTP Code is **{{ $user->otp }}**.

    Please enter the OTP Code to activate your account.

    Thanks,<br>
    PSDKP
@endcomponent
