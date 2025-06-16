<?php
session_start();

//miro si es http o https
$httpOhttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? "https://" : "http://";
//miro el host que es
$host = $_SERVER['HTTP_HOST'];
//miro la direcció que es
$direccio = $_SERVER['REQUEST_URI'];
//poso en un session la url completa per saber la ultima en la que s'ha estat
$_SESSION['url'] = $httpOhttps . $host . $direccio;
?>

<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/nav_i_footer.css">
  <link rel="stylesheet" href="../css/mesDetalls.css">
  <title>PokeBuilder - Crear Equip</title>
</head>

<body>
  <nav class="navbar">
    <div class="container-fluid">
      <a href="index.php">
        <img src="../../IMG/logo.png" class="logo" alt="logo pagina i link al Menu">
      </a>
      <button class="navbar-toggler botoNavbar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="menu d-none d-lg-block" id="menu">
        <ul class="llistaMenu">
          <li><a href="index.php">Inici</a></li>
          <li class="dropdown"><a href="pokedex.php">Pokedex</a>
            <ul class="menuDropdown">
              <li><a href="pokedex.php?tipus=Normal">Normal</a></li>
              <li><a href="pokedex.php?tipus=Planta">Planta</a></li>
              <li><a href="pokedex.php?tipus=Fuego">Fuego</a></li>
              <li><a href="pokedex.php?tipus=Agua">Agua</a></li>
              <li><a href="pokedex.php?tipus=Lucha">Lucha</a></li>
              <li><a href="pokedex.php?tipus=Bicho">Bicho</a></li>
              <li><a href="pokedex.php?tipus=Veneno">Veneno</a></li>
              <li><a href="pokedex.php?tipus=Psiquico">Psiquico</a></li>
              <li><a href="pokedex.php?tipus=Fantasma">Fantasma</a></li>
              <li><a href="pokedex.php?tipus=Eléctrico">Eléctrico</a></li>
              <li><a href="pokedex.php?tipus=Hielo">Hielo</a></li>
              <li><a href="pokedex.php?tipus=Dragon">Dragon</a></li>
              <li><a href="pokedex.php?tipus=Roca">Roca</a></li>
              <li><a href="pokedex.php?tipus=Tierra">Tierra</a></li>
              <li><a href="pokedex.php?tipus=Volador">Volador</a></li>
            </ul>
          </li>
          <li><a href="builder.php">Builder</a></li>
          <li><a href="posts.php">Publicacions</a></li>
          <li><a href="preguntesfrq.php">Preguntes frequents</a></li>
          <li><a href="nosaltres.php">Qui som?</a></li>
        </ul>
      </div>


      <div class="perfil amagarPerfil" id="perfil">
        <?php if (isset($_SESSION['apodo'])): ?>
          <a href="perfil.php" class="accesPerfil">
            <p><?= htmlspecialchars($_SESSION['apodo']) ?></p>
            <img src="<?= $_SESSION['imatge'] ?>" class="fotoUser" alt="foto del usuari">
          </a>
        <?php else: ?>
          <a href="login.php" class="nav-link">Inicia sessió</a>
        <?php endif; ?>
      </div>


      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menú</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navMobil navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class=""><a class="" href="index.php">Inici</a></li>
            <li class="dropdown">
              <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pokedex</a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="pokedex.php?tipus=Normal">Normal</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Planta">Planta</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Fuego">Fuego</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Agua">Agua</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Lucha">Lucha</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Bicho">Bicho</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Veneno">Veneno</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Psiquico">Psiquico</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Fantasma">Fantasma</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Eléctrico">Eléctrico</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Hielo">Hielo</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Dragon">Dragon</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Roca">Roca</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Tierra">Tierra</a></li>
                <li><a class="dropdown-item" href="pokedex.php?tipus=Volador">Volador</a></li>
              </ul>
            </li>
            <li class=""><a class="" href="builder.php">Builder</a></li>
            <li class=""><a class="" href="posts.php">Publicacions</a></li>
            <li class=""><a class="" href="preguntesfrq.php">Preguntes frequents</a></li>
            <li class=""><a class="" href="nosaltres.php">Qui som?</a></li>
            <li class=" mt-3">
              <?php if (isset($_SESSION['apodo'])): ?>
                <a class="" href="perfil.php"><?= htmlspecialchars($_SESSION['apodo']) ?></a>
              <?php else: ?>
                <a class="" href="login.php">Inicia sessió</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="cont_blanc">
    <section class="sectDesc">
      <div class="fons1 divDescripcio">
        <div class="descripcioEquip">
          <div>
            <h2>Descripció Equip</h2>
            <p>Explica la principal estrategia pensada per aquest equip</p>
          </div>
          <div class="detallEquipDe">
            <img src="https://img.pokemondb.net/sprites/black-white/normal/primeape.png" alt="Primeape">
            <p>Kento27</p>
          </div>
        </div>
        <textarea name="estrategia" id="estrategia" class="estrategia" placeholder="" disabled></textarea>
      </div>
    </section>

    <section class="pokemonsSel">
      <div class="seleccioPokemon">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon1" alt="">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon2" alt="">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon3" alt="">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon4" alt="">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon5" alt="">
        <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon6" alt="">
      </div>
    </section>

    <section>
      <div class="dadesPokemon">
        <div class="fons1">
          <div class="fons2 centSelPkmn">
            <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" id="pokemonSel" class="pokemonSel" alt="">
          </div>
        </div>
        <div class="fons1">
          <div class="fons2Stats centStatsPkmn">
            <table>
              <tbody>
                <tr>
                  <td class="nomStat">PS: </td>
                  <td>60</td>
                  <td>
                    <div id="barraBasePS">
                      <div id="barraStatPS"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">Atac: </td>
                  <td>55</td>
                  <td>
                    <div id="barraBaseAtac">
                      <div id="barraStatAtac"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">Defensa: </td>
                  <td>25</td>
                  <td>
                    <div id="barraBaseDefensa">
                      <div id="barraStatDefensa"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">At.Especial: </td>
                  <td>155</td>
                  <td>
                    <div id="barraBaseAtEspecial">
                      <div id="barraStatAtEspecial"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">Def.Especial: </td>
                  <td>45</td>
                  <td>
                    <div id="barraBaseDefEspecial">
                      <div id="barraStatDefEspecial"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">Velocitat: </td>
                  <td>115</td>
                  <td>
                    <div id="barraBaseVelocitat">
                      <div id="barraStatVelocitat"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="nomStat">Total: </td>
                  <td>445</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="fons1">
          <h2>IV i EV</h2>
          <table>
            <thead>
              <tr>
                <th></th>
                <th>IV</th>
                <th>EV</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="nomStat">PS: </td>
                <td><input type="number" id="IvPS" class="IvPS" max="31" disabled></td>
                <td><input type="number" id="EvPS" class="EvPS" max="252" disabled></td>
              </tr>
              <tr>
                <td class="nomStat">Atac: </td>
                <td><input type="number" id="IvAtac" class="IvAtac" max="31" disabled></td>
                <td><input type="number" id="EvAtac" class="EvAtac" max="252" disabled></td>
              </tr>
              <tr>
                <td class="nomStat">Defensa: </td>
                <td><input type="number" id="IvDefensa" class="IvDefensa" max="31" disabled></td>
                <td><input type="number" id="EvDefensa" class="EvDefensa" max="252" disabled></td>
              </tr>
              <tr>
                <td class="nomStat">At.Especial: </td>
                <td><input type="number" id="IvAtEspecial" class="IvAtEspecial" max="31" disabled></td>
                <td><input type="number" id="EvAtEspecial" class="EvAtEspecial" max="252" disabled></td>
              </tr>
              <tr>
                <td class="nomStat">Def.Especial: </td>
                <td><input type="number" id="IvDefEspecial" class="IvDefEspecial" max="31" disabled></td>
                <td><input type="number" id="EvDefEspecial" class="EvDefEspecial" max="252" disabled></td>
              </tr>
              <tr>
                <td class="nomStat">Velocitat: </td>
                <td><input type="number" id="IvVelocitat" class="IvVelocitat" max="31" disabled></td>
                <td><input type="number" id="EvVelocitat" class="EvVelocitat" max="252" disabled></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="fons1">
          <div class="genere">
            <h2>Genere</h2>
            <div class="centreGenere">
              <div class="genereHome">
                <input type="radio" name="homeDona" class="signeHome" id="signeHome" value="home" disabled>
                <label for="home"><i class='bx bx-md bx-male-sign'></i></label>
              </div>
              <div class="genereDona">
                <input type="radio" name="homeDona" class="signeDona" id="signeDona" value="dona" disabled>
                <label for="dona"><i class='bx bx-md bx-female-sign'></i></label>
              </div>
            </div>
          </div>
          <div>
            <h2>Moviments</h2>
            <div class="selMove">
              <select name="move1" id="move1" class="move1" required disabled>
                <option value="" selected disabled>Moviment 1</option>
              </select>
              <select name="move2" id="move2" class="move2" required disabled>
                <option value="" selected disabled>Moviment 2</option>
              </select>
              <select name="move3" id="move3" class="move3" required disabled>
                <option value="" selected disabled>Moviment 3</option>
              </select>
              <select name="move4" id="move4" class="move4" required disabled>
                <option value="" selected disabled>Moviment 4</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer>
    <div class="menuFooter">
      <h3>Menu Ràpid</h3>
      <ul>
        <li><a href="index.php">Inici</a></li>
        <li><a href="pokedex.php">Pokedex</a></li>
        <li><a href="builder.php">Builder</a></li>
        <li><a href="posts.php">Publicacions</a></li>
        <li><a href="preguntesfrq.php">Preguntes frequents</a></li>
        <li><a href="nosaltres.php">Qui som?</a></li>
      </ul>
    </div>
    <div class="formulariFoter">
      <p class="pokebuilder_logo">
        P
        <span class="footer_span">
          <img src="../../IMG/logo.png" alt="logo" />
        </span>
        KÉBUILDER
      </p>
      <img src="" alt="" class="logoFooter">
      <h3>Formulari de contacte</h3>
      <div>
        <label for="emailFooter">Email: </label>
        <input type="email" name="emailFooter" id="emailFooter">
      </div>
      <div>
        <label for="msgFooter">Missatge de contacte</label>
        <textarea name="msgFooter" id="msgFooter" placeholder="Diguen's coses a millorar o si tens algun problema"></textarea>
      </div>
    </div>
    <div class="contacteFooter">
      <h3>Contacten's</h3>
      <div class="divContacte">
        <div class="contacte"><a href="https://www.instagram.com"><img src="../../IMG/contacte/insta.png" alt=""></a></div>
        <div class="contacte"><a href="https://www.tiktok.com/"><img src="../../IMG/contacte/tiktok.png" alt=""></a></div>
        <div class="contacte"><a href="https://www.discord.com/"><img src="../../IMG/contacte/discord.png" alt=""></a></div>
        <div class="contacte"><a href="https://www.x.com/"><img src="../../IMG/contacte/x.png" alt=""></a></div>
      </div>
    </div>
  </footer>

  <script src="../JavaScript/tancarSessio.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>