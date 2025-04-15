# 🌥️ CloudWatch — Par Thomas Hornung et Gauthier Defrance

*Réalisé dans le cadre d'un projet de développement web en L2 à l'université de CY université et encadré par Monsieur LeMaire.*

> CloudWatch est un site web interactif qui permet de consulter la météo de toutes les villes de France avec à une interface moderne et intuitive.
[Site accessible ici !](https://hornung.alwaysdata.net)

---

## 🗂️ Sommaire

- [📌 Présentation](#-présentation)
- [⚙️ Fonctionnalités](#-fonctionnalités)
- [🖥️ Utilisation](#-utilisation)
- [🛠️ Technologies utilisées](#-technologies-utilisées)
- [📧 URL utiles](#-url-utiles)

---

## 📌 Présentation

**CloudWatch** est un projet web développé pour afficher les données météorologique des villes françaises.

Il s'adresse aux utilisateurs souhaitant :
- Obtenir la météo actuelle et les prévisions sur une des 7 journées à venir.
- Connaître la météo à deux heures près dans une ville précise sur 7 jours.
- Consulter les villes les plus recherchées

---

## ⚙️ Fonctionnalités

- ✅ Recherche météo par région => département => ville
- ✅ Statistiques sur les recherches les plus fréquentes  
- ✅ Données en temps réel via API météo de OpenMeteo
- ✅ Historique local des recherches
- ✅ Anglais et Français disponible
- ✅ Style Light et Dark à sélectionner au choix

---

## 🖥️ Utilisation

### 🔎 Recherche Météo
> Afin d'obtenir la météo d'une ville précise il est nécéssaire de d'abord sélectioner votre ville sur la page d'accueil.
> Tout d'abord il vous faudra sélectionner votre région. Vous pouvez la sélectionner en cliquant sur la région de votre choix sur la carte.
> Sinon il est possible de la sélectionner en écrivant le nom de votre région dans la boîte de texte région.
> En cliquant deux fois sur votre boîte de texte vous ferez alors apparaître la liste des régions disponible.

![Image région](https://github.com/GauthierDefrance/Cergy-Meteo/blob/main/ressources/region_test.png)

> Une fois votre région sélectionné, vous pourrez alors sélectionner votre département. Vous n'aurez alors que à remplir la boîte de texte
> pour choisir votre département. Même chose pour votre ville.

![Image département](https://github.com/GauthierDefrance/Cergy-Meteo/blob/main/ressources/departement_test.png)

> Vous obtiendrez alors un résultat sous cette forme :

![Image recherche](https://github.com/GauthierDefrance/Cergy-Meteo/blob/main/ressources/search_test.png)

### 📊 Statistiques

> Sur la page de statistiques, différentes données sont accessibles.
> Tel que un graphe avec les pages les plus recherché.
> Mais également un graphe avec les villes les plus recherché.

### 🛰️ APOD

> Sur la page technique, il est possible de voir une image / vidéo chaque jour.
> Elle sera accompagné d'un texte. Ce contenu est actualisé toutes les 24h d'après les données APOD de la Nasa.

### 📬 IP
> Sur cette même page technique il est possible de voir votre IP et une approximation de votre position géographique.


---


## 🛠️ Technologies Utilisées

- [🌥️ OpenMeteo API](https://open-meteo.com/)
- [🗺️ GeoPlugin API](https://www.geoplugin.com/)


## 📧 Url utiles

- [Accueil](https://hornung.alwaysdata.net/)
- [Stats](https://hornung.alwaysdata.net/stats.php)
- [Tech](https://hornung.alwaysdata.net/tech.php)
- [Site Map](https://hornung.alwaysdata.net/site_map.php)

