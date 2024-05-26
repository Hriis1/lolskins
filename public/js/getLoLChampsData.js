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

$(document).ready(async function () {
   var lolChampsData = await getLoLChampsData();
   console.log(lolChampsData);
});
