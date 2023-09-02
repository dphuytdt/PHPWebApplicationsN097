$("#change-password").validate({
    rules: {
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
