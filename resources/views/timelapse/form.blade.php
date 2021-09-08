@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->

    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0;" >

        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav">

                                <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                <div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v1__nav-body">
                                            <div class="kt-wizard-v1__nav-icon">
                                                <i class="fa fa-camera" style="width:21px;" ></i>
                                            </div>
                                            <div class="kt-wizard-v1__nav-label text-muted">
                                                1. Choose Photos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" >
                                        <div class="kt-wizard-v1__nav-body">
                                            <div class="kt-wizard-v1__nav-icon">
                                                <i class="fa fa-cogs" ></i>
                                            </div>
                                            <div class="kt-wizard-v1__nav-label text-muted">
                                                2. Settings
                                            </div>
                                        </div>
                                    </div>
                                     
                                </div>
                            </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                   
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    {!! Form::open(  array_merge($formOptions, ['class' => 'kt-form create-post', 'id' => 'kt_form']))  !!}
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content"  data-ktwizard-state="current" data-ktwizard-type="step-content" id="tab-image">
                        <div class="kt-heading kt-heading--md text-center text-gray">Upload photos or choose from your gallery</div> 
                        <div class="kt-heading kt-heading--md text-center text-gray"><small>(Pick at least three photos)</small></div> 
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v1__form text-center" style="margin-top:1rem;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @include('shared.success_error')
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="dropzone dropzone-file-area dz-clickable text-center" id="uploadImages" style="height:180px;">

                                                <div class="dz-default dz-message">
                                                    <div class="text-green">
                                                    <img  width="50" height="50" style="width:40px;height:40px;"  alt="Upload Photos" src="{{ url('/img/photos.svg') }}">
                                                    </div>
                                                <h5 class=" upload-text text-center"><br><p>
                                                        Upload Photos</p>
                                                </h5>
                                               
                                                </div>
                                                <div class="kt-spinner kt-spinner--left kt-spinner--sm kt-spinner--dark uploading"  style="display:none;width:20px;margin-left:auto;margin-right:auto;"></div>
                                            </div>
                                            <div class="dz-preview dz-file-preview" style="display:none;">
                                                <div class="dz-details">
                                                    <div class="dz-filename"><span data-dz-name></span></div>
                                                    <div class="dz-size" data-dz-size></div>
                                                    <img data-dz-thumbnail />
                                                </div>
                                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                                <div class="dz-success-mark"><span>✔</span></div>
                                                <div class="dz-error-mark"><span>✘</span></div>
                                                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="photosContainer">
                                        @php $count = 16;@endphp
                                        @foreach($paths as $path)
                                            @php $count++;@endphp
                                                <div class="col-4 col-sm-3" style="padding:10px;">
                                                    <input type="checkbox" id="check-{{ $count }}"  name="paths[]" value="{{ $path['path'] }}"/>
                                                        <label for="check-{{ $count}}" class="border-radius4">
                                                        <img src="{{ url('/img/placeholder-trans.jpg') }}"   data-src="{{ $path['thumb_path'] }}"  data-srcset="{{ $path['thumb_path'] }}"  alt="" class="lazy border-radius4"  style="cursor:pointer;">
                                                        </label>
                                                    
                                                </div>
                                        @endforeach
                                    </div>
                                    <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                            Next
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" id="tab-location">
                         <div class="kt-heading kt-heading--md text-center text-gray"> <i class=" fa fa-music"></i>&nbsp; Select a track</div> 
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v1__form text-center" style="margin-top:1rem;">
                                        
                                        <div class="row audio-toolbar">
                                            @php $countAudio = 0;@endphp
                                            @foreach(config('audio') as $key => $obj)
                                                
                                                    <div class="col-12">
                                                      
                                                            <input type="radio" id="check-{{ $key }}" {{ !old('audio') && $countAudio == 0 ? 'checked' : ''}} class="check-success"  name="audio" value="{{ $obj['path'] }}"/>
                                                            <label for="check-{{ $key }}"   style="position:relative;"  >
                                                            <div class="btn btn-default play-audio text-left"  style="position:relative;min-width:200px;cursor:pointer;" data-key="{{ $key }}-audio" data-check="check-{{ $key }}">
                                                              
                                                                <audio id="{{ $key }}-audio" class="audio">
                                                                       
                                                                    <source src="{{ url($obj['path']) }}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                    </audio>
                                                                    <div class="bars" style="display:none;">
                                                                    <div class="bar"></div>
                                                                    <div class="bar"></div>
                                                                    <div class="bar"></div>
                                                                    <div class="bar"></div>
                                                                    <div class="bar"></div>
                                                                    <div class="bar"></div>
                                                                    
                                                                    </div>
                                                                    <i class="fa fa-play" style="margin-right:10px;"></i>
                                                                    <span>{{ $obj['title']}}</span>
                                                                    </div>
                                                                   
                                                            </label>
                                                      
                                                         
                                                    </div>
                                                    @php $countAudio++;@endphp
                                            @endforeach
                                        

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group text-left">
                                                    {!! Form::label('Text') !!} <span class="text-gray"><small>(optionally)</small></span>
                                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter text', 'maxlength' => 43 ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-left">
                                              
                                                <div class="form-group ">
                                                    {!! Form::label('Text Color') !!} 
                                                    <br>
                                                    @php $countColors = 0; @endphp
                                                    @php $colors = config('color'); @endphp
                                                  
                                                    @foreach($colors as $k => $color)
                                                    <input type="radio" id="color-{{ $k}}" class="color"  {{ $countColors == 0 ? 'checked' : ''}} name="color" value="{{ $color['value'] }}"/>
                                                    <label for="color-{{ $k}}"  style="position:relative; display:inline;"  >
                                                            <div class="btn   text-left"   style="position:relative;cursor:pointer;width:20px;height:28px;background-color:{{ $color['value'] }};border:1px solid #eee;">
                                                    
                                                        </div>
                                                    </label>
                                                    @php $countColors++;@endphp
                                                    @endforeach
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    {!! Form::label('Effects') !!}&nbsp;&nbsp;
                                                </div>
                                            </div>   
                                            <div class="col-9 text-left">
                                                <div class="form-group ">
                                                   
                                                    <input type="radio" id="effect-none"  checked name="effect" value="none"/>
                                                    <label for="effect-none" style="position:relative; display:inline;"  >
                                                        <div class="btn btn-default text-left"   style="position:relative;cursor:pointer;">
                                                            None
                                                        </div>
                                                    </label>
                                                    <input type="radio" id="effect-fade"  name="effect" value="fade"/>
                                                    <label for="effect-fade" style="position:relative; display:inline;"  >
                                                        <div class="btn btn-default text-left"  ecked style="position:relative;cursor:pointer;">
                                                            Fade
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3 text-left">
                                                <div class="form-group">
                                                    {!! Form::label('Visibility') !!}&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="col-9 text-left">
                                                <div class="form-group ">
                                                  
                                                    <input type="radio" id="visibility-public"  checked name="is_public" value="1"/>
                                                    <label for="visibility-public" style="position:relative; display:inline;"  >
                                                        <div class="btn btn-default text-left"   style="position:relative;cursor:pointer;">
                                                            Public
                                                        </div>
                                                    </label>
                                                    <input type="radio" id="visibility-private"  name="is_public" value="0"/>
                                                    <label for="visibility-private" style="position:relative; display:inline;"  >
                                                        <div class="btn btn-default text-left"  ecked style="position:relative;cursor:pointer;">
                                                            Private
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        {!! Form::submit('Done', ['class' => 'form-control btn btn-default', 'id' => 'submit-form']) !!}
                                        <div class="generating text-center" style="display:none;">
                                            <span class="kt-spinner kt-spinner--left kt-spinner--sm kt-spinner--dark uploading" style="margin-right:30px;" ></span> &nbsp;
                                            <div style="display:inline;padding-top:10px;"> Generating timelapse...</div>
                                        </div>
                                </div>
                            </div>
                        </div>
                         
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

