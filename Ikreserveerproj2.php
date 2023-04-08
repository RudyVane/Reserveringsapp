<?php
session_start();
$user = $_SESSION['gebruiker'];
  
$persoon = $_SESSION['gebruiker'];
$project = $_SESSION['project'];
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
  font-size: 2.5vw;
  text-align: center;
}

h9 {
	font-size:4vw;
	
}
p {
	font-size:2vw;
	
}
p1 {
	font-size:4vw;
	
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
  top:50px;
  left:20%;
  
}
#wrapper {
	position:absolute;
	z-index:1;
	top:50px; 
	bottom:10px; 
	left:0;
	width:100%;
	overflow:auto;
	
	}
#scroll-content {
	position:absolute;
	z-index:1;
	width:100%;
	padding:0;
	}
</style>	
</style>	

</head>
<body>
<br><br>
<form action = "" method ="POST"><br>
<div class = "fixed">
<p1>Project reserveren</p1><br><br>
<p>Naam:<?php echo "  " . $persoon;?><br>
Project:<?php echo "  " . $project;?><br><br>

<br><p style = "font-size:2.5vw">Welke apparatuur van dit project heb je nodig?</p1><br><br>
<div class="grid-container">

<?php

$sql = "SELECT * FROM $project";
$ret = $db->query($sql);
   		$apparatuur = array();
		$app = array();
		while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
			$app = $row["Apparaat_id"];
			array_push($apparatuur, $app);
}
	

$z = count($apparatuur);
$responseid = array();
		$responsenm = array();
		$responsesn = array();
		$responseon = array();
		$responseim = array();
		$textid = array();
		$textnm = array();
		$texton = array();
		$type = array();
		$textsn = array();
		$texttp = array();
		$textim = array();
for ($num = 0; $num <= $z; $num++) {
	$appnum = $apparatuur[$num];
$sql = "SELECT * FROM apparatuur WHERE `Id` = '$appnum'";
$ret = $db->query($sql);
		while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        // temp user array
        
        $textid = $row["Id"];
		$textnm = $row["Apparaatnaam"];
		$textsn = $row["Serienummer"];
		$texttp = $row["Type"];
		$texton = $row["Onderhoud"];
		$textim = $row["Thumbnail"];
 
        array_push($responseid, $textid);
		array_push($responsenm, $textnm);
		array_push($responsesn, $textsn);
		array_push($responseon, $texton);
		array_push($responseim, $textim);
		array_push($type, $texttp);
		}
    }


$i = 0;
foreach($responseid as $id){
$letop = "";
$foto = $responseim["$i"];
if ($responseon[$i] == "nodig"){
	$letop = "Apparaat is nog niet reserveerbaar i.v.m. onderhoud!";
}
$vandaag = strtotime(date("Y-m-d"));
$sql3= "SELECT * FROM reserveringsdata WHERE `Apparaat` = $id";
$res = 0;
$ret3 = $db->query($sql3);
   while($row = $ret3->fetchArray(SQLITE3_ASSOC) ){
			$text1 = array();
			$text2 = array();
			$text3 = array();
			$text5 = array();
			$response2 = array();
			$text1 = $row["Datum_uitleen"];
			$text2 = $row["Terugbrengen"];
	}
	

?>
<div class="grid-item">
<table>
<tr>
<td rowspan="4">
<img src="images/thumbnails/<?php echo $foto ?>" width='100' height='100' ></td>
<td><?php echo $responsenm[$i]?></td></tr>
<td><?php echo $responsesn[$i]?></td></tr>
<td><?php echo $type[$i]?></td></tr>
<td><input type="checkbox" name="check_list[]" value="<?php echo $responseid[$i]?>" checked ><label>reserveer</label></td></tr>
</table>
</div>

<?php

$i++;
}
?>
</div><br>
<input type="submit" name="submit" style = "font-size:20px;	border: 1px solid #88CFBE; " value="Verzend reservering" />
</form>
<br><br>
<?php
if(isset($_POST['submit'])){//to run PHP script on submit
$apparatuur1 = array();
if(!empty($_POST['check_list'])){

foreach($_POST['check_list'] as $selected){
	$appid = $selected;
	
	array_push($apparatuur1, $appid);
	
}
$_SESSION['apparaat'] = $apparatuur1;
$_SESSION['gebruiker'] = $persoon;
$_SESSION['datum'] = $datum;
$_SESSION['terug'] = $terug;
$db->close();
echo "<script type='text/javascript'> document.location = 'Ikreserveer_app.php'; </script>";

}
}
	
?>


</body>
</html>