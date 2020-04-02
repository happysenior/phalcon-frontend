var settings;

$(document).ready(function() {
  deactivate();
  registerEventListeners();
  sessionStart();
});

const registerEventListeners = () => {
  document.addEventListener("sessionStarted", activate);
  $(".sign-in").on("submit", function(event) {
    event.preventDefault();

    var email = $("#email").val().trim();
    var password = $("#password").val();

    if(email == '' || password == '') {
      return false;
    }

    if(!$("#defaultUnchecked").prop('checked')) {
      $("#checkbox_wrap").css('border-color', 'red');
      $("#checkbox_error").fadeIn(300);
      return false;
    }
    
    var data = {
      login: email,
      secret: password,
      uuid: localStorage.getItem('uuid')
    };
    $.ajax({
        url: apiEndpoints.getAdulttoken,
        type: 'POST',
        data: data,
        dataType: "json",
        beforeSend: function(xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem('access_token'));
        },
        success: function(data) {
          if(data && data.adult_token) {
              localStorage.setItem("adult_token", data.adult_token);

              var d = new Date();
              d.setTime(d.getTime() + (24*60*60*1000));
              var expires = "expires="+ d.toUTCString();

              localStorage.setItem("expires", expires);
              window.location.replace('kid/interview');
          }
        }
        
    });

  });
};

const deactivate = () => {
  $("#loginBtn").css("background-color", "#aed2e4");
  $("#registerBtn").css("color", "#aac7d5");
};

const activate = () => {
  console.log("sessionStarted");
  $("#loginBtn").css("background-color", "#5DBDEB");
  $("#registerBtn").css("color", "#5DBDEB");

  $('#loginBtn').on('click', function() {
    
  });
};

const sessionStart = async function() {
  let credentials = await $.get(apiEndpoints.getCredentials).promise();
  credentials = JSON.parse(credentials);

  const auth =
    "Basic " + btoa(credentials.apiKey + ":" + credentials.apiSecret);

  settings = {
    url: apiEndpoints.getAppToken,
    method: "GET",
    timeout: 0,
    headers: {
      Authorization: auth
    }
  };

  let response = await $.ajax(settings);
  if (response) {
    settings.url = apiEndpoints.getUUID;
    settings.headers.Authorization = "Bearer " + response.access_token;
    localStorage.setItem("access_token", response.access_token);
    response = await $.ajax(settings);
    localStorage.setItem("uuid", response.uuid);
    const event = new Event("sessionStarted");
    document.dispatchEvent(event);
  }

  $(document).on('change', '#defaultUnchecked', function() {
    $("#checkbox_wrap").css('border-color', '#5DBDEB');
    $("#checkbox_error").fadeOut(300);
  });

};
