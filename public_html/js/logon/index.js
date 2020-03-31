$.readyException = function (error) {
    console.error(error);
};


$(document).ready(async function () {

    // var credentials = await
    //   $.get("/auth/credentials").promise();
    // credentials = JSON.parse(credentials);

    var credentials = await $.get("/auth/credentials").done();
    credentials = JSON.parse(credentials);

    var settings = {
        "url": "https://api.pianini.app/v1/auth/apptoken",
        "method": "GET",
        crossDomain: true,
        // dataType: 'jsonp',
        headers: {
            "Authorization": "BASIC " + btoa(credentials.apiKey + ":" + credentials.apiSecret),
        },
        success: function(){console.log("FOO");},
    };
    console.log("HERE");
    var result =  $.ajax(settings);
    console.log(result);
});

