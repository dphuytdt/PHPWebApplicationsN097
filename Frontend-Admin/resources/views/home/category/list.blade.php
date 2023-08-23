@extends('layouts.admin')
@section('content')
@section('title', 'Category List')
{{-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> --}}
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
@php
    $numberLimit = 30;
@endphp
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('category.index') }}</h1>
    <input type="hidden" id="__token" name="__token" value="{{ csrf_token() }}">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listCategory" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cover Image</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <th>Delete Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($paginator))
                            @foreach($paginator as $category)
                                <tr>
                                    <td>{{Illuminate\Support\Str::limit($category['name'],  $numberLimit)}}</td>
                                    <td>
                                        <img src="data:image/{{ $category['image_extension'] }};base64,{{ $category['image'] }}" alt="Image">                                    </td>
                                    @if($category['status'] == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Deactive</span>
                                    @endif
                                    <td>{{Illuminate\Support\Str::limit($category['description'],  $numberLimit)}}</td>
                                    <td>{{$category['created_at']}}</td>
                                    @if($category['updated_at'] == null)
                                        <td>Not Updated</td>
                                    @else
                                        <td>{{$category['updated_at']}}</td>
                                    @endif
                                    @if($category['deleted_at'] == null)
                                        <td>Not Deleted</td>
                                    @else
                                        <td>{{$category['deleted_at']}}</td>
                                    @endif
                                    <input type="hidden" name="id" value="{{$category['id']}}">
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$category['id']}}">
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

@if(isset($paginator))
    @foreach($paginator as $category)
    <form class="form-edit-category" method="POST" action="{{route('category.update', $category['id'])}}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModalCenter-{{$category['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$category['id']}}" aria-hidden="true">
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
                        <label for="name" class="form-label">Name Category</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{Illuminate\Support\Str::limit($category['name'],  $numberLimit)}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Cover Image</label>
                        <div class="row">
                            <div class="col-md-9">
                              <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="col-md-3">
                              <img src="data:image/{{ $category['image_extension'] }};base64,{{ $category['image'] }}" alt="{{$category['name']}}" width="100px" height="100px" name="image" class="img-thumbnail" id="uploadedImage">
                            </div>
                          </div>
                    </div>
                    <div class="">
                        <label class="form-check-label" for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            @if($category['status'] == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Deactivate</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Deactivate</option>
                            @endif
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" style="resize: none;" name="description" >{{Illuminate\Support\Str::limit($category['description'],  $numberLimit)}}</textarea>
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
        //custom 5 row per page
        $('#listCategory').dataTable( {
            "pageLength": 3,
        } );
    });
</script>
@endsection
