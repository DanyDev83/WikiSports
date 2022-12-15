# Bienvenue sur WikiSports

## Installer le site en local
- Cloner le dépôt
```
git clone https://DanyMDS@bitbucket.org/neksooo/symfonyproject.git
```
- Créer une base de données
- Importer les données contenu dans le fichier ***dump.sql*** dans votre base de données nouvellement créée
- Créer un fichier ***.env.local*** à la racine du projet et configurer votre connexion à votre base de données en ajoutant la ligne
```
DATABASE_URL="mysql://user:mot_de_passe@127.0.0.1:3306/nom_base_de_donnees?serverVersion=mariadb-10.4.25&charset=utf8mb4"
```
- Activer l'extension ***intl*** dans ***php.ini***
- Installer les dépendances avec la commande
```
composer install
```
- Lancer le serveur symfony avec la commande
```
symfony server:start
```
- Accéder au site [localhost:8000](http://localhost:8000)
- Connectez-vous avec ces idenfiants / mot de passe:
    -- Utilisateur: chips22@gmail.com / azerty
    -- Administrateur: momodu56@gmail.com / azerty
    (vous pouvez bien entendu créer votre propre compte)

- Enjoy !!!

[Daniel](daniel) / [Logan](logan) / [Muriel](muriel)

[daniel]: https://github.com/DanyDev83
[logan]: https://bitbucket.org/neksooo
[muriel]: https://github.com/bibou56