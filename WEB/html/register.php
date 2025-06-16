<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DiversityBuilder - Inici de Sessió</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/colors.css">
    <link rel="stylesheet" href="../css/nav_i_footer.css">
    <link rel="stylesheet" href="../css/register.css" />
</head>

<body>
    <div class="background-image"></div>

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

    <div class="overlay-red">
        <div class="login-box">
            <h1>Crear Usuari</h1>
            <form action="../php/register.php" method="POST">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required />

                <label for="apodo">Apodo:</label>
                <input type="text" id="apodo" name="apodo" required />

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />

                <label for="contrasenya">Contrasenya:</label>
                <input type="password" id="contrasenya" name="contrasenya" required />

                <button type="submit">Crear Usuari</button>
            </form>
            <p style="margin-top: 50px; align-self: end;">Tens conta? <a href="./login.php" style="text-decoration: underline; font-weight: bold;">Inicia sessió</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>