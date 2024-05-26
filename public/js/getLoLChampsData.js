async function getLoLChampsData() {
    var settings = {
        "url": "https://ddragon.leagueoflegends.com/cdn/14.10.1/data/en_US/champion.json",
        "method": "GET",
        "timeout": 0,
    };

    try {
        const response = await new Promise((resolve, reject) => {
            $.ajax(settings).done(function (response) {
                resolve(response['data']);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                reject(errorThrown);
            });
        });
        return response;
    } catch (error) {
        console.error('Error fetching LoL Champs data:', error);
        return null;
    }
}

async function getLoLChampSkins(champName) {
    var settings = {
        "url": "https://ddragon.leagueoflegends.com/cdn/14.10.1/data/en_US/champion/" + champName + ".json",
        "method": "GET",
        "timeout": 0,
    };

    try {
        const response = await new Promise((resolve, reject) => {
            $.ajax(settings).done(function (response) {
                resolve(response['data'][champName]['skins']);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                reject(errorThrown);
            });
        });

        //Remove the 1st element of the response since it is the default skin
        response.shift();

        return response;
    } catch (error) {
        console.error('Error fetching LoL Champ Skins data:', error);
        return null;
    }
}

$(document).ready(async function () {
    var lolChampsData = await getLoLChampsData();
    if (lolChampsData) {
        const container = $('.dropdown-content-champions');
        Object.values(lolChampsData).forEach(champion => {
            const championDiv = $('<div></div>').addClass('dropdown-choice').text(champion.name);
            container.append(championDiv);
        });
    }

    const skins = await getLoLChampSkins('Aatrox');
    if (skins) {
        console.log(skins);
    }
});
