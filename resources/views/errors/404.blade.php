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
  
  .full-width-bg:before{
   
        background: url('/img/404mobile.webp') no-repeat center center;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        filter:grayscale(1);
}

}
@media (min-width: 1025px) {
.full-width-bg:before{
  
    background: url('/img/404.webp') no-repeat center center;
    -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  filter:grayscale(1);
  }
 
}
</style>
 
<div class="text-center full-width-bg" style="color:#FFFFFF;position:relative;overflow: hidden; ">
<img src="/img/logo.svg" style="width:50px;" alt="Avanturistic Logo">
<br>
 
<h1>Nothing here</h1>
<br>
 
<br>
<h4>It's seems you are lost, let us help you navigate to home.</p>
<a class="btn btn-success text-white" href="/"><h2>

<h5>Leave desert</h4>
</h2></a>
 <br>
<p class="text-dark">Check if you misspelled URL</p>
</div>
 
@endsection
