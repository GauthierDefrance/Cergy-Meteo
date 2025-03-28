<?php 
/*Constantes*/

/*Chemins*/
define('REG_PATH', './data/v_region_2024.csv')  ;
const DEP_PATH = './data/v_departement_2024.csv' ;
const VIL_PATH = './data/cities.csv' ;

/*Fonctions*/

/**
 * Associe les numéros des régions à leur noms.
 *
 * @return array Tableau associatif associant le numéro d'une région à son nom.
 */
function reg_num_correspondance(){
    $csv = fopen(REG_PATH, "r");
    $reg = [];
    if (($csv) !== false) {
        //saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 200, ",")) !== false) {
            if (isset($ligne[0])&& isset($ligne[3])) {
                //crée un tableau associatif associant numéro de région et nom de région
                $reg[$ligne[0]] = $ligne[3];
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
    return $reg;

}

/**
 * Convertit les données des régions et départements en un tableau associatif.
 *
 * @return array Tableau associatif associant le nom de la région à une liste de départements, composées d'un numéro et d'un nom.
 */
function reg_to_depart(){
    $reg= reg_num_correspondance();
    $csv = fopen(DEP_PATH, "r");
    $reg_to_deps = [];
    if (($csv) !== false) {
        //Saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 200, ",")) !== false) {
            if (isset($ligne[0])&& isset($ligne[1])&& isset($ligne[6])) {
                $reg_code=$ligne[1];
                $reg_name=$reg[$reg_code];
                $dep_code=$ligne[0];
                $dep_name=$ligne[6];
                $dep=[$dep_code,$dep_name];
                //crée un tableau associatif associant nom de région à un array de départements
                if (!isset($reg_to_deps[$reg_name])) {
                    $reg_to_deps[$reg_name] = [];  // Initialise lorsqu'elle n'existe pas
                }
                //ajoute le département à sa place correspondante (append)
                $reg_to_deps[$reg_name][] = $dep;  
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
    return $reg_to_deps;
}


/**
 * Fonction de test du tableau associatif régions-départements.
 * @return void
 */
function log_array(){
    $test_array=reg_to_depart();
    print_r($test_array);
}
/**
 * Génère une liste de définitions HTML des régions et de leurs départements.
 *
 * @return string Un string HTML contenant la liste des régions et départements.
 */
function def_list_regions(){
    $reg_array=reg_to_depart();
    $html = "<dl>\n";

    foreach ($reg_array as $reg_array => $departments) {
        $html .= "    <dt><strong>" . htmlspecialchars($reg_array) . "</strong></dt>\n";
        foreach ($departments as $dept) {
            $html .= "    <dd>" . htmlspecialchars($dept[0]) . " - " . htmlspecialchars($dept[1]) . "</dd>\n";
        }
    }
    return $html;

}



/**
 * Récupère les villes d'un département donné.
 *
 * @param string $departement Le code du département.
 * @return array Un tableau des villes appartenant au département.
 */
function villes_de_dep(string $departement):array{
    $csv = fopen(VIL_PATH, "r");
    $villes = [];
    if (($csv) !== false) {

        //saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 50000, ",")) !== false) {
            
            if($ligne[1]==$departement){
                $villes[]=$ligne[4];
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
    return $villes;
}
/**
 * Récupère les informations des villes d'un département sélectionné.
 *
 * @param string $departement Le code du département.
 * @return array Un tableau associatif associant le nom d'une ville d'un département à sa localisation.
 */
function villes_de_dep_location(string $departement):array{
    $csv = fopen(VIL_PATH, "r");
    $villes = [];
    if (($csv) !== false) {

        //saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 50000, ",")) !== false) {
            
            if($ligne[1]==$departement){
                $villes[$ligne[4]]=[$ligne[6],$ligne[7]];
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
    return $villes;
}

/**
 * Fonction de test de tableau .
 * @return void
 */
function log_array2(array $test_array){
    print_r($test_array);
}

/**
 * Récupère la latitude d'une ville donnée.
 *
 * @param string $departement Le nom du département.
 * @param string $ville Le nom de la ville.
 * @return string la latitude de la ville
 */
function get_ville_latitude(string $departement,string $ville){
    $villes=villes_de_dep_location($departement);
    $latitude=$villes[$ville][0];
    return $latitude;
}

/**
 * Récupère la longitude d'une ville donnée.
 *
 * @param string $departement Le nom du département.
 * @param string $ville Le nom de la ville.
 * @return string la longitude de la ville
 */
function get_ville_longitude(string $departement,string $ville){
    $villes=villes_de_dep_location($departement);
    $longitude=$villes[$ville][1];
    return $longitude;
}

/**
 * Récupère les données météorologiques pour une ville donnée.
 *
 * @param string $region Le nom de la région.
 * @param string $departement Le nom du département.
 * @param string $ville Le nom de la ville.
 */
function get_weather_data(string $region,string $departement,string $ville){
    $weatherUrl = "https://api.open-meteo.com/v1/forecast?";
    $name="name=".$ville;
    $count="counter=20";
}







?>