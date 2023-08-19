@extends('layouts.admin')
@section('content')
    @section('title', 'News List')
     <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script>
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
    </script>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('news.index') }}</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="listNews" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <th>Delete Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $numberLimit = 30;
                        @endphp
                        @if(isset($news))
                            @foreach($news as $new)
                                <tr>
                                    <td>{{$new['id']}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['title'], $numberLimit)}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['slug'], $numberLimit)}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['description'], $numberLimit)}}</td>
                                    <td><img src="data:image/{{$new['image_extension']}};base64,{{ $new['image'] }}" alt="" width="100px" height="100px"></td>
                                    <td>
                                        @if($new['is_active'] == 0)
                                            <span class="badge badge-danger">Inactive</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a  class="btn btn-info btn-sm" data-target=".bd-example-modal-lg-{{$new['id']}}" data-toggle="modal">View</a>
                                    </td>
                                    <td>{{$new['created_at']}}</td>
                                    <td>{{$new['updated_at']}}</td>
                                    <td>
                                        @if($new['deleted_at'] == null)
                                            <span class="badge badge-success">N/A</span>
                                        @else
                                            <span class="badge badge-danger">Deleted</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$new['id']}}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade bd-example-modal-lg-{{$new['id']}}">
                                    <div class="modal-dialog modal-fullscreen no-scroll">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$new['title']}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <textarea disabled class="form-control" id="contents" name="contents" rows="7">{{$new['content']}}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            <input type="hidden" id="bookId" value="{{$new['id']}}">
                                        </div>
                                    </div>
                                </div>
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
    @if(isset($news))
        @foreach($news as $new)
            <form class="form-edit-category" method="POST" action="{{route('news.update', $new['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="exampleModalCenter-{{$new['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$new['id']}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Category [ {{$new['title']}} ]</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        New Title
                                        <color style="color: red">*</color>
                                    </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{Illuminate\Support\Str::limit($new['title'], $numberLimit) ?? ''}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">New Slug (Optional)</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="slug" value="{{Illuminate\Support\Str::limit($new['slug'], $numberLimit) ?? ''}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" >{{Illuminate\Support\Str::limit($new['description'], $numberLimit) ?? ''}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">
                                        Content
                                        <color style="color: red">*</color>
                                    </label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="content" >{{Illuminate\Support\Str::limit($new['content'], $numberLimit) ?? ''}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">
                                        Cover Image
                                        <color style="color: red">*</color>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" id="exampleInputPassword1" name="image" accept="image/*">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="data:image/{{$new['image_extension']}};base64,{{ $new['image'] }}" alt="{{$new['title']}}" width="100px" height="100px" class="img-thumbnail" id="uploadedImage">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="form-check-label" for="inputState">
                                        Status
                                        <color style="color: red">*</color>
                                    </label>
                                    <select id="inputState" class="form-control" name="status">
                                        @if($new['is_active'] == 1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">Deactivate</option>
                                        @else
                                            <option value="1">Active</option>
                                            <option value="0" selected>Deactivate</option>
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
            $('#listNews').DataTable();
        });
    </script>
@endsection
