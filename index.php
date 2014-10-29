<!DOCTYPE HTML> 
<html>
<!--<head>-->
<script>
function hideIndirectIP(){
 if(document.getElementById("radio_direct").checked){
 document.getElementById("indirectField").disabled = true;
 document.getElementById("directField").value="";
}
 if(document.getElementById("radio_indirect").checked){
 document.getElementById("indirectField").disabled =false;
 document.getElementById("directField").value = "***.***.*** remoteHostIP";               //replace remoteHostIP to the address of the host that can ping through the indirect hosts. 
} 
}
</script>
<style>
.error {color: #FF0000;}
</style>
<!--</head>-->
<body> 

<?php
// define variables and set to empty values
$nameErr = $directErr = $directIPErr = $indirectIPErr = $latitudeErr = $longitudeErr = $parentErr = $hostgroupErr = "";
$host_name = $direct = $directIP = $indirectIP = $latitude = $longitude = $parent = $hostgroup = $check_command_host= $check_command_service= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["host_name"])) {
     $nameErr = "host_name is required";
   } else {
     $host_name = test_input($_POST["host_name"]);
   }
   
   if (empty($_POST["direct"])) {
     $directErr = "check style is required";
   } else {
     $direct = test_input($_POST["direct"]);
   }
   
    
   
   if (empty($_POST["directIP"])) {
     $directIPErr = "direct IP address is required";
   } else {
     $directIP = test_input($_POST["directIP"]);
     if (!preg_match('/(\d+).(\d+).(\d+).(\d+)/', $directIP)) {
       $directIPErr = "Invalid IP address"; 
     }
     $temp = str_replace(".", "_", $directIP);
     
     $check_command_host = "check_nrpe!check_".$temp."_alive";
     $check_command_service = "check_nrpe!check_".$temp."_ping";
   }

   if (empty($_POST["indirectIP"])) {
     $indirectIP = "";
   } else {
     $indirectIP = test_input($_POST["indirectIP"]);
     $temp = str_replace(".", "_", $indirectIP); 
     $check_command_host = "check_nrpe!check_".$temp."_alive";
     $check_command_service = "check_nrpe!check_".$temp."_ping";
   }
   
   $addRevise = test_input($_POST["addRevise"]); 
   $latitude = test_input($_POST["latitude"]);
   $longitude = test_input($_POST["longitude"]);
   $parent = test_input($_POST["parent"]);
   $hostgroup = test_input($_POST["hostgroup"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Add or Reivse Hosts and Services</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="add_host.php">
   <input id="radio_add" type="radio" name="addRevise" value="add">Add host
   <input id="radio_indirect" type="radio" name="addRevise" value="revise">Revise host
   <br><br> 
   Host Name: <input type="text" name="host_name" value="<?php echo $host_name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Check Style:
   <input id="radio_direct" type="radio" name="direct" onclick="hideIndirectIP()" value="direct">Direct
   <input id="radio_indirect" type="radio" name="direct" onclick="hideIndirectIP()" value="indirect">Indirect
   <span class="error">* <?php echo $directErr;?></span>
 <br><br> <font color="green"> Direct means the host can be directly pinged, while indirect means it needs an extra host to go through (the extra host is a direct host, and the target host is an indirect host)</font>
   <br><br>
   Direct Host IP Address: <input id="directField" type="text" name="directIP" value="<?php echo $directIP;?>">
   <span class="error">* <?php echo $directIPErr;?></span>
   <br><br>
   Indirect Host IP Address:<input id="indirectField" type="text" name="indirectIP" value="<?php echo $indirectIP;?>">
   <span class="error">* <?php echo $indirectIPErr;?></span>
   <br><br>
   Latitude: <input type="text" name="latitude" value="<?php echo $latitude;?>">
   <span class="error">* <?php echo $latitudeErr;?></span>
   <br><br>
   Longitude: <input type="text" name="longitude" value="<?php echo $longitude;?>">
   <span class="error">* <?php echo $longitudeErr;?></span>
   <br><br>
   Parent: <input type="text" name="parent" value="<?php echo $parent;?>">
   <span class="error"><?php echo $parentErr;?></span>
   <br><br>
  <!-- Host Group: <input type="text" name="hostgroup" value="hostgroup">
   <span class="error">i<?php echo $hostgroupErr;?></span>
   <br><br>i
-->
<!--   Contact Group: <select id="cmbContact" name="contact" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
     <option value="0">admins</option>
     <option value="1">dhl</option>
     <option value="2">Toyota</option>
     <option value="3">Nissan</option>
</select> 
   <br><br> -->
   <input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>
