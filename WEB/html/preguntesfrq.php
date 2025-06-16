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
  <link rel="stylesheet" href="../css/preguntesfrq.css">
  <title>Preguntes Frequents</title>
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
    <h1>Preguntes Frequents</h1>
  </header>

  <section>
    <div class="dades">
      <h2>Introducció</h2>
      <p>Per a tots aquells que encara no sapiguen o acaben de entrar en el
        mon de pokemon ús facilitem la seguent informacio per a tenir-la en
        compte a la hora de fer equips i la comunitat</p>
    </div>
  </section>

  <section>
    <div class="dades">
      <h2>En que es diferencia els moviments/estats físics i especials?</h2>
      <p>Be, com ja hauras vist en les estadistiques de cada pokemon hi han alguns que tenen molt atac amb poc atac especial o al contrari.
        Tenin aixo en compte, si tens un pokemon que té la estadistica d'atac més alta que la de atac especial, s'utilitzarà atacs fisics. Si s'ataques amb
        atacs especials treuria menys perque la seva estadistica és més baixa.
      </p>
    </div>
  </section>

  <section>
    <div class="dades">
      <h2>Que son els moviments d'estat?</h2>
      <p>Els moviments d'estat són aquells que s'utilitzen per alterar les estadistiques del pokemon defensor o usuari, depenent del que faci el moviment.
        També són moviments d'estat aquells que perjudiquen al pokemon, fent que puguis confondre, dormir, paralitzar, cremar o envenenar. Aixó són els problemes d'estat
      </p>
    </div>
  </section>

  <section>
    <div class="dades">
      <h2>Que son els IV?</h2>
      <p>Els IV (Valors Individuals) són estadístiques ocultes que determinen el potencial màxim d’un Pokémon en cada atribut:
        PS, Atac, Defensa, Atac Especial, Defensa Especial i Velocitat. Aquests valors varien entre 0 i 31, on 31 és el valor perfecte en aquella estadística.
      </p>
      <h3>Com funcionen els IV?</h3>
      <p>Els IV (Valors Individuals) són números ocults que cada Pokémon té assignats en les seves estadístiques. Funcionen com a "gens" que determinen el seu potencial màxim.</p>
    </div>
  </section>

  <section>
    <div class="dades">
      <h2>Que son els EV?</h2>
      <p>Els EV (Valors d’Esforç) són punts que determinen com creixen les estadístiques d’un Pokémon a mesura que guanya experiència en combats.
        A diferència dels IV (Valors Individuals), que són fixos, els EV es poden entrenar i modificar.
      </p>
      <h3>Com funcionen els IV?</h3>
      <p>Els IV (Valors Individuals) són números ocults que cada Pokémon té assignats en les seves estadístiques. Funcionen com a "gens" que determinen el
        seu potencial màxim.</p>
    </div>
  </section>

  <section>
    <div class="dades">
      <h2>Taula de tipos?</h2>
      <p>Aqui teniu la taula de tipos pero nomes de la 1ra gen. Recordem que la web esta en fase beta i nomes hi han els pokemon i tipos de la 1ra gen
      </p>
      <div class="tablatipo">
        <img src="../../IMG/TablaTipos.png" alt="">
      </div>
    </div>
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