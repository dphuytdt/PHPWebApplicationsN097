@extends('layouts.admin')
@section('content')
    @section('title', 'Edit Book')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        <div class="row text-gray-800">
            <div class="col-md-12">
                <h1 class="h3 mb-4 ">{{ Breadcrumbs::render('books.edit' , $book['id']) }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container">
            <br><br>
            <form action="{{route('books.update' , $book['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$book['title']}}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description">{{$book['description']}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Cover Image</label>
                    <div class="row">
                        <div class="col-md-7">
                            <input type="file" class="form-control" id="exampleInputPassword1" name="image" accept="image/*">
                        </div>
                        <div class="col-md-5">
                            @if($book['cover_image'])
                                <img src="{{ $book['cover_image'] }}" alt="Responsive image" width="251" height="201" class="img-thumbnail" id="uploadedImage"
                            @else
                                <img src="data:image/jpeg;base64,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" alt="" width="251" height="201" class="img-thumbnail" id="uploadedImage">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <input type="file" class="form-control" id="content" name="content" accept="application/pdf">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{$book['author']}}">
                </div>
                <div class="mb-3">
                    <label for="disabledSelect" class="form-label">Category menu</label>
                    <style type="text/css">
                        .form-select{
                            width: 100%;
                            height: calc(1.5em + 0.75rem + 2px);
                            border: 1px solid #ced4da;
                        }
                        textarea {
                            resize: none;
                        }
                    </style>
                    <select id="disabledSelect" class="form-select" name="category_id">
                        <option selected>Select Category</option>
                        @foreach($categories as $category)
                            @if($category['id'] == $book['category_id'])
                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                            @endif
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price: ($)</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$book['price']}}">
                </div>
                <div class="mb-3 contentType">
                    <label for="is_vip_valid" class="form-label">Is Valid For Vip</label>
                    <select id="is_vip_valid" class="form-select" name="is_vip_valid">
                        <option selected>Select Option</option>
                        @if($book['is_vip_valid'] == 1)
                            <option value="1" selected>Yes</option>
                            <option value="2">No</option>
                        @else
                            <option value="1">Yes</option>
                            <option value="2" selected>No</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3 contentType">
                    <label for="contentType" class="form-label">Is Featured <color style="color: red;">*</color></label>
                    <select id="contentType" class="form-select" name="is_featured">
                        <option selected>Select Status</option>
                        @if($book['is_featured'] == 1)
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        @else
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3 contentType">
                    <label for="is_vip_valid" class="form-label">Is Valid For Vip <color style="color: red;">*</color></label>
                    <select id="is_vip_valid" class="form-select" name="is_vip_valid">
                        <option selected>Select Status</option>
                        @if($book['is_vip_valid'] == 1)
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        @else
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3 contentType">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select" name="status">
                        <option selected>Select Status</option>
                        @if($book['status'] == 1)
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        @else
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
@endsection
