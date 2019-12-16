<?php
session_start();
 

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $navigation = '<li><a href="SupplyList.php">Maisto atsargos</a></li>
                <li><a href="CafeteriaRateList.php">Valgyklos įvertinimai</a></li>
                <li><a href="Schedule.php">Tvarkaraštis</a></li>
                <li><a href="ZoneList.php">Kalėjimo zonos</a></li>
                <li><a href="OffenseReport.php">Nusižengimų ataskaita</a></li>
                <li><a href="PrisonerList.php">Kaliniai</a></li>
                <li><a href="SupplyStats.php">Išteklių statistika</a></li>
                   ';
    if ($_SESSION["vartotojo_tipas"] == NULL) {
        
        $content = '
        <h3>Sveiki, jūs dar neturite pareigų</h3>
        ';

        $navigation .= '';


    }
	else if ($_SESSION["vartotojo_tipas"] == 'valgyklos_darbuotojas') {
		$content = '
        <h3>Sveiki, jūs esate virtuves darbuotojas</h3>
        ';

        $navigation .= '<li><a href="SupplierList.php">Tiekeju sarasas</a></li>
                   ';


	}
    
	else if ($_SESSION["vartotojo_tipas"] == 'administratorius') {
	
	$content = '
        <h3>Sveiki, jūs esate administratorius</h3>
        ';
        $navigation .= '
                <li><a href="OffenseAdd.php">Registruoti Nusižengimą</a></li>
                   ';
        
    }
    else if ($_SESSION["vartotojo_tipas"] == 'priziuretojas') {
    
    $content = '
        <h3>Sveiki, jūs esate prižiūrėtojas</h3>
        ';
        $navigation .= '
                <li><a href="ZoneList.php">Zonų sąrašas</a></li>
                <li><a href="ScheduleCreate.php">Naujas Tvarkaraštis</a></li>
                   ';
        
    }
    $navigation .= '<li><a href="logout.php">Atsijungti</a></li> ';
}
else {
    $content = '
       
        <h3>Triviete kamera</h3>
        ';
    $navigation = '<li><a href="login.php">Prisijungti</a></li>
                <li><a href="registration.php">Registruotis</a></li>
                   ';

        
}
$title = "Home";
include 'Template.php';
?>