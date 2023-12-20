function ValidateCookie() {
    var cookieExists = document.cookie.split(';').some(function(cookie) {
      return cookie.trim().startsWith('loggedIn=');
    });
  
    return cookieExists;
}

function redirect() {
  if (!ValidateCookie()) {
    var baseUrl = window.location.origin;
    window.location.href = baseUrl + "/Vaksineregistrering/Account/Login";
  }
}
  
window.onload = redirect;
  