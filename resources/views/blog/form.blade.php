@extends('layouts.app')

@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                @include('shared.success_error')
                {!! Form::model($model, $formOptions)  !!}
                <div class="kt-form kt-form--label-right">
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first" style="padding-top:20px;">

                            <div class="kt-section__body">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group row">
                                           <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                           <div class="col-lg-9 col-xl-6">

                                               <div class="input-group">
                                                   {!! Form::select('is_published', [0 => 'Publish Later', 1 => 'Published'], null, ['class' => 'form-control']) !!}
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-xl-3 col-lg-3 col-form-label">Show Comments</label>
                                           <div class="col-lg-9 col-xl-6">

                                               <div class="input-group">
                                                   {!! Form::select('show_comments', [0 => 'Hide', 1 => 'Show'], null, ['class' => 'form-control']) !!}
                                               </div>
                                           </div>
                                       </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ @trans('posts.title') }}</label>
                                            <div class="col-lg-9 col-xl-6">

                                                <div class="input-group">
                                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ @trans('posts.description') }}</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::textarea('description', null, ['class' => 'form-control cke' , 'data-emojiable' => 'true', 'id' => 'desc']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Content</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::textarea('body', null, ['class' => 'form-control cke', 'id' => 'body']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Gallery Photos</label>
                                    <div class="col-lg-9 col-xl-6">

                                        <div id="image-files"></div>
                                        <p><small>
                                                <i class="fa fa-info-circle text-green">

                                                </i> Tap area below to add photos
                                            </small></p>
                                        <div class="dropzone dropzone-file-area dz-clickable" id="featuredImage">

                                            <div class="dz-default dz-message">
                                                <h3 class="text-green"><i class="fa fa-file-image"></i></h3>
                                                <h5 class=" text-center"><br><p>
                                                        Upload up to 5 photos</p>
                                                </h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            @if($model->image && count($model->image))

                                                @foreach($model->image as $obj)

                                                    <div class="col-sm-3">
                                                        {!! Form::hidden('image[]', json_encode($obj)) !!}
                                                        @if(isset($obj['thumb_path']))
                                                            <img src=" {{$obj['thumb_path']}}" style="width:100%;" alt="">
                                                        @endif
                                                        <a href="#" class="remove-img btn-dark btn text-white btn-xs"><i class="fa fa-trash "></i> Remove</a>
                                                    </div>
                                                @endforeach

                                            @endif
                                        </div>

                                    </div>
                                </div>


                            </div>
                            {!! Form::close() !!}
                            <hr>

                            <div class="form-group  row">
                                <div class="col-xl-3 col-lg-3 col-form-label">

                                </div>
                                <div class="col-lg-9 col-xl-6">
                                    {!! Form::submit(!$model->id ? 'Submit' : 'Update', ['class' => 'btn btn-success']) !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

