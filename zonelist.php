<?php
session_start();
include "Controllers/ZoneController.php";
$title = "Zonu sarasas";

$zoneController = new ZoneController();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	if ($_SESSION["vartotojo_tipas"] == 'priziuretojas') {
			$content = $zoneController->CreateEditTable();
			$navigation = '<li><a href="ZoneAdd.php">Kurti nauja zona</a></li>
                   ';
				include "Template.php";

	}
	else{
		$navigation = '';
	$content = $zoneController->CreateTable();
	
	include "Template.php";
	}
}else{
	header("location: index.php");
}

