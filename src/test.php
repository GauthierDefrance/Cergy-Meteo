<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Watch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #66c2ff, #003366);
            margin: 0;
            padding: 0;
            text-align: center;
            overflow-x: hidden;
        }
        .header {
            background: #33a6ff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }
        .header .buttons button {
            margin: 5px;
            padding: 5px 10px;
        }
        .sidebar {
            position: fixed;
            top: 100px;
            right: 10px;
            width: 220px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.2);
        }
        .nav-bar, .image-box {
            background: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }
        .image-box img {
            width: 100%;
            border-radius: 5px;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
            max-width: 100%;
            box-sizing: border-box;
        }
        .main-content {
            width: 60%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-sizing: border-box;
        }
        section {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }
        footer {
            background: #33a6ff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<main>
<div class="header">
    <div class="buttons">
        <button>ACCUEIL</button>
        <button>STATS</button>
        <button>IMAGES</button>
        <button>TO</button>
    </div>
    <h1>Cloud Watch</h1>
    <div class="buttons">
        <button>LANGAGE</button>
        <button>STYLE</button>
    </div>
</div>

<nav class="sidebar">
    <section class="nav-bar">
        <p>Navigation inter page</p>
    </section>
    <section class="image-box">
        <h3>Image aléatoire</h3>
        <img src="placeholder.png" alt="Image">
        <p>Texte de l'image</p>
    </section>
</nav>

<div class="container">
    <div class="main-content">
        <h2>Accueil</h2>
        <section>
            <h3>Projet</h3>
            <p>Le but de notre projet est de crée un système de recherche d'informations météo dans un endroit donné pour un utilisateur en France.
                Nous combinerons des données géographiques sur la France, obtenue à partir de plusieurs fichiers CSV trouvés sur Internet, avec une carte des régions de France, ainsi que
                des API renvoyant des informations météorologiques, pour crée un système de recherche permettant à un utilisteur de trouver la météo à l'endroit désiré.
                Dans la section ci-dessous, vous trouverez la première version du moteur de recherche météo. Pour l'instant, elle n'est pas fonctionelle.
            </p>
        </section>

        <section>
            <h3>Recherche</h3>
            <p>Zone de recherche...</p>
        </section>
    </div>
</div>
</main>

<footer>
    <p>Ce site vous est proposé par Thomas Hornung et Gauthier Defrance du groupe L2I-C à CY CERGY PARIS UNIVERSITÉ</p>
</footer>
</body>

</html>
