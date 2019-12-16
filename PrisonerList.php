<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Kalinių sąrašas";

$prisonerController = new PrisonerController();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$navigation = "";
	if ($_SESSION["vartotojo_tipas"] == 'administratorius') {
		$content = $prisonerController->CreateEditTable();
		$navigation = '<li><a href="PrisonerAdd.php">Pridėti Kalinį</a></li>
                   ';
				

	}
	else{
		$content = $prisonerController->CreateTable();
	}
	include "Template.php";
}else{
	header("location: index.php");
}

