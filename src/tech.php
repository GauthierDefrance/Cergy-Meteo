<?php
require "./include/header.inc.php";
?>

<?php
    $json=json_decode(file_get_contents('./ressources/nasa_file.JSON'),true);
    $media_type=$json['media_type']
?>

<main>
    <h1>Developpement et Technique</h1>
    <section>
        <h2 id="ImageOfTheDay">Image du Jour</h2>
        <?php
            if($media_type=="image"){
                echo("
                <figure>
                    <img src=\"./ressources/image_du_jour.jpg\" alt=\"image_du_jour\" class='nasa' \">
                    <figcaption>".$json['title']."</figcaption>
                </figure>");
            }
            elseif($media_type=="video"){
                echo ('<video class="nasa" controls>
                    <source src="' . $json['url'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>');
            }
        ?>

        <p><?php echo ("<figcaption class='texte'>".$json['explanation']."</figcaption>");?></p>
        <p>Source : <a href="https://api.nasa.gov/">Nasa</a></p>

    </section>

    <section>
        <h2>IP</h2>
        <?php
            require "./include/functions/UserIp.php";
            echo getUserLocalisation();
        ?>


    </section>


</main>

<?php
require "./include/footer.inc.php";
?>
