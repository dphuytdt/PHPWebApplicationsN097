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
                                <th>Name</th>
                                <th>Content</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($result))
                            @foreach($result['booksComment'] as $key => $comment)
                                <tr>
                                    <td>{{ $comment[0]['comment_name'] }}</td>
                                    <td>{{ $comment[0]['content'] }}</td>
                                    <td>Books</td>
                                    <td>
                                        @if($comment[0]['status'] == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $comment[0]['id'] }}">
                                        <button id="replyBookCmt{{$comment[0]['id']}}"  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenterBooks-{{$comment[0]['id']}}"
                                                @if(isset($comment[1])) disabled @endif
                                        >
                                            Reply
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="handleDeleteComment('{{ $comment[0]['id'] }}', '{{ $comment[0]['target_id'] }}', this, 1)">
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
    @foreach($result['booksComment'] as $key => $comment)
        <div class="modal fade" id="exampleModalCenterBooks-{{$comment[0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$comment[0]['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form-edit-category" onsubmit="return handleSubmitReplyComment(this);">
                        @csrf
                        <input type="hidden" name="comment_parent_id" value="{{ $comment[0]['id'] }}" />
                        <input type="hidden" name="type" value="1" />
                        <input type="hidden" name="target_id" value="{{ $comment[0]['target_id'] }}" />
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Reply comment of {{$comment[0]['comment_name']}}</h4>
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
                                <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" >{{$comment[0]['content']}}</textarea>
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
            var comment_id = formData.get('comment_parent_id');
            $.ajax({
                url: "{{ route('comments.reply') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $(form).closest('.modal').modal('hide');
                    if (formData.get('type') == 1) {
                        $('#replyBookCmt'+comment_id).attr('disabled', true);
                    } else {
                        var tr = generateNewReply(response);

                        $('#listComment').append(tr);
                    }

                    return false;
                },
            });
            return false;
        }

        function generateNewReply(response) {
            var tr = document.createElement("tr");
            tr.className = "comment-news-admin";

            // Create and populate the table cells
            var tdName = document.createElement("td");
            tdName.textContent = response['comment_name'];

            var tdContent = document.createElement("td");
            tdContent.textContent = response['content']

            var tdType = document.createElement("td");
            tdType.textContent = "News";

            var tdStatus = document.createElement("td");
            var statusSpan = document.createElement("span");
            statusSpan.className = "badge badge-success";
            statusSpan.textContent = "Active";
            tdStatus.appendChild(statusSpan);

            var tdActions = document.createElement("td");
            var hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "id";
            hiddenInput.value = response['id'];

            var replyButton = document.createElement("button");
            replyButton.id = "replyBookCmt" + response['id'];
            replyButton.type = "button";
            replyButton.className = "btn btn-primary btn-sm";
            replyButton.setAttribute("data-toggle", "modal");
            replyButton.setAttribute("data-target", "#exampleModalCenter-" + response['id']);
            replyButton.textContent = "Reply";

            var deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.className = "btn btn-danger btn-sm";
            deleteButton.onclick = function () {
                handleDeleteComment(response['id'], response['target_id'], this, 2);
            };
            deleteButton.textContent = "Delete";

            // Append all created elements to the table row
            tdActions.appendChild(hiddenInput);
            tdActions.appendChild(replyButton);
            tdActions.appendChild(deleteButton);

            tr.appendChild(tdName);
            tr.appendChild(tdContent);
            tr.appendChild(tdType);
            tr.appendChild(tdStatus);
            tr.appendChild(tdActions);

            // Return the generated table row
            return tr;
        }

        function handleDeleteComment(id, target_id, element, type, reply) {
            var csrf = '{{ csrf_token() }}';
            console.log(reply);
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
                            target_id: target_id,
                            type: type
                        },
                        success: function(response) {
                            $(element).closest('tr').remove();
                            // remove all reply comment

                        }
                    });
                }
            });
        }
    </script>
@endsection
