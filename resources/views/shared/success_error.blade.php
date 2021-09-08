
@if ( session()->has('success') )
    <div class="row">
        <div class="col-sm-12">
            
            <div class="alert alert-success">
                <div class="alert-text">
                    <i class="fa fa-info-circle"></i>
                    {!! session('success') !!}
                </div>
            </div>
        </div>
    </div>
@endif
@if ( session()->has('error') )
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div class="alert alert-danger">
                <div class="alert-text">
                    {!! session('error') !!}
                </div>
            </div>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div class="alert alert-danger"  role="alert">
                <div class="alert-text">
                    @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
