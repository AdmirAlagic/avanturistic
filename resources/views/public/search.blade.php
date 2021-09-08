@extends('layouts.app')

@section('content')
    <div id="search" class="kt-container padding0" style="min-height:760px;">
        <search-box></search-box>
      
        @if(!request()->has('q'))
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div>
               
                    @foreach($badges as $obj)
                        <a href="/outdoor-adventures/{{ $obj->slug }}" class="img-fade-hover">
                            <div style="display:inline-flex;padding:5px;border:1px solid #eee; margin:5px; border-radius:4px;">
                                <span class="text-success">#</span><span class="text-muted">{{ $obj->slug }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        @endif
        
    </div>

</div>
     

@endsection
