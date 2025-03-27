<?php 
/*Constantes*/
define('REG_PATH', './data/v_region_2024.csv')  ;
const DEP_PATH = './data/v_departement_2024.csv' ;
const VIL_PATH = './data/villes.csv' ;


function reg_to_depart(){
    $csv = fopen(REG_PATH, "r");
    $reg = [];
    if (($csv) !== false) {
        //saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 200, ",")) !== false) {
            if (isset($ligne[0])&& isset($ligne[5])) {  
                //crée un tableau associatif associant numéro de région et nom de région
                $reg[$ligne[0]] = $ligne[5];  
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
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

function log_array(){
    $test_array=reg_to_depart();
    print_r($test_array);
}

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

function villes_de_dep(string $departement):array{

}

function get_weather_data(string $region,string $departement,string $ville){

}


?>