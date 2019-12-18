<?php
session_start();
include 'Model/config.php';
$_SESSION['prev'] = "rate";
$content = '';
$content .= '<h3>Valgyklos įvertinimo langas</h3><br />';
$navigation = '<li><a href="CafeteriaRateList.php">Valgyklos įvertinimų peržiūra</a></li>
				<li><a href="Caf_recource_stats.php">Išteklių statistika</a></li>
                   ';
$content .= '<form name="valgykla" action="CafeteriaActions.php" method="post">';
$sql = "SELECT id, pavadinimas FROM valgykla";
$result = mysqli_query($link, $sql);
$content .= "Pasirinkite valgyklą";
$content .= '<select name="cars">';

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['id'];
    $pavadinimas = $row['pavadinimas'];
    $content.="<option value=/'$id/'>".$pavadinimas."</option>";
}

$content .='</select><br /><br />';
$content .= 'Irašykite įvertinimą : <input name=\'ivertinimas\' type=\'number\' min=1 max=10>';
$content .='<input type="submit" name="done" value="Vykdyti">';
$content .= '</form>';

include 'Template.php';