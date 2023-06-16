$("#requestForm").validate({
    rules: {
        email: {
            required: true,
            email: true,
            maxlength: 75
        },
        password: {
            required: true,

        },

    },
    submitHandler: function(form) {
        form.submit();
        $('button[type="submit"]').prop('disabled', true);
    }

});



