var selectedChoice = false;
var currentChamp = '';

function setSkinURLAttrOfInput(skinURL) {
    var dropdown = $(".skinDropDown");
    var input = dropdown.find('.myInput');

    input.attr('skin-url', skinURL);
}

function setOpinionAttrOfInput(opinion) {
    var dropdown = $(".skinDropDown");
    var input = dropdown.find('.myInput');

    input.attr('skin-opinion', opinion);
}
function setRatingAttrOfInput(rating) {
    var dropdown = $(".skinDropDown");
    var input = dropdown.find('.myInput');

    input.attr('skin-rating', rating);
}

function setBestSkinAttrOfInput(bestSkin) {
    var dropdown = $(".skinDropDown");
    var input = dropdown.find('.myInput');

    input.attr('bestSkin', bestSkin);
}

function resetDropdowns() {
    //Reset the champ value
    $('.champInput').val('');

    //Make the skin dropdown uninteractable
    $('.skinDropDown').addClass('uninteractable');

    //Reset the skin value
    $('.skinInput').val('');
}

function updateSkinTitleColor() {
    var $title = $('#skin-title');
    var text = $title.text();

    if (text.includes('(Usable)')) {
        var newText = text.replace('(Usable)', '<span style="color: green;"> (Usable)</span>');
        $title.html(newText);
    } else if (text.includes('(Unusable)')) {
        var newText = text.replace('(Unusable)', '<span style="color: red;"> (Unusable)</span>');
        $title.html(newText);
    } else if (text.includes('(NR)')) {
        var newText = text.replace('(NR)', '<span style="color: red;"> (NR)</span>');
        $title.html(newText);
    }
}

async function fetchSkinRatingsAdmin(champName) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/skinRating/getAdminsRatingsOfChamp',
            type: 'GET',
            data: { champ_name: champName },
            dataType: 'json',
            success: function (data) {
                resolve(data);
            },
            error: function (error) {
                reject(error);
            }
        });
    });
}

async function fetchSkinRatingsUser(champName) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/skinRating/getUsersRatingsOfChamp',
            type: 'GET',
            data: { champ_name: champName },
            dataType: 'json',
            success: function (data) {
                resolve(data);
            },
            error: function (error) {
                reject(error);
            }
        });
    });
}

async function closeDropdown(dropdown) {
    var input = dropdown.find('.myInput');
    var choices = dropdown.find('.dropdown-choice');

    // If user typed something and there hasn't been a choice selected
    if (input.val() && !selectedChoice) {
        // Update the value
        var firstVisibleOption = choices.filter(':visible').first();
        input.val(firstVisibleOption.text());

        //if it is the skinDropdown
        if (dropdown.hasClass('skinDropDown')) {
            setSkinURLAttrOfInput(firstVisibleOption.attr('skin-url'));
            setOpinionAttrOfInput(firstVisibleOption.attr('skin-opinion'));
            setRatingAttrOfInput(firstVisibleOption.attr('skin-rating'));
            setBestSkinAttrOfInput(firstVisibleOption.attr('skin-rating'));
        }
    }



    // Close the dropdown
    dropdown.find('.dropdown-content').removeClass('show');

    // Return selectedChoice to false
    selectedChoice = false;

    //If its the champ dropdown
    if (dropdown.hasClass('champDropDown')) {
        //An option was selected
        if (input.val()) {
            //Enable the skin input
            $(".skinDropDown").removeClass("uninteractable");

            //Get the skin ratings of the user for this champ
            const currRatings = await fetchSkinRatingsAdmin(input.val());
            //console.log(currRatings);

            //Get the skins of the champ to the dropdown
            const skins = await getLoLChampSkins(input.val());
            if (skins) {
                const container = $('.dropdown-content-skins');
                container.empty();
                for (let index = 0; index < skins.length; index++) {
                    const skin = skins[index];

                    //Get the url of the img of the skin
                    const skinURL = getSkinURL(input.val(), skin.num);

                    const skinDiv = $('<div></div>')
                        .addClass('dropdown-choice')
                        .text(skin.name)
                        .attr('skin-url', skinURL)
                        .attr('skin-opinion', '')
                        .attr('skin-rating', '0')
                        .attr('bestSkin', '0');

                    //Check if admin has rated the skin
                    const skinExists = currRatings.some(item => item.skin_name === skin.name);
                    if (skinExists) { //if the skin exists
                        const skinItem = currRatings.find(item => item.skin_name === skin.name);
                        const usable = skinItem.usable;

                        //Set attributes from db
                        skinDiv.attr('skin-opinion', skinItem.opinion);
                        skinDiv.attr('skin-rating', skinItem.rating);
                        skinDiv.attr('bestSkin', skinItem.best_skin);

                        if (usable) { //if the skin is usable
                            skinDiv.append($('<span></span>').text(' (Usable)').css('color', 'green'));
                        } else { //if the skin is not usable
                            skinDiv.append($('<span></span>').text(' (Unusable)').css('color', 'red'));
                        }
                    } else { //if the skin doesnt exist
                        skinDiv.append($('<span></span>').text(' (NR)').css('color', 'red'));
                    }

                    container.append(skinDiv);
                }

                //If the the selected champ changes remove empty skinInput
                if (input.val() != currentChamp) {
                    $(".skinInput").val("");
                }
                //Set the current champ to the selected champ
                currentChamp = input.val();
            }
        } else {
            //Reset and remove the skin input
            $(".skinDropDown").addClass("uninteractable");
            $(".skinInput").val("");
        }
    } else if (dropdown.hasClass('skinDropDown')) {
        //An option was selected
        if (input.val()) {
            //Set img
            $("#skinImg").attr('src', input.attr('skin-url'));

            //Set title
            $(".skin-title").text(input.val());
            updateSkinTitleColor();

            //Skin rating
            if (input.attr('skin-rating') != '0') {
                $("#skin-rating").text('Rating: ' + input.attr('skin-rating') + '/10');
            } else {
                $("#skin-rating").text('Rating: -/10');
            }

            //Set desc
            if (input.attr('skin-opinion')) {
                $("#skin-descr").text(input.attr('skin-opinion'));
            } else {
                $("#skin-descr").text("No opinion for this skin yet :/");
            }
        } else {
            $("#skinImg").attr('src', "{{ asset('img/empty.png') }}");
            $(".skin-title").text("");
            $("#skin-descr").text("");
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

        //if it is the skinDropdown set the skin-url attr
        if (dropdown.hasClass('skinDropDown')) {
            setSkinURLAttrOfInput(choice.attr('skin-url'));
            setOpinionAttrOfInput(choice.attr('skin-opinion'));
            setRatingAttrOfInput(choice.attr('skin-rating'));
            setBestSkinAttrOfInput(choice.attr('bestSkin'));
        }

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


    //Reset dropdowns when the add and edit modals close
    $('#opinionAddModal').on('hidden.bs.modal', function () {
        resetDropdowns();
    });

    /* $('#opinionAddModal').on('shown.bs.modal', function () {
        resetDropdowns();
    }); */
});