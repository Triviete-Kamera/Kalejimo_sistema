<?php
class ScheduleEntity
{
    public $id;
    public $darbo_pradzia;
    public $darbo_pabaiga;
    public $pertrauka;
    public $pertraukos_trukme;
    public $pamaina;
    public $administratorius_id;
   
    
    function __construct($id, $darbo_pradzia, $darbo_pabaiga, $pertrauka, $pertraukos_trukme, $pamaina,$administratorius_id) {
        $this->id = $id;
        $this->darbo_pradzia = $darbo_pradzia;
        $this->darbo_pabaiga = $darbo_pabaiga;
        $this->pertrauka = $pertrauka;
        $this->pertraukos_trukme = $pertraukos_trukme;
        $this->pamaina = $pamaina;
       $this->administratorius_id = $administratorius_id;


    }
}
?>