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
                            <th>Quantity</th>
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
                                    <td><img src="{{$book['cover_image'] }}" alt="" width="100px" height="100px"></td>
                                    <td>{{ $book['author'] }}</td>
                                   <td>{{ $book['category_name'] }}</td>
                                    <td>
                                        <a  class="btn btn-info btn-sm" data-target="#exampleModalCenter-{{$book['id']}}" data-toggle="modal">View</a>
                                    </td>
                                    <td >{{ $book['quantity'] }}</td>
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


@if(isset($paginator))
    @foreach($paginator as $key => $book)
        <form class="form-edit-book" method="POST" action="{{route('books.update', $book['id'])}}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="exampleModalCenter-{{$book['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$book['id']}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit book [ {{$book['title']}} ]</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- display content here with scroll bar --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{$book['cover_image']}}" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h3>{{$book['title']}}</h3>
                                    <p>{{$book['description']}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <style type="text/css">
                                        .center {
                                            display: block;
                                            margin-left: auto;
                                            margin-right: auto;
                                            width: 50%;
                                        }
                                        .content {
                                            text-align: justify;
                                            text-justify: inter-word;
                                            /* căn đều 2 bên */
                                            padding-left: 30px;
                                            padding-right: 30px;

                                        }
                                    </style>
                                    <br>
                                    <h3 class="text-center">Start Reading</h3>
                                    @if($book['content_type'] == '1')
                                        <div class="content">
                                            <p>{{$book['content']}}</p>
                                            @else
                                                <div class="content">
                                                    <img src="{{$book['content']}}" alt="" class="center">
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endforeach
@endif

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-danger').click(function(){
            var id = $(this).closest('tr').find('input[name="id"]').val();
            var url = "{{route('books.delete', ['id' => 'id'])}}";
            url = url.replace('id', id);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this books!",
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
                                swal("Poof! Your books has been deleted!", {
                                    icon: "success",
                                });
                                location.reload();
                            }
                        });
                    } else {
                        swal("Your book is safe!",{
                            icon: "success",
                        });
                    }
                });

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#listBook').DataTable(
            {
                "pageLength": 5,
            });
    });
</script>
@endsection
