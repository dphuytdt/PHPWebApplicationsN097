@extends('layouts.admin')
@section('content')
    @section('title', 'Category List')
    {{-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> --}}
    {{-- <script>
        $(document).ready(function() {
          $("#exampleInputPassword1").on("change", function() {
            var input = this;
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#uploadedImage').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          });
        });
    </script> --}}
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('news.index') }}</h1>
        {{-- <p class="mb-4">List of all categories</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="listUsers" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Update Date</th>
                            <th>Delete Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($news))
                            @foreach($news as $news)
                                <tr>
                                    <td>{{$new['id']}}</td>
                                    <td>{{$new['title']}}</td>
                                    <td>{{$new['slug']}}</td>
                                    <td>{{$new['description']}}</td>
                                    <td><img src="{{$new['image'] }}" alt="" width="100px" height="100px"></td>
                                    <td>
                                        @if($new['is_active'] == 0)
                                            <span class="badge badge-danger">Inactive</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{$new['created_at']}}</td>
                                    <td>{{$new['updated_at']}}</td>
                                    <td>{{$new['deleted_at']}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$new['id']}}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            Delete
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

    {{-- @if(isset($news))
        @foreach($news as $new)
        <form class="form-edit-category" method="POST" action="{{route('users.update', $new['id'])}}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="exampleModalCenter-{{$new['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$category['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category [ {{$category['name']}} ]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name Category</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$category['name']}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Cover Image</label>
                            <div class="row">
                                <div class="col-md-9">
                                  <input type="file" class="form-control" id="exampleInputPassword1" name="image" accept="image/*">
                                </div>
                                <div class="col-md-3">
                                  <img src="{{$category['image']}}" alt="{{$category['name']}}" width="100px" height="100px" class="img-thumbnail" id="uploadedImage">
                                </div>
                              </div>
                        </div>
                        <div class="">
                            <label class="form-check-label" for="exampleCheck1">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                @if($category['status'] == 1)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Deactive</option>
                                @endif
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" >{{$category['description']}}</textarea>
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
    @endif --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-danger').click(function(){
                var id = $(this).attr('id');
                var url = "{{route('category.delete', ['id' => 'id'])}}";
                url = url.replace('id', id);
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, user's data will be lost forever!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: url,
                                data: {id: id},
                                success: function(data){
                                    swal("Poof! Action success!", {
                                        icon: "success",
                                    });
                                    location.reload();
                                }
                            });
                        } else {
                            swal("Action canceled!", {
                                icon: "success",
                            });
                        }
                    });

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#listUsers').DataTable();
        });
    </script>
@endsection
