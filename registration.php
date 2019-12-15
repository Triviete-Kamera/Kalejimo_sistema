<?php
// Include config file
require_once "Model/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $lastname = $email = $tel = $mail = $adress = $personalcode ="";
$username_err = $password_err = $confirm_password_err = $name_err = $lastname_err = $email_err = $tel_err = $mail_err = $adress_err = $personalcode_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Įveskite naudotojo vardą.";
    } else{
        // Prepare a select statement
        $sql = "SELECT asmens_kodas FROM naudotojas WHERE slapyvardas = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Toks naudotojo vardas jau yra užimtas.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
               echo "Ops";
            }
        // Close statement
        mysqli_stmt_close($stmt);
        }
         
        
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Įveskite slaptažodį.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Slaptažodis turi būti sudarytas bent iš 6 simbolių.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Patvirkinkite slaptažodį.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Slaptažodžiai nesutampa.";
        }
    }
    if(empty(trim($_POST["personalcode"]))){
        $personalcode_err = "Įveskite asmens koda.";  }
        else{
        $personalcode = trim($_POST["personalcode"]);
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
    if(empty(trim($_POST["email"]))){
        $email_err = "Įveskite el pasta.";  }
        else{
        $email = trim($_POST["email"]);
    }
            // Validate tel
    if(empty(trim($_POST["tel"]))){
        $tel_err = "Įveskite numeri.";  }
        else{
        $tel = trim($_POST["tel"]);
    }
   

    if(empty(trim($_POST["mail"]))){
        $mail_err = "Įveskite pasto koda.";  }
        else{
        $mail = trim($_POST["mail"]);
    }

    if(empty(trim($_POST["adress"]))){
        $adress_err = "Įveskite adresa.";  }
        else{
        $adress= trim($_POST["adress"]);
    }



    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err ) && empty($personalcode_password_err )){
        
        // Prepare an insert statement
        $sql = "INSERT INTO naudotojas (asmens_kodas,slapyvardas, slaptazodis,vardas,pavarde,el_pastas,tel_nr,pasto_kodas,adresas ) VALUES ( ?,?,?,?,?,?,?,?,?)";
        //mysqli_report(MYSQLI_REPORT_ALL);
      // MYSQLI_REPORT_OFF;
        
        // echo $tel;
        if($stmt = mysqli_prepare($link,$sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issssssss", $param_personalcode, $param_username, $param_password,$param_name,$param_lastname,$param_email,$param_tel,$param_mail,$param_adress);
            
            // Set parameters
            $param_personalcode = $personalcode;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $name;
            $param_lastname= $lastname;
            $param_email = $email;
            $param_tel = $tel;
            $param_mail = $mail;
            $param_adress = $adress;
            
           
            


            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo $tel;
                header("location: login.php");
            } else{
                echo "Oopslogin.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="favicon.ico" >
        <title><?php echo("Registracija"); ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
         <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
            </div>
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Pagrindinis</a></li>
                    <li><a href="login.php">Prisijungti</a></li>
                </ul>
            </nav>
    <div class="wrapper">
        <h2>Registracija</h2>
        <p>Prašome užpildyti duomenis.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($personalcode_err)) ? 'has-error' : ''; ?>">
                <label>Asmens kodas</label>
                <input type="number" name="personalcode" class="form-control" value="<?php echo $personalcode; ?>">
                <span class="help-block"><?php echo $personalcode_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Slapyvardis</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Slaptažodis</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Pakartoti slaptažodį</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Vardas</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Pavarde</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>El pastas</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
                <label>Telefono numeris</label>
                <input type="text" name="tel" class="form-control" value="<?php echo $tel; ?>">
                <span class="help-block"><?php echo $tel_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                <label>Pasto kodas</label>
                <input type="text" name="mail" class="form-control" value="<?php echo $mail; ?>">
                <span class="help-block"><?php echo $mail_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($adress_err)) ? 'has-error' : ''; ?>">
                <label>Adresas</label>
                <input type="text" name="adress" class="form-control" value="<?php echo $adress; ?>">
                <span class="help-block"><?php echo $adress_err; ?></span>
            </div>
            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Patvirtinti">
                <input type="reset" class="btn btn-default" value="Ištrinti">
            </div>
            
        </form>
    </div>    

            
            <footer>
                <p>All rights reserved(Not really)</p>
            </footer>
        </div>
    </body>
</html>