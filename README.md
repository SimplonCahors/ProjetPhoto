Installation et initialisation du projet en local
================================================
-Se placer dans le dossier parent de celui cloné sur le terminal et rentrer la ligne de commande suivante:
(composer create-project themosis/themosis ProjetPhoto)

-composer a donc creer un dossier dans lequel se trouve un projet wordpress/themosis vide.

-deplacer le contenu du projet cloné a l'intérieur de celui créé par composer.(fusionner et remplacer pour chaque fichier)

-Maintenant il faut créer une base de donnée  vide sur PHPmyadmin afin d'y importer la base de donnée du site, celle -ci est présente dans le dossier database

-Modifier le fichier .env et rentrer vos identifiants de PHPmyadmin ainsi que le nom de la base de données créée précédemment.

-Enfin, créer votre VIRTUAL HOST, puis dans le dossier config, modifier le fichier environnement.php afin d'y rentrer l'url choisi lors de la création du VIRTUAL HOST



















Themosis framework
==================

[![Build Status](https://travis-ci.org/themosis/themosis.svg?branch=dev)](https://travis-ci.org/themosis/themosis)

The Themosis framework is a tool aimed to WordPress developers of any levels. But the better WordPress and PHP knowledge you have the easier it is to work with.

Themosis framework is a tool to help you develop websites and web applications faster using [WordPress](https://wordpress.org). Using an elegant and simple code syntax, Themosis framework helps you structure and organize your code and allows you to better manage and scale your WordPress websites and applications.

Development team
----------------
The framework was created by [Julien Lambé](http://www.themosis.com/), who continues to lead the development.

Contributing
------------
Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/themosis)
- Following us on Twitter: [@Themosis](https://twitter.com/Themosis)
- Sharing the project around your community

For details about contributing to the framework, please check the [contribution guide](http://framework.themosis.com/docs/1.3/contributing).

License
-------
The Themosis framework is open-source software licensed under [GPL-2+ license](http://www.gnu.org/licenses/gpl-2.0.html).