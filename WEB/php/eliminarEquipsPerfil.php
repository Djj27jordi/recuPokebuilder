<?php
session_start();
require 'connexio.php';
header("Content-Type: application/json");

$idUsuari = $_SESSION['ID_usuari'];
$idEquip = $_POST['idEquip'];

$sqlSelect = "SELECT fk_1er_pokemon, fk_2on_pokemon, fk_3er_pokemon, fk_4rt_pokemon, fk_5e_pokemon, fk_6e_pokemon
              FROM equips_pokemon
              WHERE ID_equipsPokemon = '$idEquip' AND fk_usuari = '$idUsuari'
";

$eliminarFilaTaulesPkmn = mysqli_query($conn, $sqlSelect);

while ($fila = mysqli_fetch_assoc($eliminarFilaTaulesPkmn)) {
  $taules = [
    '1er_pokemon' => $fila['fk_1er_pokemon'],
    '2on_pokemon' => $fila['fk_2on_pokemon'],
    '3er_pokemon' => $fila['fk_3er_pokemon'],
    '4rt_pokemon' => $fila['fk_4rt_pokemon'],
    '5e_pokemon' => $fila['fk_5e_pokemon'],
    '6e_pokemon' => $fila['fk_6e_pokemon']
  ];

  foreach ($taules as $taula => $idPkmn) {
    //if per veure si hi ha algun slot buit i no executar el sql i evitar errors
    if ($idPkmn != 0) {
      $sqlDelete = "DELETE FROM $taula WHERE ID_1erPokemon = '$idPkmn'";
      mysqli_query($conn, $sqlDelete);
    }
  }
}


$sql = "DELETE FROM publicacio WHERE fk_equipPokemon = '$idEquip' AND fk_ID_usuari = '$idUsuari'";
mysqli_query($conn, $sql);

$sql = "DELETE FROM equips_pokemon WHERE ID_equipsPokemon = '$idEquip' AND fk_usuari = '$idUsuari'";
mysqli_query($conn, $sql);

echo json_encode(['success' => true]);
