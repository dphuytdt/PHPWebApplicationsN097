@extends('layouts.admin') @section('content') @section('title', 'Statistical')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ Breadcrumbs::render('getBilling') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listCategory" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($totalPayment) && isset($user_infor) && isset($book_infor))
                    @php
                        $i = 1;
                    @endphp
                    @foreach($totalPayment as $statistical)
                        @foreach($user_infor as $user)
                            @if($statistical['user_id'] == $user['id'])
                                @php
                                    $statistical['user_id'] = $user['fullname'];
                                @endphp
                            @endif
                        @endforeach
                        @foreach($book_infor as $book)
                            @if($statistical['book_id'] == $book['id'])
                                @php
                                    $statistical['book_id'] = $book['title'];
                                @endphp
                            @endif
                        @endforeach
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$statistical['user_id']}}</td>
                        <td>{{$statistical['book_id']}}</td>
                        <td>{{$statistical['total_price']}}</td>
                        <td>{{Str::upper($statistical['payment_method'])}}</td>
                        <td>{{$statistical['created_at']}}</td>
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
<script>
    $(document).ready(function() {
        $('#listCategory').DataTable();
    });
</script>
@endsection
