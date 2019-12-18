<?php
session_start();
include 'Model/config.php';
$navigation = '<li><a href="Supplier_delete.php">Tiekeju salinimas</a></li>
				<li><a href="SuplierList.php">Tiekeju sąrašas</a></li>';
if(isset($_SESSION['prev'])=="add")
{
    $_SESSION['prev'] = "sup_actions";
    if(isset($_POST['pavadinimas']) && isset($_POST['e_pastas']) && isset($_POST['tel_nr'])&& isset($_POST['adresas']))
    {

        $pav = $_POST['pavadinimas'];
        $epastas = $_POST['e_pastas'];
        if (!filter_var($epastas, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Blogas e. pašto formatas!";
            $_SESSION['error'] = $emailErr;
            header("Location:Supplier_add.php");exit;
        }
        $tel = $_POST['tel_nr'];
        if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $tel)) {
            $emailErr = "Blogas tel. nr. formatas!";
            $_SESSION['error'] = $emailErr;
            header("Location:Supplier_add.php");exit;
        }
        $adr = $_POST['adresas'];

        $sql = "INSERT INTO tiekejas (pavadinimas, el_pastas, tel_nr, adresas) VALUES ('$pav', '$epastas', '$tel', '$adr')";
        $result = mysqli_query($link, $sql);
        if(!$result)
        {
            $content =  "Įvyko klaida įterpiant į lentelę tiekejas";
        }
        else
        {
            $content =  "Tiekėjas sėkmingai pridėtas";
        }
    }
}
include 'Template.php';