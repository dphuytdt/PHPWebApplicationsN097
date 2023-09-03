@extends('layouts.admin') @section('content') @section('title', 'Change Password')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ Breadcrumbs::render('get.changePassword', session('admin')['id']) }}</h1>
</div>
<div class="container">
    <form id="change-password" action="{{route('changePassword', session('admin')['id'])}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="oldpassword" class="form-label">Old Password</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" data-label="Old Password">
                </div>
            </div>
            <span class="text-danger" id="oldpassword-error"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="password" class="form-control" id="password" name="password" data-label="New Password">
                </div>

            </div>
            <span class="text-danger" id="password-error"></span>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-label="Confirm Password">
                </div>

            </div>
            <span class="text-danger" id="password_confirmation-error"></span>
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $("#change-password").on("submit", function(e) {
            e.preventDefault();
            var oldpassword = $("#oldpassword").val();
            var password = $("#password").val();
            var password_confirmation = $("#password_confirmation").val();
            if ($("#oldpassword").val() == "") {
                $("#oldpassword-error").text("Old password is required");
            } else {
                $("#oldpassword-error").text("");
            }
            if ($("#password").val() == "") {
                $("#password-error").text("New password is required");
            } else {
                $("#password-error").text("");
            }
            if ($("#password_confirmation").val() == "") {
                $("#password_confirmation-error").text("Confirm password is required");
            } else {
                $("#password_confirmation-error").text("");
            }

            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])(?=.{8,})/;
            if (!regex.test(password)) {
                $("#password-error").text("Password must contain at least 1 lowercase, 1 uppercase, 1 numeric, 1 special character, and 8 character");
            } else {
                $("#password-error").text("");
            }

            if (password !== password_confirmation || password_confirmation == "") {
                $("#password_confirmation-error").text("Confirm password is not match");
            } else {
                $("#password_confirmation-error").text("");
                $.ajax({
                    url: "{{route('changePassword', session('admin')['id'])}}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data.error) {
                            $.each(data.error, function(key, value) {
                                $("#" + key + "-error").text(value[0]);
                            });
                        } else {
                            $("#change-password")[0].reset();
                            $("#password_confirmation-error").text("");
                            swal({
                                title: "Success!",
                                text: data.success,
                                icon: "success",
                                button: "OK",
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
