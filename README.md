Nagios add host function is an initiative to create the application to enable users to add hosts via web interface other than revise the configration file at the backend. 


Installing
----------

Your webserver (e.g. Apache) needs to have PHP support enabled!
Please make sure your PHP is version 5.2.0 and above (see phpinfo() php function)

On some distributions you might need to install mbstring for PHP - like Fedora / RedHat:
yum install php-mbstring

* Copy the nagios_addhost directory into your Apache web folder
   (/var/www/ on Debian/Ubuntu, or /var/www/html/ on RedHat/CentOS)

* Open the website of addhost (e.g. open Firefox - point to http://nagiosIPaddress/nagios_addhost/index.php)




Usage
----------
A user-friendly interface is provided to users for adding or revising hosts from the system, where the interface is shown as follows:

![](https://github.com/hailid88/nagios_addhost/blob/master/web%20interface%20look.png)


