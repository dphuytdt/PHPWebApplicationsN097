@extends('layouts.admin')
@section('content')
    @section('title', 'News List')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
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
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #0d6efd;
            padding: 0.2rem;
        }
    </style>
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
                            <th>Tags</th>
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
                        @if(isset($news) || count($news) > 0 || $news != null)
                            @foreach($news as $new)
                                <tr>
                                    <td>{{$new['id']}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['title'], $numberLimit)}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['slug'], $numberLimit)}}</td>
                                    <td>{{Illuminate\Support\Str::limit($new['description'], $numberLimit)}}</td>
                                    <td><img src="{{ $new['image'] }}" alt="" width="100px" height="100px"></td>
                                    <td>
                                        <a  class="btn btn-info btn-sm" data-target=".bd-example-modal-lg-{{$new['id']}}" data-toggle="modal">View</a>
                                    </td>
                                    <td>
                                        @if($new['is_active'] == 0)
                                            <span class="badge badge-danger">Inactive</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $tagsNews = explode(',', $new['tags']);
                                        @endphp
                                        @foreach($tags as $tag)
                                            @foreach($tagsNews as $tagsNew)
                                                @if($tag['tag_name'] == $tagsNew)
                                                    <span class="badge badge-info">{{$tag['tag_name']}}</span>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>{{$new['created_at'] ?? 'N/A'}}</td>
                                    <td>{{$new['updated_at'] ?? 'N/A'}}</td>
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
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{$new['title']}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">New Slug (Optional)</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="slug" value="{{$new['slug']}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" >{{$new['description'], $numberLimit}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">
                                        Content
                                        <color style="color: red">*</color>
                                    </label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="content" >{{$new['content']}}</textarea>
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
                                            <img src="{{ $new['image'] }}" alt="{{$new['title']}}" width="100px" height="100px" class="img-thumbnail" id="uploadedImage">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags: <color style="color: red;">*</color></label>
                                    <br>

                                    @php
                                        $tagsNews = explode(',', $new['tags']);
                                        $temp = '';
                                    @endphp
                                    @foreach($tags as $tag)
                                        @foreach($tagsNews as $tagsNew)
                                            @if($tag['tag_name'] == $tagsNew)
                                                @php
                                                    $temp .= $tag['tag_name'].',';
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <input type="text" id="tags"  name="tags" class="form-control" data-role="tagsinput" value="{{$temp}}" required/>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(function () {
            $("input")
                .on("change", function (event) {
                    var $element = $(event.target);
                    var $container = $element.closest(".example");

                    if (!$element.data("tagsinput")) return;

                    var val = $element.val();
                    if (val === null) val = "null";
                    var items = $element.tagsinput("items");

                    $("code", $("pre.val", $container)).html($.isArray(val) ? JSON.stringify(val) : '"' + val.replace('"', '\\"') + '"');
                    $("code", $("pre.items", $container)).html(JSON.stringify($element.tagsinput("items")));
                })
                .trigger("change");
        });
    </script>
@endsection
