var required = jQuery.validator.format("{0} is required");
var maxlentha = jQuery.validator.format("{0} must be less than {1} characters");
var email = jQuery.validator.format("{0} is not a valid email address");
var pwsmatcha = jQuery.validator.format("{0} and {1} do not match");
var inValid = jQuery.validator.format("{0} is invalid");
var regExpr = jQuery.validator.format("{0} is must be 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number");
$.validator.messages.required = function (param,  inputField) {
    $getLabelTextByIdInput = $(inputField).data('label');
    return required($getLabelTextByIdInput);
}
$.validator.messages.maxlength = function (param, inputField) {
    $getLabelTextByIdInput =  $(inputField).data('label');
    return maxlentha($getLabelTextByIdInput, param);
}
$.validator.messages.email = function (param, inputField) {
    $getLabelTextByIdInput = $(inputField).data('label');
    return email($getLabelTextByIdInput);
}
$.validator.messages.equalTo = function (param, inputField) {
    $getLabelTextByIdInput = $('#password').data('label');
    $getLabelTextByIdInput2 = $('#password_confirmation').data('label');
    return pwsmatcha($getLabelTextByIdInput, $getLabelTextByIdInput2);
}
$.validator.addMethod("regExpression", function (value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(value);
}, function (param, inputField) {
    $getLabelTextByIdInput = $('#password').data('label');
    return regExpr($getLabelTextByIdInput);
});

$.validator.setDefaults({
    errorPlacement: function (error, element) {
        //change to red 
        element.css('border-color', 'red');
        //background color to red
        element.css('background-color', 'rgba(255, 0, 0, 0.2)');
        //error message to red
        error.css('color', 'red');
        //error message to italic font, size 12px
        error.css('font-style', 'italic');
        error.css('font-size', '12px');
        //add error message
        error.insertAfter(element);
        //keep default element size
        element.css('width', '100%');
        //keep default element size
        // element.css('height', '100%');

        // if(element.attr('name') == 'email') {
        //     error.appendTo('#emailError');
        // }
        // if (element.attr('name') == 'password') {
        //     error.appendTo('#passwordError');
        // }
    },
});