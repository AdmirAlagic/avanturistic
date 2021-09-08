@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">

                <div class="kt-portlet__body">
                    @include('shared.success_error')
                    {!! Form::model($model , $formOptions)  !!}
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="">Text</label>
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        {!! Form::textarea('content', null, ['class' => 'form-control cke', 'id' =>'body']) !!}
                                                    </div>

                                                </div>
                                            </div>
                                            <label class="">URL</label>
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        {!! Form::text('url', '/', ['class' => 'form-control',]) !!}
                                                    </div>

                                                </div>
                                            </div>
                                            <label class="">Type</label>
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        {!! Form::select('type', [ 'emails' => 'Emails','all' => 'All'], null, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        {!! Form::textarea('emails', null, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                            </div>
                                            {!! Form::submit(__('general.update'), ['class' => 'btn btn-success']) !!}
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

