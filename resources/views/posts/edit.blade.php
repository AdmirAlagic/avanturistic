@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        {!! Form::model($post, $formOptions)  !!}
        @include('shared.success_error')

        <div class="kt-portlet">

            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first" style="padding-top:0px;">
                            <div class="kt-section__body" style="position: relative;padding-top: 0;">
                                <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>


                                <div class="col-sm-12">

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ @trans('posts.title') }}</label>
                                        <div class="col-lg-9 ">
                                            <div class="input-group">
                                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if($user->group == \App\User::$_USER_GROUP_BUSINESS)
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{  __('Price') }}</label>
                                        <div class="col-lg-9 ">
                                            <div class="row mt-10">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                    
                                                        {!! Form::text('price', $post->price ? $post->displayPrice : null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                   
                                                    <input type="text" name="currency_code" value="{{  $post->currency_code }}" list="currencies" class="form-control" placeholder="Price currency">
                                                    <datalist id="currencies">
                                                      <option value="EUR">
                                                      <option value="USD">
                                                    </datalist>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                   
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ @trans('posts.description') }}</label>
                                            {{--<br><small class="text-muted">Enter informative description <br> about adventure & location</small> </label>--}}
                                        <div class="col-lg-9 ">
                                            <div class="input-group">
                                                {!! Form::textarea('description', null, ['class' => 'form-control' , 'id' => 'cke-description', 'style' => 'width:100%;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label"><i class="fa fa-play-circle"></i> YouTube <b>Video</b> URL <span class="text-muted"><small><br> (Video will be shown in Watch section)</small></span></label>
                            <div class="col-lg-9 ">
                                <div class="input-group">
                                    {!! Form::text('video', null, ['class' => 'form-control' , 'placeholder' => 'Paste YouTube video URL']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-xl-3 col-lg-3 col-form-label">
                                <i class="fa fa-share-alt-square"></i> Embedded Code <span class="text-muted"><small> <br>(Embed your posts from other social networks)</small></span>
                            </label>
                            <div class="col-lg-9 ">
                                <div class="input-group">
                                    {!! Form::textarea('embeded_code', null, ['class' => 'form-control' , 'placeholder' => 'Paste embedded code', 'rows' => 2]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Upload photos</small></label>
                            <div class="col-lg-9 ">
                                
                                <div class="dropzone dropzone-file-area dz-clickable" id="featuredImage">

                                    <div class="dz-default dz-message"> <h3 class="text-green"><i class="fa fa-file-image"></i></h3>
                                        <h5 class=" text-center"><br><p>
                                                Upload up to. 5 photos</p>
                                        </h5>
                                        <a href="#" style="cursor:pointer;" onclick="void();" class="btn btn-green"><span class="text-white">Upload</span></a>
                                        <span></span></div>
                                </div>
                                @if($post->image)
                                  <br>
                                    <p class="text-center text-gray">Drag photos to reorder</p>
                                    <div class="row " id="sortable">
                                        @php $imgCount = 0;@endphp
                                    
                                            @foreach($post->image as $key => $image)
                                                @if(isset($image['path']))
                                                
                                                    <div class="text-center col-4 col-sm-3 ">
                                                    {!! Form::hidden('image['. $key. '][placeholder]', $image['placeholder']) !!}
                                                    {!! Form::hidden('image['. $key. '][path]', $image['path']) !!}
                                                    {!! Form::hidden('image['. $key. '][thumb_path]', $image['thumb_path']) !!}
                                                        <a href="{{ $image['path'] }}" class="spotlight" data-control="fullscreen,zoom" >
                                                            <div style="position: relative; ">
                                                                <img src="{{ $image['thumb_path'] }}" alt="" style="border:2px solid #474747;">
                                                            
                                                            </div>
                                                        </a>
                                                        <input type="text" name="image[{{ $key}}][title]" value="{{ isset($image['title']) ? $image['title'] : null }}" placeholder="Enter title" style="border-radius:0;" class="form-control">
                                                        
                                                        <a  style="position:absolute;top:0;right:10px;" href="#" class="fixed remove-img  btn btn-icon text-white btn-xs"> <i class="fa fa-times text-white"></i></a>
                                                    </div>
                                                    @php $imgCount++;@endphp
                                                @endif
                                            @endforeach
                                    
                                    </div>
                                @endif
                                <div id="image-files"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Location Name</label>
                                <div class="col-lg-9 ">
                                    <div class="input-group">
                                        {!! Form::text('address', null, ['class' => 'form-control' , 'placeholder' => 'Enter location name']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="route-input-description">
                                <label class="col-xl-3 col-lg-3 col-form-label">Route Description</label>
                                <div class="col-lg-9 ">
                                    {!! Form::text('map_options[description]', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{ @trans('posts.location') }} <small>(* required)</small></label>
                                <div class="col-lg-9 ">
                                    <label for="">Tap on map to set location</label>
                                    <div style="margin-top: 5px;position:relative;">
                                     <span  style="position: absolute;bottom: 0;left:0px;z-index: 3;background-color: #333333c7; border-bottom-left-radius: 4px; border-top-right-radius: 4px; ">
                                        <a style="padding:5px;"  class="btn showSatelite  text-white" href="#">Satellite Map</a>
                                    </span>
                                        <div id="single-map" style="width:100%; height:270px; margin:0;padding:0;position:relative;">
                                        </div>
                                        {{--map--}}
                                    </div>

                                    <div id="post-info" style="display:none;"  data-routes="{{ isset($post->map_options['route']) ? json_encode($post->map_options['route']) : null  }}"   >

                                    </div>
                                    <br>
                                    Use&nbsp;&nbsp;<img style="border:1px solid #999;margin-bottom:5px;width:30px;height:30px;border-radius:4px;" width="30" src="/img/search.png" alt="">&nbsp;&nbsp;button to find location.
                                    <br>  Use&nbsp;&nbsp;<img style="border:1px solid #999;width:30px;height:30px;border-radius:4px;" width="30" src="/img/polyline.png" alt="">&nbsp;&nbsp;button to draw <b>trail</b>, <b>route</b> or <b>directions</b> 

                                    <input type="hidden" name="map_options[route]" id="route-input">
                                    <input type="hidden" name="map_options[length]" id="route-input-length" value="{{ isset($post->map_options['length']) ? $post->map_options['length'] : '' }}">

                                    {!! Form::hidden('lat') !!}
                                    {!! Form::hidden('lng') !!}
                                    {!! Form::hidden('country_code') !!}
                                   
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body" style="padding:0;">
                        <div class="col-sm-12">

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Activities</label>
                                <div class="col-lg-9  text-center">

                                    <div class="kt-scroll" style="overflow-x:hidden !important; overflow-y:auto !important;" data-scroll="false" data-height="320" data-mobile-height="420">
                                        <div class="row">
                                            @foreach($badges as $key => $val)
                                                <div class="col-4 text-center">
                                                    <div class="kt-switch">
                                                        

                                                        <label style="margin-top: 5px;">

                                                            <div class="badge-wrap {{ isset($post->options['badges'][$key]) || request()->category == $key ? '' : 'inactive' }}" style="-webkit-box-shadow: 0px 0px 3px 0px rgb(102 102 102);-moz-box-shadow: 0px 0px 3px 0px rgb(102 102 102);box-shadow: 0px 0px 3px 0px rgb(102 102 102); border:4px solid {{ $val['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 45px; height: 45px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;">
                                                            </div>
                                                            <input type="checkbox" name="options[badges][{{ $key }}]" {{ isset($post->options['badges'][$key]) || request()->category == $key ? 'checked' : '' }} >

                                                            <div style="white-space: nowrap;font-style: italic;font-size:0.8rem;font-weight:normal;margin-top:5px;">{{ $val['name'] }}</div> 
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                <div class="col-lg-9  text-center">

                                    {!! Form::submit(!$post->id ? 'Upload' : 'Save Changes', ['class' => 'btn btn-success ']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
       

    </div>

    <!-- end:: Content -->
@endsection

