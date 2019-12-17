<?php
session_start();
include "Controllers/PrisonerController.php";
$title = "Pridėti Kalinį";

$prisonerController = new PrisonerController();

$birth = $startDate = $cell = $name = $lastname = $personalcode = "";
$birth_err = $startDate_err = $cell_err = $name_err = $lastname_err = $personalcode_err = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'administratorius' && isset($_SESSION['id'])) {
	$navigation = $cells = '';
	$cells = $prisonerController->GetCellOptions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Validate id
	    if(empty(trim($_POST["personalcode"]))){
	        $personalcode_err = "Įveskite asmens kodą.";
	    } else{
	        
	        if($prisonerController->GetPrisoner(trim($_POST["personalcode"])) != null){
	        	$personalcode_err = "Toks kalinys jau yra.";
	        }
	        else{
	        	$personalcode = trim($_POST["personalcode"]);
	        }
	        
	         
	        
	    }
	    

	    // Validate name
	    if(empty(trim($_POST["name"]))){
	        $name_err = "Įveskite varda.";  }
	    else{
	        $name = trim($_POST["name"]);
	    }

	        // Validate last name
	    if(empty(trim($_POST["lastname"]))){
	        $lastname_err = "Įveskite pavarde.";  }
	    else{
	        $lastname = trim($_POST["lastname"]);
	    }

	            // Validate email
	    if(empty(trim($_POST["birth"]))){
	        $birth_err = "Įveskite gimimo datą.";  }
	    else{
	        $birth = trim($_POST["birth"]);
	    }
	            // Validate tel
	    if(empty(trim($_POST["cellform"]))){
	        $cell_err = "Pasirinkite kamerą";  }
	    else{
	        $cell = trim($_POST["cellform"]);
	    }
	    if(empty(trim($_POST["startDate"]))){
	        $startDate_err = "Įveskite Įkalinimo datą";  }
	    else{
	        $startDate = trim($_POST["startDate"]);
	    }



	    
	    // Check input errors before inserting in database
	    if(empty($personalcode_err) && empty($name_err) && empty($lastname_err )&& empty($birth_err ) && empty($cell_err )){
	        $prisonerController->AddPrisoner($personalcode, $name, $lastname, $birth,NULL,$startDate, $_SESSION['id'], $cell);
	        header("location: PrisonerList.php");
	    }
	}
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Kalinio Registracija</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
            <div class="form-group '.((!empty($personalcode_err)) ? "has-error" : "").'">
                <label>Asmens kodas</label>
                <input type="number" name="personalcode" class="form-control" value="">
                <span class="help-block">'.$personalcode_err.'</span>
            </div>
            <div class="form-group '.((!empty($name_err)) ? "has-error" : "").'">
                <label>Vardas</label>
                <input type="text" name="name" class="form-control" value="">
                <span class="help-block">'.$name_err.'</span>
            </div>
            <div class="form-group '.((!empty($lastname_err)) ? "has-error" : "").'">
                <label>Pavarde</label>
                <input type="text" name="lastname" class="form-control" value="">
                <span class="help-block">'.$lastname_err.'</span>
            </div>
            <div class="form-group '.((!empty($birth_err)) ? "has-error" : "").'">
                <label>Gimimo Data</label>
                <input type="date" name="birth" class="form-control" value="">
                <span class="help-block">'.$birth_err.'</span>
            </div>
            <div class="form-group '.((!empty($startDate_err)) ? "has-error" : "").'">
                <label>Įkalinimo Data</label>
                <input type="date" name="startDate" class="form-control" value="">
                <span class="help-block">'.$startDate_err.'</span>
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
