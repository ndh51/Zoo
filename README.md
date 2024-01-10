# SAE 3-01 | Gestion d'un zoo
## Membres 
- VOIRET Gautier | login ```voir0012```  
- GARDIN Louis | login ```gard0025```  
- BOURGASSER Leo | login ```bour0341```  
- SCHNEIDER Arthur | login ```schn0025```  
- HALES Nadhir  | login ```hale0010```
## Projet
Dans le cadre de notre deuxième année d'études, le projet web d'un site de **gestion de zoo** consiste à allier le travail d'équipe et nos compétences en développement web. Nous utiliserons ```Symfony``` et tous les concepts de programmations en notre connaissance.

## Installation
1. Récupérer les dépendances de composer
```bash
composer install 
```
2. Copier le .env en .env.local
```bash
cp .env .env.local 
```
3. Mettre en commentaire la ligne 29 
```
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```
4. Modifier la ligne 28
```
DATABASE_URL="mysql://{login}:{password}@{serverName}/{dbName}?serverVersion=10.2.25-MariaDB&charset=utf8mb4"
```

## Configurations
### Base de données  
MPD :
![MPD](MPD.png)

### Scripts Composer  
Démarrer le serveur local, naviguable à partir de **http://127.0.0.1:8000/**
```bash 
composer start
``` 
Fermer le serveur local symfony en cours (utile si le cmd est fermé)
```bash
composer stop
```  
<br>

Lancer la création totale de la base de données de zéro **(celle-ci prend en moyenne 4 minutes)**
```bash
composer db
```
Ce script utilise :
- Supprimer la base de données zoo 
```bash 
 composer drop
``` 
- Créer la base de données zoo 
```bash
composer create
```
- Application des migrations la base de données zoo
```bash 
composer migrate
```
- charge les données factices la base de données zoo
```bash
composer load
```

Lancer la suite de test PHPUnit
```bash
composer test
```