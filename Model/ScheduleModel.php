<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Entities/ScheduleEntity.php";
require($path);

//Contains database related code for the Coffee page.
class ScheduleModel {

   
    
    function GetSchedule($id){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM tvarkarastis WHERE administratorius_id ='".$id."'";
        $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
        $row = mysqli_fetch_row($result);

          if($row == NULL){
            return NULL;
        }
            $id = $row[0];
            $darbo_pradzia = $row[1];
            $darbo_pabaiga = $row[2];
            $pertrauka = $row[3];
            $pertraukos_trukme = $row[4];
             $pamaina = $row[5];
             $adminstratorius_id = $row[6];
          

            $schedule = new ScheduleEntity($id,$darbo_pradzia,$darbo_pabaiga,$pertrauka,$pertraukos_trukme,$pamaina,$adminstratorius_id);
            
        mysqli_close($dbc);
        return $schedule;
    }
     function GetWho(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "SELECT slapyvardis FROM naudotojas";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $cellArray = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($cellArray,$row['slapyvardis']);
        }
        mysqli_close($dbc);
        return $cellArray;
    }
    function GetId($who){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "SELECT id FROM naudotojas WHERE slapyvardis = '$who'";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
      $row = mysqli_fetch_array($result);
      $res = $row['id'];
        
        mysqli_close($dbc);
        return $res;
    }

    function AddSchedule(ScheduleEntity $schedule){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "INSERT INTO tvarkarastis (darbo_pradza, darbo_pabaiga, pertrauka, pertraukos_trukme, pamaina, administratorius_id)
                    VALUES ('$schedule->darbo_pradzia', '$schedule->darbo_pabaiga', '$schedule->pertrauka', '$schedule->pertraukos_trukme', '$schedule->pamaina', 
                            '$schedule->administratorius_id')";
        
        
        $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
        mysqli_close($dbc);
    }
}