var selectedChoice = false;

function closeDropdown(dropdown) {
    var input = dropdown.find('.myInput');
    var choices = dropdown.find('.dropdown-choice');

    // If user typed something and there hasn't been a choice selected
    if (input.val() && !selectedChoice) {
        // Update the value
        var firstVisibleOption = choices.filter(':visible').first().text();
        input.val(firstVisibleOption);
    }

    // Close the dropdown
    dropdown.find('.dropdown-content').removeClass('show');

    // Return selectedChoice to false
    selectedChoice = false;

    //If its the champ dropdown
    if (dropdown.attr('id') == 'champDropDown') {
        //An option was selected
        if (input.val()) {
            //Enable the skin input
            $("#skinDropDown").removeClass("uninteractable");
        } else {
            //Reset and remove the skin input
            $("#skinDropDown").addClass("uninteractable");
            $("#skinInput").val("");
        }
    }
}

$(document).ready(function () {
    $(document).on('input', '.myInput', function () {
        var input = $(this);
        var filter = input.val().toUpperCase();
        var dropdown = input.closest('.dropdown');
        var choices = dropdown.find('.dropdown-choice');

        // Filter
        choices.each(function () {
            if ($(this).text().toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        dropdown.find('.dropdown-content').addClass('show');

    });

    $(document).on('click', '.myInput', function () {
        var input = $(this);
        var dropdown = input.closest('.dropdown');
        // Close other dropdowns
        otherDropdowns = $('.dropdown').not(dropdown);
        otherDropdowns.each(function () {
            $(this).find('.dropdown-content').removeClass('show');

            //If its the champ dropdown
            if ($(this).attr('id') == 'champDropDown') {
                //An option was selected
                var input = $(this).find('.myInput');
                if (input.val()) {
                    //Enable the skin input
                    $("#skinDropDown").removeClass("uninteractable");
                } else {
                    //Reset and remove the skin input
                    $("#skinDropDown").addClass("uninteractable");
                    $("#skinInput").val("");
                }
            }
        });
    });

    $(document).on('click', '.dropdown-choice', function () {
        var choice = $(this);
        var dropdown = choice.closest('.dropdown');
        var input = dropdown.find('.myInput');

        // Choose and close menu
        input.val(choice.text());
        selectedChoice = true;
        closeDropdown(dropdown);
    });

    $(document).on('click', '.myInput', function () {
        var input = $(this);
        var dropdown = input.closest('.dropdown');
        var choices = dropdown.find('.dropdown-choice');

        // Filter
        var filter = input.val().toUpperCase();
        choices.each(function () {
            if ($(this).text().toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        dropdown.find('.dropdown-content').addClass('show');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('.dropdown').length) {
            $('.dropdown-content').each(function () {
                var dropdown = $(this).closest('.dropdown');
                if ($(this).hasClass('show')) {
                    closeDropdown(dropdown);
                }
            });
        }
    });
});