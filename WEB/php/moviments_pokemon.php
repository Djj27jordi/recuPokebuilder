<?php
header('Content-Type: application/json');
require_once 'connexio.php';

$conn->set_charset("utf8"); //ens assegurem que la connexió utilitza UTF-8 per utilitzar caracters especials

$idPokemon = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idPokemon <= 0) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT m.ID_moviment, m.nom
        FROM moviments m
        JOIN pokemon_moviments pm ON m.ID_moviment = pm.ID_moviment
        WHERE pm.ID_pokemon = $idPokemon";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([]);
    exit;
}

$moviments = [];
while ($row = $result->fetch_assoc()) {
    $moviments[] = $row;
}

echo json_encode($moviments, JSON_UNESCAPED_UNICODE); // JSON_UNESCAPED_UNICODE em serveix per evitar problemes amb caracters especials

$conn->close();
?>
