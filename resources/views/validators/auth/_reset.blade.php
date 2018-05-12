$('.reset-password-form').formValidation({
    @include('validators.general._framework'),
    fields: {
        email: {
            validators: {
                notEmpty: {
                    message: 'The email is required.'
                },
                emailAddress: {
                    message: 'The value is not a valid email address.'
                },
            }
        },
        @include('validators.accounts.fields._password_register'),
        @include('validators.accounts.fields._password_confirmation'),
    }
})
.on('err.field.fv', function(e, data) {

    var invalidFields = data.fv.getInvalidFields()

    removeServerSideValidationFeedback(invalidFields)

})
.on('success.field.fv', function(e, data) {

    var validFields = data.element

    removeServerSideValidationFeedback(validFields)
})