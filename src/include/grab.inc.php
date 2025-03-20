<?php
    $imageUrl = "https://fastly.picsum.photos/id/88/600/400.jpg?hmac=XiB6m5M3RBq7_L0vHoWJN9GCEO_2V_UhQ2IYesftCbg";
    $path = "../ressources/image_du_jour.png"; 
    $image = file_get_contents($imageUrl);
    if ($image === false) {
        echo "Failed to download image.<br>";
        print_r(error_get_last());
    }
    file_put_contents($path, $image);

?>