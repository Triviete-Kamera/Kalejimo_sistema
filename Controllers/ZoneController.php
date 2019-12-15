<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Model/zoneModel.php";
require($path);

class ZoneController {

	function CreateEditTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td><b>Pavadinimas</b></td>
                    <td><b>tel_nr</b></td>
                    <td><b>el_pastas</b></td>
                    <td><b>Adresas</b></td>
                    
                </tr>";

        $zoneArray = $this->GetZones();

        foreach ($zoneArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='givepermission.php?update=$value->id' >Redaguoti</a></td>
                        <td>$value->pavadinimas</td>
                        <td>$value->tel_nr</td>
                        <td>$value->el_pastas</td>
                        <td>$value->adresas</td>
                         
                    </tr>";
        }
        $size = count($zoneArray);
        if ($size<1) {
            $result =  "<h3>Nera kalejimo zonu.</h3>" ;         
        }
        else{

        $result = $result . "</table>";
        }
        return $result;
    }
     function GetZones() {
        $zoneModel = new ZoneModel();
        return $zoneModel->GetZones();
    }
}