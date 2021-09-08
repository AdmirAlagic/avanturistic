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
            @include('shared.success_error')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Deleted at</th>
                        <th>Has FCM</th>
                        <th>Last login at</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $obj)
                        <tr>
                            <td>
                                <a href="{{route('admin.users.show', ['user' => $obj->id])}}">{{$obj->id}}</a>
                            </td>
                            <td>
                                <a href="/{{ '@' .$obj->name_slug }}">
                                    @if($obj->isOnline())
                                        <span class="kt-badge kt-badge--dot kt-badge--success"></span>&nbsp;
                                    @endif
                                    {{$obj->name}}
                                </a>
                            </td>
                            <td>{{$obj->country_code}}</td>
                            <td>{{$obj->email}}</td>
                            <td>{{$obj->created_at}}</td>
                            <td>{{$obj->deleted_at}}</td>
                            <td>
                                @if($obj->fcm_token)
                                    <span class="text-success">
                                    Yes
                                    </span>
                                @else
                                    No 
                                @endif    
                            </td>
                            <td>{{ $obj->last_login_at ? $obj->last_login_at->diffForHumans() : 'N/A'}}</td>

                            <td style="display: flex;">
                            <a class="btn" href="/admin/loginAsUser/{{ $obj->id}}">Impersonate</a>
                                <a href="{{route('admin.fcm.form',$obj->id)}}" class="btn btn-primary btn-sm">Send Notification</a>
                                <button type="button" name="button"
                                        onclick="if(confirm('Are you sure you want to delete user?')){ $('form#delete-{{$obj->id}}').submit(); }"
                                        class="btn btn-danger btn-sm">Delete
                                </button>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy',$obj->id], 'class' => 'hidden', 'id'=>"delete-".$obj->id]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!}
            </div>
        </div>
    </div>

@endsection
