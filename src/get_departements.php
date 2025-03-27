<?php
header('Content-Type: application/json');

$departements = [
    "Île-de-France" => ["Paris", "Seine-et-Marne", "Yvelines"],
    "Auvergne-Rhône-Alpes" => ["Rhône", "Isère", "Savoie"],
    "Normandie" => ["Seine-Maritime", "Calvados", "Orne"]
];

$region = $_GET['region'] ?? '';
$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';

if (isset($departements[$region])) {
    $result = array_filter($departements[$region], fn($dep) => str_contains(strtolower($dep), $q));
    echo json_encode(array_values($result));
} else {
    echo json_encode([]);
}
?>