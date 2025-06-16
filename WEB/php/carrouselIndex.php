<?php
  require 'connexio.php';
  header("Content-Type: application/json");

  $pokemonsRand = [];

  for ($i=0; $i < 10; $i++) { 
    $numRandom = rand(1, 151);

    $sql = "SELECT ID_pokedex, imatgeM, nom FROM pokedex WHERE ID_pokedex = $numRandom";
    $resposta = mysqli_query($conn, $sql);

    if ($fila = mysqli_fetch_assoc($resposta)) {
      $pokemonsRand[] = $fila;
    }
  }
  
  echo json_encode($pokemonsRand);
?>