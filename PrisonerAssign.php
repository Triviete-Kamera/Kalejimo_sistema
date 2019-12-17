<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Priskirti Kalinį";

$prisonerController = new PrisonerController();

$birth = $startDate = $cell = $name = $lastname = $personalcode = "";
$birth_err = $startDate_err = $cell_err = $name_err = $lastname_err = $personalcode_err = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'administratorius' && isset($_SESSION['id'])) {
	$navigation = $cells = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    if(empty(trim($_POST["cellform"]))){
	        $cell_err = "Pasirinkite kamerą";  }
	    else{
	        $cell = trim($_POST["cellform"]);
	    }



	    
	    // Check input errors before inserting in database
	    if( empty($cell_err )){
	        $prisonerController->EditPrisonerCell(trim($_POST["prisonerId"]), $cell);
	        header("location: PrisonerList.php");
	    }
	}
	$prisonerid = $_GET['prisoner'];
	$prisoner = $prisonerController->GetPrisonerId($prisonerid);
	$cells = $prisonerController->GetCellOptionsID($prisoner->kamera_id);
	if($id = NULL){
		header("location: PrisonerList.php");
	}
	
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Kalinio Kameros Priskyrimas</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
        		<input type="hidden" id="prisonerId" name="prisonerId" value="'.$prisonerid.'">
            <div class="form-group '.((!empty($personalcode_err)) ? "has-error" : "").'">
                <label>Asmens kodas</label>
                <input type="number" name="personalcode" class="form-control" value="'.$prisoner->asmens_kodas.'" readonly>
                <span class="help-block">'.$personalcode_err.'</span>
            </div>
            
            <div class="form-group '.((!empty($cell_err)) ? "has-error" : "").'">
                <label>Kamera</label>
                <select name="cellform" class="form-control">
                	'.$cells.'
                </select>
                <span class="help-block">'.$cell_err.'</span>
            </div>
            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>
            
        </form>';
include "Template.php";
