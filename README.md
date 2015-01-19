SOCIALNETWORKDEV
=======================

Installation
------------

Web Server Setup
----------------

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

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
