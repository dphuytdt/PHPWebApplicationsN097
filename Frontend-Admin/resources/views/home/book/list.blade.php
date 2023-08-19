@extends('layouts.admin')
@section('content')
@section('title', 'Book List')
{{-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> --}}
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
@php
    $numberLimit = 30;
@endphp
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('books.index') }}</h1>
    {{-- <p class="mb-4">List of all categories</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <table id="listBook" class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Cover Image</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Content</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($paginator))
                            @foreach($paginator as $key => $book)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $book['title'] }}</td>
{{--                                    <td><img src="{{ asset('storage/'.$book['cover_image']) }}" alt="" width="100px" height="100px"></td>--}}
                                    <td><img src="data:image/{{$book['image_extension']}};base64,{{ $book['cover_image'] }}" alt="" width="100px" height="100px"></td>
                                    <td>{{ Illuminate\Support\Str::limit($book['author'], $numberLimit) }}</td>
                                   <td>{{ Illuminate\Support\Str::limit($book['category_name'], $numberLimit) }}</td>
                                    <td>
                                        <a  class="btn btn-info btn-sm" data-target=".bd-example-modal-lg-{{$book['id']}}" data-toggle="modal">View</a>
                                    </td>
                                    @if($book['price'] == null)
                                        <td>Not Updated</td>
                                    @elseif($book['price'] == 0)
                                        <td>Free</td>
                                    @else
                                        <td>${{ $book['price'] }}</td>
                                    @endif
                                    <input type="hidden" name="id" value="{{ $book['id'] }}">
                                    <td>
                                        <a href="{{ route('books.edit', $book['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>


                                <div class="modal fade bd-example-modal-lg-{{$book['id']}}">
                                    <div class="modal-dialog modal-fullscreen no-scroll">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$book['title']}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div id="pdf-wrapper">
                                                    <iframe src="data:application/pdf;base64,{{ $book['content'] }}#toolbar=0" width="100%" height="100%" frameborder="0">
                                                    </iframe>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" id="bookmarked" class="btn btn-primary">Bookmarked</button>
                                            </div>
                                            <input type="hidden" id="bookId" value="{{$book['id']}}">
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#listBook').DataTable(
            {
                "pageLength": 5,
            });
    });
</script>
@endsection
