@extends('layouts.email')
@section('content')

<tr>
    <td width="100%" cellpadding="0" cellspacing="0">
        <table align="center" cellpadding="0" cellspacing="0" style="text-align:center;font-family:'Montserrat', sans-serif;color:#333;font-family: 'Montserrat',sans-serif;">
            <!-- Body content -->
            <h1 style="font-size:1.2rem;color:#111111;font-family: 'Montserrat',sans-serif;">Confirm Your Account</h1>
            
            <p style="font-size:0.9rem;">
            Please click the button below to verify your email address.
            </p>
            <table align="center" cellpadding="0" cellspacing="0" style="box-sizing: border-box;text-align-center;">
            <a href="{{ $verificationUrl }}" style="margin-top:1rem;margin-bottom:1rem;display:inline-block;width: fit-content;font-size:0.9rem;padding:10px; padding-left:15px;padding-right:15px; background-color:#b4d677; font-family:'Montserrat', sans-serif;border-radius:4px;color:#FFFFFF;text-decoration:none;">
                Verify Email Address
            </a>
            </table>
            <p style="font-size:0.7rem;font-family: 'Montserrat',sans-serif;">
                If you did not create an account, no further action is required.
            </p>
            
            <p style="font-size:0.9rem;">
                Regards,<br>
                Avanturistic
            </p>
            <hr style="border-bottom:1px solid #eeeeee;border-top:0px;margin-top:3rem;margin-bottom:1rem;">
            <p style="text-align:center;">
                <small style="color:#999999;font-size:0.7rem;font-family: 'Montserrat',sans-serif;">
                If you’re having trouble clicking the "Verify Email Address" button,<br> copy and paste the 
                URL below into your web browser:  <a href="{{ $verificationUrl }}" style="box-sizing: border-box;color:#999999;overflow-wrap: break-word;word-wrap: break-word;-ms-word-break: break-all;word-break: break-all;-ms-hyphens: auto;-moz-hyphens: auto;-webkit-hyphens: auto;hyphens: auto;">
                {{ $verificationUrl }}
                        </a>
                        </small>
                        </p>

        </table>
    </td>
</tr>
 
@endsection