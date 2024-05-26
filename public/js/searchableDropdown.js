var selectedChoice = false;
var currentChamp = '';

async function closeDropdown(dropdown) {
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

            //Get the skins of the champ to the dropdown
            const skins = await getLoLChampSkins(input.val());
            if (skins) {
                console.log(skins);
                const container = $('.dropdown-content-skins');
                container.empty();
                for (let index = 0; index < skins.length; index++) {
                    const skin = skins[index];
                    const skinDiv = $('<div></div>').addClass('dropdown-choice').text(skin.name);
                    container.append(skinDiv);
                }

                //If the the selected champ changes remove empty skinInput
                if (input.val() != currentChamp) {
                    $("#skinInput").val("");
                }
                //Set the current champ to the selected champ
                currentChamp = input.val();
            }
        } else {
            //Reset and remove the skin input
            $("#skinDropDown").addClass("uninteractable");
            $("#skinInput").val("");
        }
    }
}

$(document).ready(async function () {
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

    $(document).on('click', '.dropdown-choice', async function () {
        var choice = $(this);
        var dropdown = choice.closest('.dropdown');
        var input = dropdown.find('.myInput');

        // Choose and close menu
        input.val(choice.text());
        selectedChoice = true;
        await closeDropdown(dropdown);
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

    //Hoping between dropdowns
    $(document).on('click', '.myInput', async function () {
        var input = $(this);
        var dropdown = input.closest('.dropdown');
        // Close other dropdowns
        otherDropdowns = $('.dropdown').not(dropdown);
        otherDropdowns.each(async function () {
            var dropdownContent = $(this).find('.dropdown-content');
            if (dropdownContent.hasClass('show')) {
                await closeDropdown($(this));
            }
        });
    });

    $(document).on('click', async function (event) {
        if (!$(event.target).closest('.dropdown').length) {
            $('.dropdown-content').each(async function () {
                var dropdown = $(this).closest('.dropdown');
                if ($(this).hasClass('show')) {
                    await closeDropdown(dropdown);
                }
            });
        }
    });
});