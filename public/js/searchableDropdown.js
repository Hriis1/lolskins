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
            $('#myDropdown').removeClass('show');
        }
    });
});