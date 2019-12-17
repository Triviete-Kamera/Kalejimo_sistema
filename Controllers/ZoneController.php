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
                        <td><a href='ZoneEdit.php?zone=$value->id' >Redaguoti</a></td>
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
    function CreateTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                 
                    <td><b>Pavadinimas</b></td>
                    <td><b>tel_nr</b></td>
                    <td><b>el_pastas</b></td>
                    <td><b>Adresas</b></td>
                    
                </tr>";

        $zoneArray = $this->GetZones();

        foreach ($zoneArray as $key => $value) {
            $result = $result .
                    "<tr>
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
     
    function AddZone($id,$pavadinimas, $tel_nr, $el_pastas, $adresas ,$naudotojas_id){
        $zoneModel = new ZoneModel();
        return $zoneModel->AddZone(new ZoneEntity($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id));
    }
    function EditZone($id,$pavadinimas, $tel_nr, $el_pastas, $adresas ,$naudotojas_id){
       // echo $id;
       // echo $pavadinimas;
        $zoneModel = new ZoneModel();
        return $zoneModel->EditZone($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id);
    }
   
     function GetZones() {
        $zoneModel = new ZoneModel();
        return $zoneModel->GetZones();
    }
     function GetZone($pavadinimas) {
        $prisonerModel = new ZoneModel();
        //print_r($prisonerModel->GetZone($pavadinimas));
        return $prisonerModel->GetZone($pavadinimas);
    }
    function GetUsers() {
        $zoneModel = new ZoneModel();
        return $zoneModel->GetUsers();
    }
    
    function GetZoneId($id) {
        $zoneModel = new ZoneModel();
        return $zoneModel->GetZoneId($id);
    }

}