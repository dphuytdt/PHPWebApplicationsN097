@extends('layouts.admin') @section('content') @section('title', 'My Profile')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ Breadcrumbs::render('getBilling') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listCategory" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>Book ID</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($totalPayment))
                    @php
                    $i = 1;
                    @endphp
                    @foreach($totalPayment as $statistical)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$statistical['user_id']}}</td>
                        <td>{{$statistical['book_id']}}</td>
                        <td>{{strtoupper($statistical['total_price'])}}</td>
                        <td>{{$statistical['payment_method']}}</td>
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
