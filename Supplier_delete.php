<?php
session_start();
include 'Model/config.php';
$_SESSION['prev'] = "delete";
$content .= '<h3>Tiekėjų šalinimas</h3><br />';
$navigation = '<li><a href="Supplier_add.php">Tiekėjų pridėjimas</a></li>
				<li><a href="SuplierList.php">Tiekėjų sąrašas</a></li>
                   ';

$content .= '<form name="temos" action="SupplierActions.php" method="post">';
$content.='<table class="center" border="1" cellspacing="0" cellpadding="3">
<tr><td><b>Pavadinimas</b></td><td><b>E. paštas</b></td><td><b>Telefonas</b></td><td><b>Adresas</b></td><td><b>Šalinti</b></td></tr>';

$sql = "SELECT id, pavadinimas, el_pastas, tel_nr, adresas FROM tiekejas ";
$result = mysqli_query($link, $sql);
if (!$result || (mysqli_num_rows($result) < 1))
{echo "Klaida skaitant lentelę tiekejas"; exit;}

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['id'];
    $pavadinimas = $row['pavadinimas'];
    $el_pastas = $row['el_pastas'];
    $tel_nr = $row['tel_nr'];
    $adresas = $row['adresas'];

    $content .= '<tr>';
    $content .= '<td>'.$pavadinimas.'</td>';
    $content .= '<td>'.$el_pastas.'</td>';
    $content .= "<td>".$tel_nr."</td>";
    $content .= "<td>".$adresas."</td>";
    $content .= "<td><input type=\"checkbox\" name=\"naikinti_".$id."\"></td>";
    $content .= "</tr>";
}
$content .='</table>';
$content .='<br /><input type="submit" name="done" value="Šalinti">';
$content .= '</form>';
include 'Template.php';