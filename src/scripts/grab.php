<?php
/**
 * @file grab.php
 * @brief Script récupérant l'APOD par l'API de la NASA.
 * Appel l'API de la NASA, récupère les données correspondantes en JSON, et les places dans un fichier approprié pour une utilisation ulterieure.
 * Puis, vérifie le type de média envoyer par l'API, et le stoque de manìere approprié. La pluspart du temps, c'est une image, et elle écrase le fichier image du jour.
 *
 * Ce script est appellé tout les jours par le serveur hébergeant le site.
 *
 * @author Thomas Hornung
 * @date 2025-13-03
 */
require_once('/home/hornung/www/protected/KEYS.php');
$jsonUrl = "https://api.nasa.gov/planetary/apod?api_key=".$NASA_KEY;
//$jsonUrl = "https://api.nasa.gov/planetary/apod?api_key=".$NASA_KEY.'&date=2025-02-05';
$jsonPath= '../ressources/nasa_file.JSON';
$json = file_get_contents($jsonUrl);
if ($json === false) {
    echo "Failed to fetch JSON.";
}
else{
    echo $json;
    file_put_contents($jsonPath, $json);
}

$data = json_decode($json, true);

if($data['media_type']){

}
$imageUrl = isset($data['url']) ? $data['url'] : false;
$imgPath = "../ressources/";

if($data['media_type']=="image"){
    echo "hey";
    $imgPath .= "image_du_jour.jpg";
    $image = file_get_contents($imageUrl);
    if ($image === false) {
        echo "Failed";
        print_r(error_get_last());
    }
    file_put_contents($imgPath, $image);
    echo "put content in";
}
elseif($data['media_type']=="video"){
    if (strpos($data['url'], '.mp4') !== false) {
        $video= file_get_contents($imageUrl);
        $videoPath .= "video_du_jour.mp4";
        if ($video === false) {
            echo "Failed";
            print_r(error_get_last());
        }
        file_put_contents($videoPath, $video);
    } 
}
else{
    echo "Catastrophe!";
}
    

    
?>