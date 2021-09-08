@extends('layouts.admin')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Quotes
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <a href="{{route('admin.quotes.create')}}" class="btn btn-success btn-sm text-white">Add</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Text</th>
                        <th>Author</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotes as $obj)
                        <tr>
                            <td>{{ $obj->id }}</td>
                            <td>
                                {{ $obj->title }}
                            </td>
                            <td>
                                {{ $obj->author }}
                            </td>

                            <td style="display: flex;">

                                <a href="{{route('admin.quotes.edit',$obj->id)}}" class="btn btn-info btn-sm">Edit</a>
                                {{--<button type="button" name="button"--}}
                                {{--onclick="if(confirm('Are you sure you want to delete post?')){ $('form#delete-{{$obj->id}}').submit(); }"--}}
                                {{--class="btn btn-danger btn-sm">Delete--}}
                                {{--</button>--}}
                                {{--{!! Form::open(['method' => 'DELETE', 'route' => ['admin.categories.destroy',$obj->id], 'class' => 'hidden', 'id'=>"delete-".$obj->id]) !!}--}}
                                {{--{!! Form::close() !!}--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $quotes->links() !!}
        </div>
    </div>

@endsection
