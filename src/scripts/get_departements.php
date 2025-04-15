<?php

// Permet toutes les origines (peut être restreint à un domaine spécifique)
header("Access-Control-Allow-Origin: *");

// Permet les méthodes GET, POST et OPTIONS
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Permet les en-têtes spécifiques dans la requête
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");

// Si la méthode est OPTIONS (pré-vol), la réponse doit être immédiate
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

include_once "../include/functions/main.inc.php";

header('Content-Type: application/json');

/*
 * Script qui renvoie les départements associés à une région.
 */

$TabAssociatifDepartements = reg_to_depart();

if (!isset($_GET['region']) || empty($_GET['region'])) {
    echo json_encode([
        "success" => false,
        "message" => "Région invalide ou non spécifiée",
        "data" => []
    ]);
    exit;
}

$region = sanitize_string($_GET['region']);

$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';

$departements = $TabAssociatifDepartements[$region] ?? [];

if (empty($departements)) {
    echo json_encode([
        "success" => false,
        "message" => "Aucun département trouvé pour cette région",
        "data" => []
    ]);
    exit;
}

$result = "";

/**
 * Vérifie si la recherche donnée match avec un département (en se basant sur le nom du département uniquement)
 * @param $departement
 * @param $recherche
 * @return bool
 */
function filtrerDepartements($departement, $recherche) {
    // On extrait le nom du département (élément indexé à 1)
    $dep_name = strtolower($departement[1]);
    $recherche = strtolower($recherche);

    return strpos($dep_name, $recherche) !== false;
}

/**
 * Trie la liste des départements en fonction de la recherche
 */
$result = array_filter($departements, function($dep) use ($q) {
    return filtrerDepartements($dep, $q);
});

if (empty($result)) {
    echo json_encode([
        "success" => false,
        "data" => []
    ]);
} else {
    // Modifié pour inclure le numéro de département avec le nom
    $departmentsWithNumbers = array_map(function($dep) {
        return [
            "number" => $dep[0], // Le numéro du département
            "name" => $dep[1]    // Le nom du département
        ];
    }, array_values($result));

    echo json_encode([
        "success" => true,
        "data" => $departmentsWithNumbers
    ]);
}
?>
