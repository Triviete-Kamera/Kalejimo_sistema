<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Nusižengimų ataskaita";

$prisonerController = new PrisonerController();

$dateFrom = $dateTo = $table = $amount = "";
$dateFrom_err = $dateTo_err= $amount_err = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
	$navigation = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    
        if(empty(trim($_POST["amount"]))){
            $amount_err = "Įveskite kiekį.";  }
        else{
            $amount = trim($_POST["amount"]);
        }

	    if(empty(trim($_POST["dateFrom"]))){
            $dateFrom_err = "Įveskite datą.";  }
        else{
            $dateFrom = trim($_POST["dateFrom"]);
        }
	        // Validate last name
	    if(empty(trim($_POST["dateTo"]))){
	        $dateTo_err = "Įveskite datą.";  }
	    else{
	        $dateTo = trim($_POST["dateTo"]);

            if($dateFrom == "" || strtotime($dateFrom) > strtotime($dateTo)){
                $dateTo_err = "Turi būti velesnė nei pasirinkta Nuo.";
            }
	    }
	    // Check input errors before inserting in database
	    if(empty($dateFrom_err) && empty($dateTo_err) && empty($amount_err)){
	        $table = $prisonerController->GetOffenseReport($dateFrom, $dateTo, $amount);
	    }
	}
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Nusižengimų Ataskaita</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
            <div class="form-group '.((!empty($dateFrom_err)) ? "has-error" : "").'">
                <label>Nuo</label>
                <input type="date" name="dateFrom" class="form-control" value="'.$dateFrom.'">
                <span class="help-block">'.$dateFrom_err.'</span>
            </div>
            <div class="form-group '.((!empty($dateTo_err)) ? "has-error" : "").'">
                <label>Iki</label>
                <input type="date" name="dateTo" class="form-control" value="'.$dateTo.'">
                <span class="help-block">'.$dateTo_err.'</span>
            </div>
            <div class="form-group '.((!empty($amount_err)) ? "has-error" : "").'">
                <label>Grafo stulpelių kiekis</label>
                <input type="number" name="amount" class="form-control" value="'.$amount.'">
                <span class="help-block">'.$amount_err.'</span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>

            
        </form>
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        <div>
                '.$table.'
        </div>';
include "Template.php";
