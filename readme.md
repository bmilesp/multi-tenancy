vhost file should look something like this (to accept wildcard subdomains):

<VirtualHost 127.0.0.1>
DocumentRoot "\var\www\site.com"
ServerName "site.com"
ServerAlias *.site.com
</VirtualHost>