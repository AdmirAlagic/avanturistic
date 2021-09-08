@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">

                <div class="kt-portlet__body">
                    @include('shared.success_error')
                    {!! Form::model($model , ['route' => ['admin.categories.update', $model->id], 'method' => 'PATCH'])  !!}
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">

                                   <div class="row">
                                       <div class="col-sm-12">
                                           <label class="">Title</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Slug</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Icon</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Empty Icon</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('icon_empty', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Color</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('color', null, ['class' => 'form-control']) !!}
                                                       <span style="background:{{ isset($model->color) ? $model->color : null }}"><b><span style="color:white;">color</span></b></span>
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">BG Image</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('bg_image', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>

                                           <label class="">Share Desription #1</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[intro_description_share1]', null, ['class' => 'form-control cke', 'id' => 'intro_description_share1']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[intro_description_share1]', null, ['class' => 'form-control cke', 'id' => 'intro_description_share1']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Share Button Text</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::text('options[share_btn]', null, ['class' => 'form-control cke', 'id' => 'share_btn']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Explore Desription #1</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[intro_description_explore]', null, ['class' => 'form-control cke', 'id' => 'intro_description_explore']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">About category</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[about]', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Structured Data</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[structured_data]', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <label class="">Meta Description</label>
                                           <div class="">
                                               <div class="">
                                                   <div class="">
                                                       {!! Form::textarea('options[meta_description]', null, ['class' => 'form-control']) !!}
                                                   </div>

                                               </div>
                                           </div>
                                           <br>
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

