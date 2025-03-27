<?php
include_once "../include/functions/main.inc.php";

header('Content-Type: application/json');

/*
 * Scripts qui renvoi les départements associé à une région.
 */

$TabAssociatifVille = reg_to_depart();

$region = $_GET['regions'] ?? '';
$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';

$departements = $TabAssociatifDepartements[$region] ?? [];

$result="";

/**
 * Vérifie si la recherche donné match avec un département
 * @param $departement
 * @param $recherche
 * @return bool
 */
function filtrerDepartements($departement, $recherche) {
    $departement = strtolower($departement);
    $recherche = strtolower($recherche);
    return strpos($departement, $recherche) !== false;
}

/**
 * Sorcellerie, trie l'array liste selon si elle match les conditions de filtrerDepartements
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
        "data" => array_values($result)
    ]);
}

?>