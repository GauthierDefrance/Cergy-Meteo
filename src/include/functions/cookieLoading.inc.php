<?php 
/**
 * @file cookieLoading.inc.php
 * @brief Gestion et chargement des cookies et de leurs données.
 *
 * Ce fichier définit des fonctions qui permettent de définir des cookies, de leur donner des valeurs,
 * et de récupérer ces valeurs ultérieurement.
 * 
 * @author Thomas Hornung
 * @date 2025-20-03
 */

declare(strict_types=1);

/**
 * Crée un cookie 'mode' pendant 30 jours.
 * @param string $mode la valeure (sombre ou clair) du mode d'affichage qu'on souhaite stocker.
 * @return void
 */
function set_mode(string $mode):void{
    setcookie('mode', $mode, time() + (86400 * 30), "/");
}

/**
 * Modifie la langue sélectionné dans les cookies.
 * @param string $lang
 * @return void
 */
function set_lang(string $lang) {
    setcookie('lang',$lang, time() + (86400 * 30), "/");
}

/**
 * Récupère le mode stocké en cookie ou, s'il est indiqué, le mode passé en paramètre dans l'URL.
 * @return string le mode d'affichage.
 */
function mode():string{
    if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
        return ($mode==='dark') ? 'dark' : 'light'; 
    }
    elseif(isset($_COOKIE['mode'])){
        $mode = $_COOKIE['mode'];
        if (in_array($mode, ["light", "dark"])) {
            return $mode;
        } else {
            //efface le cookie en le placeant dans le passé
            setcookie('mode', $mode, time() - 4000 , "/");
        }
    }
    else{
        return 'light';
    }

    return ($mode==='dark') ? 'dark' : 'light';
    $mode = isset($_COOKIE['mode']) ? $_COOKIE['mode'] : 'light';
    return ($mode==='dark') ? 'dark' : 'light';
}

/**
 * Crée un cookie 'lastViewed' pendant 90 jours, contant le dernière ville recherché, son département, et la date du stockage.
 * @param string $ville la ville recherché.
 * @param string $departement le département de la ville recherché.
 */

function set_last_viewed(string $ville,string $departement, string $region) {
    $date = date("Y-m-d"); //peut êtres à mettre en francais une autre fois?
    $lastViewed = [
        "ville" => $ville,
        "departement" => $departement,
        "region" => $region,
        "date" => $date
    ];
    setcookie("lastViewed", json_encode($lastViewed), time() + (86400 * 90), "/");
}

/**
 * Récupère un tableau contant la ville stocké en cookie ou, à défaut un tableau générique.
 * @return array $ville un tableau contenant la dernière ville recherché, son département et la date de stockage.
 */
function last_viewed():array{
    if (isset($_COOKIE["lastViewed"])) {
        $ville = json_decode($_COOKIE["lastViewed"], true);
    }
    else{
        $ville = [
            "ville" => "none",
            "departement" => "none",
            "region" => "none",
            "date" => "none"
        ];
    }
    return $ville;
}


?>