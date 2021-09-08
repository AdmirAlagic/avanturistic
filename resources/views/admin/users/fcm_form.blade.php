@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                        <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                             Notification for {{ $user->email }} - {{ $user->name }}
                        </h3>
                    </div>
                     
                </div>
                <div class="kt-portlet__body">
                   
                    @include('shared.success_error')
                    {!! Form::open($formOptions)  !!}
                    {!! Form::hidden('user_id',  $user->id,  ['class' => 'form-control']) !!}
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                     
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Message</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"></div>
                                                {!! Form::text('message',  null,  ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group  row">
                                        <div class="col-xl-3 col-lg-3 col-form-label"></div>
                                        <div class="col-lg-9 col-xl-6">
                                            {!! Form::submit(__('Send'), ['class' => 'btn btn-primary']) !!}
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

