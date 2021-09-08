@extends('layouts.admin')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Users
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Reports</th>
                            <th>Created at</th>
                            <th>Visibility</th>
                            <th>Deleted at</th>
                            <th></th>
                        </tr>
                        </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <a href="/adventure/{{$post->id}}">
                                    @if($post->image[0])
                                        <img src="{{ $post->image[0]['thumb_path'] }}" style="width:50px" alt="">
                                    @endif
                                </a>
                            </td>
                            <td>@if($post->user) {{$post->user->name}} @else User does not exists @endif</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->views}}</td>
                            <td>{{$post->likes}}</td>
                            <td>{{ $post->dislikes }}</td>
                            <td>{{$post->created_at}}</td>
                            <th>@if($post->is_public) Public @else Private @endif</th>
                            <td>{{$post->deleted_at}}</td>

                            <td style="display: flex;">
                                @if($post->is_recommended)
                                    <a class="btn" href="">Featured</a>
                                @else
                                <a class="btn" href="/admin/posts/{{ $post->id }}/mark-as-featured" onclick="if(confirm('Are you sure you want to mark this post as featured?')){ return true; } else {return false;}">
                                    Mark as featured
                                </a>
                                @endif
                                <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                
                                <button type="button" name="button"
                                        onclick="if(confirm('Are you sure you want to delete post?')){ $('form#delete-{{$post->id}}').submit(); }"
                                        class="btn btn-danger btn-sm">Delete
                                </button>
                                
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.posts.destroy',$post->id], 'class' => 'hidden', 'id'=>"delete-".$post->id]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $posts->links() !!}
        </div>
    </div>

@endsection
