<?php $title="Stats"; ?>
<?php
require "./include/header.inc.php";
require "./include/functions/stats.inc.php";
?>

<main>
    <h1>Stats</h1>
    <section>
        <h2>Page en Construction!</h2>
        <p>Cette page est actuellement en construction, veuillez revenir plus tard lorsqu'elle sera complète.</p>
        <img src="./ressources/enconstruction.jpg" alt="en_construction" />
        <p><?php most_searched_cities();?></p>
        <p><?php most_visited_pages(); ?></p>
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
