Nagios add host function is an initiative to create the application to enable users to add hosts via web interface other than revise the configration file at the backend. 


Installing
----------

Nagios Configuration
====================

Apache / Addhost setup
=====================
Your webserver (e.g. Apache) needs to have PHP support enabled!
Please make sure your PHP is version 5.2.0 and above :) (see phpinfo() php function)

On some distributions you might need to install mbstring for PHP - like Fedora / RedHat:
yum install php-mbstring

1) copy the nagios_addhost directory into your Apache web folder
   (/var/www/ on Debian/Ubuntu, or /var/www/html/ on RedHat/CentOS)

2) Open the website of addhost (e.g. open Firefox - point to http://nagiosIPaddress/nagios_addhost/index.php)

When not working as expected, send the source code of the website (Ctrl-U in Firefox) to hailid88@gmail.com for support :) 


