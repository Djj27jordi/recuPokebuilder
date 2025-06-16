<?php
session_start();
include 'connexio.php';

$sql = "SELECT imatgeM FROM pokedex";
$result = $conn->query($sql);

$imatgesPokemon = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imatgesPokemon[] = $row;
    }
}

echo json_encode($imatgesPokemon);
$conn->close();
?>