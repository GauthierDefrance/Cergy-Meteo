<?php
/**
 * @file randomImage.php
 * @brief Fonctions en relation avec le retrait d'images aléatoires.
 *
 * Ces fonctions permettent de trouver des fichiers images dans un dossier et 
 * d'en choisir une aléatoirement à renvoyer.
 *
 * @author Gauthier Defrance
 * @date 2025-20-03
 */

/**
 * Constante tableau associatif servant UNIQUEMENT à obtenir une description de certaines images. Ne fournit
 * pas un chemin aux fonctions récupérant ces images.
 */
const IMAGES = [
    "bleu_ciel.webp" => "bleu ciel",
    "ciel-etoile.webp" => "ciel etoile",
    "ile.webp" => "jolies îles",
    "monet.webp" => "tableau de monet",
    "peinture_ciel.webp" => "peinture du ciel"
];

function getFichiersInDirectory($répertoire) {
    if (is_dir($répertoire)) {
        $contenu = scandir($répertoire);

        $fichiers = array_filter($contenu, function($fichier) use ($répertoire) {
            return is_file($répertoire . DIRECTORY_SEPARATOR . $fichier);
        });
        $fichiers = array_values($fichiers);

        return $fichiers;
    } else {
        echo "Le répertoire $répertoire n'existe pas.";
        return [];
    }
}

function getRandomImagePath() : string {
    $path = "./ressources/Galery";
    $dir = getFichiersInDirectory($path);
    $random = random_int(0, sizeof($dir)-1);
    return $dir[$random];
}

function getRandomImage() : string {
    $path = "./ressources/Galery";
    $IMAGE_NAME = getRandomImagePath();
    $IMAGE_CAPTION = "Aucune caption détécté.";
    if(isset(IMAGES[$IMAGE_NAME])){
        $IMAGE_CAPTION=IMAGES[$IMAGE_NAME];
    }

    return "<figure>
                <img class='galery' src='".$path."/".$IMAGE_NAME."'/>
                <figcaption><p>$IMAGE_CAPTION</p></figcaption>
        </figure>";
}

?>
