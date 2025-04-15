<footer id="PageFooter">

        <?php
        if ($lang=="fr") {
            echo "<p>Ce site vous est proposé par <strong>Thomas Hornung</strong> et <strong>Gauthier Defrance</strong> du groupe L2I-C à CY CERGY PARIS UNIVERSITÉ</p>
        <p>Cette page a été affiché <?= $currentHits ?> fois.</p>";
        } else {
            echo "<p>This website is brought to you by <strong>Thomas Hornung</strong> and <strong>Gauthier Defrance</strong> from the L2I-C group at CY CERGY PARIS UNIVERSITY.</p>
        <p>This page has been viewed <?= $currentHits ?> times.</p>";
        }
        ?>
    <hr />

    <nav class="navigation">
        <div class="container">
            <!-- Bloc gauche : GitHub et Carte -->
            <ul class="left-block">
                <li class="box">
                    <a href="https://www.cyu.fr/">
                        <div class="logo-fac">
                            <?php
                                if(mode()=="light") {
                                    echo "<img src='./ressources/CY_black.png' alt='Erreur du chargement du logo CY' />";
                                } else {
                                    echo "<img  src='./ressources/CY_white.png' alt='Erreur du chargement du logo CY' />";
                                }
                            ?>
                        </div>
                    </a>

                </li>

                <li class="box">
                    <a href="https://github.com/GauthierDefrance/Cergy-Meteo">
                        <div class="nav-menu-button">
                            <i class="fa-brands fa-github fa-2xl"></i>
                            <span>GitHub</span>
                        </div>
                    </a>
                </li>
            </ul>

            <!-- Bloc droit : Tech -->
            <ul class="right-block">
                <li class="box">
                    <a href="./site_map.php">
                        <div class="nav-menu-button">
                            <i class="fa-solid fa-map-location-dot fa-2xl"></i>
                            <span><?php if(lang=="fr"){ echo "Carte";} else {echo "Map";}?></span>
                        </div>
                    </a>
                </li>
                <li class="box">
                    <a href="./tech.php">
                        <div class="nav-menu-button">
                            <i class="fa-solid fa-wrench fa-2xl"></i>
                            <span>Tech</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <hr />

    <a href="#"><?php if(lang=="fr"){ echo "Haut de page";} else {echo "Start of the page";}?></a>


</footer>



</body>




</html>