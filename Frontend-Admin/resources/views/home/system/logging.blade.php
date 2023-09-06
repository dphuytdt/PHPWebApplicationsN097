@extends('layouts.admin') @section('content') @section('title', 'Activity Log')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ Breadcrumbs::render('checkLog') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="listCategory" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($logs))
                        @php
                            $i = 1;
                        @endphp
                        @foreach($logs as $log)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$log['time']}}</td>
                                <td>{{$log['content']}}</td>
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
