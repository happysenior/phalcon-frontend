var apiEndpoints = {
  getCredentials: '/auth/credentials',
  getAppToken: '/v1/auth/apptoken',
  getUUID: '/v1/auth/session',
  getAdulttoken: '/v1/auth/adulttoken'

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

  var d1 = new Date(expires);
  var d2 = new Date();

  if(access_token && expires && d1.getTime() > d2.getTime() ) {

  } else {
    if(window.location.pathname != '/logon') {
      window.location = '/logon';
    }
  }
}