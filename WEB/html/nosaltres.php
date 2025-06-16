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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/nav_i_footer.css">
  <link rel="stylesheet" href="../css/nosaltres.css">
  <title>Qui som?</title>
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

  <header>
    <h1>Qui som?</h1>
  </header>

  <section>
    <p>Som dos estudiants que preferim estar en el anonimat per el moment i que ens agrada molt pokemon.
      Desde petits sempre ens ha agradat pokemon fins a dia de avui. Per aquells temps feiem lo que tothom
      ha fet almenys una vegada, quedarse els llegendaris perque son mes xulos i mes ‘forts’ o que el starter
      sigui el carry de tot el equip en tota la aventura. Ara que som més concients de com funciona em
      volgut compartir els nostres coneixements per ajudarvos a crear el vostre equip. Com ultimament el
      competitiu es cada vegada més conegut, i a mes a mes, després de que Nintendo hagi publicat un nou joc
      exclusivament per el competitiu hi ha mes gent que vol entrar en aquest mon. Aixi que em decidit crear
      aquesta pagina web per ajudar a la gent per a que es crei el seu equip.</p>
  </section>

  <section>
    <h2>Membres</h2>
    <div class="membre1">
      <h3>Jordi Ariza</h3>
      <p>Sóc una persona bastant friki d'aquest món del Pokémon, des de petit m'ha apassionat tot el que envolta
        aquesta saga: els videojocs, les sèries, les cartes... Tot! M'encanta perdre'm en aquest univers i descobrir-ne
        cada detall. No m'agrada deixar les coses a mitges.
      </p>
      <p>Quan em poso amb un projecte, m'hi involucro al màxim i no paro fins que les coses surten bé. M'agrada
        fer-les amb cura, i sobretot, amb ganes. Em considero una persona amable i sempre disposada a ajudar els
        altres amb el que faci falta. Aquest espai neix amb la intenció de compartir la meva passió i connectar
        amb altres entrenadors i entrenadores com jo.</p>
    </div>
    <div class="membre2">
      <h3>Gerard Gorrea</h3>
      <p>Sóc una persona que li agrada molt els videojocs, les pelicules i les sèries. De petit un dels primers jocs
         que vaig jugar va ser el Pokémon: Heart Gold i, a dia d'avui segueix sent un dels meus jocs preferits.
      </p>
      <p>M'agrada el món Pokémon des de petit. Des de petit m'ha agradat la idea de crear el meu equip. També m'he
         interessat recentment pel món del competitiu, i m'agrada aprendre'n cada dia.
      </p>
    </div>
  </section>

  <section>
    <h2>El nostre objectiu</h2>
    <p>Tot i incentivar a fer equips competitius, els equips no han de ser competitius, es poden fer inclus
      només per diversió, probar coses noves, crear obres d’art o inclus aberracions. El objectiu d’aquesta
      web és que es diverteixin crean el seu equip competitiu o no competitiu. Creiem que és una bona forma
      de començar en aquest mon.
    </p>
  </section>

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