<?php
session_start();
$content = '';
include 'Model/config.php';

if(isset($_SESSION['prev'])=="add")
{
    $navigation = '<li><a href="Supplier_delete.php">Tiekėjų šalinimas</a></li>
				<li><a href="SuplierList.php">Tiekėjų sąrašas</a></li>';
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

if(isset($_SESSION['prev']) == "delete")
{
    $navigation = '<li><a href="Supplier_add.php">Tiekėjų pridėjimas</a></li>
				<li><a href="SuplierList.php">Tiekėjų sąrašas</a></li>';
    $sql = "SELECT id, pavadinimas, el_pastas, tel_nr, adresas FROM tiekejas";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result))
    {
        $id=$row['id'];
        $del='naikinti_'.$id;
        $naikinti=(isset($_POST['naikinti_'.$id]));
        if ($naikinti == $del)
        {
            $sql = "DELETE FROM tiekejas WHERE id='$id'";
            mysqli_query($link, $sql);
        }

    }
    $content = "Pasirinkti tiekėjai sėkmingai pašalinti";
}
include 'Template.php';