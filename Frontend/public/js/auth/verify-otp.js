$("#verifyOtpForm").validate({
    rules: {
        otp: {
            required: true,
            number: true,
            maxlength: 6,
            minlength: 6,
        },
    },
    submitHandler: function(form) {
        form.submit();
        $('button[type="submit"]').prop('disabled', true);
    }

});



