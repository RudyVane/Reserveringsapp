<?php
session_start();
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
<link rel="stylesheet" href="css/styledate.css">
<link rel="stylesheet" href="css/timepicker.css"/>
<link rel="stylesheet" href="stylessl.css">
<link rel='stylesheet' id='chld_thm_cfg_parent-css'  href='https://spinlink.nl/wp-content/themes/Divi/style.css?ver=5.2.2' type='text/css' media='all' /> 
<script type="text/javascript" src="https://ZulNs.github.io/libs/timepicker.js"></script>

<script language="javascript" type="text/javascript">
<!--
function initInput()
	{
	var variable1 = res1;
	var variable2 = res2;
	document.forms[0].Datum.value = variable1;
	document.forms[0].Terug.value = variable2;
	}
//-->
</script>
<style>
@media screen and (max-width: 600px) {	
body {
   transform: scale(2);
   transform-origin: 0 0;
   // add prefixed versions too.
}
html, body {
	height: 100%;
	overflow: scroll;
}
table {
	width:50%;
}

input {
	font-size:3vw;
	border: 1px solid #bebebe;
}	
td {
	color: #000000;
	font-size:2vw;
}
.outside-while{
        border:1px solid #a6a6a6;font-size:2vw;font-weight:200;
		color:#000000;
		
		text-align: center;
    }

    .inside-while{
        border:1px solid #a6a6a6;
		color:#000000;
		
		font-size:2vw;
		font-weight:200;
		text-align: center;
    }
h9 {
	font-size:3vw;
}
p {
	font-size:3vw;
}
p1 {
	font-size:3vw;
}

}
@media screen and (min-width: 600px) {	
button {
	fontsize:2vw;
}
p {
	font-size:1vw;
}

input {
	font-size:1vw;
	border: 1px solid #bebebe;
}
table {
	width:50%;
}
	
   .outside-while{
        border:1px solid #a6a6a6;font-size:0.75vw;font-weight:500;
		color:#a6a6a6;
		
		text-align: center;
    }

    .inside-while{
        border:1px solid #a6a6a6;
		color:#a6a6a6;
		
		font-size:0.75vw;
		font-weight:300;
		text-align: center;
    }

td {
	color:#000000;
	font-size:1vw;
}
}
</style>		
	</head>
<body onLoad="initInput()">

<div class = "container" style="position: absolute;top:1%;left: 2%; text-align:left;">
<h9>Reserveren</h9>
<br>
<form action = "" method ="POST">  
<p>Jouw naam: </p>
<input type="text" name="Naam" size="15" required /><br>

      <p1>Reserveringsdatum<br>
      <div class="row">
        <div class="col-xss-4">
          <div id="reserveren" data-toggle="calendar"></div>
		  
        </div>
        </div>
        
<input name="Datum" id="Datum" size="15" value="" required>
<br>
	<p1>Verwachte inleverdatum<br>
      <div class="row">
        <div class="col-xss-4">
          <div id="inleveren" data-toggle="calendar"></div>
        </div>
        </div>
		
<input name="Terug" id="Terug" size="15" value="" required>
<br>

  	<input type="submit" name="OK" value="Losse apparatuur reserveren" />
	<input type="submit" name="Proj" value="Projectapparatuur reserveren" /> 

</form>



<?php
	
if(isset($_POST['OK'])){
	$_SESSION['datum'] = $_POST['Datum'];
	$_SESSION['terug'] = $_POST['Terug'];
	$naam = $_POST['Naam'];
	$_SESSION['gebruiker'] = $_POST['Naam'];
	
	$naam1=strtoupper($naam);
	$response = array();
  $sql = "SELECT Naam FROM personen WHERE Naam='$naam1'"; 
	$ret = $db->query($sql);
	
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
				
{ 
	echo "<script type='text/javascript'> document.location = 'Ikreserveer2.php'; </script>";
}?>
<p style="color:red;">Wachtwoord is niet correct</p><?php
			die;
	}echo $naam;?><p style="color:red;">Naam bestaat niet</p><?php
			die;	
}
if(isset($_POST['Proj'])){
	$_SESSION['datum'] = $_POST['Datum'];
	$_SESSION['terug'] = $_POST['Terug'];
	$naam = $_POST['Naam'];
	$_SESSION['gebruiker'] = $_POST['Naam'];
	
	$naam1=strtoupper($naam);
	$response = array();
  $sql = "SELECT Naam FROM personen WHERE Naam='$naam1'"; 
	$ret = $db->query($sql);
	
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
				
{ 
	echo "<script type='text/javascript'> document.location = 'Ikreserveerproj.php'; </script>";
}?>
<p style="color:red;">Wachtwoord is niet correct</p><?php
			die;
	}echo $naam;?><p style="color:red;">Naam bestaat niet</p><?php
			die;	
}
?>
<script type="text/javascript" src="scripts/components/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/dateTimePicker.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function()
    {
      $('#basic').calendar();
      
      $('#reserveren').calendar(
      {
        day_first: 1,
        unavailable: ['2019-08-30'],
        onSelectDate: function(date, month, year)
        {
          var res1 = ""+ year + "-" + month + "-" + date + "";
		  
		  document.forms[0].Datum.value = res1;
        }
      });
      $('#inleveren').calendar(
      {
        day_first: 1,
        unavailable: ['2019-08-30'],
        onSelectDate: function(date, month, year)
        {
          var res2 = ""+ year + "-" + month + "-" + date + "";
		  
		  document.forms[0].Terug.value = res2;
        }
      });
    });
    </script>


<?php
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
, $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobileDevice()){
	?><br><br>
	<h9>Overzicht uitleen/reserveringen</h9>

<br>
<button style = "background-color:#FF0000;font-size:2vw">Te laat</button>
<button style = "background-color:#32CD32;font-size:2vw">Uitgeleend</button>
<button style = "background-color:#FFFF00;font-size:2vw">Gereserveerd</button><br>
<?php
   $datum = date('Y-n-j');
   
   $sql = "SELECT * FROM reserveringsdata WHERE `Ingeleverd` = 'Nee' AND `Apparaat` IS NOT NULL ORDER BY `Id` desc";
   $ret = $db->query($sql);
   
          
 echo "<table>";
            echo "<tr>";
                
                echo "<th class='outside-while'>uitleendatum</th>";
				echo "<th class='outside-while'>inleverdatum</th>";
				echo "<th class='outside-while'>Persoon</th>";
				echo "<th class='outside-while'>apparaat</th>";
								
                
            echo "</tr>";
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
			$stap = array(  'datum_uit' => htmlspecialchars($row['Datum_uitleen']),	
						'terug' => htmlspecialchars($row['Terugbrengen']),						
						'tijd_uit' => htmlspecialchars($row['Tijd_uitleen']),					
						'persoon' => htmlspecialchars($row['Persoon']),
						'datum_in' => htmlspecialchars($row['Datum_inleveren']),
										
						'apparaatnaam' => htmlspecialchars($row['Apparaatnaam']),					
						
						);	$td1 = strtotime($stap['terug']);
							$td2 = strtotime($datum);
						if ($td1 < $td2){ 
							$color = "#FF0000";
							$coltxt = "#333";
						}
						else {
							$color = "#32CD32";
							$coltxt = "#333";
						}
						if ($stap['tijd_uit'] == "00:00:00") {
							$color = "#FFFF00";
							$coltxt = "#333";
						}
						if ($stap['datum_in'] != "") {
							$color = "#FFFFFF";
							$coltxt = "#a6a6a6";
						}
            echo "<tr>";
                
                echo '<td class="inside-while">' . $row['Datum_uitleen'] . '</td>';
				echo '<td style="color:'.$coltxt.'; background-color:'.$color.'" class="inside-while">' . $row['Terugbrengen'] . '</td>';
				echo '<td class="inside-while">' . $row['Persoon'] . '</td>';
				echo '<td class="inside-while">' . $row['Apparaatnaam'] . "</td>";
				
				
            echo "</tr>";
        }
   
        echo "</table>";   
	
   }else{
	   ?>
<div class = "container" style="position: absolute;top:3%;left: 50%; text-align:left;">
  
<h9>Overzicht uitleen/reserveringen</h9>

<br>
<button style = "background-color:#FF0000;">Te laat met inleveren
<button style = "background-color:#32CD32;">Uitgeleend
<button style = "background-color:#FFFF00;">Gereserveerd</button><br>
<?php
   $datum = date('Y-n-j');
   
   $sql = "SELECT * FROM reserveringsdata WHERE `Ingeleverd` = 'Nee' ORDER BY `Id` desc";
   $ret = $db->query($sql);
   
          
 echo "<table>";
            echo "<tr>";
                
                echo "<th class='outside-while'>Datum uitleen</th>";
				echo "<th class='outside-while'>Datum inleveren</th>";
				echo "<th class='outside-while'>Persoon</th>";
				echo "<th class='outside-while'>Naam apparaat</th>";
				echo "<th class='outside-while'>Naam toebehoren</th>";
				
                
            echo "</tr>";
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
			$stap = array(  'datum_uit' => htmlspecialchars($row['Datum_uitleen']),	
						'terug' => htmlspecialchars($row['Terugbrengen']),						
						'tijd_uit' => htmlspecialchars($row['Tijd_uitleen']),					
						'persoon' => htmlspecialchars($row['Persoon']),
						'datum_in' => htmlspecialchars($row['Datum_inleveren']),
										
						'apparaatnaam' => htmlspecialchars($row['Apparaatnaam']),					
						
						'naam_toebehoren' => htmlspecialchars($row['Naam_toebehoren']),
						'lokatie' => htmlspecialchars($row['Lokatie_gebruik']),				
											
						'projectnaam' => htmlspecialchars($row['Projectnaam']),
						);	$td1 = strtotime($stap['terug']);
							$td2 = strtotime($datum);
						if ($td1 < $td2){ 
							$color = "#FF0000";
							$coltxt = "#333";
						}
						else {
							$color = "#32CD32";
							$coltxt = "#333";
						}
						if ($stap['tijd_uit'] == "00:00:00") {
							$color = "#FFFF00";
							$coltxt = "#333";
						}
						if ($stap['datum_in'] != "") {
							$color = "#FFFFFF";
							$coltxt = "#a6a6a6";
						}
            echo "<tr>";
                
                echo '<td class="inside-while">' . $row['Datum_uitleen'] . '</td>';
				echo '<td style="color:'.$coltxt.'; background-color:'.$color.'" class="inside-while">' . $row['Terugbrengen'] . '</td>';
				echo '<td class="inside-while">' . $row['Persoon'] . '</td>';
				echo '<td class="inside-while">' . $row['Apparaatnaam'] . "</td>";
				echo '<td class="inside-while">' . $row['Naam_toebehoren'] . "</td>";
				
            echo "</tr>";
        }
   
        echo "</table>";   

   }
?>

<br>
</div></div>
					
</body>
</html>
