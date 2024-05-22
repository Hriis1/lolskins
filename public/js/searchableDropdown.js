function closeDropdown() {

    //If user typed sth
    if ($('#myInput').val()) {

        //Update the value
        var firstVisibleOption = $('.dropdown-choice:visible').first().text();
        $('#myInput').val(firstVisibleOption);
    }

    //Close the dropdown
    $('#myDropdown').removeClass('show');
}

$(document).ready(function () {
    $('#myInput').on('keyup', function () {
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

    $('.dropdown-choice').on('click', function () {
        //Choose and close menu
        $('#myInput').val($(this).text());
        $('#myDropdown').removeClass('show');
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