<?php
    $imageUrl = "https://upload.wikimedia.org/wikipedia/en/thumb/8/80/Wikipedia-logo-v2.svg/1024px-Wikipedia-logo-v2.svg.png";
    $path = "ressources/image_du_jour.png"; 
    $image = file_get_contents($imageUrl);
    file_put_contents($path, $image);

?>