@extends('layouts.app')

@section('content')
    <div id="search" class="kt-container padding0" style="min-height:740px;">
        <search-box></search-box>
        <div class="text-center mb-20">
               
            @foreach($badges as $obj)
                 
                <a href="/outdoor-adventures/{{ $obj->slug }}" class="img-fade-hover">
                    <div style="display:inline-flex;padding:5px;border:1px solid #eee; margin:5px; border-radius:4px;">
                      
                        <span>#</span><span class="text-muted">{{ $obj->slug }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        
    </div>

</div>
     

@endsection
