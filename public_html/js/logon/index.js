$(document).ready(function() {
  deactivate();
  registerEventListeners();
  sessionStart();
});

const registerEventListeners = () => {
  document.addEventListener("sessionStarted", activate);
  $(".sign-in").on("submit", function(event) {
    event.preventDefault();
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
      console.log("log");
  })
};

const sessionStart = async function() {
  let credentials = await $.get(apiEndpoints.getCredentials).promise();
  credentials = JSON.parse(credentials);

  const auth =
    "Basic " + btoa(credentials.apiKey + ":" + credentials.apiSecret);

  let settings = {
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
};
