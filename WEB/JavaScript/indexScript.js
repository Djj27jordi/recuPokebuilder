function caixaAleatori() {
  let caixaAleatori1 = document.querySelector("#caixaAleatori1");
  let caixaAleatori2 = document.querySelector("#caixaAleatori2");

  let web = new XMLHttpRequest();
  web.open("POST", "../php/randomitzadorIndex.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      let randomitzadorJSON = JSON.parse(web.responseText);
      
      caixaAleatori1.innerHTML = `
        <div class="fila1">
          <a href="">
              <img src="${randomitzadorJSON[0].imatgeM}" data-idPokemon="${randomitzadorJSON[0].ID_pokedex}" alt="${randomitzadorJSON[0].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[1].imatgeM}" data-idPokemon="${randomitzadorJSON[1].ID_pokedex}" alt="${randomitzadorJSON[1].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[2].imatgeM}" data-idPokemon="${randomitzadorJSON[2].ID_pokedex}" alt="${randomitzadorJSON[2].nom}">
          </a>
        </div>
        <div class="fila2">
          <a href="">
              <img src="${randomitzadorJSON[3].imatgeM}" data-idPokemon="${randomitzadorJSON[3].ID_pokedex}" alt="${randomitzadorJSON[3].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[4].imatgeM}" data-idPokemon="${randomitzadorJSON[4].ID_pokedex}" alt="${randomitzadorJSON[4].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[5].imatgeM}" data-idPokemon="${randomitzadorJSON[5].ID_pokedex}" alt="${randomitzadorJSON[5].nom}">
          </a>
        </div>
      `;
      caixaAleatori2.innerHTML = `
        <div class="fila1">
          <a href="">
              <img src="${randomitzadorJSON[6].imatgeM}" data-idPokemon="${randomitzadorJSON[6].ID_pokedex}" alt="${randomitzadorJSON[6].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[7].imatgeM}" data-idPokemon="${randomitzadorJSON[7].ID_pokedex}" alt="${randomitzadorJSON[7].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[8].imatgeM}" data-idPokemon="${randomitzadorJSON[8].ID_pokedex}" alt="${randomitzadorJSON[8].nom}">
          </a>
        </div>
        <div class="fila2">
          <a href="">
              <img src="${randomitzadorJSON[9].imatgeM}" data-idPokemon="${randomitzadorJSON[9].ID_pokedex}" alt="${randomitzadorJSON[9].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[10].imatgeM}" data-idPokemon="${randomitzadorJSON[10].ID_pokedex}" alt="${randomitzadorJSON[10].nom}">
          </a>
          <a href="">
              <img src="${randomitzadorJSON[11].imatgeM}" data-idPokemon="${randomitzadorJSON[11].ID_pokedex}" alt="${randomitzadorJSON[11].nom}">
          </a>
        </div>
      `;
    } else {
      console.log(web.status);
    }
  };
  web.send();
}

caixaAleatori();
recollirDadescarrousel();

let posicioCarrousel = 0;
let dadesCarrousel = [];

function recollirDadescarrousel() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/carrouselIndex.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      dadesCarrousel = JSON.parse(web.responseText);
      posicioPokemonCarrousel(); // Només renderitza després de rebre les dades
    } else {
      console.log(web.status);
    }
  };
  web.send();
}

//funcio per el posicionament del carrousel
function posicioPokemonCarrousel() {
  if (dadesCarrousel.length < 3) return;
  let left = (posicioCarrousel - 1 + dadesCarrousel.length) % dadesCarrousel.length;
  let center = posicioCarrousel;
  let right = (posicioCarrousel + 1) % dadesCarrousel.length;

  let carrousel = document.querySelector("#carrouselImgs");
  carrousel.innerHTML = `
    <div class="imglateral">
      <a href="pokedexDetall.php?id=${dadesCarrousel[left].ID_pokedex}">
        <img src="${dadesCarrousel[left].imatgeM}" alt="${dadesCarrousel[left].nom}">
      </a>
    </div>
    <div class="imgcentre">
      <a href="pokedexDetall.php?id=${dadesCarrousel[center].ID_pokedex}">
        <img src="${dadesCarrousel[center].imatgeM}" alt="${dadesCarrousel[center].nom}">
        <div class="idNom">
          <p>#${dadesCarrousel[center].ID_pokedex}</p>
          <p>${dadesCarrousel[center].nom}</p>
        </div>
      </a>
    </div>
    <div class="imglateral">
      <a href="pokedexDetall.php?id=${dadesCarrousel[right].ID_pokedex}">
        <img src="${dadesCarrousel[right].imatgeM}" alt="${dadesCarrousel[right].nom}">
      </a>
    </div>
  `;
}

//el carrousel s'inicia quan es carrega la pàgina
window.addEventListener("DOMContentLoaded", function() {
  recollirDadescarrousel();

  document.getElementById('btnAnterior').addEventListener('click', function(e) {
    e.preventDefault();
    posicioCarrousel = (posicioCarrousel - 1 + dadesCarrousel.length) % dadesCarrousel.length;
    posicioPokemonCarrousel();
  });
  document.getElementById('btnSeguent').addEventListener('click', function(e) {
    e.preventDefault();
    posicioCarrousel = (posicioCarrousel + 1) % dadesCarrousel.length;
    posicioPokemonCarrousel();
  });
});