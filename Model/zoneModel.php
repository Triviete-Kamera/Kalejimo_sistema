<?php
require(__DIR__."/../Entities/zoneEntity.php");

//Contains database related code for the Coffee page.
class ZoneModel {

   
    function GetZones(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM kalejimo_zona";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $zoneArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $pavadinimas = $row[1];
            $tel_nr = $row[2];
            $el_pastas = $row[3];
            $adresas = $row[4];
             $naudotojas_id = $row[5];
          

            $zone = new ZoneEntity($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id);
            array_push($zoneArray,$zone);
        }
        mysqli_close($dbc);
        return $zoneArray;
    }
    function GetZone($pavadinimas){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM kalejimo_zona WHERE pavadinimas='".$pavadinimas."'";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $row = mysqli_fetch_row($result);

          if($row == NULL){
            return NULL;
        }
            $id = $row[0];
            $pavadinimas = $row[1];
            $tel_nr = $row[2];
            $el_pastas = $row[3];
            $adresas = $row[4];
             $naudotojas_id = $row[5];
          

            $zone = new ZoneEntity($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id);
            
        mysqli_close($dbc);
        return $zone;
    }
    function GetZoneId($id){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM kalejimo_zona WHERE id='".$id."'";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
       
        $row = mysqli_fetch_row($result);
          if($row == NULL){
            return NULL;
        }
            $id = $row[0];
            $pavadinimas = $row[1];
            $tel_nr = $row[2];
            $el_pastas = $row[3];
            $adresas = $row[4];
             $naudotojas_id = $row[5];
          

            $zone = new ZoneEntity($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id);
           
        
        mysqli_close($dbc);
        return $zone;
    }
    function GetUsers(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "SELECT naudotojas_id FROM kalejimo_zona";
        $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
        $userArray = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($userArray,$row);
        }
        mysqli_close($dbc);
        return $userArray;
    }
    function AddZone($zone){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "INSERT INTO kalejimo_zona (pavadinimas, tel_nr, el_pastas, adresas, naudotojas_id)
                    VALUES ('$zone->pavadinimas', '$zone->tel_nr', '$zone->el_pastas', '$zone->adresas', '$zone->naudotojas_id')";
        $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
        mysqli_close($dbc);
    }
    function EditZone($id, $pavadinimas, $tel_nr, $el_pastas, $adresas){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "UPDATE kalejimo_zona SET pavadinimas='$pavadinimas', tel_nr='$tel_nr', el_pastas='$el_pastas',
                                     adresas='$adresas' WHERE id='$id'";
        
       // echo $query;
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        mysqli_close($dbc);
    }
   
}