--
configure
--
enable "rewrite_module" in the httpd.conf 
"AllowOverride" on "all"

--
step
--
using gii:
Module Class: This represents the main name-spaced class name of the module, which will be set to app\api\v1\Module.

--
web app apache config:
--
/etc/apache2/sites-available/mds.mysite.com
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName www.mds.mysite.com
        ServerAlias mds.mysite.com

        DocumentRoot "/var/www/mds/www"

        <Directory /var/www/mds/www/>
                RewriteEngine on
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule . index.php
                Order allow,deny
                allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>


api apache config:
/etc/apache2/sites-available/mdsapi.mysite.com
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName mdsapi.mysite.com
        ServerAlias www.mdsapi.mysite.com

        DocumentRoot "/var/www/mds/api"

        <Directory /var/www/mds/api/>
                RewriteEngine on
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule . index.php
                Order allow,deny
                allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
--	
--
test
--
http://localhost/myschool/api/v1/pelajars

next page - http://localhost/myschool/api/v1/pelajars?page=2

return field tertentu - http://localhost/myschool/api/v1/pelajars?fields=id,nama_pelajar

'PUT,PATCH {id}' => 'update', - http://localhost/myschool/v1/pelajar/update/1
'DELETE {id}' => 'delete',
'GET,HEAD {id}' => 'view',
'POST' => 'create',
'GET,HEAD' => 'index',
'{id}' => 'options',
'' => 'options',