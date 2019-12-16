<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Kalinių sąrašas";

$prisonerController = new PrisonerController();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	$content = $prisonerController->CreateEditTable();
	if ($_SESSION["vartotojo_tipas"] == 'administratorius') {
			$navigation = '<li><a href="PrisonerAdd.php">Pridėti Kalinį</a></li>
                   ';
				include "Template.php";

	}
}else{
	header("location: index.php");
}

