<?php
require 'connexio.php';
header("Content-Type: application/json");

$pokemonAleatori = [];

$sql = "SELECT ID_pokedex, imatgeM, nom FROM pokedex ORDER BY RAND() LIMIT 12";
$resposta = mysqli_query($conn, $sql);

while ($fila = mysqli_fetch_assoc($resposta)) {
    $pokemonAleatori[] = $fila;
}

echo json_encode($pokemonAleatori);
?>