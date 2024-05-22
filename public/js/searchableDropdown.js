selectedChoise = false;
function closeDropdown() {

    //If user typed sth and there hasnt been a chpose selected
    if ($('#myInput').val() && !selectedChoise) {

        //Update the value
        var firstVisibleOption = $('.dropdown-choice-champ:visible').first().text();
        $('#myInput').val(firstVisibleOption);
    }

    //Close the dropdown
    $('#myDropdown').removeClass('show');

    //Return selectedChoise to false
    selectedChoise = false;
}

$(document).ready(function () {
    $('#myInput').on('input', function () {
        //filter
        var filter = $(this).val().toUpperCase();
        $('#myDropdown div').each(function () {
            if ($(this).text().toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        $('#myDropdown').addClass('show');
    });

    $('.dropdown-choice-champ').on('click', function () {
        //Choose and close menu
        $('#myInput').val($(this).text());
        selectedChoise = true;
        closeDropdown();
    });

    $('#myInput').on('click', function () {
        //filter
        var filter = $(this).val().toUpperCase();
        $('#myDropdown div').each(function () {
            if ($(this).text().toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        $('#myDropdown').addClass('show');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('.dropdown').length) {
            if ($('#myDropdown').hasClass('show')) {
                closeDropdown();
            }
        }
    });
});