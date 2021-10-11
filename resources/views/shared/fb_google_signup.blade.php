<div>
    <div class="row">
        <div class="col-12 ">
            <a style="margin-top:10px;width:8rem;height:8rem;margin-right:1em;" class="btn loginBtn--facebook br-8 border-gray" href="/login/facebook">
                <img class="mt-10" src="/img/facebook.svg" width="30" style="width:30px;" alt="">
                <div class="mt-10 mb-10">
                    <b>Facebook</b>
                </div>
            </a>
          
        @if(isset($isWebView) && !$isWebView)
           
            <a style="margin-top:10px;width:8rem;height:8rem;" class="btn loginBtn--google br-8 border-gray " href="/login/google">
                <img class="mt-10" src="/img/google-icon.svg" width="30" style="width:30px;" alt="">
                <div class="mt-10 mb-10">
                    <b>Google</b>
                </div>
            </a>
                 
        @endif
    </div>
    </div>
</div>

