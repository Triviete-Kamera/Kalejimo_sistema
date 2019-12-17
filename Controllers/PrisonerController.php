<?php
//$path = $_SERVER['DOCUMENT_ROOT'];
$path = __DIR__.'/../Model/PrisonerModel.php';
require($path);
class PrisonerController {
    function CreateEditTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td><b>Asmens Kodas</b></td>
                    <td><b>Vardas Pavardė</b></td>
                    <td><b>Gimimo Data</b></td>
                    <td><b>Kalinimas</b></td>
                    <td></td>
                    
                </tr>";
        $prisonerArray = $this->GetPrisoners();
        foreach ($prisonerArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='PrisonerEdit.php?prisoner=$value->id' >Redaguoti</a> <a href='PrisonerAssign.php?prisoner=$value->id' >Priskirti</a></td>
                        <td>$value->asmens_kodas</td>
                        <td>$value->vardas $value->pavarde</td>
                        <td>$value->gimimo_data</td>
                        <td>$value->ikalinimo_data - $value->paleidimo_data</td>
                        <td><a href='Offense.php?prisoner=$value->id' >Nusižengimai</a> </td>
                         
                    </tr>";
        }
        $size = count($prisonerArray);
        if ($size<1) {
            $result =  "<h3>Nėra kalinių.</h3>" ;         
        }
        else{
        $result .=  "</table>";
        }
        return $result;
    }
    function CreateTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td><b>Asmens Kodas</b></td>
                    <td><b>Vardas Pavardė</b></td>
                    <td><b>Gimimo Data</b></td>
                    <td><b>Kalinimas</b></td>
                    
                </tr>";
        $prisonerArray = $this->GetPrisoners();
        foreach ($prisonerArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td>$value->asmens_kodas</td>
                        <td>$value->vardas $value->pavarde</td>
                        <td>$value->gimimo_data</td>
                        <td>$value->ikalinimo_data - $value->paleidimo_data</td>
                         
                    </tr>";
        }
        $size = count($prisonerArray);
        if ($size<1) {
            $result =  "<h3>Nėra kalinių.</h3>" ;         
        }
        else{
        $result .=  "</table>";
        }
        return $result;
    }
    function GetCellOptions() {
        $cells = $this->GetCells();
        $res = "";
        foreach ($cells as $key => $value) {
            $res .= "<option value ='$value'>$value</option>";
        }
        return $res;
    }
    function GetCellOptionsID($id) {
        $cells = $this->GetCells();
        $res = "";
        foreach ($cells as $key => $value) {
            if($value == $id){
                $res .= "<option value ='$value' selected='selected'>$value</option>";
            }else{
                $res .= "<option value ='$value'>$value</option>";
            }
            
        }
        return $res;
    }
     function GetPrisoners() {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetPrisoners();
    }
     function GetPrisoner($asmens_kodas) {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetPrisoner($asmens_kodas);
    }
    function GetPrisonerId($id) {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetPrisonerId($id);
    }
    function GetCells() {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetCells();
    }
    function AddPrisoner($asmens_kodas, $vardas, $pavarde, $gimimo_data, $paleidimo_data, $ikalinimo_data, $administratorius_id, $kamera_id){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->AddPrisoner(new PrisonerEntity($asmens_kodas,$vardas,$pavarde,$ikalinimo_data,$paleidimo_data,$gimimo_data,$administratorius_id,$kamera_id));
    }
    function EditPrisoner($id, $asmens_kodas, $vardas, $pavarde, $gimimo_data, $paleidimo_data, $ikalinimo_data){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->EditPrisoner($id, $asmens_kodas, $vardas, $pavarde, $gimimo_data, $paleidimo_data, $ikalinimo_data);
    }
    function EditPrisonerCell($id, $cell){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->EditPrisonerCell($id, $cell);
    }
}