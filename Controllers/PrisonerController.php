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
    function CreateOffenseTable($prisoner) {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td><b>Tipas</b></td>
                    <td><b>Data</b></td>
                    
                </tr>";
        $prisonerArray = $this->GetOffenses($prisoner);
        foreach ($prisonerArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td>$value->tipas</td>
                        <td>$value->data</td>
                         
                    </tr>";
        }
        $size = count($prisonerArray);
        if ($size<1) {
            $result =  "<h3>Nėra nusižengimų.</h3>" ;         
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
    function GetOffenseReport($from, $to, $amount){
        $reportArray = array();
        $start = strtotime($from);
        $diff = strtotime($to) - $start;
        $step = $diff/$amount;
        $theft = $murder = $kontra = $assou = $lawless = "";
        for ($i=0; $i < $amount; $i++) { 
            $end = $start + $step;
            $startDate = date("Y-m-d", $start);
            $endDate = date("Y-m-d", $end);
            $data1 =$this->GetOffensesDate($startDate, $endDate, "vagyste");
            $data2 =$this->GetOffensesDate($startDate, $endDate, "zmogzudyste");
            $data3 =$this->GetOffensesDate($startDate, $endDate, "kontrobanda");
            $data4 =$this->GetOffensesDate($startDate, $endDate, "smurtas");
            $data5 =$this->GetOffensesDate($startDate, $endDate, "nepaklusnumas");
            $label = $startDate." - ".$endDate;
            $start += $step;

            $theft .= '{  y: '.$data1.' , label: "'.$label.'"}';
            $murder .= '{  y: '.$data2.' , label: "'.$label.'"}';
            $kontra .= '{  y: '.$data3.' , label: "'.$label.'"}';
            $assou .= '{  y: '.$data4.' , label: "'.$label.'"}';
            $lawless .= '{  y: '.$data5.' , label: "'.$label.'"}';
            if($i+1 !=$amount){
                $theft .= ',';
                $murder .= ',';
                $kontra .= ',';
                $assou .= ',';
                $lawless .= ',';
            }
        }
        $result = '
            <script type="text/javascript">
                window.onload = function () {
                    var chart = new CanvasJS.Chart("chartContainer",
                                {
                                    title:{
                                        text: "Nusikaltimai"
                                    },
                                    data: [
                                        {
                                            type: "stackedColumn",
                                            legendText: "Vagystės",
                                            showInLegend: "true",
                                            dataPoints: [
                                                '.$theft.'

                                            ]
                                        },  
                                        {
                                            type: "stackedColumn",
                                            legendText: "Žmogžudystės",
                                            showInLegend: "true",
                                            dataPoints: [
                                                '.$murder.'

                                            ]
                                        },  
                                        {
                                            type: "stackedColumn",
                                            legendText: "Kontrobandos",
                                            showInLegend: "true",
                                            dataPoints: [
                                                '.$kontra.'

                                            ]
                                        },
                                        {
                                            type: "stackedColumn",
                                            legendText: "Smurtai",
                                            showInLegend: "true",
                                            dataPoints: [
                                                '.$assou.'

                                            ]
                                        },
                                        {
                                            type: "stackedColumn",
                                            legendText: "Nepaklusnumai",
                                            showInLegend: "true",
                                            dataPoints: [
                                                '.$lawless.'

                                            ]
                                        }
                                    ]
                    }
                );

                chart.render();
              }
              </script>
                    ';
        return $result;
    }
     function GetPrisoners() {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetPrisoners();
    }
     function GetOffenses($id) {
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetOffenses($id);
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
    function AddOffense($tipas, $data, $kalinys_id){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->AddOffense($tipas, $data, $kalinys_id);
    }
    function EditPrisoner($id, $asmens_kodas, $vardas, $pavarde, $gimimo_data, $paleidimo_data, $ikalinimo_data){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->EditPrisoner($id, $asmens_kodas, $vardas, $pavarde, $gimimo_data, $paleidimo_data, $ikalinimo_data);
    }
    function EditPrisonerCell($id, $cell){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->EditPrisonerCell($id, $cell);
    }
    function GetOffensesDate($from, $to, $type){
        $prisonerModel = new PrisonerModel();
        return $prisonerModel->GetOffensesDate($from, $to, $type);
    }
}