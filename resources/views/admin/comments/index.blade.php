@extends('layouts.admin')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Comments
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('shared.success_error')
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Post/Blog</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $obj)
                        <tr>
                            <td>{{ $obj->created_at }}</td>
                            <td>
                               {{ $obj->name  }}
                            </td>
                            <td>
                                {{ $obj->email  }}
                            </td>
                            <td>
                                {{ $obj->body  }}
                            </td>
                            <td>
                                @if($obj->post)
                                <a target="_blank" href="/adventure/{{ $obj->post->id  }}/{{ $obj->post->slug  }}">
                                    #{{ $obj->post->id  }}
                                </a>
                                @endif
                                @if($obj->blog)
                                    <a target="_blank" href="/{{ $obj->blog->slug  }}">
                                        {{ $obj->blog->title  }}
                                    </a>
                                @endif
                            </td>

                            <td style="display: flex;">
                                @if($obj->approved)
                                    Approved
                                @else
                                <a class="btn btn-success text-white" href="/admin/comments/{{ $obj->id }}/approve">Approve</a>
                                @endif
                                <!-- {{--{!! Form::open(['method' => 'DELETE', 'route' => ['admin.comments.destroy',$obj->id], 'class' => 'hidden', 'id'=>"delete-".$obj->id]) !!}--}}
                                {{--{!! Form::close() !!}--}} -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $comments->links() !!}
        </div>
    </div>

@endsection
