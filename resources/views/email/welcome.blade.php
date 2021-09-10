@extends('layouts.email')
@section('content')

<tr>
    <td width="100%" cellpadding="0" cellspacing="0">
        <table align="center" cellpadding="0" cellspacing="0">
            <!-- Body content -->
            <h1 style="font-size:1.2rem;color:#111111;font-family: 'Montserrat',sans-serif;">
                 Welcome to Avanturistic
            </h1>
            <p style="font-size:0.9rem;font-family: 'Montserrat',sans-serif;">Hi <em><b>{{ $user->name }}</b></em>, welcome to the network of nature lovers and outdoor enthusiasts.   We are looking forward to see your favorite adventure locations.</p>
            <hr style="border-bottom:1px solid #eeeeee;border-top:0px;margin-top:3rem;margin-bottom:1rem;font-family: 'Montserrat',sans-serif;">
            <small>
            <p  style="font-size:0.9rem;font-family: 'Montserrat',sans-serif;">If you have any questions or idea to share you can contact us directly through the <a style="color:#acc957;" href="https://avanturistic.com/support">support chat</a>.</p></small>
        </table>
    </td>
</tr>
<tr>
    <td align="center" style="padding-top:2em;font-size:14px;#">
        <p  style="font-size:0.9rem;font-family: 'Montserrat',sans-serif;">
            Sincerely,<br>
            <strong>Avanturistic team</strong>
        </p>
       
    </td>
</tr>
@endsection