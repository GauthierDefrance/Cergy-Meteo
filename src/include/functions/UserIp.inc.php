<?php
/**
 * @file UserIp.inc.php
 * @brief Programme servant à obtenir l'IP d'un utilisateur connecté
 *
 * @author Gauthier Defrance & Thomas Hornung
 * @date 2025-16-04
 */


/**
 * Méthode qui calcule l'IP de l'utilisateur actuel.
 * @return String IP de l'utilisateur courant.
 */
function getUserIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Si l'utilisateur est directement connecté (sans proxy)
    elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // L'adresse IP de l'utilisateur, obtenue directement depuis REMOTE_ADDR
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Retourner l'adresse IP
    return $ip;
}

/**
 * Fonction qui affiche les informations relative à la positions d'un utilisateur selon son IP.
 * @return string un tableau html
 */
function getUserLocalisation():string{
    $ip = getUserIP();
    $XMLurl = "http://www.geoplugin.net/xml.gp?ip=".$ip;
    $xml = simplexml_load_string(file_get_contents($XMLurl));
    $country = $xml->geoplugin_countryName;
    $region = $xml->geoplugin_region;
    $city = $xml->geoplugin_city;
    $latitude = $xml->geoplugin_latitude;
    $longitude = $xml->geoplugin_longitude;

    $result = "<table class='tableur'><thead><tr> <th>IP</th>  <th>Pays</th>  <th>Région</th>  <th>Ville</th>  <th>Latitude</th>  <th>Longitude</th></tr></thead>";
    $result .= "<tbody><tr> <td>$ip</td>  <td>$country</td>  <td>$region</td>  <td>$city</td>  <td>$latitude</td>  <td>$longitude</td></tr></tbody></table>";

    return $result;
}



?>