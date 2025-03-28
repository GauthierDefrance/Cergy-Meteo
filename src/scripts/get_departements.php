<?php
include_once "./include/functions/main.inc.php";

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

$region = $_GET['region'];

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
    echo json_encode([
        "success" => true,
        "data" => array_map(function($dep) {
            return $dep[1];
        }, array_values($result))
    ]);
}
?>
