<?php
session_start();
include "Controllers/ScheduleController.php";
$title = "Zonu sarasas";

$scheduleController = new ScheduleController();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
   
        $navigation = '';
    $content = $scheduleController->CreateTable($_SESSION['id']);
    
    include "Template.php";
    
}else{
    header("location: index.php");
}