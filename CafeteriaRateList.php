<?php
session_start();
$content = '
        <h3>Valgyklos įvertinimų peržiūra</h3><br />'
;

$navigation = '<li><a href="Cafeteria_rate.php">Valgyklos įvertinimo langas</a></li>
				<li><a href="Cafeteria_resources.php">Išteklių statistika</a></li>
                   ';

include 'Model/config.php';

$content.='<table class="center" border="1" cellspacing="0" cellpadding="3">
<tr><td><b>Pavadinimas</b></td><td><b>E. paštas</b></td><td><b>Telefonas</b></td><td><b>Įvertinimas</b></td><td><b>Zonos id</b></td></tr>';

$sql = "SELECT id, pavadinimas, el_pastas, tel_nr, ivertinimas, kalejimo_zona_id FROM valgykla";
$result = mysqli_query($link, $sql);
if (!$result || (mysqli_num_rows($result) < 1))
{echo "Klaida skaitant lentelę valgykla"; exit;}

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['id'];
    $pavadinimas = $row['pavadinimas'];
    $el_pastas = $row['el_pastas'];
    $tel_nr = $row['tel_nr'];
    $ivertinimas = $row['ivertinimas'];
    $zona = $row['kalejimo_zona_id'];

    $content .= '<tr>';
    $content .= '<td>'.$pavadinimas.'</td>';
    $content .= '<td>'.$el_pastas.'</td>';
    $content .= "<td>".$tel_nr."</td>";
    $content .= "<td>".$ivertinimas."</td>";
    $content .= "<td>".$zona."</td>";
    $content .= "</tr>";

}

$content .='</table>';
include 'Template.php';
?>
