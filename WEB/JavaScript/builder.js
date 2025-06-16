// Variable global per saber si el Pokémon actual té variació de gènere
let variacioGenereActual = false;
let selectedPokemonId = null;
const pokemonsAmbGenere = ['003', '012', '019', '020', '025', '026', '041', '042', '044', '045', '064', '065', '084', '085', '097', '111', '112', '118', '119', '123', '129', '130'];

function updateImage() {
  const imgPkmn = document.getElementById('imgPokemon');
  if (!imgPkmn || !selectedPokemonId) return;

  let sexe = document.getElementById('signeHome').checked ? 'M' : 'F';
  let shiny = document.getElementById('shiny').checked;

  let web = new XMLHttpRequest();
  web.open("POST", `../php/cerca_pokemon.php?id=${selectedPokemonId}`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  web.onreadystatechange = function () {
    if (web.readyState === 4 && web.status === 200) {
      let data = JSON.parse(web.responseText);
      if (data.error) {
        imgPkmn.src = "../../img/shilluette.png";
        return;
      }
      // Decideix la imatge segons sexe i shiny
      let src = "";
      if (data.pokemon.imatgeM === data.pokemon.imatgeF) {
        // No té variació de gènere
        src = shiny ? data.pokemon.imatgeShinyM : data.pokemon.imatgeM;
      } else {
        // Té variació de gènere
        if (shiny) {
          src = (sexe === 'M') ? data.pokemon.imatgeShinyM : data.pokemon.imatgeShinyF;
        } else {
          src = (sexe === 'M') ? data.pokemon.imatgeM : data.pokemon.imatgeF;
        }
      }
      imgPkmn.src = src;
    }
  };
  web.send();
}

document.querySelectorAll('input[name="genere"], #shiny').forEach(el => {
  el.addEventListener('change', () => {
    if (selectedPokemonId !== null) {
      const variacio = teVariacioGenere(selectedPokemonId);
      updateImage(selectedPokemonId, variacio);
    }
  });
});

// Funció per actualitzar les opcions dels selects per evitar duplicats
function actualitzarOpcionsMoviments() {
  const seleccionats = ['move1', 'move2', 'move3', 'move4'].map(id => {
    const s = document.getElementById(id);
    return s ? s.value : '';
  });

  ['move1', 'move2', 'move3', 'move4'].forEach(id => {
    const select = document.getElementById(id);
    if (!select) return;

    const valorSeleccionat = select.value;
    Array.from(select.options).forEach(opt => {
      // L'opció està habilitada si:
      //  - és l'opció buida (value='')
      //  - o és la opció seleccionada en aquest select
      //  - sinó es deshabilita si està seleccionada en un altre select
      if (opt.value === '' || opt.value === valorSeleccionat) {
        opt.disabled = false;
      } else if (seleccionats.includes(opt.value)) {
        opt.disabled = true;
      } else {
        opt.disabled = false;
      }
    });
  });
}

// Funció per carregar dades del Pokémon per ID
function carregarPokemon(idPokemon) {
  selectedPokemonId = idPokemon;
  fetch(`../php/cerca_pokemon.php?id=${idPokemon}`)
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        alert(data.error);
        return;
      }

      const p = data.pokemon;
      const e = data.extra;

      variacioGenereActual = (p.imatgeM !== p.imatgeF);
      updateImage(idPokemon, variacioGenereActual);

      // Actualitzar estadístiques base a la taula
      const statsMap = {
        PS: p.PS,
        Atac: p.atac,
        Defensa: p.defensa,
        'At.Especial': p.atEspecial,
        'Def.Especial': p.defEspecial,
        Velocitat: p.velocitat,
        Suma: p.total,
      };
      const trs = document.querySelectorAll('.fons2Stats tbody tr');
      trs.forEach(tr => {
        const nomStat = tr.querySelector('.nomStat').textContent.replace(':', '').trim();
        if (nomStat in statsMap) {
          tr.children[1].textContent = statsMap[nomStat];
        }
      });

      // Actualitzar IV/EV i controls
      if (e) {
        document.getElementById('IvPS').value = e.iv_ps ?? 0;
        document.getElementById('EvPS').value = e.ev_ps ?? 0;
        document.getElementById('IvAtac').value = e.iv_atac ?? 0;
        document.getElementById('EvAtac').value = e.ev_atac ?? 0;
        document.getElementById('IvDefensa').value = e.iv_defensa ?? 0;
        document.getElementById('EvDefensa').value = e.ev_defensa ?? 0;
        document.getElementById('IvAtEspecial').value = e.iv_atEspecial ?? 0;
        document.getElementById('EvAtEspecial').value = e.ev_atEspecial ?? 0;
        document.getElementById('IvDefEspecial').value = e.iv_defEspecial ?? 0;
        document.getElementById('EvDefEspecial').value = e.ev_defEspecial ?? 0;
        document.getElementById('IvVelocitat').value = e.iv_Velocitat ?? 0;
        document.getElementById('EvVelocitat').value = e.ev_Velocitat ?? 0;

        if (e.Genere == 1) {
          document.getElementById('signeHome').checked = true;
          document.getElementById('signeDona').checked = false;
        } else if (e.Genere == 0) {
          document.getElementById('signeHome').checked = false;
          document.getElementById('signeDona').checked = true;
        } else {
          document.getElementById('signeHome').checked = false;
          document.getElementById('signeDona').checked = false;
        }
        document.getElementById('shiny').checked = e.Shiny == 1;
      } else {
        document.getElementById('signeHome').checked = true;
        document.getElementById('signeDona').checked = false;
        document.getElementById('shiny').checked = false;
        ['IvPS', 'EvPS', 'IvAtac', 'EvAtac', 'IvDefensa', 'EvDefensa', 'IvAtEspecial', 'EvAtEspecial', 'IvDefEspecial', 'EvDefEspecial', 'IvVelocitat', 'EvVelocitat'].forEach(id => {
          const input = document.getElementById(id);
          if (input) input.value = '0';
        });
      }

      // Cridar a canviStats per recalcular i actualitzar barra i modificades
      canviStats();

      // Carregar moviments
      fetch(`../php/moviments_pokemon.php?id=${idPokemon}`)
        .then(response => response.json())
        .then(movimentsDisponibles => {
          ['move1', 'move2', 'move3', 'move4'].forEach((id, i) => {
            const select = document.getElementById(id);
            if (!select) return;

            const valorActual = select.value;
            select.innerHTML = '<option value="">-- Selecciona un moviment --</option>';

            movimentsDisponibles.forEach(mov => {
              const option = document.createElement('option');
              option.value = mov.ID_moviment;
              option.textContent = mov.nom;
              if (mov.ID_moviment == valorActual) option.selected = true;
              select.appendChild(option);
            });
          });

          ['move1', 'move2', 'move3', 'move4'].forEach(id => {
            const select = document.getElementById(id);
            if (select) {
              select.addEventListener('change', actualitzarOpcionsMoviments);
            }
          });

          actualitzarOpcionsMoviments();
        })
        .catch(err => console.error("Error carregant moviments disponibles:", err));

    })
    .catch(err => {
      console.error("Error carregant dades Pokémon:", err);
    });

}


// funcio per calcular i nmostrar estats calculades
function canviStats() {
  // PS
  let var_PsCalculat_Etq = document.getElementById("numStatPS");
  let var_BasePS = parseInt(document.getElementById("statBasePS").innerHTML);
  let var_lvl = parseInt(document.getElementById("nivell").value);
  let var_IvPs = parseInt(document.getElementById("IvPS").value);
  let var_EvPs = parseInt(document.getElementById("EvPS").value);
  if (
    isNaN(var_lvl) || isNaN(var_BasePS) ||
    isNaN(var_IvPs) || isNaN(var_EvPs)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BasePS + var_IvPs + var_EvPs);
    return;
  }
  let var_calculPs = Math.floor(((2 * var_BasePS + var_IvPs + Math.floor(var_EvPs / 4)) * var_lvl) / 100) + var_lvl + 10;
  var_PsCalculat_Etq.innerHTML = var_calculPs;

  // Def
  let var_DefCalculat_Etq = document.getElementById("numStatDe");
  let var_BaseDef = parseInt(document.getElementById("statBaseDe").innerHTML);
  let var_IvDef = parseInt(document.getElementById("IvDe").value);
  let var_EvDef = parseInt(document.getElementById("EvDe").value);
  if (
    isNaN(var_lvl) || isNaN(var_BaseDef) ||
    isNaN(var_IvDef) || isNaN(var_EvDef)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BaseDef + var_IvDef + var_EvDef);
    return;
  }
  let var_calculDef = Math.floor(((2 * var_BaseDef + var_IvDef + Math.floor(var_EvDef / 4)) * var_lvl) / 100) + 5;
  var_DefCalculat_Etq.innerHTML = var_calculDef;

  // DefEspecial
  let var_DefEsCalculat_Etq = document.getElementById("numStatDeEs");
  let var_BaseDefEs = parseInt(document.getElementById("statBaseDeEs").innerHTML);
  let var_IvDefEs = parseInt(document.getElementById("IvDeEs").value);
  let var_EvDefEs = parseInt(document.getElementById("EvDeEs").value);
  if (
    isNaN(var_lvl) || isNaN(var_BaseDefEs) ||
    isNaN(var_IvDefEs) || isNaN(var_EvDefEs)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BaseDefEs + var_IvDefEs + var_EvDefEs);
    return;
  }
  let var_calculDefEs = Math.floor(((2 * var_BaseDefEs + var_IvDefEs + Math.floor(var_EvDefEs / 4)) * var_lvl) / 100) + 5;
  var_DefEsCalculat_Etq.innerHTML = var_calculDefEs;

  // Atac
  let var_AtCalculat_Etq = document.getElementById("numStatAt");
  let var_BaseAt = parseInt(document.getElementById("statBaseAt").innerHTML);
  let var_IvAt = parseInt(document.getElementById("IvAt").value);
  let var_EvAt = parseInt(document.getElementById("EvAt").value);
  if (
    isNaN(var_lvl) || isNaN(var_BaseAt) ||
    isNaN(var_IvAt) || isNaN(var_EvAt)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BaseAt + var_IvAt + var_EvAt);
    return;
  }
  let var_calculAt = Math.floor(((2 * var_BaseAt + var_IvAt + Math.floor(var_EvAt / 4)) * var_lvl) / 100) + 5;
  var_AtCalculat_Etq.innerHTML = var_calculAt;

  // AtacEspecial
  let var_AtEsCalculat_Etq = document.getElementById("numStatAtEs");
  let var_BaseAtEs = parseInt(document.getElementById("statBaseAtEs").innerHTML);
  let var_IvAtEs = parseInt(document.getElementById("IvAtEs").value);
  let var_EvAtEs = parseInt(document.getElementById("EvAtEs").value);
  if (
    isNaN(var_lvl) || isNaN(var_BaseAtEs) ||
    isNaN(var_IvAtEs) || isNaN(var_EvAtEs)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BaseAtEs + var_IvAtEs + var_EvAtEs);
    return;
  }
  let var_calculAtEs = Math.floor(((2 * var_BaseAtEs + var_IvAtEs + Math.floor(var_EvAtEs / 4)) * var_lvl) / 100) + 5;
  var_AtEsCalculat_Etq.innerHTML = var_calculAtEs;

  // Vel
  let var_VelCalculat_Etq = document.getElementById("numStatVel");
  let var_BaseVel = parseInt(document.getElementById("statBaseVel").innerHTML);
  let var_IvVel = parseInt(document.getElementById("IvVel").value);
  let var_EvVel = parseInt(document.getElementById("EvVel").value);
  if (
    isNaN(var_lvl) || isNaN(var_BaseVel) ||
    isNaN(var_IvVel) || isNaN(var_EvVel)
  ) {
    console.warn("Falten valors vàlids" + var_lvl + var_BaseVel + var_IvVel + var_EvVel);
    return;
  }
  let var_calculVel = Math.floor(((2 * var_BaseVel + var_IvVel + Math.floor(var_EvVel / 4)) * var_lvl) / 100) + 5;
  var_VelCalculat_Etq.innerHTML = var_calculVel;

  // Recollir totes les estadístiques calculades
  const statsCalculades = {
    'PS': var_calculPs,
    'Atac': var_calculAt,
    'Defensa': var_calculDef,
    'At.Especial': var_calculAtEs,
    'Def.Especial': var_calculDefEs,
    'Velocitat': var_calculVel
  };

  // Objecte amb els IDs de les barres
  const idBarres = {
    'PS': 'barraStatPS',
    'Atac': 'barraStatAtac',
    'Defensa': 'barraStatDefensa',
    'At.Especial': 'barraStatAtEspecial',
    'Def.Especial': 'barraStatDefEspecial',
    'Velocitat': 'barraStatVelocitat'
  };

  // Actualitzar amplada de cada barra segons l'estadística
  const maxStat = 300;

  Object.entries(idBarres).forEach(([nomStat, idBarra]) => {
    const barra = document.getElementById(idBarra);
    if (barra && statsCalculades[nomStat] !== undefined) {
      let valorLimitat = Math.min(statsCalculades[nomStat], maxStat);
      let percent = (valorLimitat / maxStat) * 100;
      barra.style.width = percent + '%';
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const inputs = ["nivell", "IvPS", "EvPS", "IvAt", "EvAt", "IvDe", "EvDe", "IvAtEs", "EvAtEs", "IvDeEs", "EvDeEs", "IvVel", "EvVel"];
  inputs.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener("input", canviStats);
    }
  });
  canviStats();
});

// Funció per comprovar si un Pokémon té variació de gènere
['signeHome', 'signeDona', 'shiny'].forEach(id => {
  const el = document.getElementById(id);
  if (el) {
    el.addEventListener('change', updateImage);
  }
});

// Llista d'IDs dels inputs IV i EV
const ivIds = ["IvPS", "IvAt", "IvDe", "IvAtEs", "IvDeEs", "IvVel"];
const evIds = ["EvPS", "EvAt", "EvDe", "EvAtEs", "EvDeEs", "EvVel"];
const nivellId = "nivell";

// Limitació dels imputs
function limitarInputs() {
  // Limitar nivell
  const nivell = document.getElementById(nivellId);
  if (nivell) {
    if (nivell.value > 100) nivell.value = 100;
    if (nivell.value < 1) nivell.value = 1;
  }

  // Limitar IVs
  ivIds.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      if (input.value > 31) input.value = 31;
      if (input.value < 0) input.value = 0;
    }
  });

  // Limitar EVs
  evIds.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      if (input.value > 255) input.value = 255;
      if (input.value < 0) input.value = 0;
    }
  });
}

// Afegim listeners a tots els inputs IV, EV i nivell per limitar-los quan l'usuari canvia el valor
function setupLimitListeners() {
  [...ivIds, ...evIds, nivellId].forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener("input", () => {
        limitarInputs();
        canviStats(); // Funció que tens per actualitzar estadístiques (si l'utilitzes)
      });
    }
  });
}

// Inicialitzar listeners en carregar la pàgina
window.addEventListener("DOMContentLoaded", () => {
  setupLimitListeners();
});

function limitarEVs() {
  // Llista dels IDs dels inputs EV
  const evIds = ['EvPS', 'EvAt', 'EvDe', 'EvAtEs', 'EvDeEs', 'EvVel'];
  let sumaEV = 0;

  // Sumem tots els valors EV actuals (convertint-los a enters)
  evIds.forEach(id => {
    const input = document.getElementById(id);
    const valor = parseInt(input.value) || 0;
    sumaEV += valor;
  });

  // Si la suma supera 510, ajustem l'input que ha provocat el canvi
  if (sumaEV > 510) {
    // Càlcul de quant cal reduir
    const excedent = sumaEV - 510;
    // Restem l'excedent a l'input actual, sense passar de zero
    this.value = Math.max(parseInt(this.value) - excedent, 0);
  }
}

// Assignem l'escoltador als inputs EV
document.addEventListener('DOMContentLoaded', () => {
  const evIds = ['EvPS', 'EvAt', 'EvDe', 'EvAtEs', 'EvDeEs', 'EvVel'];
  evIds.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener('input', limitarEVs);
    }
  });
});

// Array per guardar tots els pokémons seleccionats
let pokemonsGuardats = JSON.parse(sessionStorage.getItem('pokemonsGuardats')) || [];
let pokemonsFila = JSON.parse(sessionStorage.getItem('pokemonsFila')) || [];

function filaEquipPokemons() {
  for (let i = 0; i < 6; i++) {
    const li = document.getElementById('pkmn' + (i + 1));
    li.innerHTML = '';

    const img = document.createElement('img');
    img.className = 'imgPkmn';

    if (pokemonsFila[i]) {
      img.src = pokemonsFila[i].imatge;
      img.alt = pokemonsFila[i].nom || '';
      img.style.cursor = 'pointer';
      li.appendChild(img);

      // Quan fas clic a la imatge, carrega les dades d'aquest Pokémon als inputs i barres
      img.addEventListener('click', function () {
        let web = new XMLHttpRequest();
        web.open("POST", `../php/cerca_pokemon.php?id=${pokemonsFila[i].id}`);
        web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        web.onreadystatechange = function () {
          if (web.readyState === 4 && web.status === 200) {
            let data = JSON.parse(web.responseText);
            if (data.error) {
              alert(data.error);
              return;
            }
            defaultCarregarDadesPokemon({
              id_pokemon: pokemonsFila[i].id,
              nivell: pokemonsFila[i].nivell || 50,
              sexe: pokemonsFila[i].sexe || 'M',
              shiny: pokemonsFila[i].shiny || false,
              IvPS: pokemonsFila[i].IvPS || 0,
              IvAtac: pokemonsFila[i].IvAtac || 0,
              IvDefensa: pokemonsFila[i].IvDefensa || 0,
              IvAtEspecial: pokemonsFila[i].IvAtEspecial || 0,
              IvDefEspecial: pokemonsFila[i].IvDefEspecial || 0,
              IvVelocitat: pokemonsFila[i].IvVelocitat || 0,
              EvPS: pokemonsFila[i].EvPS || 0,
              EvAtac: pokemonsFila[i].EvAtac || 0,
              EvDefensa: pokemonsFila[i].EvDefensa || 0,
              EvAtEspecial: pokemonsFila[i].EvAtEspecial || 0,
              EvDefEspecial: pokemonsFila[i].EvDefEspecial || 0,
              EvVelocitat: pokemonsFila[i].EvVelocitat || 0,
              id_moviments: pokemonsFila[i].id_moviments || [],
              imatge: pokemonsFila[i].imatge,
              baseStats: {
                ps: data.pokemon.PS,
                atac: data.pokemon.atac,
                defensa: data.pokemon.defensa,
                atEspecial: data.pokemon.atEspecial,
                defEspecial: data.pokemon.defEspecial,
                velocitat: data.pokemon.velocitat
              }
            });
          }
        };
        web.send();
      });

      // Botó eliminar sota la imatge
      const btnEliminar = document.createElement('button');
      btnEliminar.className = 'btnEliminar';
      btnEliminar.textContent = 'Eliminar';
      btnEliminar.addEventListener('click', function (e) {
        e.stopPropagation(); // Evita que s'obri el modal
        pokemonsFila.splice(i, 1);
        sessionStorage.setItem('pokemonsFila', JSON.stringify(pokemonsFila));
        filaEquipPokemons();
        resetDadesPokemon();

      });
      li.appendChild(btnEliminar);

    } else {
      img.src = '../../IMG/huevo.gif';
      img.alt = '';
      img.style.cursor = 'pointer';
      li.appendChild(img);

      // Obrir modal en clicar la imatge (només si hi ha ou)
      img.onclick = function () {
        modalAfegirPokemon(i);
      };
    }
  }
}

//guardem les dades de cada pokemon segons la posicio del seu slot
let dadesPokemonEquipTemp = {};
//si refresquem la pagina que no perdi les dades de l'equip
if (sessionStorage.getItem('dadesPokemonEquipTemp')) {
  dadesPokemonEquipTemp = JSON.parse(sessionStorage.getItem('dadesPokemonEquipTemp'));
}
let posicioActualSlot = null;

function guardarEstatPokemon(posicioSlot) {
  let sexe;
  let shiny;
  if (document.querySelector('input[name="genere"]:checked').value =="home") {
    sexe = 0;
  } else {
    sexe = 1;
  }

  if (document.getElementById('shiny').checked == false) {
    shiny = 0;
  } else {
    shiny = 1;
  }
  dadesPokemonEquipTemp[posicioSlot] = {
    id_pokemon: parseInt(selectedPokemonId),
    nivell: parseInt(document.getElementById('nivell').value),
    sexe: sexe,
    shiny: shiny,
    IvPS: parseInt(document.getElementById('IvPS').value),
    IvAtac: parseInt(document.getElementById('IvAt').value),
    IvDefensa: parseInt(document.getElementById('IvDe').value),
    IvAtEspecial: parseInt(document.getElementById('IvAtEs').value),
    IvDefEspecial: parseInt(document.getElementById('IvDeEs').value),
    IvVelocitat: parseInt(document.getElementById('IvVel').value),
    EvPS: parseInt(document.getElementById('EvPS').value),
    EvAtac: parseInt(document.getElementById('EvAt').value),
    EvDefensa: parseInt(document.getElementById('EvDe').value),
    EvAtEspecial: parseInt(document.getElementById('EvAtEs').value),
    EvDefEspecial: parseInt(document.getElementById('EvDeEs').value),
    EvVelocitat: parseInt(document.getElementById('EvVel').value),
    id_moviments: [
      parseInt(document.getElementById('move1').value),
      parseInt(document.getElementById('move2').value),
      parseInt(document.getElementById('move3').value),
      parseInt(document.getElementById('move4').value)
    ]
  };
  sessionStorage.setItem('dadesPokemonEquipTemp', JSON.stringify(dadesPokemonEquipTemp));
}

['nivell', 'IvPS', 'IvAt', 'IvDe', 'IvAtEs', 'IvDeEs', 'IvVel',
  'EvPS', 'EvAt', 'EvDe', 'EvAtEs', 'EvDeEs', 'EvVel',
  'move1', 'move2', 'move3', 'move4', 'signeHome', 'signeDona', 'shiny'
].forEach(id => {
  const el = document.getElementById(id);
  if (el) {
    el.addEventListener('change', () => {
      if (typeof posicioActualSlot !== 'undefined') {
        guardarEstatPokemon(posicioActualSlot);
      }
    });
  }
});

function carregarDadesPokemon(posicioSlot) {
  const pokemon = dadesPokemonEquipTemp[posicioSlot]
  if (!pokemon) return false;

  document.getElementById('nivell').value = pokemon.nivell;
  document.getElementById('IvPS').value = pokemon.IvPS;
  document.getElementById('IvAt').value = pokemon.IvAtac;
  document.getElementById('IvDe').value = pokemon.IvDefensa;
  document.getElementById('IvAtEs').value = pokemon.IvAtEspecial;
  document.getElementById('IvDeEs').value = pokemon.IvDefEspecial;
  document.getElementById('IvVel').value = pokemon.IvVelocitat;
  document.getElementById('EvPS').value = pokemon.EvPS;
  document.getElementById('EvAt').value = pokemon.EvAtac;
  document.getElementById('EvDe').value = pokemon.EvDefensa;
  document.getElementById('EvAtEs').value = pokemon.EvAtEspecial;
  document.getElementById('EvDeEs').value = pokemon.EvDefEspecial;
  document.getElementById('EvVel').value = pokemon.EvVelocitat;
  document.getElementById('move1').value = pokemon.id_moviments[0] || "";
  document.getElementById('move2').value = pokemon.id_moviments[1] || "";
  document.getElementById('move3').value = pokemon.id_moviments[2] || "";
  document.getElementById('move4').value = pokemon.id_moviments[3] || "";
  if (pokemon.shiny === 1) {
    document.getElementById('shiny').checked = true;
  } else {
    document.getElementById('shiny').checked = false;
  }
  if (pokemon.sexe === 0) {
    document.getElementById('signeHome').checked = true;
    document.getElementById('signeDona').checked = false;
  } else {
    document.getElementById('signeHome').checked = false;
    document.getElementById('signeDona').checked = true;
  }
  canviStats();
}

document.addEventListener('DOMContentLoaded', function () {
  //Posem els listeners al li per agafar la seva id per utilitzarla com a pocisió actual del slot
  for (let i = 0; i < 6; i++) {
    const li = document.getElementById('pkmn' + (i + 1));
    if (li) {
      li.addEventListener('click', function () {
        if (posicioActualSlot) guardarEstatPokemon(posicioActualSlot);
        posicioActualSlot = 'pkmn' + (i + 1);
        carregarDadesPokemon(posicioActualSlot);
      });
    }
  }
});

function modalAfegirPokemon(posicio) {
  const select = document.getElementById('selectPokemon');
  const imgModal = document.getElementById('modalImgPokemon');

  // Mostra la imatge actual del slot (ou o Pokémon)
  if (pokemonsFila[posicio]) {
    imgModal.src = pokemonsFila[posicio].imatge;
  } else {
    imgModal.src = '../../IMG/huevo.gif';
  }

  // Omple el select
  select.innerHTML = "<option disabled selected>Carregant...</option>";
  fetch('../php/llistar_pokemon.php')
    .then(response => response.json())
    .then(data => {
      select.innerHTML = "";
      data.sort((a, b) => a.id - b.id);
      data.forEach(p => {
        const option = document.createElement('option');
        option.value = p.id;
        option.textContent = p.Nom;
        select.appendChild(option);
      });
    })
    .catch(() => {
      select.innerHTML = "<option disabled>Error carregant dades</option>";
    });

  // Actualitza la imatge del modal quan canvies el select
  select.onchange = function () {
    let web = new XMLHttpRequest();
    web.open("GET", "../php/cerca_pokemon.php?id=" + select.value);
    web.onreadystatechange = function () {
      if (web.readyState === 4 && web.status === 200) {
        let data = JSON.parse(web.responseText);
        if (data.pokemon && data.pokemon.imatgeM) {
          imgModal.src = data.pokemon.imatgeM;
        }
      }
    };
    web.send();
  };

  // Mostra el modal
  const pokemonModal = new bootstrap.Modal(document.getElementById('pokemonModal'));
  pokemonModal.show();

  // Quan confirmes, afegeix o substitueix el Pokémon al slot seleccionat
  document.getElementById('confirmarPokemon').onclick = function () {
    const idPokemonSeleccionat = select.value;
    if (!idPokemonSeleccionat) {
      alert('Si us plau, selecciona un Pokémon.');
      return;
    }
    fetch(`../php/cerca_pokemon.php?id=${idPokemonSeleccionat}`)
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
          return;
        }
        pokemonsFila[posicio] = {
          id: data.pokemon.ID_pokedex,
          nom: data.pokemon.nom,
          imatge: data.pokemon.imatgeM
        };
        sessionStorage.setItem('pokemonsFila', JSON.stringify(pokemonsFila));
        filaEquipPokemons();
        defaultCarregarDadesPokemon({
          id_pokemon: data.pokemon.ID_pokedex,
          nivell: 50,
          sexe: 'M',
          shiny: false,
          IvPS: 0,
          IvAtac: 0,
          IvDefensa: 0,
          IvAtEspecial: 0,
          IvDefEspecial: 0,
          IvVelocitat: 0,
          EvPS: 0,
          EvAtac: 0,
          EvDefensa: 0,
          EvAtEspecial: 0,
          EvDefEspecial: 0,
          EvVelocitat: 0,
          id_moviments: data.pokemon.id_moviments || [],
          baseStats: {
            ps: data.pokemon.PS,
            atac: data.pokemon.atac,
            defensa: data.pokemon.defensa,
            atEspecial: data.pokemon.atEspecial,
            defEspecial: data.pokemon.defEspecial,
            velocitat: data.pokemon.velocitat
          }
        });
        pokemonModal.hide();
      });
  };
}

function resetDadesPokemon() {
  // Imatge gran
  const imgPkmn = document.getElementById('imgPokemon');
  if (imgPkmn) imgPkmn.src = "../../img/shilluette.png";

  // Stats base i modificades
  document.getElementById('statBasePS').textContent = '-';
  document.getElementById('statBaseAt').textContent = '-';
  document.getElementById('statBaseDe').textContent = '-';
  document.getElementById('statBaseAtEs').textContent = '-';
  document.getElementById('statBaseDeEs').textContent = '-';
  document.getElementById('statBaseVel').textContent = '-';
  document.getElementById('statBaseTotal').textContent = '-';
  document.getElementById('numStatPS').textContent = '-';
  document.getElementById('numStatAt').textContent = '-';
  document.getElementById('numStatDe').textContent = '-';
  document.getElementById('numStatAtEs').textContent = '-';
  document.getElementById('numStatDeEs').textContent = '-';
  document.getElementById('numStatVel').textContent = '-';
  document.getElementById('numStatTotal').textContent = '';

  // Inputs IV/EV/Nivell
  ['IvPS', 'IvAt', 'IvDe', 'IvAtEs', 'IvDeEs', 'IvVel',
    'EvPS', 'EvAt', 'EvDe', 'EvAtEs', 'EvDeEs', 'EvVel', 'nivell'].forEach(id => {
      const input = document.getElementById(id);
      if (input) input.value = 0;
    });

  // Sexe i shiny
  const home = document.getElementById('signeHome');
  const dona = document.getElementById('signeDona');
  if (home) home.checked = true;
  if (dona) dona.checked = false;
  const shiny = document.getElementById('shiny');
  if (shiny) shiny.checked = false;

  // Moviments
  ['move1', 'move2', 'move3', 'move4'].forEach(id => {
    const select = document.getElementById(id);
    if (select) select.value = "";
  });

  // Barres d'estadístiques
  ['barraStatPS', 'barraStatAtac', 'barraStatDefensa', 'barraStatAtEspecial', 'barraStatDefEspecial', 'barraStatVelocitat'].forEach(id => {
    const barra = document.getElementById(id);
    if (barra) barra.style.width = "0%";
  });
}

document.addEventListener('DOMContentLoaded', filaEquipPokemons);

// Funció per carregar dades del Pokémon als inputs
function defaultCarregarDadesPokemon(pokemon) {
  console.log("pokemon rebut a defaultCarregarDadesPokemon:", pokemon);

  selectedPokemonId = pokemon.id_pokemon;

  if (pokemon.baseStats) {
    document.getElementById('statBasePS').textContent = pokemon.baseStats.ps;
    document.getElementById('statBaseAt').textContent = pokemon.baseStats.atac;
    document.getElementById('statBaseDe').textContent = pokemon.baseStats.defensa;
    document.getElementById('statBaseAtEs').textContent = pokemon.baseStats.atEspecial;
    document.getElementById('statBaseDeEs').textContent = pokemon.baseStats.defEspecial;
    document.getElementById('statBaseVel').textContent = pokemon.baseStats.velocitat;
    // Si vols, pots calcular el total aquí també
    document.getElementById('statBaseTotal').textContent = Number(pokemon.baseStats.ps) + Number(pokemon.baseStats.atac) + Number(pokemon.baseStats.defensa) + Number(pokemon.baseStats.atEspecial) + Number(pokemon.baseStats.defEspecial) + Number(pokemon.baseStats.velocitat);
  }

  if (posicioActualSlot) {
    carregarDadesPokemon(posicioActualSlot);
  }
  else {
    const nivellInput = document.getElementById('nivell');
    if (nivellInput) nivellInput.value = pokemon.nivell;
    const sexeInput = document.querySelector(`input[name="genere"][value="${pokemon.sexe}"]`);
    if (sexeInput) sexeInput.checked = true;
    const shinyInput = document.getElementById('shiny');
    if (shinyInput) shinyInput.checked = pokemon.shiny;
    const ivPS = document.getElementById('IvPS');
    if (ivPS) ivPS.value = pokemon.IvPS ?? 0;
    const ivAt = document.getElementById('IvAt');
    if (ivAt) ivAt.value = pokemon.IvAtac ?? 0;
    const ivDe = document.getElementById('IvDe');
    if (ivDe) ivDe.value = pokemon.IvDefensa ?? 0;
    const ivAtEs = document.getElementById('IvAtEs');
    if (ivAtEs) ivAtEs.value = pokemon.IvAtEspecial ?? 0;
    const ivDeEs = document.getElementById('IvDeEs');
    if (ivDeEs) ivDeEs.value = pokemon.IvDefEspecial ?? 0;
    const ivVel = document.getElementById('IvVel');
    if (ivVel) ivVel.value = pokemon.IvVelocitat ?? 0;
    const evPS = document.getElementById('EvPS');
    if (evPS) evPS.value = pokemon.EvPS ?? 0;
    const evAt = document.getElementById('EvAt');
    if (evAt) evAt.value = pokemon.EvAtac ?? 0;
    const evDe = document.getElementById('EvDe');
    if (evDe) evDe.value = pokemon.EvDefensa ?? 0;
    const evAtEs = document.getElementById('EvAtEs');
    if (evAtEs) evAtEs.value = pokemon.EvAtEspecial ?? 0;
    const evDeEs = document.getElementById('EvDeEs');
    if (evDeEs) evDeEs.value = pokemon.EvDefEspecial ?? 0;
    const evVel = document.getElementById('EvVel');
    if (evVel) evVel.value = pokemon.EvVelocitat ?? 0;
    const move1 = document.getElementById('move1');
    if (move1) move1.value = pokemon.id_moviments?.[0] || "";
    const move2 = document.getElementById('move2');
    if (move2) move2.value = pokemon.id_moviments?.[1] || "";
    const move3 = document.getElementById('move3');
    if (move3) move3.value = pokemon.id_moviments?.[2] || "";
    const move4 = document.getElementById('move4');
    if (move4) move4.value = pokemon.id_moviments?.[3] || "";
  }

  updateImage(pokemon.id_pokemon, true);
  canviStats();

  //fem que es vegin els moviments que pot apendre el pokemon
  let web = new XMLHttpRequest();
  web.open("POST", `../php/moviments_pokemon.php?id=${pokemon.id_pokemon}`);
  web.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  web.onreadystatechange = function () {
    if (web.readyState === 4 && web.status === 200) {
      let movimentsDisponibles = JSON.parse(web.responseText);

      ['move1', 'move2', 'move3', 'move4'].forEach((id, i) => {
        const select = document.getElementById(id);
        if (!select) return;

        select.innerHTML = '<option value="">-- Selecciona un moviment --</option>';

        movimentsDisponibles.forEach(mov => {
          const option = document.createElement('option');
          option.value = mov.ID_moviment;
          option.textContent = mov.nom;
          // Aquí és on has de mirar si hi ha un moviment guardat per aquest slot i posició
          let movimentGuardat = null;
          if (
            posicioActualSlot &&
            dadesPokemonEquipTemp[posicioActualSlot] &&
            Array.isArray(dadesPokemonEquipTemp[posicioActualSlot].id_moviments)
          ) {
            movimentGuardat = dadesPokemonEquipTemp[posicioActualSlot].id_moviments[i];
          } else if (Array.isArray(pokemon.id_moviments)) {
            movimentGuardat = pokemon.id_moviments[i];
          }
          if (movimentGuardat == mov.ID_moviment) {
            option.selected = true;
          }
          select.appendChild(option);
        });
      });

      actualitzarOpcionsMoviments();
    }
  };
  web.send();
}

// MODAL
// Funció per omplir el select del modal amb pokemons de la BBDD
function omplirSelectPokemons() {
  const select = document.getElementById('selectPokemon');
  select.innerHTML = "<option disabled selected>Carregant...</option>";

  fetch('../php/llistar_pokemon.php')
    .then(response => response.json())
    .then(data => {
      select.innerHTML = ""; // neteja opcions

      data.forEach(p => {
        const option = document.createElement('option');
        option.value = p.id;
        option.textContent = p.Nom;
        select.appendChild(option);
      });
    })
    .catch(err => {
      select.innerHTML = "<option disabled>Error carregant dades</option>";
      console.error("Error al carregar pokemons:", err);
    });
}

function teVariacioGenere(pokemonId) {
  const idStr = String(pokemonId).padStart(3, '0');
  return pokemonsAmbGenere.includes(idStr);
}

// Botó confirmar modal (has de tenir un botó amb id 'confirmarPokemon')
document.getElementById('confirmarPokemon').addEventListener('click', function () {
  const select = document.getElementById('selectPokemon');
  const idPokemonSeleccionat = select.value;

  if (!idPokemonSeleccionat) {
    alert('Si us plau, selecciona un Pokémon.');
    return;
  }

  // Aquí pots fer la crida a cerca_pokemon_id.php per carregar dades
  fetch(`../php/cerca_pokemon.php?id=${idPokemonSeleccionat}`)
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        alert(data.error);
        return;
      }

      // console.log("Data Pokémon rebut:", data.pokemon);
      variacioGenereActual = teVariacioGenere(data.pokemon.ID_pokedex);

      defaultCarregarDadesPokemon({
        id_pokemon: data.pokemon.ID_pokedex,
        nivell: 50,
        sexe: 'M',
        shiny: false,
        IvPS: 0,
        IvAtac: 0,
        IvDefensa: 0,
        IvAtEspecial: 0,
        IvDefEspecial: 0,
        IvVelocitat: 0,
        EvPS: 0,
        EvAtac: 0,
        EvDefensa: 0,
        EvAtEspecial: 0,
        EvDefEspecial: 0,
        EvVelocitat: 0,
        id_moviments: data.pokemon.id_moviments || [],
        baseStats: {
          ps: data.pokemon.PS,
          atac: data.pokemon.Ataque,
          defensa: data.pokemon.Defensa,
          atEspecial: data.pokemon.Ataque_especial,
          defEspecial: data.pokemon.Defensa_especial,
          velocitat: data.pokemon.Velocidad
        }
      });

      updateImage(data.pokemon.ID_pokedex, variacioGenereActual);


      // Tanquem el modal
      const modalEl = document.getElementById('pokemonModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();
    })
    .catch(err => {
      alert('Error carregant dades del Pokémon.');
      console.error(err);
    });
});


document.querySelectorAll('input[name="genere"], #shiny').forEach(el => {
  el.addEventListener('change', () => {
    if (selectedPokemonId !== null) {
      const variacio = teVariacioGenere(selectedPokemonId);
      updateImage(selectedPokemonId, variacio);
    }
  });
});

//Boto que guarda les dades del equip a la bbdd
document.getElementById('guardarEquip').addEventListener('click', function() {

  let web = new XMLHttpRequest();
  web.open("POST", "../php/guardar_equip.php");
  web.setRequestHeader("Content-Type", "application/json");

  web.onload = function () {
    if (web.status === 200) {
      console.log(web.responseText);
      
      let data = JSON.parse(web.responseText);
      if (data.success) {
        alert('Equip guardat correctament!');
        
        //un cop guardat torno a posar tot buit per si vol fer un equip nou
        pokemonsFila = [];
        dadesPokemonEquipTemp = {};
        sessionStorage.clear();
        filaEquipPokemons();
        resetDadesPokemon();
        document.getElementById('estrategia').value = '';

      } else {
        alert('Error: ' + data.error);
      }
    } else {
      alert('Error en la petició: ' + web.status);
    }
  };

  web.send(JSON.stringify({ pokemons: dadesPokemonEquipTemp, estrategia: document.getElementById('estrategia').value }));
});