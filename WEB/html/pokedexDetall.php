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
  <link rel="stylesheet" href="../css/pokedexDetall.css">
  <title>Pokedex - <?php $dadesPokemon['nom']; ?></title>
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
    <header>
      <h1>POKÉDEX</h1>
      <div class="divBuscador">
        <div class="posicioL">
          <input type="text" placeholder="Cerca..." class="buscador" id="buscador" oninput="buscadorDetallPokedex()">
          <i class='bx bx-search-alt-2 lupa'></i>
          <div id="resultatsBuscador" class="desplegable"></div>
        </div>
      </div>
    </header>

    <section class="sectionAnteriorSeguent">
      <div class="divAnteriorSeguent">
        <div class="pokedexAnterior" onclick="antSegPkmn(false)" id="pokedexAnterior"></div>
        <div class="pokedexSeguent" onclick="antSegPkmn(true)" id="pokedexSeguent"></div>
      </div>
    </section>

    <section>
      <div class="base">
        <div class="estructPrincipal">
          <div class="fonsImg">
            <img src="https://img.pokemondb.net/sprites/black-white/normal/charizard.png" alt="Charizard">
          </div>
          <div class="divGenere">
            <div class="tiposGenere">
              <p>Tipo: </p>
              <div class="tipos" id="tipos">
                <div class="recuadreTipo" id="recuadrefuego">
                  <p>Fuego</p>
                </div>
                <div class="recuadreTipo" id="recuadrevolador">
                  <p>Volador</p>
                </div>
              </div>
              <div class="genereShiny">
                <div class="centreGenere">
                  <div class="genereHome">
                    <input type="radio" name="homeDona" class="signeHome" id="signeHome" value="home" checked>
                    <label for="home"><i class='bx bx-md bx-male-sign'></i></label>
                  </div>
                  <div class="genereDona">
                    <input type="radio" name="homeDona" class="signeDona" id="signeDona" value="dona">
                    <label for="dona"><i class='bx bx-md bx-female-sign'></i></label>
                  </div>
                </div>
                <div class="shiny">
                  <input type="checkbox" id="booleanShiny" class="booleanShiny" name="booleanShiny">
                  <p>Shiny</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="fonsStats centStatsPkmn">
              <table>
                <tbody>
                  <tr>
                    <td class="nomStat">PS: </td>
                    <td id="numPS">60</td>
                    <td>
                      <div id="barraBasePS">
                        <div id="barraStatPS"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">Atac: </td>
                    <td id="numAtac">55</td>
                    <td>
                      <div id="barraBaseAtac">
                        <div id="barraStatAtac"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">Defensa: </td>
                    <td id="numDef">25</td>
                    <td>
                      <div id="barraBaseDefensa">
                        <div id="barraStatDefensa"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">At.Especial: </td>
                    <td id="numAtEsp">155</td>
                    <td>
                      <div id="barraBaseAtEspecial">
                        <div id="barraStatAtEspecial"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">Def.Especial: </td>
                    <td id="numDefEsp">45</td>
                    <td>
                      <div id="barraBaseDefEspecial">
                        <div id="barraStatDefEspecial"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">Velocitat: </td>
                    <td id="numVel">115</td>
                    <td>
                      <div id="barraBaseVelocitat">
                        <div id="barraStatVelocitat"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="nomStat">Total: </td>
                    <td id="numTotal">445</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="estructSecundari">
          <div class="atrPkmn">
            <h2>Charizard</h2>
            <h3>Num. 006</h3>
            <div class="divAtributs">
              <div>
                <p>Pes: </p>
                <p id="pes">90,5 KG</p>
              </div>
              <div>
                <p>Altura: </p>
                <p id="altura">1,7 M</p>
              </div>
              <div>
                <p>Sexo: </p>
                <div>
                  <i class='bx bx-md bx-male-sign'></i>
                  <i class='bx bx-md bx-female-sign'></i>
                </div>
              </div>
            </div>
          </div>
          <div class="efectiuTipos">
            <div class="fonsEfectiu">
              <div>
                <p>Debil x2:</p>
                <div class="x2">
                  <div class="recuadreTipo" id="recuadreagua">
                    <p>Agua</p>
                  </div>
                  <div class="recuadreTipo" id="recuadreelectrico">
                    <p>Eléctrico</p>
                  </div>
                </div>
              </div>
              <div>
                <p>Debil x4:</p>
                <div class="x4">
                  <div class="recuadreTipo" id="recuadreroca">
                    <p>Roca</p>
                  </div>
                </div>
              </div>
              <div>
                <p>Resistent 1/2:</p>
                <div class="entre2">
                  <div class="recuadreTipo" id="recuadrefuego">
                    <p>Fuego</p>
                  </div>
                  <div class="recuadreTipo" id="recuadrelucha">
                    <p>Lucha</p>
                  </div>
                </div>
              </div>
              <div>
                <p>Resistent 1/4:</p>
                <div class="entre4">
                  <div class="recuadreTipo" id="recuadrebicho">
                    <p>Bicho</p>
                  </div>
                  <div class="recuadreTipo" id="recuadreplanta">
                    <p>Planta</p>
                  </div>
                </div>
              </div>
              <div>
                <p>Inmune:</p>
                <div class="inmune">
                  <div class="recuadreTipo" id="recuadretierra">
                    <p>Tierra</p>
                  </div>
                </div>
              </div>
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
  <script src="../JavaScript/detallsPokemon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>