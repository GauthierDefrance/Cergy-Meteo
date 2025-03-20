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
    }
    elseif($data['media_type']=="video"){

    }
    else{
        echo "Catastrophe!";
    }
    

    
?>