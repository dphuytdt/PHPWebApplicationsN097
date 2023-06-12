@extends('layouts.admin')
@section('content')
@section('title', 'Category List')
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">List of all categories</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <td>{{$category['name']}}</td>
                                    <td><img src="{{$category['image']}}" alt="{{$category['name']}}" width="100px" height="100px"></td>
                                    @if($category['status'] == 1)
                                        <td>Active</td>
                                    @else
                                        <td>Deactive</td>
                                    @endif
                                    <td>{{$category['description']}}</td>
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
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$category['id']}}">
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
                <style >
                    .pagination-container {
                        text-align: center;
                    }

                    .pagination {
                        display: inline-block;
                        margin-top: 10px;
                    }

                    .pagination a, .pagination span {
                        display: inline-block;
                        padding: 5px 10px;
                        margin-right: 5px;
                        border: 1px solid #ccc;
                        text-decoration: none;
                        color: #333;
                    }

                    .pagination a:hover {
                        background-color: #f5f5f5;
                    }

                    .pagination .current {
                        background-color: #ccc;
                        color: #fff;
                    }

                </style>
                <div class="pagination">
                    @if ($paginator->onFirstPage())
                        <span class="disabled">Previous</span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
                    @endif

                    {{-- Hiển thị số trang --}}
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    @if ($i === $paginator->currentPage())
                        <span class="current">{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                    @endfor

                    {{-- Hiển thị nút Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}">Next</a>
                    @else
                        <span class="disabled">Next</span>
                    @endif
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>

</div>

@if(isset($paginator))
    @foreach($paginator as $category)
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter-{{$category['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$category['id']}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    @endforeach
@endif
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-danger').click(function(){
            var id = $(this).attr('id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{URL::to('/admin/category/delete/'.$category['id'])}}",
                        data: {id: id},
                        success: function(data){
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                } else {
                    swal("Your imaginary file is safe!",{
                        icon: "success",
                    });
                }
            });

        });
    });
</script>
@endsection