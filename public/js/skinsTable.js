$(document).ready(function () {
    new DataTable('#dataSkins');

    //Surface level validation from frontend for add and edit forms
    $('#addRatingForm').on('submit', function (e) {
        validateOpinionForms(e, this, '#addOptinionError');
    });
    $('#editRatingForm').on('submit', function (e) {
        validateOpinionForms(e, this, '#editOptinionError');
    });

    //When opening the edit modal
    $('.editBtn').click(function () {

        //Get the values
        //Get the current tr
        var $row = $(this).closest('tr');

        // Get the values from the tr
        var champVal = $row.find('#champTD').text();
        var skinVal = $row.find('#skinTD').text();
        var usableVal = $row.find('#usableTD').text() == 'Yes' ? 1 : 0;
        var opinionVal = $row.find('#opinionTD').text();
        var ratingVal = $row.find('#ratingTD').text();
        if (ratingVal) { // Check if ratingVal is not empty
            ratingVal = parseInt(ratingVal.charAt(0)); // Get the first character as integer
        }
        var best_skinVal = $row.find('#best_skinTD').text() == 'Yes' ? 1 : 0;


        //Set the edit modal values
        $('#champ_name_edit').val(champVal);
        $('#skin_name_edit').val(skinVal);
        $('#usable_edit').val(usableVal);
        $('#opinion_edit').val(opinionVal);
        if (ratingVal) {
            $('#rating_edit').val(ratingVal);
        }
        $('#best_skin_edit').val(best_skinVal);

    });
});

function validateOpinionForms(e, form, errorTextIdSelector) {
    e.preventDefault();
    var isValid = true;

    // Validate specific fields by ID
    var requiredFields = ['#user_id_input', '.champ_input', '.skin_input', '.usable'];

    requiredFields.forEach(function (selector) {
        var $field = $(form).find(selector);
        if (!$field.val().trim()) {
            isValid = false;
        }
    });

    if (isValid) {
        HTMLFormElement.prototype.submit.call(form);
    } else {
        $(errorTextIdSelector).text('Fill in all required fields!');
    }
}


