<?php
session_start();
header('Content-Type: application/json');
include 'connexio.php';

if (isset($_POST['idEquip']) && isset($_POST['publicar'])) {
  $idEquip = $_POST['idEquip'];
  $publicar = $_POST['publicar'];
  $idUser = $_SESSION['ID_usuari'];

  if ($publicar === "Publicar") {
    $sql = "INSERT INTO publicacio (num_vots, publicat, fk_equipPokemon, fk_ID_usuari) VALUES (0, 1, '$idEquip', '$idUser')";
    mysqli_query($conn, $sql);
    echo json_encode(['success' => true]);
    
  } 
  else if ($publicar === "No publicar") {
    $sql = "UPDATE publicacio SET publicat = 0 WHERE fk_equipPokemon = '$idEquip' AND fk_ID_usuari = '$idUser'";
    mysqli_query($conn, $sql);
    echo json_encode(['success' => true]);
  } 
  else {
    echo json_encode(['success' => false, 'message' => 'Error en el sistema']);
  }
} 
?>