<?php
session_start();
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
	font-size:5vw;
	
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
	top:5%;
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
	font-size:4vw;
	
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
<h9>Registratie inleveren</h9><br>
<form action = "" method ="POST"><br>
<p1>Wie levert in?</p1><br><br><p>
<?php 
$sql = "SELECT DISTINCT `Persoon` FROM reserveringsdata WHERE `Ingeleverd` = 'Nee' ORDER BY `Id`";
$ret = $db->query($sql);
$pers = array();
$respers = array();
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){

?>
<input type="radio" name="radio" value="<?php echo $row['Persoon']?>"<label><?php echo $row['Persoon']?></label><br/>
<?php
}
?>	
   
  <br>
<input type="submit" name="OK" value="Verzenden" />
<br>
</form>
<?php
if(isset($_POST['OK'])){
	
	$naam = $_POST["radio"];
	$_SESSION['naam'] = $naam;

$sql = "SELECT * FROM reserveringsdata WHERE `Persoon` = '$naam' AND `Ingeleverd` = 'Nee' AND `Datum` IS NOT NULL ORDER BY `Datum_uitleen`";

$ret = $db->query($sql);
		$id = array();
		$datuit = array();
		$terug = array();
		$pers = array();
		$appid = array();
		$appnm = array();
		$toebid = array();
		$toebnm = array();
		$lok = array();
		$pjid = array();
		$pjnm = array();
		$resid = array();
		$resdat = array();
		$resterug = array();
		$respers = array();
		$resappid = array();
		$resappnm = array();
		$restoebid = array();
		$restoebnm = array();
		$reslok = array();
		$respjid = array();
		$respjnm = array();
		
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
		
		$id = htmlspecialchars($row['Id']);
		$datuit = htmlspecialchars($row['Datum_uitleen']);	
		$terug = htmlspecialchars($row['Terugbrengen']);						
		$pers = htmlspecialchars($row['Persoon']);
		$appid = htmlspecialchars($row['Apparaat']);				
		$appnm = htmlspecialchars($row['Apparaatnaam']);					
		$toebid = htmlspecialchars($row['Toebehoren']);
		$toebnm = htmlspecialchars($row['Naam_toebehoren']);
		$lok = htmlspecialchars($row['Lokatie_gebruik']);			
		$pjid = htmlspecialchars($row['Project_Id']);					
		$pjnm = htmlspecialchars($row['Projectnaam']);
		
		array_push($resid, $id);
		array_push($resdat, $datuit);
		array_push($resterug, $terug);
		array_push($respers, $pers);
		array_push($resappid, $appid);
		array_push($resappnm, $appnm);
		array_push($restoebid, $toebid);
		array_push($restoebnm, $toebnm);
		array_push($reslok, $lok);
		array_push($respjid, $pjid);
		array_push($respjnm, $pjnm);
		}
    
if ($resid != null OR $_SESSION['uitleen'] == "OK"){
$i = 0;
?>
<form action = "" method ="POST"><br>
<p1>
	Welke objecten zijn ingeleverd?</p1><br><br><p>
	<?php

foreach($resid as $ids){

?>
<input type="checkbox" name="check_list[]" checked value="<?php echo $resid[$i]?>"<label><?php echo $resdat[$i] . "- " . $resappnm[$i] . $restoebnm[$i]?></label><br/>
<?php
$i++;
}
}

?>

<br><br>	

<br><br>
	
<input type="submit" name="submit" value="Bevestigen"/>

</form>
<br><br>

<?php
}
if(isset($_POST['submit'])){
	$naam = $_SESSION['naam'];
	$datin = date("Y-n-j");
	$tijdin = date("H:i");
	
	
	$naam1=strtoupper($naam);
	$response = array();
  				 
if(!empty($_POST['check_list'])){

foreach($_POST['check_list'] as $selected){
	$tel = 0;
	$idres = $selected;
		
	$sql3 = "UPDATE reserveringsdata SET Datum_inleveren = '$datin', Tijd_inleveren = '$tijdin', Ingeleverd = 'Ja', Uitleenaantal = '$tel' WHERE Id = '$idres'";
	$ret3 = $db->exec($sql3);
   if(!$ret3) {
      echo $db->lastErrorMsg();
   } else {
      
   }

	
   }
	


}
echo "<script type='text/javascript'> document.location = 'Bedankt.php';</script>";
}




?>
<br>


</body>
</html>