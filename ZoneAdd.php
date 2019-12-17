<?php
session_start();
include "Controllers/ZoneController.php";
$title = "Prideti zona";

$zoneController = new ZoneController();

$name = $tel = $email = $adress   = "";
$name_err = $tel_err = $email_err = $adress_err  = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'priziuretojas' && isset($_SESSION['id'])) {
	$navigation = $user_id = '';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Validate id
	    if(empty(trim($_POST["name"]))){
	        $name_err = "Įveskite pavadinima.";
	    } else{
	        
	        if($zoneController->GetZone(trim($_POST["name"])) != null){
	        	$name_err = "Tokia zona jau egzistuoja..";
	        }
	        else{

	        	$name = trim($_POST["name"]);
	        }
	        
	         
	        
	    }
	    

	    // Validate name
	    if(empty(trim($_POST["tel"]))){
	        $tel_err = "Įveskite telefono numeri.";  }
	    else{
	        $tel = trim($_POST["tel"]);
	    }

	        // Validate last name
	    if(empty(trim($_POST["email"]))){
	        $email_err = "Įveskite ppasto adresa.";  }
	    else{
	        $email = trim($_POST["email"]);
	    }

	            // Validate email
	    if(empty(trim($_POST["adress"]))){
	        $adress_err = "Įveskite adresa.";  }
	    else{
	        $adress = trim($_POST["adress"]);
	    }
	    
	   


	    
	    // Check input errors before inserting in database
	    if(empty($name_err) && empty($tel_err) && empty($adress_err )&& empty($user_id_err ) && empty($email_err )){
	        $zoneController->AddZone(-1,$name, $tel, $email, $adress, $_SESSION['id']);
	        header("location: ZoneList.php");
	    }
	}
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Kalinio Registracija</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
            <div class="form-group '.((!empty($name_err)) ? "has-error" : "").'">
                <label>Pavadinimas</label>
                <input type="text" name="name" class="form-control" value="">
                <span class="help-block">'.$name_err.'</span>
            </div>
            <div class="form-group '.((!empty($tel_err)) ? "has-error" : "").'">
                <label>Telefono numeris</label>
                <input type="text" name="tel" class="form-control" value="">
                <span class="help-block">'.$tel_err.'</span>
            </div>
            <div class="form-group '.((!empty($email_err)) ? "has-error" : "").'">
                <label>Pasto adresas</label>
                <input type="text" name="email" class="form-control" value="">
                <span class="help-block">'.$email_err.'</span>
            </div>
            <div class="form-group '.((!empty($adress_err)) ? "has-error" : "").'">
                <label>Adresas</label>
                <input type="text" name="adress" class="form-control" value="">
                <span class="help-block">'.$adress_err.'</span>
            </div>
           
            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>
            
        </form>';
include "Template.php";