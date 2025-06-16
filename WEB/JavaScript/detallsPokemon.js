let ID_pokemon;
let tipo1;
let tipo2;

const normal = "rgb(226, 226, 226)";
const planta = "rgb(171, 230, 160)";
const fuego = "rgb(244, 166, 166)";
const agua = "rgb(156, 201, 245)";
const lucha = "rgb(255, 183, 128)";
const bicho = "rgb(195, 212, 122)";
const veneno = "rgb(201, 164, 232)";
const psiquico = "rgb(246, 164, 187)";
const fantasma = "rgb(181, 159, 181)";
const electrico = "rgb(255, 235, 153)";
const hielo = "rgb(168, 240, 255)";
const dragon = "rgb(165, 175, 242)";
const roca = "rgb(224, 187, 94)";
const tierra = "rgb(196, 138, 98)";
const volador = "rgb(183, 216, 245)";

function buscadorDetallPokedex() {
  let web = new XMLHttpRequest();
  web.open("POST", "../php/buscadorPokedex.php");
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  let buscador = document.getElementById("buscador").value;
  let dadesDesplegable = document.getElementById("resultatsBuscador");

  if (buscador === "") {
    dadesDesplegable.innerHTML = '';
    dadesDesplegable.style.display = 'none';
    return;
  }

  web.onload = function () {
    if (web.status === 200) {
      let pokemonsJSON = JSON.parse(web.responseText);

      if (pokemonsJSON.length === 0) {
        dadesDesplegable.innerHTML = '<div class="opcioBuscador">No trobat</div>';
        dadesDesplegable.style.display = 'block';
        return;
      }

      dadesDesplegable.innerHTML = '';
      pokemonsJSON.forEach(pokemon => {
        dadesDesplegable.innerHTML += `<div class="opcioBuscador" data-id="${pokemon.ID_pokedex}">${pokemon.nom}</div>`;
      });
      dadesDesplegable.style.display = 'block';

      // Event per cada opció
      let opcionsBuscador = document.querySelectorAll('.opcioBuscador');
      
      opcionsBuscador.forEach(opcio => {
        opcio.addEventListener('click', function() {
          window.location.href = `pokedexDetall.php?id=${this.dataset.id}`;
        });
      });

      // Amaga el desplegable si es perd el focus
      document.getElementById('buscador').addEventListener('blur', function() {
        setTimeout(() => { document.getElementById('resultatsBuscador').style.display = 'none'; }, 100);
      });
      document.getElementById('buscador').addEventListener('focus', function() {
        if (document.getElementById('resultatsBuscador').innerHTML.trim() !== '') 
          document.getElementById('resultatsBuscador').style.display = 'block';
      });
    }
    else {
      console.log(web.status);
    }
  };

  // web.onload = function () {
  //   if (web.status === 200) {      
  //     console.log(web.status);
  //     console.log("RAW:", web.responseText);
  //     let pokemonsJSON = JSON.parse(web.responseText);
  //     console.log(pokemonsJSON);
  //     let pokedex = document.querySelector("#pokedex");
  //     pokedex.innerHTML = '';
  
  //     pokemonsJSON.forEach(pokemon => {
  //       pokedex.innerHTML += `
  //       <a href="pokedexDetall.php?id=${pokemon.ID_pokedex}">
  //         <div class="divPkmn">
  //           <p>#${pokemon.ID_pokedex}</p>
  //           <img src="${pokemon.imatgeM}" alt="${pokemon.nom}">
  //           <p>${pokemon.nom}</p>
  //         </div>
  //       </a>
  //       `;
  //     });

  //   } else {
  //     console.log(web.status);
      
  //   }
  // }

  web.send("buscador=" + buscador);
}

function antSegPkmn(proxPkmn) {
  const url = new URLSearchParams(window.location.search);
  let IdUrl = Number(url.get('id'));

  Number(IdUrl);

  if (proxPkmn == true) {
    IdUrl++;
  } else {
    IdUrl--;
  }
  
  window.location.href = `pokedexDetall.php?id=${IdUrl}`;
}

function botonsAntProx() {
  const url = new URLSearchParams(window.location.search);
  let IdUrl = Number(url.get('id'));
  let ant = IdUrl - 1;
  let prox = IdUrl + 1;
  console.log(ant, IdUrl, prox);
  

  let web = new XMLHttpRequest();
  web.open("POST", `../php/pastOrNext.php`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      let pokemonPagJSON = JSON.parse(web.responseText);

      let anterior = document.querySelector('#pokedexAnterior');
      let seguent = document.querySelector('#pokedexSeguent');
      let divAntSeg = document.querySelector('.divAnteriorSeguent');
      let anteriorNom = "";
      let seguentNom = "";
      
      if (pokemonPagJSON[0].ID_pokedex == ant) {
        anteriorNom = pokemonPagJSON[0].nom;
      } else if (pokemonPagJSON[1] && pokemonPagJSON[1].ID_pokedex == ant) {
        anteriorNom = pokemonPagJSON[1].nom;
      }
      
      if (pokemonPagJSON[0].ID_pokedex == prox) {
        seguentNom = pokemonPagJSON[0].nom;
      } else if (pokemonPagJSON[1] && pokemonPagJSON[1].ID_pokedex == prox) {
        seguentNom = pokemonPagJSON[1].nom;
      }

      if (IdUrl <= 1) {
        anterior.style.display = "none";
        seguent.style.display = "block";
        divAntSeg.style.justifyContent = "flex-end";
        seguent.innerHTML = `<p>#${prox} ${seguentNom}</p>`;
      } else if (IdUrl >= 151) {
        anterior.style.display  = "block";
        seguent.style.display = "none";
        divAntSeg.style.justifyContent = "flex-start";
        anterior.innerHTML = `<p>#${ant} ${anteriorNom}</p>`;
      } else {
        anterior.innerHTML = `<p>#${ant} ${anteriorNom}</p>`;
        seguent.innerHTML = `<p>#${prox} ${seguentNom}</p>`;
      }
    }
  }

  web.send("idAnt=" + ant + "&idProx=" + prox);
}

function conseguirDades() {
  const url = new URLSearchParams(window.location.search);
  let IdUrl = Number(url.get('id'));

  let web = new XMLHttpRequest();
  web.open("POST", `../php/dadesPokemon.php`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      console.log("la id es:" + IdUrl);
      console.log(web.responseText);
      

      let pokemonsJSON = JSON.parse(web.responseText);
      ID_pokemon = pokemonsJSON.ID_pokedex;

      let titolPag = document.querySelector('title');
      titolPag.textContent = `Pokedex - ${pokemonsJSON.nom}`;

      let img = document.querySelector('.fonsImg img');
      img.src = pokemonsJSON.imatgeM;

      let PS = document.querySelector('#numPS');
      let atac = document.querySelector('#numAtac');
      let defensa = document.querySelector('#numDef');
      let atEsp = document.querySelector('#numAtEsp');
      let defEsp = document.querySelector('#numDefEsp');
      let velocitat = document.querySelector('#numVel');
      let total = document.querySelector('#numTotal');
      PS.textContent = pokemonsJSON.PS;
      atac.textContent = pokemonsJSON.atac;
      defensa.textContent = pokemonsJSON.defensa;
      atEsp.textContent = pokemonsJSON.atEspecial;
      defEsp.textContent = pokemonsJSON.defEspecial;
      velocitat.textContent = pokemonsJSON.velocitat;
      total.textContent = pokemonsJSON.total;
      
      // Màxim visual per a la barra (ajusta segons el teu disseny)
      const statMax = 200;
      
      // Assigna amplada i valor a cada barra segons el valor base
      document.getElementById('barraStatPS').style.width = (pokemonsJSON.PS / statMax * 100) + '%';
      document.getElementById('barraStatAtac').style.width = (pokemonsJSON.atac / statMax * 100) + '%';
      document.getElementById('barraStatDefensa').style.width = (pokemonsJSON.defensa / statMax * 100) + '%';
      document.getElementById('barraStatAtEspecial').style.width = (pokemonsJSON.atEspecial / statMax * 100) + '%';
      document.getElementById('barraStatDefEspecial').style.width = (pokemonsJSON.defEspecial / statMax * 100) + '%';
      document.getElementById('barraStatVelocitat').style.width = (pokemonsJSON.velocitat / statMax * 100) + '%';
      
      let nomPkmn = document.querySelector('.atrPkmn h2');
      let IdPkmn = document.querySelector('.atrPkmn h3');
      nomPkmn.textContent = pokemonsJSON.nom;
      IdPkmn.textContent = "Num. " + pokemonsJSON.ID_pokedex;

      let pes = document.querySelector('#pes');
      let altura = document.querySelector('#altura');
      pes.textContent = pokemonsJSON.pes + " kg";
      altura.textContent = pokemonsJSON.altura + " m";
    }
  }

  web.send("id=" + IdUrl);
}

function genereIMG() {
  const url = new URLSearchParams(window.location.search);
  const IdUrl = url.get('id');
  let web = new XMLHttpRequest();
  web.open("POST", `../php/dadesPokemon.php`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  
  web.onload = function () {
    if (web.status === 200) {
      console.log(web.status);
      let pokemonsJSON = JSON.parse(web.responseText);
      console.log(web.responseText);
      
      let genere = document.querySelector('input[name="homeDona"]:checked');
      let valorGenere;
      if (genere) {
        valorGenere = genere.value;
      } else {
        valorGenere = null;
      }
      
      let booleanShiny = document.querySelector('#booleanShiny').checked;
      let img = document.querySelector('.fonsImg img');
      
      if (valorGenere == "home" && !booleanShiny) {
        img.src = pokemonsJSON.imatgeM;
      } else if (valorGenere == "dona" && !booleanShiny) {
        img.src = pokemonsJSON.imatgeF;
      } else if (valorGenere == "home" && booleanShiny) {
        img.src = pokemonsJSON.imatgeShinyM;
      } else if (valorGenere == "dona" && booleanShiny) {
        img.src = pokemonsJSON.imatgeShinyF;
      } else if (!booleanShiny) {
        img.src = pokemonsJSON.imatgeM;
      } else if (booleanShiny) {
        img.src = pokemonsJSON.imatgeShinyM;
      } else {
        img.src = pokemonsJSON.imatgeM;
        console.log("no s'ha trobat");
      }
    }
  }
  web.send("id=" + IdUrl);
}

//funcio per mostrar stats del pokemon
function mostrarStats() {

}

function tipoPokemon() {
  const url = new URLSearchParams(window.location.search);
  const IdUrl = url.get('id');

  let web = new XMLHttpRequest();
  web.open("POST", `../php/tipoPokemonEspecific.php`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  web.onload = function () {
    if (web.status === 200) {
      console.log(web.status);
      console.log(web.responseText);
      let tiposJSON = JSON.parse(web.responseText);

      let divTipos = document.querySelector('#tipos');
      divTipos.innerHTML = ``;

      tiposJSON.forEach(tipo => {
        divTipos.innerHTML += `
        <div class="recuadreTipo" id="recuadre${tipo.nom}"><p>${tipo.nom}</p></div>`;
      });
      
      tipo1 = tiposJSON[0].nom;
      tipo2 = tiposJSON[1]?.nom || null;

      debilitats (tipo1, tipo2);
    }
  }
  web.send("id=" + IdUrl);
}



// NO FUNCIONA: error en el php perque no envia res
function debilitats (tipo1, tipo2) {
  let web = new XMLHttpRequest();
  web.open("POST", `../php/efectiu.php`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    web.onload = function () {
      if (web.status === 200) {
        console.log(web.responseText);
        
        let esfectivitatJSON = JSON.parse(web.responseText);
        let x0 = [];
        let x2 = [];
        let x4 = [];
        let meitat = [];
        let quart = [];

        let efectes = {};

        esfectivitatJSON.forEach(efectiu => {
          const tipus = efectiu.tipus_atacant;
          const dmg = parseFloat(efectiu.dmg);

          if (efectes[tipus] === undefined) {
            efectes[tipus] = dmg;
          } else {
            efectes[tipus] *= dmg;
          }
        });

        for (let tipus in efectes) {
          const valor = efectes[tipus];
          if (valor === 0) x0.push(tipus);
          else if (valor === 4) x4.push(tipus);
          else if (valor === 2) x2.push(tipus);
          else if (valor === 0.25) quart.push(tipus);
          else if (valor === 0.5) meitat.push(tipus);
          // Si valor === 1, no se muestra (es neutro)
        }

        function duplicats(arrayTipos) {
          let comptador = {};
          let repetits = [];

          arrayTipos.forEach(t => {
            comptador[t] = (comptador[t] || 0) + 1;
          });
        
          for (let tipus in comptador) {
            if (comptador[tipus] > 1) {
              repetits.push(tipus);
            }
          }
        
          return repetits;
        }

        x4 = duplicats(x2);
        quart = duplicats(meitat);

        x2 = x2.filter(t => !x4.includes(t));
        meitat = meitat.filter(t => !quart.includes(t));

        x0.forEach(immun => {
          x2 = x2.filter(t => t !== immun);
          x4 = x4.filter(t => t !== immun);
          meitat = meitat.filter(t => t !== immun);
          quart = quart.filter(t => t !== immun);
        });

        console.log("Immunes (x0):", x0);
        console.log("Resistents (x0.5):", meitat);
        console.log("Molt resistents (x0.25):", quart);
        console.log("Débils (x2):", x2);
        console.log("Molt dèbils (x4):", x4);

        x4Tipos = document.querySelector('.x4');
        x2Tipos = document.querySelector('.x2');
        entre2Tipos = document.querySelector('.entre2');
        entre4Tipos = document.querySelector('.entre4');
        inmuneTipos = document.querySelector('.inmune');

        x4Tipos.innerHTML = '';
        x2Tipos.innerHTML = '';
        entre2Tipos.innerHTML = '';
        entre4Tipos.innerHTML = '';
        inmuneTipos.innerHTML = '';

        if (x4.length > 0) {
          x4.forEach(tipo => {
            x4Tipos.innerHTML += `<div class="recuadreTipo" id="recuadre${tipo}"><p>${tipo}</p></div>`;
          });
        } else {
          x4Tipos.innerHTML = `<div class="recuadreTipo"><p>No en n'hi ha</p></div>`;
        }

        if (x2.length > 0) {
          x2.forEach(tipo => {
            x2Tipos.innerHTML += `<div class="recuadreTipo" id="recuadre${tipo}"><p>${tipo}</p></div>`;
          });
        } else {
          x2Tipos.innerHTML = `<div class="recuadreTipo"><p>No en n'hi ha</p></div>`;
        }

        if (meitat.length > 0) {
          meitat.forEach(tipo => {
            entre2Tipos.innerHTML += `<div class="recuadreTipo" id="recuadre${tipo}"><p>${tipo}</p></div>`;
          });
        } else {
          entre2Tipos.innerHTML = `<div class="recuadreTipo"><p>No en n'hi ha</p></div>`;
        }

        if (quart.length > 0) {
          quart.forEach(tipo => {
            entre4Tipos.innerHTML += `<div class="recuadreTipo" id="recuadre${tipo}"><p>${tipo}</p></div>`;
          });
        } else {
          entre4Tipos.innerHTML = `<div class="recuadreTipo"><p>No en n'hi ha</p></div>`;
        }

        if (x0.length > 0) {
          x0.forEach(tipo => {
            inmuneTipos.innerHTML += `<div class="recuadreTipo" id="recuadre${tipo}"><p>${tipo}</p></div>`;
          });
        } else {
          inmuneTipos.innerHTML = `<div class="recuadreTipo"><p>No en n'hi ha</p></div>`;
        }
      }
    }

  web.send("tipo1=" + tipo1 + "&tipo2=" + tipo2);
}

conseguirDades();
botonsAntProx();
tipoPokemon();
// debilitats(tipo1, tipo2);

let home = document.getElementById('signeHome');
let dona = document.getElementById('signeHome');
let shiny = document.getElementById('signeHome');

document.querySelector('#signeHome').addEventListener('change', genereIMG);
document.querySelector('#signeDona').addEventListener('change', genereIMG);
document.querySelector('#booleanShiny').addEventListener('change', genereIMG);