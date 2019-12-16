<?php
//$path = $_SERVER['DOCUMENT_ROOT'];
$path = __DIR__."/../Entities/PrisonerEntity.php";
require($path);

//Contains database related code for the Coffee page.
class PrisonerModel {

   
    function GetPrisoners(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM kalinys";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $prisonerArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $asmens_kodas = $row[0];
            $vardas = $row[1];
            $pavarde = $row[2];
            $ikalinimo_data = $row[3];
            $paleidimo_data = $row[4];
            $gimimo_data = $row[5];
            $administratorius_id = $row[6];
            $kamera_id = $row[7];

            $prisoner = new PrisonerEntity($asmens_kodas,$vardas,$pavarde,$ikalinimo_data,$paleidimo_data,$gimimo_data,$administratorius_id,$kamera_id);
            array_push($prisonerArray,$prisoner);
        }
        mysqli_close($dbc);
        return $prisonerArray;
    }
    function GetPrisoner($asmens_kodas){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }

        $query = "SELECT * FROM kalinys WHERE asmens_kodas='".$asmens_kodas."'";
        $result = mysqli_query($dbc,$query) or die(mysql_error());

        $row = mysqli_fetch_row($result);

            $vardas = $row[1];
            $pavarde = $row[2];
            $ikalinimo_data = $row[3];
            $paleidimo_data = $row[4];
            $gimimo_data = $row[5];
            $administratorius_id = $row[6];
            $kamera_id = $row[7];

        $prisoner = new PrisonerEntity($asmens_kodas,$vardas,$pavarde,$ikalinimo_data,$paleidimo_data,$gimimo_data,$administratorius_id,$kamera_id);
        
        mysqli_close($dbc);
        return $prisoner;
    }

    function AddPrisoner($prisoner){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "INSERT INTO kalinys (asmens_kodas, vardas, pavarde, ikalinimo_data, paleidimo_data, gimimo_data, administratorius_id, kamera_id)
                    VALUES ($prisoner->asmens_kodas, $prisoner->vardas, $prisoner->pavarde, $prisoner->ikalinimo_data, $prisoner->paleidimo_data, 
                            $prisoner->gimimo_data, $prisoner->administratorius_id, $prisoner->kamera_id)";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        mysqli_close($dbc);
    }
    function GetAdministrators(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "SELECT asmens_kodas,vardas,pavarde FROM naudotojas WHERE vartotojo_tipas='administratorius'";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $adminArray = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($adminArray,$row);
        }
        mysqli_close($dbc);
        return $adminArray;
    }
    function GetCells(){
         require ('Credentials.php');
        //Open connection and Select database.     
        $dbc=mysqli_connect($host, $user, $passwd,$database);
        if(!$dbc){
            die ("WTF" .mysql_error($dbc));
        }
        $query = "SELECT kameros_nr FROM kamera";
        $result = mysqli_query($dbc,$query) or die(mysql_error());
        $cellArray = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($cellArray,$row);
        }
        mysqli_close($dbc);
        return $cellArray;
    }
   
}