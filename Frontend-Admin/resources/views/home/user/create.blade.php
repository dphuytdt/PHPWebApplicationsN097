@extends('layouts.admin')
@section('content')
    @section('title', 'Create News')
    {{-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#image").on("change", function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#uploadedImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row text-gray-800">
            <div class="col-md-12">
                <h1 class="h3 mb-4 ">{{ Breadcrumbs::render('users.create') }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
            <br>
        @elseif(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#importNewsModal">
            <i class="fas fa-download fa-sm text-white-50"></i> Import Users
        </a>

        <div class="modal fade" id="importNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('users.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Users From CSV File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input name="file" type="file" id="file" class="form-control" accept="text/csv" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="fullname" class="form-label">Full name: (Optional)</label>
                <input type="text" class="form-control" id="fullname" name="fullname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email: <color style="color: red;">*</color></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">User Role</label>
                <style type="text/css">
                    .form-select{
                        width: 100%;
                        height: calc(1.5em + 0.75rem + 2px);
                        border: 1px solid #ced4da;
                    }
                </style>
                <select id="role" name="role" class="form-select" required>
                    <option selected disabled>Select Role</option>
                    <option value="ROLE_USER">User</option>
                    <option value="ROLE_ADMIN">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
