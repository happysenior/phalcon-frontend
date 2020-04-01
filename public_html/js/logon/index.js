// $.readyException = function (error) {
//     console.error(error);
// };


$(document).ready(
    async function() {

    var credentials = await
    $.get("/auth/credentials").promise();
    credentials = JSON.parse(credentials);

    // console.log(credentials);
    var auth = "Basic " + btoa(credentials.apiKey + ":" + credentials.apiSecret);
    // console.log(auth);
    var settings = {
        "url": "/v1/auth/apptoken", // please replace hard coded URL with config value!
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": auth
        },
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
    });

});

