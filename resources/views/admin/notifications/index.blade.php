@extends('layouts.admin')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Notifications
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @include('shared.success_error')
            <a href="{{route('admin.notifications.create')}}" class="btn btn-success btn-sm text-white">Add</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                       
                        <th>Content</th>
                        <th>Date</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $obj)
                        <tr>
                            <td>{{ $obj->content }}</td>
                             
                            <td>
                                {{ $obj->created_at }}
                            </td>

                            <td style="display: flex;">

                                 
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $notifications->links() !!}
        </div>
    </div>

@endsection
