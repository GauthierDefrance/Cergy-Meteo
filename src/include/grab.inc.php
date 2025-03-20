<?php
    require_once('../protected/KEYS.php');

    $jsonUrl = "https://api.nasa.gov/planetary/apod?api_key=".$NASA_KEY;
    $jsonPath= '../ressources/nasa_file.JSON';
    $json = file_get_contents($jsonUrl);
    if ($json === false) {
        echo "❌ Failed to fetch JSON.";
    }
    else{
        echo $json;
        file_put_contents($jsonPath, $json);
    }

    $data = json_decode($json, true);


    $imageUrl = $data['url'];
    $imgPath = "../ressources/image_du_jour.png"; 
    $image = file_get_contents($imageUrl);
    if ($image === false) {
        echo "Failed to download image.<br>";
        print_r(error_get_last());
    }
<<<<<<< Updated upstream
    file_put_contents($imgPath, $image);
    
=======
    file_put_contents($path, $image);
>>>>>>> Stashed changes
?>