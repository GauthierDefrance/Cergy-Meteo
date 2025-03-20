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
        <h2>Image du Jour</h2>
        <?php
            if($media_type=="image"){
                echo("
                <figure>
                    <img src=\"./ressources/image_du_jour.jpg\" alt=\"image_du_jour\" style=\"width:100%\">
                    <figcaption>".$json['title']."</figcaption>
                    
                    
                </figure>");
            }
            elseif($media_type=="video"){
                echo ('<video width="640" height="360" controls>
                    <source src="' . $json['url'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>');
            }
        ?>
        
            
    
        </figure>
        <p><?php echo ("<figcaption>".$json['explanation']."</figcaption>");?></p>
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
