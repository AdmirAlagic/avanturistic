<div>
    <div class="row">
        <div class="col-12 ">

            <a style="margin-top:10px;" class="btn social-loginBtn loginBtn--facebook " href="/login/facebook">
               Continue with Facebook
            </a>
        </div>
        @if(isset($isWebView) && !$isWebView)
            <div class="col-12 ">

                <a style="margin-top:10px;" class="btn social-loginBtn loginBtn--google " href="/login/google">
                Continue with Google
                </a>
            </div>
        
        @endif
    </div>
</div>

