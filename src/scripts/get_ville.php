<?php
/**
 * @file get_ville.php
 * @brief Script pour récupérer les villes associé à un département d'une région
 *
 * Scripts PHP fonctionnant un peu comme une API.
 * JavaScript sur la page indexe fait des requêtes à cette pages pour
 * demander quelles villes afficher selon la région, le département et des charactères tapé.
 *
 * Le Script PHP renvoit alors un JSON selon si la requête est valide ou non.
 *
 * @author Gauthier Defrance
 * @date 2025-16-04
 */


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
 * Script qui renvoie les villes associées à un département dans une région.
 */

// Récupération des paramètres depuis l'URL
$region = sanitize_string($_GET['region']) ?? '';
$departementNum = sanitize_string($_GET['departement']) ?? '';

// Récupérer la liste des villes du département en utilisant son code
$TabAssociatifVilles = villes_de_dep($departementNum,"../data/cities.csv");

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
