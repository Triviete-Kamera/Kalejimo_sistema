<?php
session_start();
include "Controllers/ScheduleController.php";
$title = "Kurti tvarkarasti";

$scheduleController = new ScheduleController();

$ws = $wd = $break = $breaklength = $shift  = "";
$ws_err = $wd_err = $break_err = $breaklenght_err = $shift_err  = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["vartotojo_tipas"] == 'priziuretojas' && isset($_SESSION['id'])) {
	$navigation = $who = $who_err = '';
	$who = $scheduleController->GetWhoOptions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Validate id
	    if(empty(trim($_POST["ws"]))){
	        $ws_err = "Įveskite pamainos pradzia.";
	    } else{
	        
	        	$ws = trim($_POST["ws"]);
	        }
	        
	         
	        
	    
	    

	    // Validate name
	    if(empty(trim($_POST["wd"]))){
	        $wd_err = "Įveskite pamainos pabaiga.";  }
	    else{
	        $wd = trim($_POST["wd"]);
	    }
	    if(!empty(trim($_POST["who"]))){
	        $whocreate = trim($_POST["who"]);  }

	        // Validate last name
	    if(empty(trim($_POST["break"]))){
	        $break_err = "Įveskite pertraukos pradzia.";  }
	    else{
	        $break = trim($_POST["break"]);
	    }

	            // Validate email
	    if(empty(trim($_POST["breaklenght"]))){
	        $breaklength_err = "Įveskite pertraukos trukme.";  }
	    else{
	        $breaklength = trim($_POST["breaklenght"]);
	    }

	    if(empty(trim($_POST["shift"]))){
	        $shift_err = "Pasirinkite pamaina.";  }
	    else{
	        $shift = trim($_POST["shift"]);
	    }
	    
	    if(!empty(trim($_POST["shift"]))){
        $shift= trim($_POST["shift"]);
       // echo $gender;
    }


	    
	    // Check input errors before inserting in database
	    if(empty($ws_err) && empty($wd_err) && empty($break_err )&& empty($breaklenght_err ) && empty($shift_err )){
	    	$uid = $scheduleController->GetId($whocreate);
	    	echo $uid;
	        $scheduleController->AddSchedule($ws, $wd, $break, $breaklength,$shift,$uid);
	        header("location: ScheduleCreate.php");
	    }
	}
	       
}else{
	header("location: index.php");
}
$content = '
        <h2>Tvarkarascio sukurimas</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
            <div class="form-group '.((!empty($who_err)) ? "has-error" : "").'">
                <label>Kam kurti</label>
                 <select name="who" class="form-control">
                	'.$who.'
                </select>
                <span class="help-block">'.$who_err.'</span>
            </div>
            <div class="form-group '.((!empty($ws_err)) ? "has-error" : "").'">
                <label>Pamainos pradzia</label>
                <input type="time" name="ws" class="form-control" value="">
                <span class="help-block">'.$ws_err.'</span>
            </div>
            <div class="form-group '.((!empty($wd_err)) ? "has-error" : "").'">
                <label>Darbo pabaiga</label>
                <input type="time" name="wd" class="form-control" value="">
                <span class="help-block">'.$wd_err.'</span>
            </div>
            <div class="form-group '.((!empty($break_err)) ? "has-error" : "").'">
                <label>Pertraukos pradzia</label>
                <input type="time" name="break" class="form-control" value="">
                <span class="help-block">'.$break_err.'</span>
            </div>
            <div class="form-group '.((!empty($breaklenght_err)) ? "has-error" : "").'">
                <label>Pertraukos trukme</label>
                <input type="number" name="breaklenght" class="form-control" value="">
                <span class="help-block">'.$breaklenght_err.'</span>
            </div>
            <div class="form-group '.((!empty($shift_err)) ? "has-error" : "").'">
                 <label>Pamaina</label>
                <input type="radio" name="shift" value="rytine">Rytine
                <input type="radio" name="shift" value="vakarine">Vakarine
                <input type="radio" name="shift" value="naktine">Naktine
                <span class="help-block">'.$shift_err.'</span>
            </div>
           
            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>
            
        </form>';
include "Template.php";