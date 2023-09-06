@extends('layouts.admin')
@section('content')
@section('title', 'Slides List')
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
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">{{ Breadcrumbs::render('slides.index') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listCategory" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Cover Image</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <th>Delete Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($paginator))
                            @foreach($paginator as $slide)
                                <tr>
                                    <td>{{$slide['title']}}</td>
                                    <td><img src="{{ Storage::disk('dropbox')->url($slide['image']) }}" alt="{{$slide['title']}}" width="100px" height="100px"></td>
                                    @if($slide['is_active'] == 1)
                                        <td>Active</td>
                                    @else
                                        <td>Deactive</td>
                                    @endif
                                    <td>{{$slide['created_at']}}</td>
                                    @if($slide['updated_at'] == null)
                                        <td>Not Updated</td>
                                    @else
                                        <td>{{$slide['updated_at']}}</td>
                                    @endif
                                    @if($slide['deleted_at'] == null)
                                        <td>Not Deleted</td>
                                    @else
                                        <td>{{$slide['deleted_at']}}</td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$slide['id']}}">
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
            </div>
        </div>
    </div>

</div>

@if(isset($paginator))
    @foreach($paginator as $slide)
    <form class="form-edit-category" method="POST" action="{{route('category.update', $slide['id'])}}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModalCenter-{{$slide['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-{{$slide['id']}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Slide [ {{$slide['title']}} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name Category</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$slide['title']}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cover Image</label>
                        <div class="row">
                            <div class="col-md-9">
                              <input type="file" class="form-control" id="exampleInputPassword1" name="image" accept="image/*">
                            </div>
                            <div class="col-md-3">
                              <img src="{{ Storage::disk('dropbox')->url($slide['image']) }}" alt="{{$slide['title']}}" width="100px" height="100px" class="img-thumbnail" id="uploadedImage">
                            </div>
                          </div>
                    </div>
                    <div class="">
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                        <select id="inputState" class="form-control" name="status">
                            @if($slide['is_active'] == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Deactive</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Deactive</option>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-danger').click(function(){
            var id = $(this).attr('id');
            var url = "{{route('category.delete', ['id' => 'id'])}}";
            url = url.replace('id', id);
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
                        url: url,
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

<script>
    $(document).ready(function() {
        $('#listCategory').DataTable();
    });
</script>
@endsection
