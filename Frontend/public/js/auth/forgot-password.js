$("#forgotPswForm").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },

    },
    submitHandler: function(form) {
        form.submit();
        $('button[type="submit"]').prop('disabled', true);
    }

});



