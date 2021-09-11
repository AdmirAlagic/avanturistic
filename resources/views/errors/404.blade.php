@extends('layouts.app')

@section('content')
<style>
    #kt_header,#kt_header_mobile, #kt_footer{
       display:none !important;
    }
    .full-width-bg{
        height:100vh;
        padding-top:5vh;
    }
    @media (max-width: 1024px) {
  
 /*  .full-width-bg:before{
   
        background: url('/img/404mobile.webp') no-repeat center center;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        
} */

}
 
.full-width-bg:before{
  
    background: url('/img/desert.jpeg') no-repeat center center;
    -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
 
  }
 
 
</style>
 
<div class="text-center full-width-bg" style="color:#4A4A4A;position:relative;overflow: hidden; padding:2em;">
<div class="img-circle flex justify-center" style="margin-left:auto;margin-right:auto;width:70px;height:70px;background-color:#FFFFFF;">
  <img src="/img/logo.svg" style="width:50px;" alt="Avanturistic Logo">
</div>
<br>
 
<h1>Nothing here</h1>
<br>
 
<br>
<h4>It's seems you are lost, let us help you navigate to home.</h4>
<br>
<a class="btn  btn-dark text-white" href="/">
  Leave Desert
</a>
<br>
 <br>
<p class="text-white" style="">Check if you misspelled URL</p>
</div>
 
@endsection
