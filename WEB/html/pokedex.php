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

require '../php/connexio.php';

$linies = 20;

if (isset($_REQUEST['paginacio']))
  $inici = $_REQUEST['paginacio'];
else
  $inici = 0;

$sql = "SELECT * FROM pokedex LIMIT $inici, $linies";
$registres = $conn->query($sql);
$impressos = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/nav_i_footer.css">
  <link rel="stylesheet" href="../css/pokedex.css">
  <title>Pokedex</title>
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
          <input type="text" placeholder="Cerca..." class="buscador" id="buscador" oninput="buscadorPokedex()">
          <i class='bx bx-search-alt-2 lupa'></i>
        </div>
      </div>
    </header>

    <section>
      <div class="divFiltro">
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Normal" id="filtroNormal">
            <p>Normal</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Planta" id="filtroPlanta">
            <p>Planta</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Fuego" id="filtroFuego">
            <p>Fuego</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Agua" id="filtroAgua">
            <p>Agua</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Lucha" id="filtroLucha">
            <p>Lucha</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Bicho" id="filtroBicho">
            <p>Bicho</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Veneno" id="filtroVeneno">
            <p>Veneno</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Psiquico" id="filtroPsiquico">
            <p>Psiquico</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Fantasma" id="filtroFantasma">
            <p>Fantasma</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Electrico" id="filtroElectrico">
            <p>Eléctrico</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Hielo" id="filtroHielo">
            <p>Hielo</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Dragon" id="filtroDragon">
            <p>Dragon</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Roca" id="filtroRoca">
            <p>Roca</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Tierra" id="filtroTierra">
            <p>Tierra</p>
          </div>
        </div>
        <div class="tamanyF">
          <div class="filtro" data-filtre="false" data-nomF="Volador" id="filtroVolador">
            <p>Volador</p>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="pokedex" id="pokedex">
        <?php
        while ($reg = $registres->fetch_array()) {
          $impressos++;
        ?>
          <a href="pokedexDetall.php?id=<?php echo $reg['ID_pokedex']; ?>">
            <div class="divPkmn">
              <p>#<?php echo $reg['ID_pokedex']; ?></p>
              <img src="<?php echo $reg['imatgeM']; ?>" alt="<?php echo $reg['nom']; ?>">
              <p><?php echo $reg['nom']; ?></p>
            </div>
          </a>
        <?php } ?>
      </div>
    </section>

    <section>
      <div class="paginacio">
        <?php
        if ($inici == 0) {
          echo "";
        } else {
          $anterior = $inici - $linies;
          echo "<a href=\"pokedex.php?paginacio=$anterior\" class=\"anterior\"><- Anterior</a> ";
        }

        if ($impressos == $linies) {
          $proper = $inici + $linies;
          echo "<a href=\"pokedex.php?paginacio=$proper\" class=\"seguent\">Següent -></a>";
        }
        ?>
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
  <script src="../JavaScript/buscadorPokedex.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>