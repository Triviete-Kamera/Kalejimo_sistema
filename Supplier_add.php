<?php
session_start();
if(isset($_SESSION['prev'])=="sup_actions")
{
    $content.=$_SESSION['error'];
    $content.='<br />';
}
include 'Model/config.php';
$_SESSION['prev'] = "add";
$content .= '<h3>Tiekėjų Papildymas</h3><br />';
$navigation = '<li><a href="Supplier_delete.php">Tiekėju šalinimas</a></li>
				<li><a href="SuplierList.php">Tiekėju sąrašas</a></li>
                   ';
$content .= '<form name="temos" action="SupplierActions.php" method="post">';
$content .= '<table class="center" border="0" cellspacing="0" cellpadding="3">
		<tr><td><b>Įvesti Tiekėją:</b></td></tr>
		<tr><td>Pavadinimas:<input name=\'pavadinimas\' type=\'text\'></td>></tr>
		<tr><td>El. paštas:<input name=\'e_pastas\' type=\'text\'></td>></tr>
		<tr><td>Telefonas:<input name=\'tel_nr\' type=\'text\'></td>></tr>
		<tr><td>Adresas:<input name=\'adresas\' type=\'text\'></td>></tr>
		</table>
		<input type="submit" name="done" value="Vykdyti">';
$content .= '</form>';

include 'Template.php';