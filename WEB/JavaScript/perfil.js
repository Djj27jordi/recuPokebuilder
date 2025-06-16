//Quan es faci click a la imatge de perfil s'obrira el modal i s'activa la funcio per mostrar les imatges
function cambiarFotoPerfil() {
  // Carrega les imatges només si encara no s'han carregat
  let llista = document.getElementById('llistaImatgesPerfil');
  if (llista.children.length === 0) {
    let web = new XMLHttpRequest();
    web.open("POST", "../php/modalImatgesPerfil.php");
    web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    web.onload = function () {
      if (web.status === 200) {
        console.log(web.status, web.responseText);

        let imatges = JSON.parse(web.responseText);
        imatges.forEach(pokemonImg => {
          let img = document.createElement('img');
          img.className = "imgsPkmnModal";
          img.src = pokemonImg.imatgeM;
          img.addEventListener('click', function () {
            // Quan seleccionis una imatge, envia-la per AJAX per guardar-la
            let web2 = new XMLHttpRequest();
            console.log(web2.status, web2.responseText);
            web2.open("POST", "../php/cambiarFotoPerfil.php");
            web2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            web2.onload = function () {
              if (web2.status === 200) {
                let resposta = JSON.parse(web2.responseText);
                if (resposta.success) {
                  document.getElementById('fotoPerfil').src = pokemonImg.imatgeM;
                  document.getElementById('fotoUser').src = pokemonImg.imatgeM;
                  alert("Foto de perfil actualitzada correctament.");
                } else {
                  alert("Error al canviar la foto de perfil: " + resposta.error);
                }
              } else {
                alert("Error, status: " + web2.status);
              }
            };
            web2.send("novaFoto=" + pokemonImg.imatgeM);
          });
          llista.appendChild(img);
        });
      } else {
        alert("Error, status: " + web.status);
      }
    };
    web.send();
  }
}

function tancarSessio() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/tancaSessio.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      console.log("Sessió tancada correctament.");
      window.location.href = "../html/index.php";
    } else {
      console.error("Error al tancar la sessió:", web.status);
    }
  };
  web.send();
}

function carregarEquips() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/carregarEquipsPerfil.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

   web.onload = function () {
    if (web.status === 200) {
      console.log(web.status, web.responseText);
      let equipsJSON = JSON.parse(web.responseText);
      let llistaEquips = document.getElementById('caixes');
      let contadorEquips = 0;
      if (equipsJSON == []) {
        llistaEquips.innerHTML = '<p>No tens ningun equip fet</p>';
      }
      llistaEquips.innerHTML = '';

      equipsJSON.forEach(equip => {
        contadorEquips++;
        llistaEquips.innerHTML += `
        <div class="caixa">
          <div class="nomMiniMenu">
            <h3>Equip ${contadorEquips}</h3>
            <div class="menuOpcionsContainer">
              <i class='bx bx-md bx-dots-horizontal-rounded miniMenu'></i>
              <div class="menuOpcions">
                <p id="publi" onclick="publicacio(${equip.ID_equipsPokemon})">Publicar</p>
                
                <p>Eliminar equip</p>
              </div>
            </div>
          </div>
          <div class="equip">
            <img src="${equip.img1}" class="equipPokemon" id="pokemon1" alt="">
            <img src="${equip.img2}" class="equipPokemon" id="pokemon2" alt="">
            <img src="${equip.img3}" class="equipPokemon" id="pokemon3" alt="">
            <img src="${equip.img4}" class="equipPokemon" id="pokemon4" alt="">
            <img src="${equip.img5}" class="equipPokemon" id="pokemon5" alt="">
            <img src="${equip.img6}" class="equipPokemon" id="pokemon6" alt="">
          </div>
          <div class="totalLikeEquip">
            <i class='bx bx-sm bxs-heart'></i>
            <p>27</p>
          </div>
        </div>
        `;
      });

    } else {
      console.error("Error al carregar els equips:" + web.status);
    }
  };
  web.send();
}

function publicacio(IdEquip) {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/publicarDesdePerfil.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  web.onload = function () {
    if (web.status === 200) {
      console.log(web.status, web.responseText);
      let publicarJSON = JSON.parse(web.responseText);
      if (publicarJSON.success) {
        let publicar = document.getElementById("publi").textContent;
        if (publicar === "Publicar") {
          document.getElementById("publi").textContent = "No publicar";
        } else {
          document.getElementById("publi").textContent = "Publicar";
        }
        alert("Equip publicat correctament.");
        carregarEquips();
      } else {
        alert("Error al publicar l'equip: " + publicarJSON.error);
      }
    } else {
      console.error("Error al publicar l'equip:", web.status);
    }
  }
  web.send("idEquip=" + IdEquip + "&publicar=" + document.getElementById("publi").textContent);
}

function eliminarEquip(IdEquip) {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/eliminarEquipsPerfil.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      console.log(web.status, web.responseText);
      let EquipElJSON = JSON.parse(web.responseText);
      if (EquipElJSON.success) {
        alert("Equip eliminat correctament.");
        carregarEquips();
      } else {
        alert("Error al eliminar l'equip: " + EquipElJSON.error);
      }
    } else {
      console.error("Error al eliminar l'equip:", web.status);
    }
  };
  web.send("idEquip=" + IdEquip);
}

function crearNouEquip() {
  sessionStorage.clear();
  window.location.href = "../html/builder.php";
}
carregarEquips();