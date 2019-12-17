<?php
//$path = $_SERVER['DOCUMENT_ROOT'];
$path = __DIR__.'/../Model/ScheduleModel.php';
require($path);
class ScheduleController {
    function CreateTable($aid) {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td><b>Darbo pradžia</b></td>
                    <td><b>Darbo pabaiga</b></td>
                    <td><b>Pertraukos pradžia</b></td>
                    <td><b>Pertraukos trukmė</b></td>
                    
                    
                </tr>";


        $schedule = $this->GetSchedule($aid);

        if ($schedule == NULL) {
            $result =  "<h3>Jums nėra sukurtas tvarkaraštis.</h3>" ;         
        }
        else{
            $result = $result .
                    "<tr>
                       
                        <td>$schedule->darbo_pradzia</td>
                        <td>$schedule->darbo_pabaiga</td>
                        <td>$schedule->pertrauka</td>
                        <td>$schedule->pertraukos_trukme</td>
                        
                         
                    </tr>";
        }
        
        
        
        

        $result .=  "</table>";
        
        return $result;
    }
    function GetSchedule($aid) {
        $scheduleModel = new ScheduleModel();
        //print_r($scheduleModel->GetSchedule($pavadinimas));
        return $scheduleModel->GetSchedule($aid);
    }
     function GetWhoOptions() {
        $cells = $this->GetWho();
        $res = "";
        foreach ($cells as $key => $value) {
            $res .= "<option value ='$value'>$value</option>";
        }
        return $res;
    }
    function GetWho() {
        $sheduleModel = new ScheduleModel();
        return $sheduleModel->GetWho();
    }
    function GetId($who) {
        $sheduleModel = new ScheduleModel();
        return $sheduleModel->GetId($who);
    }
    function AddSchedule($darbo_pradzia, $darbo_pabaiga, $pertrauka, $pertraukos_trukme, $pamaina, $administratorius_id){
        $scheduleModel = new ScheduleModel();
        return $scheduleModel->AddSchedule(new ScheduleEntity(-1,$darbo_pradzia,$darbo_pabaiga,$pertrauka,$pertraukos_trukme,$pamaina,$administratorius_id));
    }
}
