<?php 
/**
 * @file main.inc.php
 * @brief Gestion des données géographiques et météorologiques.
 *
 * Ce fichier définit des fonctions permettent de récuperer des informations sur les régions, 
 * départements et villes de France dans des fichiers CSV, et de les retourner 
 * sous différentes formes pour un accès facile. 
 * Il contient aussi des fonctions appellant l'API renvoyant des données météorologiques.
 * 
 * @author Thomas Hornung
 * @date 2025-20-03
 */

/*Chemins*/
define('REG_PATH', './data/v_region_2024.csv')  ;
const DEP_PATH = './data/v_departement_2024.csv' ; //temporary absolute paths?
const VIL_PATH = './data/cities.csv' ;

/*Fonctions*/

/**
 * Associe les numéros des régions à leur noms.
 *
 * @return array Tableau associatif associant le numéro d'une région à son nom.
 */
function reg_num_correspondance($path=REG_PATH){
    $csv = fopen($path, "r");
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
function reg_to_depart($path=DEP_PATH, $rpath=REG_PATH){
    $reg= reg_num_correspondance($rpath);
    $csv = fopen($path, "r");
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
function villes_de_dep(string $departement, string $path=VIL_PATH):array{
    $csv = fopen($path, "r");
    $villes = [];
    if (($csv) !== false) {

        //saute la première ligne
        fgetcsv($csv);
        //Parcours le fichier CSV
        while (($ligne = fgetcsv($csv, 50000, ",")) !== false) {
            
            if($ligne[1]==$departement){
                if((!in_array($ligne[4], $villes))){
                    $villes[]=$ligne[4];
                }
                
            }
        }
        fclose($csv);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
    return $villes;
}

/**
 * Vérifie si une ville appartient à un département.
 *
 * @param string $ville Le nom de la ville à vérifier.
 * @param string $departement Le code du département dans lequel vérifier.
 * @return bool Retourne true si la ville appartient au département, sinon false.
 */
function ville_dans_departement(string $ville, string $departement): bool {
    // Récupère les villes et leurs localisations dans le département spécifié
    $villes = villes_de_dep_location($departement);

    // Vérifie si la ville est présente dans le tableau des villes
    return isset($villes[$ville]);
}

/**
 * Récupère les informations des villes d'un département sélectionné.
 *
 * @param string $departement Le code du département.
 * @return array Un tableau associatif associant le nom d'une ville d'un département à sa localisation.
 */
function villes_de_dep_location(string $departement, $path=VIL_PATH):array{
    $csv = fopen($path, "r");
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
 * Crée une datalist html des départements d'une région de France.
 *
 * @param string $region Le nom de la région.
 * @return string $html une datalist html des noms des départements de la région.
 */

function region_data_list(string $region){
    $depart=reg_to_depart()[$region];
    $html='<label for="departement">Entrez votre département :</label>';
    $html.='<input list="departements" id="departement" name="departement">';
    $html.='<datalist id="departements">';
    foreach ($depart as $key => $dep){
        $html.='<option value="'.htmlspecialchars($dep[1]).'">';
    }
    $html.='</datalist>';
    return $html;
}

/**
 * Crée une scrolling list html des départements d'une région de France.
 *
 * @param string $region Le nom de la région.
 * @return string $html une scrolling list html des noms des départements de la région.
 */

function departements_scrolling_list(string $region){
    $departs=reg_to_depart()[$region];
    $html='<form action="weather.php" method="get" >
    <input type="hidden" name="region" value="'.$region.'">
    <label for="departement">Choisissez un département :</label>
    <select name="departement" id="departement">';
    foreach ($departs as $key => $dep){
        $html.= '<option value="'.htmlspecialchars($dep[0]).'">'.htmlspecialchars($dep[1]).'</option>';
        }
    $html.='</select>
    <button type="submit">Envoyer</button>
    </form>';
    return $html;
}

/**
 * Crée une scrolling list html des villes d'un département de France.
 *
 * @param string $depart_code Le code du département.
 * @return string $html une scrolling list html des noms des villes du département.
 */

function villes_scrolling_list(string $depart_code, string $reg_name='none'){
    $villes=villes_de_dep($depart_code);
    $html='<form action="weather.php" method="get" >
    <input type="hidden" name="departement" value="'.$depart_code.'">
    <input type="hidden" name="region" value="'.$reg_name.'">
    <label for="ville">Choisissez une ville :</label>
    <select name="ville" id="ville">';
    foreach ($villes as $key => $ville){
        $html.= '<option value="'.htmlspecialchars($ville).'">'.htmlspecialchars($ville).'</option>';
        }
    $html.='</select>
    <button type="submit">Envoyer</button>
    </form>';
    return $html;
}

/**
 * Récupère la latitude d'une ville donnée.
 *
 * @param string $departement Le numero du département.
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
 * @param string $departement Le numero du département.
 * @param string $ville Le nom de la ville.
 * @return string la longitude de la ville
 */
function get_ville_longitude(string $departement,string $ville){
    $villes=villes_de_dep_location($departement);
    $longitude=$villes[$ville][1];
    return $longitude;
}

/**
 * Récupère la longitude et la longitude d'une ville donnée.
 *
 * @param string $departement Le numero du département.
 * @param string $ville Le nom de la ville.
 * @return array un tableau des coordonées de la ville, latitude en première case
 */
function get_ville_coordinates(string $departement,string $ville){
    $villes=villes_de_dep_location($departement);
    $latitude=$villes[$ville][0];
    $longitude=$villes[$ville][1];
    $coords=[$latitude,$longitude];

    return $coords;
}

/**
 * Récupère les données météorologiques pour une ville donnée.
 * Utilise l'API open météo à laquelle la latitude et longitude correspondantes sont données.
 * 
 * @param string $region Le nom de la région.
 * @param string $departement Le nom du département.
 * @param string $ville Le nom de la ville.
 * @return array un tableau obtenu à partir du JSON contenant des données météo
 */
function get_weather_data(string $departement,string $ville){
    $weatherUrl = "https://api.open-meteo.com/v1/forecast?";
    $latitude=get_ville_latitude($departement,$ville);
    $longitude=get_ville_longitude($departement,$ville);
    $hourly="hourly=temperature_2m";
    $weatherUrl .= "latitude=".$latitude."&longitude=".$longitude."&daily=temperature_2m_min,temperature_2m_max,precipitation_sum,weathercode&timezone=Europe%2FParis";
    $response = file_get_contents($weatherUrl);

    if ($response === FALSE) {
        echo('Erreur lors de la récupération des données météo');
    }

    return json_decode($response, true);

}

/**
 * Augmente de 1 le nombre de hits de la ville en paramètre sur un fichier csv.
 * Crée une nouvelle ligne pour la ville si elle n'existe pas déjà.
 * 
 * @param string $departement Le numéro du département de ka ville.
 * @param string $ville Le nom de la ville.
 * @return void
 */
function increase_ville_hits(string $ville,string $departement, $filepath='./data/hits_villes.csv'){
    //read mode, grab toutes les lignes du fichiers, peu éfficace sur des grands fichiers
    if (($file = fopen($filepath, 'r')) !== false) {
        $data = [];
    
        while (($ligne = fgetcsv($file)) !== false) {
            $data[] = $ligne;
        }
        fclose($file);
    
        if (($file = fopen($filepath, 'w')) !== false) {
            $exists = false;
            foreach ($data as $ligne) {
                if($ligne[0]===$ville && $ligne[1]===$departement){
                    $ligne[2]+=1;
                    $exists= true;
                }
                fputcsv($file, $ligne);
            }
            if ($exists === false && !empty($ville) && !empty($departement)) {
                $newLigne = [$ville, $departement, 1];
                fputcsv($file, $newLigne);
            }
            
            fclose($file);
        } else {
            echo "Erreur d'écriture du fichier.";
        }
    } else {
        echo "Erreur de lecture du fichier.";
    }
}

/**
 * Vérifie si un numéro de département se trouve dans une région donnée.
 *
 * @param string $num_departement Le numéro du département à vérifier.
 * @param string $nom_region Le nom de la région dans laquelle vérifier.
 * @return bool Retourne vrai si le département est dans la région, sinon faux.
 */
function est_departement_dans_region($num_departement, $nom_region) {
    // Appel à la fonction reg_to_depart() pour récupérer le tableau associatif
    $reg_to_deps = reg_to_depart();

    // Vérifie si la région existe dans le tableau
    if (isset($reg_to_deps[$nom_region])) {
        // Parcours des départements de la région
        foreach ($reg_to_deps[$nom_region] as $dep) {
            // Le code du département est dans le premier élément du tableau $dep
            if ($dep[0] === $num_departement) {
                return true; // Le département est trouvé dans cette région
            }
        }
    }
    return false; // Le département n'est pas trouvé dans cette région
}

/**
 * Fonction de test implémentant une exception, renvoyant le nom d'une région lorsqu'on entre son numéro.
 *
 * @return string le code correspondant du département.
 * @throws Exception Si la région ne correspond à rien.
 */
function exceptional_function(array $region, $path=REG_PATH){
    $cor= reg_num_correspondance($path);
    if(!isset($cor[$region])){
        throw new Exception("Exception: Le numéro de région indiqué ne correspond à aucun numéro connu. assurez vous de bien mettre 0 avant les nombre à 1 chiffre.");
    }
    return ($cor[$region]);
    

}
/**
 * Calcule la somme des carrés des n premiers entiers
 *
 * @param int $n Le nombre d'entiers dans la somme.
 * @return int La somme calculée.
 */
function somme_carre(int $n): int {
    $somme = 0;
    for ($i = 1; $i <= $n; $i++) {
        $somme += $i * $i;
    }
    return $somme;
}

/**
 * Calcule la somme des carrés des n premiers entiers avec la formule
 *
 * @param int $n Le nombre d'entiers à inclure dans la somme.
 * @return int Le résultat obtenu par la formule : n(n+1)(2n+1)/6.
 */
function somme_carre_formule(int $n): int {
    return ($n * ($n + 1) * (2 * $n + 1)) / 6;
}

/**
 * Vérifie que la somme des carrés calculée par boucle est identique à celle de la formule.
 *
 * @param int $n Le nombre d'entiers à tester
 * @return void
 * @throws AssertionError Si les deux résultats ne correspondent pasd
 */
function verifier_somme_carre(int $n): void {

    $resultat_calcul = somme_carre($n);
    $resultat_formule = somme_carre_formule($n);

    assert($resultat_calcul === $resultat_formule, "Erreur : la somme des carrés calculée ne correspond pas sur n = $n, il y a donc une erreur");
    echo("Assertion validé");
}

/**
 * Fonction qui normalise un string pour éviter toutes injections
 * @param string $string le string à convertir
 * @return string un string purger
 */
function sanitize_string(string $string) : string {
    $clean = strip_tags($string);
    $clean = htmlspecialchars($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $clean = preg_replace('/[<>=!]/', '', $clean);
    return $clean;
}



?>