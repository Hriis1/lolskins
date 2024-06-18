$(document).ready(function () {
    new DataTable('#dataSkins');

    $('#addRatingForm').on('submit', function (e) {
        validateAddOpinionForm(e, this);
    });
});

function validateAddOpinionForm(e, form) {
    e.preventDefault();
    var isValid = true;

    // Validate specific fields by ID
    var requiredFields = ['#user_id_input', '.champInput', '.skinInput'];

    requiredFields.forEach(function (selector) {
        var $field = $(form).find(selector);
        if (!$field.val().trim()) {
            isValid = false;
        }
    });

    if (isValid) {
        HTMLFormElement.prototype.submit.call(form);
    } else {
        $('#addOptinionError').text('Fill in all required fields!');
    }
}


