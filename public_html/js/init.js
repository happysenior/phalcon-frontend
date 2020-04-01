var apiEndpoints = {
  getCredentials: '/auth/credentials',
  getAppToken: '/v1/auth/apptoken',
  getUUID: '/v1/auth/session',

}

var colors = {
  grey: '#4B515D', 
}
$(document).ready(
  
  async function() {

    checkAuthenticate();

  }
);


function checkAuthenticate() {
  var access_token = localStorage.getItem('access_token');
  var expires = localStorage.getItem("expires");

  if(access_token && expires && new Date(expires)<new Date()) {

  } else {
    if(window.location.pathname != '/logon') {
      window.location = '/logon';
    }
  }
}