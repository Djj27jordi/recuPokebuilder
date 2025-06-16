<?php
session_start();
header('Content-Type: application/json');
include 'connexio.php';

if (!isset($_SESSION['ID_usuari'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Sessió no iniciada']);
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$data = json_decode(file_get_contents('php://input'), true);
$pokemons = $data['pokemons'];
//error_log(print_r($pokemons, true));
$id_usuari = $_SESSION['ID_usuari'];
//echo $id_usuari . " -> id usuari,  ";
$ids_pokemon = [];

$taules = [
    'pkmn1' => '1er_pokemon',
    'pkmn2' => '2on_pokemon',
    'pkmn3' => '3er_pokemon',
    'pkmn4' => '4rt_pokemon',
    'pkmn5' => '5e_pokemon',
    'pkmn6' => '6e_pokemon'
];
//echo "hola";
foreach ($taules as $slot => $taula) {
    if (isset($pokemons[$slot])) {
        //echo ",,,, ".$taula ."slot: ".$slot;
        $dadesPokemon = $pokemons[$slot];
        // for ($i=0; $i < 4; $i++) { 
        //     if ($dadesPokemon['id_moviments'][$i] == null || $dadesPokemon['id_moviments'][$i] == "undefined"){
        //         $dadesPokemon['id_moviments'][$i] = 0;
        //     }
        // }
        // $mov1 = intval($dadesPokemon['id_moviments'][0] ?? 0);
        // $mov2 = intval($dadesPokemon['id_moviments'][1] ?? 0);
        // $mov3 = intval($dadesPokemon['id_moviments'][2] ?? 0);
        // $mov4 = intval($dadesPokemon['id_moviments'][3] ?? 0);
        $sql = "INSERT INTO $taula (
            fk_pokemon, nivell, genere, shiny,
            IvPS, IvAtac, IvDefensa, IvAtEspecial, IvDefEspecial, IvVelocitat,
            EvPS, EvAtac, EvDefensa, EvAtEspecial, EvDefEspecial, EvVelocitat,
            fk_mov1, fk_mov2, fk_mov3, fk_mov4
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error en prepare(): ' . $conn->error]);
            exit;
        }
        $stmt->bind_param(
            "iiiiiiiiiiiiiiiiiiii",
            $dadesPokemon['id_pokemon'],
            $dadesPokemon['nivell'],
            $dadesPokemon['sexe'],
            $dadesPokemon['shiny'],
            $dadesPokemon['IvPS'],
            $dadesPokemon['IvAtac'],
            $dadesPokemon['IvDefensa'],
            $dadesPokemon['IvAtEspecial'],
            $dadesPokemon['IvDefEspecial'],
            $dadesPokemon['IvVelocitat'],
            $dadesPokemon['EvPS'],
            $dadesPokemon['EvAtac'],
            $dadesPokemon['EvDefensa'],
            $dadesPokemon['EvAtEspecial'],
            $dadesPokemon['EvDefEspecial'],
            $dadesPokemon['EvVelocitat'],
            $dadesPokemon['id_moviments'][0],
            $dadesPokemon['id_moviments'][1],
            $dadesPokemon['id_moviments'][2],
            $dadesPokemon['id_moviments'][3],
        );

        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'message' => 'Error executant insert: ' . $stmt->error]);
            exit;
        }

        $ids_pokemon[] = $conn->insert_id;
    } else {
        $ids_pokemon[] = null;
    }
}

// Ara guarda l'equip
$estrategia = $data['estrategia'] ?? '';
$stmt = $conn->prepare("INSERT INTO equips_pokemon (
  fk_1er_pokemon, fk_2on_pokemon, fk_3er_pokemon, fk_4rt_pokemon, fk_5e_pokemon, fk_6e_pokemon, fk_usuari, estrategia
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "iiiiiiis",
    $ids_pokemon[0],
    $ids_pokemon[1],
    $ids_pokemon[2],
    $ids_pokemon[3],
    $ids_pokemon[4],
    $ids_pokemon[5],
    $id_usuari,
    $estrategia
);
$stmt->execute();

echo json_encode(['success' => true]);
$conn->close();
?>
