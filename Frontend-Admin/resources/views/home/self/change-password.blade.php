@extends('layouts.admin') @section('content') @section('title', 'Change Password')
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
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="password" class="form-control" id="password" name="password" data-label="New Password">
                </div>
                <span class="text-danger" id="password-error"></span>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-label="Confirm Password">
                </div>
                <span class="text-danger" id="password_confirmation-error"></span>
            </div>
        </div>
        <button type="button" class="btn btn-primary">Change</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('password_confirmation-error');
        const form = document.getElementById('change-password');

        function validatePassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password !== confirmPassword) {
                passwordError.textContent = "Passwords do not match.";
                confirmPasswordError.textContent = "Passwords do not match.";
                form.addEventListener('submit', preventFormSubmission);
            } else {
                passwordError.textContent = "";
                confirmPasswordError.textContent = "";
                form.removeEventListener('submit', preventFormSubmission);
            }
        }

        function preventFormSubmission(event) {
            event.preventDefault();
        }

        form.addEventListener('submit', validatePassword);
    });
</script>
@endsection
