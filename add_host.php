<html>
<body>
<?php
include("index.php");
#echo "<h2>Your Input:</h2>";
#echo $host_name;
#echo "<br>";
#echo $direct;
#        hostgroups              $hostgroup
#        icon_image              $icon_image
#        icon_image_alt          $icon_image_alt
#        statusmap_image         $statusmap_image


#echo "Your input has successfully transferred!";

echo "Your input has been ";

if(strcmp(trim($addRevise),"add")==0){
   echo "Added";
}
if(strcmp(trim($addRevise),"revise")==0){
   echo "Revised";
   #need to go through all the confirmation file and find the right one and to revise it. 
}




$input = "define host{
        use                     linux-box
        host_name               $host_name
        notes              	latlng: $latitude,$longitude
        alias                 	$indirectIP
        address                 $directIP
        contact_groups          admins". "
        check_command           $check_command_host
        parents                 $parent
}

define service{
        use                             generic-service
        host_name                       $host_name
        service_description             PING
        check_command                   $check_command_service
}
";

echo "<pre>$input<pre>";


$myfile = fopen("/usr/local/nagios/etc/hosts/new_host.cfg", "a") or die("Unable to open file!");
$txt = "\n" . $input; 
fwrite($myfile, $txt);
fclose($myfile);

# firstly write to the local file
$myfile = fopen("/tmp/new_host/new_remote_host.cfg", "w") or die("Unable to open file!");
$txt = $host_name;
fwrite($myfile, $txt);
fclose($myfile);

# transfer to the remote file
$local_file = '/tmp/new_host/new_remote_host.cfg';
$remote_host = 'root@remotehost_IP:';                                #change the remotehost ip address to the IP address of server, through which we ping other hosts that cannot be directly connected. 
$remote_file = '/tmp/test.cfg';
$transfer_command = 'rsync -avh -e "ssh -i /var/www/.ssh/id_rsa" ' . $local_file . ' ' . $remote_host . $remote_file;         #transfer the contents from local host to remote host. public key, private key are generated from puttygen.
echo "<pre>$transfer_command</pre>";
$output = exec($transfer_command);
echo "<pre>$output</pre>";

$local_command = "ssh root@localhost_IP service nagios restart";        #change the local_IP address to your monitoring server.    #Restart Nagios to make the changes be effective.        
$output= exec($local_command);
echo "<pre>$output</pre>";
?>
Succeed!
</body>
</html>
