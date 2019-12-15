<?php
session_start();
 

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	if ($_SESSION["vartotojo_tipas"] == 'valgyklos_darbuotojas') {
		$title = "Home";
		$content = '
        <h3>Sveiki, jūs esate virtuves darbuotojas</h3>
        ';

        $navigation = '<li><a href="/Views/Cafeteria/SuplierList.php">Tiekeju sarasas</a></li>
                <li><a href="index.php">Valgyklos ivertinimu sarasas</a></li>
                <li><a href="logout.php">Atsijungti</a></li>
                   ';
        include 'Template.php';


	}
	if ($_SESSION["vartotojo_tipas"] == 'administratorius') {
	
    $title = "Home";
	$content = '
        <h3>Sveiki, jūs esate administratorius</h3>
        ';
        include 'template.php';
        $navigation = '
                <li><a href="logout.php">Atsijungti</a></li>
                   ';
    }
    if ($_SESSION["vartotojo_tipas"] == 'priziuretojas') {
    
    $title = "Home";
    $content = '
        <h3>Sveiki, jūs esate prižiūrėtojas</h3>
        ';
        $navigation = '
         <li><a href="zonelist.php">Zonu sarasas</a></li>
                <li><a href="logout.php">Atsijungti</a></li>
                   ';
        include 'Template.php';
    }
}
else {
	$title = "Home";
$content = '
       
        <h3>Triviete kamera</h3>
        ';
$navigation = '<li><a href="login.php">Prisijungti</a></li>
                <li><a href="registration.php">Registruotis</a></li>
                   ';

        
include 'Template.php';
}
?>