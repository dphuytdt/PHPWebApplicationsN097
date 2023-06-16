$("#formProfile").validate({
    rules: {
        fullname: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        birthday: {
            required: true,
            date: true,
            // format: 'dd/mm/yyyy'
        },
        address: {
            required: true,
            minlength: 2,
            maxlength: 100
        },
        phone: {
            required: true,
            minlength: 10,
            maxlength: 11,
            number: true
        },


    },
    submitHandler: function(form) {
        form.submit();
        $('button[type="submit"]').prop('disabled', true);
    }

});



