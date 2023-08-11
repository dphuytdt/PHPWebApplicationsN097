$("#registerForm").validate({
    rules: {
        fullname: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        email: {
            required: true,
            email: true,
            maxlength: 75
        },
        passwordRe: {
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



