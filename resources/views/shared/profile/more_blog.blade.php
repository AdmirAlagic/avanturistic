
<div class="row">
    @foreach($blog as $obj)
        @php $image = json_decode($obj->image);@endphp
        @if(isset($image->thumb_path))
            <div class="col-sm-12">

                <div class="blog-post kt-animate-fade-in" style="margin-bottom:20px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px; background-color:#f8f8fb; padding:10px;">

                    <div class="row">

                        <div class="col-sm-3">

                            <a href="/experience/{{ $obj->post_id }}/{{$obj->post_slug}}">
                                <img class="image-thumbnail" src="{{ $image->thumb_path }}" alt="" style="width:100%;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
                            </a>

                        </div>
                        <div class="col-sm-9">
                            <h5>
                                <b> {{ $obj->title }}</b>
                            </h5>
                            <hr>
                           @if($obj->description )
                                <p> {{ $obj->description }}</p>
                                <hr>
                            @endif
                            <a  class="btn btn-default align-self-end pull-right" href="/experience/{{ $obj->post_id }}/{{$obj->post_slug}}">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
