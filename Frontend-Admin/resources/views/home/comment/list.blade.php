@extends('layouts.admin')
@section('content')
@section('title', 'Comment List')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('comments.index') }}</h1>
        {{-- <p class="mb-4">List of all categories</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="listComment" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Content<th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($paginator))
                            @foreach($paginator as $key => $comment)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $comment['comment_name'] }}</td>
                                    <td>{{ $comment['content'] }}</td>
                                    <td>
                                        @if($comment['status'] == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $comment['id'] }}">
                                        <a href="{{ route('comments.edit', $comment['id']) }}" class="btn btn-primary btn-sm">Edit</a>
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
                            <tr  class="center">
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
            $('#listComment').DataTable(
                {
                    "pageLength": 5,
                });
        });
    </script>
@endsection
