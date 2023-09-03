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
                                <th>Content</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Reply Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($result))
                            @foreach($result['newsComment'] as $key => $comment)
                                <tr class="comment-news-admin">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $comment['comment_name'] }}</td>
                                    <td>{{ $comment['content'] }}</td>
                                    <td>News</td>
                                    <td>
                                        @if($comment['status'] == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($result['newsRepply'] as $key => $commentReply)
                                            @if($comment['id'] == $commentReply['comment_parent_id'])
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenterBooks-{{$comment['id']}}">
                                                    View
                                                </button>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $comment['id'] }}">
                                        @if(null == $comment['comment_parent_id'])
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$commentReply['id']}}">
                                                Reply
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm" disabled>
                                                Reply
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm" onclick="handleDeleteComment('{{ $comment['id'] }}', '{{ $comment['news_id'] }}', this)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($result['booksComment'] as $key => $comment)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $comment['comment_name'] }}</td>
                                    <td>{{ $comment['content'] }}</td>
                                    <td>Books</td>
                                    <td>
                                        @if($comment['status'] == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($result['booksRepply'] as $key => $commentReply)
                                            @if($comment['id'] == $commentReply['comment_parent_id'])
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenterBooks-{{$commentReply['id']}}">
                                                    View
                                                </button>
                                            @else
                                                <span class="badge badge-danger">No reply</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $comment['id'] }}">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenterBooks-{{$comment['id']}}">
                                            Reply
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
@if(isset($result))
    @foreach($result['newsComment'] as $key => $comment)
        <div class="modal fade" id="exampleModalCenter-{{$comment['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$comment['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-edit-category" onsubmit="handleSubmitReplyComment(this); return false;">
                        @csrf
                        <input type="hidden" name="comment_parent_id" value="{{ $comment['id'] }}" />
                        <input type="hidden" name="news_id" value="{{ $comment['news_id'] }}" />
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Reply comment of {{$comment['comment_name']}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <style type="text/css">
                            textarea {
                                resize: none;
                            }
                        </style>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Content</label>
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" >{{$comment['content']}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Content reply</label>
                                <div class="row">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($result['booksComment'] as $key => $comment)
        <div class="modal fade" id="exampleModalCenterBooks-{{$comment['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$comment['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-edit-category" onsubmit="handleSubmitReplyComment(); return false;">
                        @csrf
                        <input type="hidden" name="comment_parent_id" value="{{ $comment['id'] }}" />
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Reply comment of {{$comment['comment_name']}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <style type="text/css">
                            textarea {
                                resize: none;
                            }
                        </style>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Content</label>
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" >{{$comment['content']}}</textarea>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <label for="exampleFormControlTextarea1" class="form-label">Content reply</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($result['newsRepply'] as $key => $comment)
        <div class="modal fade" id="exampleModalCenterBooks-{{$comment['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$comment['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-edit-category" onsubmit="handleSubmitReplyComment(); return false;">
                        @csrf
                        <input type="hidden" name="comment_parent_id" value="{{ $comment['id'] }}" />
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Reply comment of {{$comment['comment_name']}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <style type="text/css">
                            textarea {
                                resize: none;
                            }
                        </style>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Content</label>
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" >{{$comment['content']}}</textarea>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <label for="exampleFormControlTextarea1" class="form-label">Content reply</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @foreach($result['booksRepply'] as $key => $comment)
        <div class="modal fade" id="exampleModalCenterBooks-{{$comment['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$comment['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-edit-category" onsubmit="handleSubmitReplyComment(); return false;">
                        @csrf
                        <input type="hidden" name="comment_parent_id" value="{{ $comment['id'] }}" />
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Reply comment of {{$comment['comment_name']}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <style type="text/css">
                            textarea {
                                resize: none;
                            }
                        </style>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Content</label>
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" >{{$comment['content']}}</textarea>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <label for="exampleFormControlTextarea1" class="form-label">Content reply</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

    <script type="text/javascript">
        $(document).ready(function() {
            $('#listComment').DataTable(
                {
                    "pageLength": 5,
                }
            );
        });
    </script>

    <script>
        function handleSubmitReplyComment(form) {
            const formData = new FormData(form);
            var comment_parent_id = formData.get('comment_parent_id');
            var content = formData.get('content');
            var csrf = formData.get('_token');
            var news_id = formData.get('news_id');

            $.ajax({
                url: "{{ route('comments.reply') }}",
                type: "POST",
                data: {
                    comment_parent_id: comment_parent_id,
                    content: content,
                    _token: csrf,
                    news_id: news_id
                },
                success: function(response) {
                    $(form).closest('.modal').modal('hide');
                }
            });
        }

        function handleDeleteComment(id, news_id, element) {
            var csrf = '{{ csrf_token() }}';
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this comment!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete) {
                    $.ajax({
                        url: "{{ route('comments.delete') }}",
                        type: "POST",
                        data: {
                            comment_id: id,
                            _token: csrf,
                            news_id: news_id
                        },
                        success: function(response) {
                            $(element).closest('tr').remove();
                        }
                    });
                }
            });

        }
    </script>
@endsection
