<?php $title="Weather Forecast"; 
$region= isset($_GET['region']) ? $_GET['region']:'inconnue';
if(isset($_GET['ville'])){
    $mode='vil';
}
elseif(isset($_GET['departement'])){
    $mode='dep';
}
else{
    $mode='reg';
}


?>
<?php
require "./include/header.inc.php";
?>

<main>
    <h1>Weather Forecast</h1>
    
    <?php //place this in a function?
    switch($mode){
        case 'vil':
            echo '
            <section>
                <h2>Votre météo pour la ville ' . $_GET['ville'] . ' en PHP!</h2>
                <p>Cette page est temporaire, elle sert d\'option simplifiée de recherche météo, utilisant uniquement PHP, des datalists et des chargements de pages.</p>
                <img src="./ressources/enconstruction.jpg" alt="en_construction" />
            </section>
            ';
            break;
        case 'dep':
            echo '
            <section>
                <h2>Votre météo pour le département ' . $_GET['departement'] . ' en PHP!</h2>
                <p>Cette page est temporaire, elle sert d\'option simplifiée de recherche météo, utilisant uniquement PHP, des datalists et des chargements de pages.</p>
                <img src="./ressources/enconstruction.jpg" alt="en_construction" />
            </section>
            ';
            break;
        case 'reg': //can be made default
            echo '
            <section>
                <h2>Votre météo pour nnnnjee' . $region . ' en PHP!</h2>
                <p>Cette page est temporaire, elle sert d\'option simplifiée de recherche météo, utilisant uniquement PHP, des datalists et des chargements de pages.</p>
                <img src="./ressources/enconstruction.jpg" alt="en_construction" />
            </section>
            ';
            break;
        default:
            echo '
            <section>
                <h2>Votre météo pour la région ' . $region . ' en PHP!</h2>
                <p>Cette page est temporaire, elle sert d\'option simplifiée de recherche météo, utilisant uniquement PHP, des datalists et des chargements de pages.</p>
                <img src="./ressources/enconstruction.jpg" alt="en_construction" />
            </section>
            ';
            break;


    } 
    
    
    
    
    ?>
    <section>
        <h2>Votre météo pour la région <?=$region?> en PHP!</h2>
        <p>Cette page est temporaire, elle sert d'option simplifié de recherche météo, utilisant uniquement PHP, des datalists et des chargements de pages.</p>
        <img src="./ressources/enconstruction.jpg" alt="en_construction" />
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
