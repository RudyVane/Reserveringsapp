<?php
session_start();
$_SESSION["admin"]="";
$_SESSION['gebruiker']="";
$naam = "";
class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('Reserveringssl.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      
   }
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>

<link rel='stylesheet' id='chld_thm_cfg_parent-css'  href='https://spinlink.nl/wp-content/themes/Divi/style.css?ver=5.2.2' type='text/css' media='all' />
<link rel="stylesheet" href="css/styledate.css">
<style>

h9 {
	font-size:4vw;
}
p {
	font-size:3vw;
}

</style>

</head>

<body>


<div class = "container" style="position: absolute;top:1%;left: 20%;text-align:left;">

<br><br>
<h9>Succes met je project!</h9><br><br>
<p>Vergeet niet te registreren wanneer je de apparatuur meeneemt of weer terugbrengt!</p>
<a href="Ikneemmee.php">Registreer meenemen</a><br><br>
<a href="Ikleverin.php">Registreer inleveren</a>
</body>
</html>