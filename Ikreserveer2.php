<?php
session_start();
$persoon = $_SESSION['gebruiker'];	
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
	font-size:1.5vw;
	
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
<form action = "" method ="POST"><br>
<div class = "fixed">
<p1>Welke apparatuur wil je reserveren?</p1><br><p>

<input type="submit" name="OK" style = "border: 1px solid #88CFBE; " value="Verzend reservering" /><br>
</div>
<div id="wrapper">
        <div id="scroll-content">


<div class="grid-container">  

	<?php
		
$sql = "SELECT * FROM apparatuur";
$ret = $db->query($sql);
   
		$responseid = array();
		$responsenm = array();
		$responsesn = array();
		$responsest = array();
		$responseon = array();
		$responseim = array();
		$responseun = array();
		$textid = array();
		$textnm = array();
		$texton = array();
		$type = array();
		$nivo = array();
		$avp = array();
		$textsn = array();
		$textst = array();
		$texttp = array();
		$textim = array();
		$textun = array();
		$textav = array();
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        // temp user array
        $go = "";
        $textid = $row["Id"];
		$textnm = $row["Apparaatnaam"];
		$textsn = $row["Serienummer"];
		$texttp = $row["Type"];
		$textst = $row["Status"];
		$texton = $row["Onderhoud"];
		$textim = $row["Thumbnail"];
		$textun = $row["Uitleenniveau"];
		$textav = $row["Audio/Video/Props"];
		
        array_push($responseid, $textid);
		array_push($responsenm, $textnm);
		array_push($responsesn, $textsn);
		array_push($responsest, $textst);
		array_push($responseon, $texton);
		array_push($responseim, $textim);
		array_push($type, $texttp);
		//}
	
//$i=0;  
//foreach($responseid as $id){
	$foto = $textim;
	//$res = 0;

$vandaag = date("Y-m-d");
$sql3= "SELECT * FROM reserveringsdata WHERE Apparaat = '$textid'";
$uit = "";
$t1 = "";
$ret3 = $db->query($sql3);
   while($row = $ret3->fetchArray(SQLITE3_ASSOC) ){
			$text1 = "";
			$text2 = "";
			$text3 = "";
			$datuit = "";
			$response2 = array();
			$text1 = $row["Datum_uitleen"];
			$text2 = $row["Terugbrengen"];
			$text3 = $row["Datum_inleveren"];
			$datuit = strtotime($text1);
			$datter = strtotime($text2);
			$vand = strtotime($vandaag);
			$ter = strtotime($terug);
			$datu = strtotime($datum);
			
			if($datuit >= $vand){
				$t1 = "Gereserveerd van: ";
				$uit = $uit . $text1 . " t/m " . $text2 . "<br>";
				}
			
	}

	
//if($res == 0) {
?>
<div class="grid-item">
<img src="images/thumbnails/<?php echo $foto ?>" width='100' height='100' >
<input type="checkbox" name="check_list[]" value="<?php echo $textid?>"><br>
<?php echo $textnm . "-" . $textsn?><br>
<?php echo $texttp;?><br>
<?php
echo $t1 . $uit;
//}
?>

</div>

<?php
}
$i++;
//}

?>
</div></div>
</div>
</form> 
<br><br>

<?php
	
if(isset($_POST['OK'])){
if(!empty($_POST['check_list'])){
$apparaat = array();
foreach($_POST['check_list'] as $selected){
	$appid = $selected;
	array_push($apparaat, $appid);
}
	$db->close();
	$_SESSION['gebruiker'] = $persoon;
	$_SESSION['apparaat'] = $apparaat;
	$_SESSION['datum'] = $datum;
	$_SESSION['terug'] = $terug;
	
	echo "<script type='text/javascript'> document.location = 'Ikreserveer_app.php'; </script>";
	
	

		}
	}
?>
</div>
</div>

</body>
</html>