<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Pridėti Nusižengimą";

$prisonerController = new PrisonerController();

$date = $type = "";
$date_err = $type_err = "";
$prisonerId = "";
if(isset($_GET['prisoner'])){
	$prisonerId = $_GET['prisoner'];
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'administratorius' && isset($_SESSION['id'])) {
	$navigation = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    

	    $type = trim($_POST["type"]);
	        // Validate last name
	    if(empty(trim($_POST["date"]))){
	        $date_err = "Įveskite datą.";  }
	    else{
	        $date = trim($_POST["date"]);
	    }

	     $prisonerId = trim($_POST["prisonerId"]);



	    
	    // Check input errors before inserting in database
	    if(empty($date_err) && !empty($prisonerId)){
	        $prisonerController->AddOffense($type, $date,$prisonerId);
	        $location = "Offense.php?prisoner=".$prisonerId;
	        header("location: ".$location);
	    }
	}
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Nusižengimo Registracija</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
        		<input type="hidden" id="prisonerId" name="prisonerId" value="'.$prisonerId.'">
            <div class="form-group '.((!empty($type_err)) ? "has-error" : "").'">
                <label>Tipas</label>
                <select name="type" class="form-control">
                	<option value ="vagyste">Vagystė</option>
                	<option value ="zmogzudyste">Žmogžudystė</option>
                	<option value ="kontrabanda">Kontrabanda</option>
                	<option value ="smurtas">Smurtas</option>
                	<option value ="nepaklusnumas">Nepaklusnumas</option>
                </select>
                <span class="help-block">'.$type_err.'</span>
            </div>
            <div class="form-group '.((!empty($date_err)) ? "has-error" : "").'">
                <label>Data</label>
                <input type="date" name="date" class="form-control" value="">
                <span class="help-block">'.$date_err.'</span>
            </div>
            
            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>
            
        </form>';
include "Template.php";
