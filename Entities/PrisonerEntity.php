<?php
class PrisonerEntity
{
    public $asmens_kodas;
    public $vardas;
    public $pavarde;
    public $ikalinimo_data;
    public $paleidimo_data;
    public $gimimo_data;
    public $administratorius_id;
    public $kamera_id;
    
    function __construct($asmens_kodas, $vardas, $pavarde, $ikalinimo_data, $paleidimo_data, $gimimo_data, $administratorius_id, $kamera_id) {
        $this->asmens_kodas = $asmens_kodas;
        $this->vardas = $vardas;
        $this->pavarde = $pavarde;
        $this->ikalinimo_data = $ikalinimo_data;
        $this->paleidimo_data = $paleidimo_data;
        $this->gimimo_data = $gimimo_data;
        $this->administratorius_id = $administratorius_id;
        $this->kamera_id = $kamera_id;


    }
}
?>