@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">
                
                <div class="kt-portlet__body">
                    @include('shared.success_error')
                    {!! Form::model($model , ['route' => ['admin.posts.update', $model->id], 'method' => 'PATCH'])  !!}
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    @if(isset($model->image['path']))
                                        <a href="{{ $model->image['path'] }}" class="spotlight" data-control="fullscreen,zoom" >
                                            <img src="{{ $model->image['path'] }}" alt="{{ $model->title }}">
                                        </a>
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Is Public</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    {!! Form::select('is_public', [0  => 'No' , 1 => 'Yes'], $model->is_public, ['class' => 'form-control']) !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Show on Map</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        {!! Form::select('show_on_map', [0  => 'No' , 1 => 'Yes'], $model->show_on_map, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <hr>
                                    <div class="form-group  row">
                                        <div class="col-xl-3 col-lg-3 col-form-label"></div>
                                        <div class="col-lg-9 col-xl-6">
                                            {!! Form::submit(__('general.update'), ['class' => 'btn btn-primary']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

