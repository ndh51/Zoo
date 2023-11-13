# SAE 3-01 | Gestion d'un zoo
## Membres 
- VOIRET Gautier | login ```voir0012```  
- GARDIN Louis | login ```gard0025```  
- BOURGASSER Leo | login ```bour0341```  
- SCHNEIDER Arthur | login ```schn0025```  
- HALES Nadhir  | login ```hale0010```
## Projet
Dans le cadre de notre deuxième année d'études, le projet web d'un site de **gestion de zoo** consiste à allier le travail d'équipe et nos compétences en développement web. Nous utiliserons ```Symfony``` et tous les concepts de programmations en notre connaissance.
## Configurations
### Base de données  
### Scripts Composer  
```composer start``` démarre le serveur local, naviguable à partir de **http://127.0.0.1:8000/**  
```composer stop``` ferme le serveur local symfony en cours (utile si le cmd est fermé)  
<br>
```composer db``` lance la création totale de la base de données de zéro, ce script utilise :
- ```composer drop``` supprime la base de données zoo
- ```composer create``` créé la base de données zoo
- ```composer migrate``` application des migrations la base de données zoo 
- ```composer load``` charge les données factices la base de données zoo

