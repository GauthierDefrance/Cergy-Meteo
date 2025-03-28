<?php
include_once "../include/functions/main.inc.php";

header('Content-Type: application/json');

/*
 * Script qui renvoie les villes associées à un département.
 */


$TabAssociatifVilles = villes_de_dep();

if (!isset($_GET['departement']) || empty($_GET['departement'])) {
    echo json_encode([
        "success" => false,
        "message" => "Département invalide ou non spécifié",
        "data" => []
    ]);
    exit;
}

$departement = $_GET['departement'] ?? '';

$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';


$TabAssociatifVilles = $TabAssociatifVilles[$departement] ?? [];

$result = "";

/**
 * Filtrer les villes en fonction de la recherche.
 * @param $ville
 * @param $recherche
 * @return bool
 */
function filtrerVilles($ville, $recherche) {
    $ville = strtolower($ville);
    $recherche = strtolower($recherche);
    return strpos($ville, $recherche) !== false;
}

/**
 * Appliquer le filtre aux villes du département.
 */
$result = array_filter($TabAssociatifVilles, function($ville) use ($q) {
    return filtrerVilles($ville, $q);
});


if (empty($result)) {
    echo json_encode([
        "success" => false,
        "message" => "Aucune ville trouvée",
        "data" => []
    ]);
} else {
    echo json_encode([
        "success" => true,
        "message" => "Villes trouvées",
        "data" => array_values($result)
    ]);
}
?>
