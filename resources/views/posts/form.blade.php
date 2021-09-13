@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->

    @if(isset($disableHeaderMobile))
    {{-- <div class="kt-visible-desktop" style="height: 3em;"></div> --}}
    @endif
    <div class="kt-container create-post-container kt-grid__item kt-grid__item--fluid" style="padding:0;">

        <div class="">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav kt-visible-tablet-and-mobile" >
                            <div class="kt-wizard-v1__nav-items" style="padding:0;">
                                <div class="kt-wizard-v1__nav-item item-image"  data-ktwizard-state="current" style="min-height:40px;">
                                    <a  class="btn  flex justify-center   noborder-r " href="/" style="position:absolute;top:0;left:0;height: 100%;">
                                    <i class="fa fa-angle-left "></i> Cancel
                                    </a>
                                    <a  style="position:absolute;top:0;right:0;border:none;height:40px;"    class="to-location btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r">
                                        <span class="text-white">
                                            Next
                                        </span>
                                    </a>
                                </div>
                                <div class="kt-wizard-v1__nav-item item-location" style="display: none;min-height:40px;">

                                    <a   class="back-to-upload btn flex justify-center  btn-tall  noborder-r" style="position:absolute;top:0;left:0;height: 100%;" >
                                        <i class="fa fa-angle-left "></i> Back
                                    </a>
                                    <button class="finish-form btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r" style="position:absolute;top:0;right:0;border:none;height:40px; " >
                                        Describe & Finish
                                    </button>

                                </div>
                                <div class="kt-wizard-v1__nav-item item-finish"  style="display: none;height:40px;">

                                    <a   class="back-to-location btn  btn-tall  noborder-r" style="position:absolute;top:0;left:0;height: 100%;" >
                                        <i class="fa fa-angle-left "></i> Back
                                    </a>
                                    <button   type="submit " class="submitPost btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r" style="border:none;height: 40px;border:none;position:fixed;top:0;right:0;z-index:9999;" >
                                        <i class="fa fa-paper-plane"></i> Upload
                                    </button>
                                   <div style="height:40px;width:100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v1__nav kt-visible-desktop" style="position: relative;" >
                            <div class="kt-wizard-v1__nav-items" style="padding:0;">
                                <div class="kt-wizard-v1__nav-item item-image"  data-ktwizard-state="current" style="min-height:40px;">
                                    <a  class="btn  flex justify-center   btn-tall noborder-r " href="/" style="position:absolute;top:0;left:0;height: 100%;">
                                    <i class="fa fa-angle-left "></i> Cancel
                                    </a>
                                    <a  style="position:absolute;top:0;right:0;border:none;height:40px;"    class=" to-location btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r">
                                        <span class="text-white">
                                            Next
                                        </span>
                                    </a>
                                </div>
                                <div class="kt-wizard-v1__nav-item item-location" style="display: none;min-height:40px;">

                                    <a   class="btn back-to-upload flex justify-center btn-tall  noborder-r" style="position:absolute;top:0;left:0;height: 100%;" >
                                        <i class="fa fa-angle-left "></i> Back
                                    </a>
                                    <button class=" finish-form btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r" style="position:absolute;top:0;right:0;border:none;height:40px; " >
                                        Describe & Finish
                                    </button>

                                </div>
                                <div class="kt-wizard-v1__nav-item item-finish"  style="display: none;height:40px;">

                                    <a   class="back-to-location btn  btn-tall  noborder-r" style="position:absolute;top:0;left:0;" >
                                        <i class="fa fa-angle-left "></i> Back
                                    </a>
                                    <button  type="submit"   class="submitPost btn  btn-green btn-md flex kt-font-bold kt-font-transform-u noborder-r" style="border:none;height: 40px;border:none;position:absolute;top:0;right:0;" >
                                        <i class="fa fa-paper-plane"></i> Upload
                                    </button>
                                   <div style="height:40px;width:100%;"></div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @include('shared.success_error')
                        </div>
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    {!! Form::model($model, array_merge($formOptions, ['class' => 'kt-form create-post', 'id' => 'kt_form']))  !!}
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content"  data-ktwizard-state="current" data-ktwizard-type="step-content" id="tab-image">
                        <div class="kt-heading kt-heading--md text-center text-gray"><small>Step 1/3</small></div> 
                        <div class="kt-heading kt-heading--md text-center text-gray">Upload photos</div> 
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v1__form text-center" style="margin-top:1rem;">
                                    <div class="image-msg text-center"></div>
                                    <div id="image-files"></div>
                                    <p><small>
                                            <i class="fa fa-info-circle ">

                                            </i> Tap area below to add photos
                                        </small></p>
                                    <div class="dropzone dropzone-file-area dz-clickable" id="featuredImage">

                                        <div class="dz-default dz-message">
                                            <div class="text-green">
                                            <img  width="50" height="50" style="width:40px;height:40px;"  alt="Upload Photos" src="{{ url('/img/photos.svg') }}">
                                            </div>
                                        <h5 class=" text-center"><br><p>
                                                Choose photos</p>
                                        </h5>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                     
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" id="tab-location">
                            <div class="kt-heading kt-heading--md text-center text-gray"><small>Step 2/3</small></div> 
                            <div class="kt-heading kt-heading--md text-center text-gray">Set Location</div> 
                            <div class="kt-form__section kt-form__section--first" style="margin-top:1rem;">
                                <div class="form-group">
                                    <label>Location Name</label>
                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter location name']) !!}
                                </div>
                                <br>
                                <div class="form-group" id="route-input-description" style="display:none;">
                                    <label>Route Description</label>
                                    {!! Form::text('map_options[description]', null, ['class' => 'form-control', 'placeholder' => 'Enter route description']) !!}
                                </div>

 
                                <p class="text-center" style="margin-bottom:5px;">Tap on map to <b>set location</b><span class=""> (required)</span>
                               
                                </p>
                                <p class="text-center " > 
                                    <small>
                                        Use&nbsp;&nbsp;<img style="border:1px solid #999;margin-bottom:5px;width:30px;height:30px;border-radius:4px;" width="30" src="/img/search.png" alt="">&nbsp;&nbsp;button to find location.
                                       
                                    </small></p>
                                <div id="location-msg text-center" class="location-msg"></div>
                                <div style="margin-top: 5px;position:relative;">
                                     <span  style="position: absolute;bottom: 0;left:0px;z-index: 3;background-color: #333333c7; border-bottom-left-radius: 4px; border-top-right-radius: 4px; ">
                                        <a style="padding:5px;"  class="btn showSatelite  text-white" href="#">Satellite Map</a>
                                    </span>
                                    <div id="single-map" style="width:100%; height:270px; margin:0;padding:0;position:relative;">
                                    </div>
                                   
                                </div>
                                <br>
                                <small class="">
                                    Use&nbsp;&nbsp;<img style="border:1px solid #999;width:30px;height:30px;border-radius:4px;" width="30" src="/img/polyline.png" alt="">&nbsp;&nbsp;button to draw <b>trail</b>, <b>route</b> or <b>directions</b> 
                                </small>
                              
                                {!! Form::hidden('map_options[route]', null, ['id' => 'route-input']) !!}
                                {!! Form::hidden('map_options[length]', null , ['id' => 'route-input-length']) !!}
                                {!! Form::hidden('country_code') !!}
                                {!! Form::hidden('lat') !!}
                                {!! Form::hidden('lng') !!}
                            </div>
                        </div>
                        <!--end: Form Wizard Step 2-->
                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" id="tab-finish">
                        <div class="kt-heading kt-heading--md text-center text-gray"><small>Step 3/3</small></div> 
                        <div class="kt-heading kt-heading--md text-center text-gray">Describe</div> 
                            <div class="kt-form__section kt-form__section--first" style="margin-top:1rem;">
                                <div style="border: 1px solid #f1f1f1;padding: 10px;border-radius: 10px;">
                                    <label>Title</label><span class=""><small></small></span>
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    <br>
                                    <label>{{ @trans('posts.description') }}</label>
                                    {{--<br><small class="">Enter informative description  about adventure & location</small>--}}
                                    <div class="description-emoji">
                                        {!! Form::textarea('description', null, ['class' => 'form-control ' ,   'rows' => 2, 'id' => 'cke-description', 'style' => 'resize: x;']) !!}
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div style="border: 1px solid #f1f1f1;padding: 10px;border-radius: 10px;">
                                    <div class="video">
                                        <label style="display: flex;align-items:center;margin-bottom:0;">
                                            <img src="/img/video.svg" width="22"  style="width:22px;invert(0.2);">&nbsp;YouTube&nbsp;<b>Video</b>&nbsp;URL</label>
                                            <div class="text-gray" style="margin-bottom: 0.5rem;">
                                                <small> Video will be shown in Watch section</small>
                                            </div>
                                        {!! Form::text('video', null, ['class' => 'form-control' , 'placeholder' => 'Paste YouTube video URL']) !!}
                                    </div>
                                </div>
                                <br>
                                <div style="border: 1px solid #f1f1f1;padding: 10px;border-radius: 10px;">
                                    <div class="embeded" >
                                        <label style="display: flex;align-items:center;margin-bottom:0;"><i class="fa fa-share-alt-square" style="font-size:1.4rem;"></i>&nbsp;&nbsp;Embedded Code</label>
                                        <div class="text-gray" style="margin-bottom: 0.5rem;"><small> Embed your posts from other social networks</small></div>
                                         
                                        {!! Form::textarea('embeded_code', null, ['class' => 'form-control' , 'placeholder' => 'Paste embedded code', 'rows' => 2]) !!}
                                        <small></small>
                                    </div>
                                </div>

                                <br>
                                <div style="border: 1px solid #f1f1f1;padding: 10px;border-radius: 10px;">
                                    <label class="text-center" style="width:100%;">Choose Activities</label>
                                    <br>
                                    <div class="kt-scroll" style="overflow-x:hidden !important; overflow-y:auto !important;" data-scroll="false" data-height="320" data-mobile-height="420">
                                        <div class="row" style="margin:0;">
                                            @foreach($badges as $key => $val)
                                                <div class="col-4 text-center" style=" padding:0; margin-bottom:10px;">
                                                    <div class="kt-switch" >
                                                        
                                                        <label style="margin-top: 5px;">

                                                            <div class="badge-wrap {{ isset($model->options['badges'][$key]) || request()->category == $key ? 'active' : 'inactive' }}" style="-webkit-box-shadow: 0px 0px 3px 0px rgb(102 102 102);-moz-box-shadow: 0px 0px 3px 0px rgb(102 102 102);box-shadow: 0px 0px 3px 0px rgb(102 102 102); border:4px solid {{ $val['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 45px; height: 45px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;">
                                                            </div>
                                                            <input type="checkbox" name="options[badges][{{ $key }}]" {{ isset($model->options['badges'][$key]) || request()->category == $key ? 'checked' : '' }} >

                                                            <div style="white-space: nowrap;font-style: italic;font-size:0.8rem;margin-top:5px;font-weight:normal;">{{ $val['name'] }}</div> 
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <!--end: Form Wizard Step 3-->

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

