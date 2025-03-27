<?php $title="Tech"; ?>
<?php
require "./include/header.inc.php";
?>

<?php
    $json=json_decode(file_get_contents('./ressources/nasa_file.JSON'),true);
    $media_type=$json['media_type'];
    $url= $json['url'] ?? false;
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
                //on pourra remplacer par un switchcase
                if(strpos($url, '.mp4') !== false){
                    echo ('<video class="nasa" controls>
                    <source src="' . $json['url'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>');
                }
                elseif(strpos($url,'youtube.com')){
                    echo ('<iframe width="560" height="315" src="'.$url.'" 
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>');
                        
                }
                else{

                }
                
            }
            else {
                echo "
                        <figure>
                            <img src=\"./ressources/default.jpg\" alt=\"image_du_jour\" class='nasa' \">
                            <figcaption>Pas d&apos;images aujourd&apos;hui !</figcaption>
                        </figure>
                    ";
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
    <section>
        <h2>TD 10 Exercice 5</h2>
        <?php
            require "./include/functions/main.inc.php";
            echo def_list_regions();
        ?>

    </section>


</main>

<?php
require "./include/footer.inc.php";
?>
