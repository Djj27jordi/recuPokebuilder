window.addEventListener('unload', function() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/tancaSessio.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
  web.onload = function () {
    if (web.status === 200) {
      console.log("Sessió tancada correctament.");
      
    } else {
      console.error("Error al tancar la sessió:", web.status);
    }
  };
  web.send();
});