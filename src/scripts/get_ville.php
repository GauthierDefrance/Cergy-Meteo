<?php
include_once "./include/functions/main.inc.php";

header('Content-Type: application/json');

/*
 * Script qui renvoie les villes associées à un département dans une région.
 */

// Récupération des paramètres depuis l'URL
$region = $_GET['region'] ?? '';
$departement = $_GET['departement'] ?? '';

// Si la région ou le département n'est pas spécifié, on retourne une erreur.
if (empty($region) || empty($departement)) {
    echo json_encode([
        "success" => false,
        "message" => "Région ou département invalide ou non spécifié",
        "data" => []
    ]);
    exit;
}

// Récupérer les départements de la région via la fonction reg_to_depart()
$tab = reg_to_depart();

// Vérifier que la région existe
if (!isset($tab[$region])) {
    echo json_encode([
        "success" => false,
        "message" => "Région invalide",
        "data" => []
    ]);
    exit;
}

// Récupérer les départements de la région spécifiée
$departements = $tab[$region];

// Vérifier que le département existe pour cette région
// Vérifier que le département existe pour cette région
$departementExistant = false;
foreach ($departements as $dep) {
    if ($dep[0] === $departement) {
        $departementExistant = true;
        break;
    }
}


if (!$departementExistant) {
    echo json_encode([
        "success" => false,
        "message" => "Département invalide pour cette région",
        "data" => []
    ]);
    exit;
}

// Récupérer la liste des villes du département
$TabAssociatifVilles = villes_de_dep($departement);

// Filtrage des villes si une recherche est fournie
$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';
$result = [];

// Fonction de filtrage des villes
function filtrerVilles($ville, $recherche) {
    $ville = strtolower($ville);
    $recherche = strtolower($recherche);
    return strpos($ville, $recherche) !== false;
}

// Appliquer le filtre aux villes
if (!empty($q)) {
    $result = array_filter($TabAssociatifVilles, function($ville) use ($q) {
        return filtrerVilles($ville, $q);
    });
} else {
    $result = $TabAssociatifVilles;
}

// Réponse JSON avec les villes filtrées
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
