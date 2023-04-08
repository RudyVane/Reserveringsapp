<?php
session_start();
 
$persoon = $_SESSION['gebruiker'];
$apparatuur = $_SESSION['apparaat'];
$datum = $_SESSION['datum'];
$terug = $_SESSION['terug'];

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

<link rel="stylesheet" href="stylessl.css">
<link rel='stylesheet' id='chld_thm_cfg_parent-css'  href='https://spinlink.nl/wp-content/themes/Divi/style.css?ver=5.2.2' type='text/css' media='all' /> 
<style>

.grid-container {
  display: grid;
  width:90%;
  grid-template-columns: 25% 25% 25% 25%;
  background-color: #88CFBE;
  padding: 1px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 1px;
  font-size: 1vw;
  text-align: center;
}

h9 {
	font-size:4vw;
	
}
p {
	font-size:1.5vw;
	
}
p1 {
	font-size:3vw;
	
}
input[type=submit] {
	font-size: 1.5vw;
}
input[type=checkbox] {
  width: 3vw;
  
  padding: 1px 1px;
  margin: 0 0;
  box-sizing: border-box;
}
.fixed {
  position:absolute;
  z-index:2;
  top:1%;
  left:1%;
  
}
#wrapper {
	position:absolute;
	z-index:1;
	top:8%; 
	bottom:10px; 
	left:1%;
	width:100%;
	overflow:auto;
	
	}
#scroll-content {
	top:8%;
	position:absolute;
	z-index:1;
	width:100%;
	padding:0;
	}
	
@media screen and (max-width: 600px) and (orientation: portrait){
	
.grid-container {
  display: grid;
  width:90%;
  grid-template-columns: 25% 25% 25% 25%;
  background-color: #88CFBE;
  padding: 1px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 1px;
  font-size: 3vw;
  text-align: center;
}

h9 {
	font-size:5vw;
	
}
p {
	font-size:3vw;
	
}
p1 {
	font-size:5vw;
	
}
input[type=submit] {
	font-size: 5vw;
}
input[type=checkbox] {
  width: 3vw;
  
  padding: 1px 1px;
  margin: 0 0;
  box-sizing: border-box;
}
.fixed {
  position:absolute;
  z-index:2;
  top:0;
  left:0;
  
}
#wrapper {
	position:absolute;
	z-index:1;
	top:50px; 
	bottom:10px; 
	left:5px;
	width:100%;
	overflow:auto;
	
	}
#scroll-content {
	position:absolute;
	z-index:1;
	width:100%;
	padding:0;
	}	
	
	
	
	
}	
</style>		

</head>
<body>
<div class = "container" style="position: absolute;top:3%;left: 2%; text-align:left;">
<h9>Reserveer apparatuur</h9><br><br>


<p>Gekozen apparatuur: -<?php 
$i = count($apparatuur);
foreach ($apparatuur as $id){
$sql2 = "SELECT * FROM apparatuur WHERE `Id` = $id";
$ret2 = $db->query($sql2);
   while($row2 = $ret2->fetchArray(SQLITE3_ASSOC) ){
	   $serie = $row2['Serienummer'];
echo $row2['Apparaatnaam'] . $serie . " - ";
		}
	}
?>
<p id="demo"></p>



      <form action = "" method ="POST">
      
<br><br>
	<p1>Lokatie gebruik</p1><br><p style="color:red"><input type="text" name="Lokatie" size="25" required />*</p><br>
	<p1>Project</p1><br><p style="color:red"><input type="text" name="Project" size="25" required />*<br><br>
  
<input type="submit" name="OK" value="Verzend reservering" />


</form>
<br><br>



<?php
if(isset($_POST['OK'])){
	$datum = $_SESSION['datum'];
	$terug = $_SESSION['terug'];
	$persoon = $_SESSION['gebruiker'];
	$lokatie = $_POST['Lokatie'];
	

	
$i = count($apparatuur);

for ($num = 0; $num <= $i; $num++) {
	$appnum = $apparatuur[$num];
$sql1 = "SELECT * FROM apparatuur WHERE `Id` = '$appnum'";
$ret1 = $db->query($sql1);
		while($row1 = $ret1->fetchArray(SQLITE3_ASSOC) ){
		$serienr = $row1['Serienummer'];
		$naam = $row1['Apparaatnaam'] . $serienr;
$sql6 ="SELECT * FROM reserveringsdata";
   $ret6 = $db->query($sql6);
   while($row6 = $ret6->fetchArray(SQLITE3_ASSOC) ){
      $a = $row6['Id'];
   }
$sql6=<<<EOF
UPDATE apparatuur SET Status = 'uit' WHERE Id = '$appnum';
EOF;
$ret6 = $db->exec($sql6);
   if(!$ret6) {
      echo $db->lastErrorMsg();
   }
   
   
$id = $a+1;  
$sql2 =<<<EOF
INSERT INTO reserveringsdata (`Id`,`Datum_uitleen`,`Terugbrengen`,`Persoon`,`Apparaat`,`Apparaatnaam`,`Lokatie_gebruik`,`Project_Id`,`Projectnaam`) 
VALUES ('$id','$datum','$terug','$persoon','$appnum','$naam','$lokatie','$pj','$project');
EOF;
$ret2 = $db->exec($sql2);
   if(!$ret2) {
      echo $db->lastErrorMsg();
   } else {
      
   }
	$sql3 = "SELECT * FROM toebehoren WHERE `Apparaat_Id` = '$appnum'";
$ret3 = $db->query($sql3);
		while($row3 = $ret3->fetchArray(SQLITE3_ASSOC) ){
        $textid = $row3['Id'];
        $textnm = $row3['Naam'];
$sql7 ="SELECT * FROM reserveringsdata";
   $ret7 = $db->query($sql7);
   while($row7 = $ret7->fetchArray(SQLITE3_ASSOC) ){
      $a = $row7['Id'];
   }
$id = $a+1;        
$sql4 =<<<EOF
INSERT INTO reserveringsdata (`Id`,`Datum_uitleen`,`Terugbrengen`,`Persoon`,`Toebehoren`,`Naam_toebehoren`,`Lokatie_gebruik`,`Project_Id`,`Projectnaam`) 
VALUES ('$id','$datum','$terug','$persoon','$textid','$textnm','$lokatie','$pj','$project');
EOF;
$ret4 = $db->exec($sql4);
   if(!$ret4) {
      echo $db->lastErrorMsg();
   } else {
      
				}
    
			}
		}
	}
echo "<script type='text/javascript'> document.location = 'Succes.php'; </script>";	
}
		
?>
</body>
</html>
