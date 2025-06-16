<?php
session_start();
//Si s'intenta accedir sense estar loguejat redirigeix al login.php
if (!$_SESSION['apodo']) {
  header('Location: login.php');
  exit();
}

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
  <link rel="stylesheet" href="../css/perfil.css">
  <title>Perfil - <?= $_SESSION['apodo'] ?></title>
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

  <!-- Modal Foto de perfil-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Foto de perfil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="llistaImatgesPerfil">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="cont_blanc">
    <section>
      <div class="estruct">
        <div class="posicioPerfil">
          <div class="dadesPrincipal">
            <img src="<?= $_SESSION['imatge'] ?>" alt="Seadra" id="fotoPerfil" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="cambiarFotoPerfil()">
            <h2><?= $_SESSION['apodo'] ?></h2>
            <div class="totalLike">
              <i class='bx bx-md bxs-heart'></i>
              <p>27</p>
            </div>
            <div class="divTancarSessio" onclick="tancarSessio()">
              <button id="tancarSessio">Tanca Sessió</button>
            </div>
          </div>
        </div>
        <div class="equipsCreats">
          <h1>Els teus equips</h1>
          <div class="caixes" id="caixes">
            <!-- <div class="caixa">
              <div class="nomMiniMenu">
                <h3>Nom Equip</h3>
                <div class="menuOpcionsContainer">
                  <i class='bx bx-md bx-dots-horizontal-rounded miniMenu'></i>
                  <div class="menuOpcions">
                    <p>Modificar equip</p>
                    <p>Eliminar equip</p>
                  </div>
                </div>
              </div>
              <div class="equip">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon1" alt="">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon2" alt="">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon3" alt="">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon4" alt="">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon5" alt="">
                <img src="https://img.pokemondb.net/sprites/black-white/normal/gengar.png" class="equipPokemon" id="pokemon6" alt="">
              </div>
              <div class="totalLikeEquip">
                <i class='bx bx-sm bxs-heart'></i>
                <p>27</p>
              </div>
            </div> -->
          </div>
          <button class="afegirCaixa" onclick="crearNouEquip()">
            <i class='bx bx-lg bx-plus-circle'></i>
          </button>
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
  <script src="../JavaScript/perfil.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>