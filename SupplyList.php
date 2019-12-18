<?php
session_start();
$content = '
        <h3>Maisto atsargu sąrašas</h3><br />'
;


#include 'Template.php';
include 'Model/config.php';

$content.='<table class="center" border="1" cellspacing="0" cellpadding="3"><tr><td><b>Pavadinimas</b></td><td><b>E. paštas</b></td><td><b>Telefonas</b></td></tr>';

$sql = "SELECT kiekis, galiojimas, valgykla_id, maisto_produktas_id, saskaita_id FROM maisto_atsarga ";
$result = mysqli_query($link, $sql);
if (!$result || (mysqli_num_rows($result) < 1))
{echo "Klaida skaitant lentelę tiekejas"; exit;}

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['kiekis'];
    $pavadinimas = $row['galiojimas'];
    $el_pastas = $row['valgykla_id'];

    $content .= '<tr>';
    $content .= '<td>'.$id.'</td>';
    $content .= '<td>'.$pavadinimas.'</td>';
    $content .= "<td>".$el_pastas."</td>";
    $content .= "</tr>";

}

$content .='</table>';
include 'Template.php';
?>
