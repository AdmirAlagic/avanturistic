<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    
</head>
<body style="background:#fbfbfb;min-height:120px;">
 
   

    <table class="wrapper" width="100%" cellpadding="0" align="center"  cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
        <tr>
            <td align="center">
                <table class="content" align="center" style="width:100%;padding:1em;text-align: center;max-width:570px;background:#FFFFFF;color:#474747;font-family: 'Montserrat',sans-serif;" cellpadding="0" cellspacing="0" >
                    <!-- Email Body -->
                    <tr>
                        <td class="body"  align="center" cellpadding="0" cellspacing="0">
                            <table class="wrapper" width="100%" cellpadding="0" align="center"  cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <tr>
                                    <td  align="center" style="text-align:center;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:800;">
                                            
                                        <a href="https://avanturistic.com" target="_blank"  style="text-decoration:none;vertical-align:middle;">
                                            <img src="{{ url('/img/logo.png') }}" alt="" width="30" height="30" style="width: 30px;">&nbsp; 
                                        </a>
                                        <a  href="https://avanturistic.com" target="_blank" style="font-size:1.5rem;padding-top:15px;color:#474747;text-decoration:none;vertical-align:middle;letter-spacing:2px;">
                                            <b>Avanturistic</b>
                                        </a>
                                        <p style="color:#999999;font-size:0.99rem;margin-top:0px;padding-top: 0px;padding-left: 3px;font-weight:100;font-family: 'Montserrat',sans-serif;letter-spacing: 1px;padding-left:3px;">A network for adventure</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>

    <table class="wrapper" width="100%" cellpadding="0" align="center"  cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;padding-top:1rem;">
        <tr>
            <td align="center">
                <table class="content" align="center" style="width:100%;padding:2em;text-align: center;border-radius:4px;border:1px solid #eeeeee; max-width:570px;background:#FFFFFF;font-family: 'Montserrat',sans-serif;" cellpadding="0" cellspacing="0" >
                    <!-- Email Body -->
                    <tr>
                        <td class="body"  align="center" cellpadding="0" cellspacing="0">
                            @yield('content')
                        </td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
 
    <table class="wrapper" width="100%" cellpadding="0" align="center"  cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;padding-top:1rem;margin-bottom:1rem;">
        <tr>
            <td align="center">
                <table class="content" align="center" style="width:100%;padding:2em;text-align: center;border-radius:4px;border:1px solid #eeeeee; max-width:570px;background:#FFFFFF;font-family: 'Montserrat',sans-serif;" cellpadding="0" cellspacing="0" >
                    <!-- Email Body -->
                    <tr>
                        <td class="body"  align="center" cellpadding="0" cellspacing="0">
                            <table class="table" style="width:100%padding:2em;">
                                <tbody>
                               
                                <tr>
                                    <td style="font-size:12px;" valign="top" align="center" style="text-align:center;font-family: 'Montserrat',sans-serif;">
                                    <br>
                                                <a target="_blank" href="https://www.facebook.com/avanturistic" style="text-decoration:none;font-family: 'Montserrat',sans-serif;">
                                                    <img src="{{ url('/img/social/facebook-square.png') }}"  alt="Avanturistic on Facebook" style="height: 28px;">
                                                </a>
                                                &nbsp;
                                                <a target="_blank" href="https://www.instagram.com/avanturistic.com.app" style="text-decoration:none;">
                                                    <img  src="{{ url('/img/social/instagram.png') }}"   alt="Avanturistic on Instagram"  style="height: 28px;">
                                                </a>
                                                <br><br>
                                                <a href="mailto:info@avanturistic.com" style="color:#999;text-decoration:none;font-family: 'Montserrat',sans-serif;font-size:0.8rem;">
                                                info@avanturistic.com
                                                </a>
                                                <br>
                                              
                                                <a style="color:#999999;text-decoration:none;font-family: 'Montserrat',sans-serif;" href="https://www.avanturistic.com/">
                                                https://www.avanturistic.com</a>
                                                </small>
                                                <br>
                                                <small>
                                               <a style="color:#999;" href="{{ url('/email-preferences') }}">
                                                Unsubscribe</a>
                                                </small>
                                                <br> 
                                                <br>
                                                <p style="font-family: 'Montserrat',sans-serif;"><small>Copyright © {{ date('Y')}} <b>Avanturistic</b> <br> All rights reserved.</small></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
    
     
</body>
</html>