<?php
session_start();
include 'connexio.php';
header('Content-Type: application/json');

$sql = "SELECT p.ID_publicacio, p.num_vots, p.publicat, p.fk_equipPokemon, eq.estrategia AS estrategia, pok1dex.imatgeM AS pkmn1, pok2dex.imatgeM AS pkmn2, pok3dex.imatgeM AS pkmn3, pok4dex.imatgeM AS pkmn4, pok5dex.imatgeM AS pkmn5, pok6dex.imatgeM AS pkmn6, u.apodo AS nom_usuari, u.imatge AS img_perfil
        FROM publicacio p
        JOIN equips_pokemon eq ON p.fk_equipPokemon = eq.ID_equipsPokemon
        JOIN 1er_pokemon pkmn1 ON eq.fk_1er_pokemon = pkmn1.ID_1erPokemon
        JOIN pokedex pok1dex ON pkmn1.fk_pokemon = pok1dex.ID_pokedex
        JOIN 2on_pokemon pkmn2 ON eq.fk_2on_pokemon = pkmn2.ID_1erPokemon
        JOIN pokedex pok2dex ON pkmn2.fk_pokemon = pok2dex.ID_pokedex
        JOIN 3er_pokemon pkmn3 ON eq.fk_3er_pokemon = pkmn3.ID_1erPokemon
        JOIN pokedex pok3dex ON pkmn3.fk_pokemon = pok3dex.ID_pokedex
        JOIN 4rt_pokemon pkmn4 ON eq.fk_4rt_pokemon = pkmn4.ID_1erPokemon
        JOIN pokedex pok4dex ON pkmn4.fk_pokemon = pok4dex.ID_pokedex
        JOIN 5e_pokemon pkmn5 ON eq.fk_5e_pokemon = pkmn5.ID_1erPokemon
        JOIN pokedex pok5dex ON pkmn5.fk_pokemon = pok5dex.ID_pokedex
        JOIN 6e_pokemon pkmn6 ON eq.fk_6e_pokemon = pkmn6.ID_1erPokemon
        JOIN pokedex pok6dex ON pkmn6.fk_pokemon = pok6dex.ID_pokedex
        JOIN usuaris u ON p.fk_ID_usuari = u.ID_usuari
        WHERE p.publicat = 1
        ORDER BY p.ID_publicacio DESC";
$execucioPubli = mysqli_query($conn, $sql);

$posts = [];
while ($fila = mysqli_fetch_assoc($execucioPubli)) {
  $posts[] = $fila;
}

echo json_encode($posts);
?>
