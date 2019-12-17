<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Nusižengimų sąrašas";

$prisonerController = new PrisonerController();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'administratorius') {
	$navigation = "";
	$prisoner = $_GET['prisoner'];
		$content = $prisonerController->CreateOffenseTable($prisoner);
		$navigation = '<li><a href="OffenseAdd.php?prisoner='.$prisoner.'">Pridėti Nusižengimą</a></li>
                   ';
				

	
	include "Template.php";
}else{
	header("location: index.php");
}

