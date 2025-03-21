<?php
function getUserIP() {
    // Si l'utilisateur utilise un proxy, l'adresse IP sera dans HTTP_X_FORWARDED_FOR
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

function getUserLocalisation():string{
    $ip = getUserIP();
    $XMLurl = "http://www.geoplugin.net/xml.gp?ip=".$ip;
    $xml = simplexml_load_string(file_get_contents($XMLurl));
    echo "<p>$xml</p>";
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