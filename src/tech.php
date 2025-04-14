<?php $title="Tech"; ?>
<?php
$MadeDate = '14/04/2025';
$description = 'Page affichant l&apos;IP de l&apos;utilisateur et l&apos;image du jour APOD.';
require "./include/header.inc.php";
?>

<?php
    $json=json_decode(file_get_contents('./ressources/nasa_file.JSON'),true);
    $media_type=$json['media_type'];
    $url= $json['url'] ?? false;
?>

<div style="width: 100%;">
    <nav class="internal-nav">
        <ul>
            <li><a href="#Dev-Tech">Dev. &amp; Tech.</a></li>
            <li><a href="#ImageOfTheDay">APOD</a></li>
            <li><a href="#ip">IP</a></li>
            <li>Image aléatoire</li>
            <li><?php
                require_once "./include/functions/randomImage.php";
                echo getRandomImage();
                ?></li>
        </ul>
    </nav>
</div>

<main>
    <h1 id="Dev-Tech">Developpement et Technique</h1>
    <section>
        <h2 id="ImageOfTheDay">Image du Jour</h2>
        <?php
            if($media_type=="image"){
                echo("
                <figure>
                    <img src=\"./ressources/image_du_jour.jpg\" alt=\"image_du_jour\" class='nasa' />
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
                            <img src=\"./ressources/default.jpg\" alt=\"image_du_jour\" class='nasa' \" />
                            <figcaption>Pas d&apos;images aujourd&apos;hui !</figcaption>
                        </figure>
                    ";
            }
        ?>

        <?php echo ("<p lang='en' class='texte'>".$json['explanation']."</p>");?>
        <p>Source : <a href="https://api.nasa.gov/">Nasa</a></p>

    </section>

    <section>
        <h2 id="ip">IP</h2>
        <?php
            require "./include/functions/UserIp.php";
            echo getUserLocalisation();
        ?>

   </section>

</main>

<?php
require "./include/footer.inc.php";
?>
