<?php
session_start();
$content = '
        <h3>Tiekėjų sąrašas</h3><br />'
;

$navigation = '<li><a href="Supplier_delete.php">Tiekeju salinimas</a></li>
				<li><a href="Supplier_add.php">Tiekeju pridejimas</a></li>
                   ';
#include 'Template.php';
include 'Model/config.php';

$content.='<table class="center" border="1" cellspacing="0" cellpadding="3"><tr><td><b>Pavadinimas</b></td><td><b>E. paštas</b></td><td><b>Telefonas</b></td><td><b>Adresas</b></td></tr>';

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
    $content .= "</tr>";

}

$content .='</table>';
include 'Template.php';
?>
