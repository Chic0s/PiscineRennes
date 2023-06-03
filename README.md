
# Piscines Rennes

## Contexte 

Nous devons réaliser un site internet pour regrouper les différentes piscines de Rennes. En effet, l'objectif est que les clients puissent accéder au site internet pour acheter des billets et réserver dans la Piscine de leur choix. 


## Fonctionnalités

### Comment Démarrer ? 

Rien de plus simple ! Vous pouvez tester le site en live : https://jury:examinateur@denispierre.fr/Piscine

Cependant, il est possible de l'utiliser en local en suivant le guide d'installation. 

Vous pouvez dès à présent acheter des billets et réserver un créneau. 
Pour accéder à la partie "Admin", une redirection ![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/6c9db4b1-8ef9-48cf-aa70-3f68c0293fd1)
 à été mise en place en bas à gauche de la page Accueil. (identifiant=local:password=local)

- Acheter des billets

- Réserver des créneaux

- Vérifier le(s) billet(s)

Page Admin : 

- Création de créneau

- Ajout de bassin 

- Ajout de Piscine 

- Visuel sur les Ventes,  réservations et codes. 


## Installation

### Les logiciels 

![alt text](https://cdn.freebiesupply.com/logos/thumbs/2x/visual-studio-code-logo.png) 

- IDE - Visual Studio Code : https://code.visualstudio.com/download

![alt text](https://upload.wikimedia.org/wikipedia/commons/f/f8/WampServer-logo.png) 

- WampServer : https://www.wampserver.com/

## Mise en place

### Installation de WampServer

Il est important d'utiliser une version 8.2.0 de PHP pour profiter de toutes les fonctionnalités. 
![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/64a36969-b77e-44e9-b937-9345b63f1ecf)

### Installation de la base de données - PhpMyAdmin

Pour installer la base de données, il faut utiliser le fichier " SaveData.sql " présent dans le répo.

Nous allons faire un clic droit sur le tray icon de WampServer (Il faut avoir lancer WampServer au préalable et s'assurer que TOUT les services soient lancées). 

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/48eb1714-ef0c-4763-9719-60c2b3234524)

Puis nous nous dirigons vers le localhost. Votre navigateur va s'ouvrir avec l'url suivante :![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/af854483-0074-432b-8e34-595c7889bc17)

Nous allons cliquer sur PhpMyAdmin : 

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/d0ee6a19-acb9-4c4c-b0d1-93f36a6fd3b2)

Le nom d'utilisateur par défaut est root, il n'y a pas de mot de passe. 

Nous allons créer une nouvelle base de données et l'appeler "SaveData" :

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/79cb6b25-59f8-4360-a080-ea2aeb0244ec)

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/77e5515b-6312-43e4-a673-a5269396c73c)

Nous allons importer le fichier "SaveData.sql" de notre répositories dans notre nouvelle base de données. 

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/5c0109eb-44e9-4513-b217-03e842b0542c)

### Installation des fichiers Piscine 

Nous allons déplacer le dossier "Piscine" contenant les fichiers sources comme le index.php et le .htaccess dans le dossier " www " du serveur wamp. (Exemple : "C:\wamp64\www " - le chemin diffère en fonction de votre installation)
![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/1ee8f41b-7339-4bd8-9f33-ecc9878c4177)
 

L'installation est terminée ! Il est possible d'accéder au site depuis l'url suivante : localhost/Piscine 

![image](https://github.com/Chic0s/PiscineRennes/assets/96829109/8690ae61-9324-4ab0-82b8-eb1d4cac75dc)

## Diagramme

### Diagramme de classes
![image](https://user-images.githubusercontent.com/96829109/239767094-4681846f-f7f3-4795-8d7a-122ee8568ceb.png)

### Diagramme de cas d'utilisation
![image](https://user-images.githubusercontent.com/96829109/239767113-478e7ccb-1e14-4ee8-8f83-fb3194bdb08b.png)


