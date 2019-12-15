<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Entities/zoneEntity.php";
require($path);

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
              $valgykla_id = $row[6];

            $zone = new ZoneEntity($id,$pavadinimas,$tel_nr,$el_pastas,$adresas,$naudotojas_id,$valgykla_id);
            array_push($zoneArray,$zone);
        }
        mysqli_close($dbc);
        return $zoneArray;
    }
   
}