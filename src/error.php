<?php $title="Erreur"; ?>
<?php
$MadeDate = '14/04/2025';
$description = 'Page affichant l&apos;erreur rencontré par l&apos;utilisateur.';
$Error="None";
if(isset($_GET['error'])){
    $Error=$_GET['error'];
}
require "./include/header.inc.php";
?>

<main>
    <h1>Oups !</h1>
    <section>
        <p>Il semblerait qu'il y a eu une erreur lors de la connexion !</p>
        <p>Erreur : <?= $Error ?></p>
    </section>
</main>

<?php
require "./include/footer.inc.php";
?>
