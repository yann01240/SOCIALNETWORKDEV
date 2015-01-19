SOCIALNETWORKDEV
=======================

Installation
------------

Application
-----------

Une fois le projet Dézipé, ouvrez le projet "SOCIALNETWORKDEV" sous Netbeans


Web Server Setup
----------------

### Apache Setup

Pour configurer apache, configurer un virtual host vers le dossier public/ du projet:

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
