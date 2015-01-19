SOCIALNETWORKDEV
=======================

Installation
------------

Une fois le projet Dézipé, ouvrez le projet "SOCIALNETWORKDEV" sous Netbeans


Configuration Apache
--------------------

Pour configurer apache, ajouter un hôte virtuel vers le dossier public/ du projet:

    <VirtualHost *:80>
        ServerName SOCIALNETWORKDEV.localhost
        DocumentRoot /path/to/SOCIALNETWORKDEV/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/SOCIALNETWORKDEV/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

Configuration MySQL
-------------------

Pour configurer MySQL, executer le script SOCIALNETWORKDEV.sql

