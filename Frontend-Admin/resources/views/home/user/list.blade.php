@extends('layouts.admin')
@section('content')
@section('title', 'Category List')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('users.index') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listUsers" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Wallet</th>
                            <th>Role</th>
                            <th>Vip Member</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Update Date</th>
                            <th>Delete Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($users))
                            @php
                                $numberLimit = 30;
                            @endphp
                            @foreach($user_infor as $user)
                                <tr>
                                    <td>{{Illuminate\Support\Str::limit($user['fullname'], $numberLimit)}}</td>
                                    <td>{{Illuminate\Support\Str::limit($user['email'], $numberLimit)}}</td>
                                    <td>{{$user['user_detail']['wallet'] ?? 'N/A'}}</td>
                                    <td>
                                        @if($user['role'] == "ROLE_USER")
                                            <span class="badge badge-danger">User</span>
                                        @else
                                            <span class="badge badge-success">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user['is_vip'] == 0)
                                            <span class="badge badge-danger">No</span>
                                        @else
                                            <span class="badge badge-success">Yes</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user['is_active'] == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{$user['created_at']}}</td>
                                    <td>{{$user['updated_at'] ?? 'N/A'}}</td>
                                    <td>{{$user['deleted_at'] ?? 'N/A'}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$user['id']}}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <style type="text/css">
                            .center {
                                text-align: center;
                            }
                            .center strong {
                                color: red;
                            }
                        </style>
                            <tr name="center" class="center">
                                <td colspan="8">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@if(isset($users))
    @foreach($user_infor as $user)
    <form class="form-edit-category" method="POST" action="{{route('users.update', $user['id'])}}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModalCenter-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$user['id']}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit User [ {{$user['fullname']}} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="fullname" value="{{$user['fullname']}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$user['email']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label" for="role">Role</label>
                        <select id="inputState" class="form-control" name="role">
                            @if($user['role'] == "ROLE_USER")
                                <option value="ROLE_USER" selected>User</option>
                                <option value="ROLE_ADMIN">Admin</option>
                            @else
                                <option value="ROLE_USER">User</option>
                                <option value="ROLE_ADMIN" selected>Admin</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label" for="is_active">Status</label>
                        <select id="is_active" class="form-control" name="is_active">
                            @if($user['is_active'] == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Deactive</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Deactive</option>
                            @endif
                        </select>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    @endforeach
@endif

<script>
    $(document).ready(function() {
        $('#listUsers').DataTable();
    });
</script>
@endsection
