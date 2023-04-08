<?php
session_start();
	
$datum = $_SESSION['datum'];
$terug = $_SESSION['terug'];
$user = $_SESSION['gebruiker'];
 
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
   transform: scale(1.5);
   transform-origin: 0 0;
   // add prefixed versions too.
}
html, body {
	height: 100%;
	overflow: scroll;
}

input {
	font-size:14px;
	border: 1px solid #bebebe;
}	
td {
	color: #000000;
	font-size:4vw;
}

h9 {
	font-size:5vw;
}
p {
	font-size:3vw;
}
p1 {
	font-size:4vw;
}

}
@media screen and (min-width: 600px) {	

input {
	font-size:14px;
	border: 1px solid #bebebe;
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
	font-size:10px;
}
}
</style>
</head>
<body onLoad="initInput()">	
<div class = "container" style="position: absolute;top:3%;left: 2%; text-align:left;">	
<h9>Projecten</h9><br>
<form action = "" method ="POST"><br>
<p1>Welk project wil je reserveren?</p1><br><br>

	<?php
	$sql = "SELECT * FROM project";

$ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
?>
<button class="button" type="submit" name="project" width = "100%" value="<?php echo $row['Naam'];?>"><?php echo $row['Naam']?></button><br><br>

<?php	
}
?>
</form>	
<?php	
if(isset($_POST['project'])){echo "ok";
	$_SESSION['datum'] = $datum;
	$_SESSION['terug'] = $terug;
	$_SESSION['gebruiker'] = $user;
	$_SESSION['project'] = $_POST['project'];

	echo "<script type='text/javascript'> document.location = 'Ikreserveerproj2.php'; </script>";

		}	


?>	


</div></div>

</div></div>
			
</body>
</html>