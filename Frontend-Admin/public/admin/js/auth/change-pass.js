$("#change-password").validate({
    rules: {
        oldpassword: {
            required: true,
            minlength: 8,
            regExpression: true,

        },
        password: {
            required: true,
            minlength: 8,
            regExpression: true,

        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },

    },
    submitHandler: function(form) {
        form.submit();
        $('button[type="submit"]').prop('disabled', true);
    }
});
