<?php
include 'connexio.php';
session_start();

if (isset($_POST['novaFoto']) && isset($_SESSION['ID_usuari'])) {
  $novaFoto = $_POST['novaFoto'];
  $idUsuari = $_SESSION['ID_usuari'];

  $sql = "UPDATE usuaris SET imatge = '$novaFoto' WHERE ID_usuari = '$idUsuari'";
  $result = $conn->query($sql);

  if ($result) {
    $_SESSION['imatge'] = $novaFoto;
    echo json_encode(['success' => true, 'novaFoto' => $novaFoto]);
  } else {
    echo json_encode(['success' => false, 'error' => 'No s\'ha pogut actualitzar la foto']);
  }
} 
else {
  echo json_encode(['success' => false, 'error' => 'Dades incorrectes']);
}
$conn->close();
