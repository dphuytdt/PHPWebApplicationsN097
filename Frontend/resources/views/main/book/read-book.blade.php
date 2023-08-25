@extends('layouts.main') @section('title', 'Read Book' . $result['book']['title']) @section('content')
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">{{__('messages.productDetails')}} {{ $result['book']['title'] }}</h3>
                        {{ Breadcrumbs::render('bookDetails', $result['book']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <style>
            .container {
                width: 100%;
                height: 100%;
            }
            iframe {
                width: 100%;
                height: 100%;
            }
        </style>
    <div class="container">
        <div class="container">
            <iframe class="iframe" src="https://docs.google.com/gview?url={{Storage::disk('dropbox')->url($result['book']['content'])}}&embedded=true" frameborder="0"></iframe>
        </div>
    </div>
   <script>
         $(document).ready(function() {
            var iframe = document.getElementsByClassName('iframe');
            //get current page of iframe
            var currentPage = iframe[0].contentWindow.document.location.href;

         });
   </script>
@endsection
