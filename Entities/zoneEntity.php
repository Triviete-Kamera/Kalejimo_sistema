<?php
class ZoneEntity
{
    public $id;
    public $pavadinimas;
    public $tel_nr;
    public $el_pastas;
    public $adresas;
    public $naudotojas_id;
    public $valgykla_id;
    
    function __construct($id, $pavadinimas, $tel_nr, $el_pastas, $adresas, $naudotojas_id, $valgykla_id) {
        $this->id = $id;
        $this->pavadinimas = $pavadinimas;
        $this->tel_nr = $tel_nr;
        $this->el_pastas = $el_pastas;
        $this->adresas = $adresas;
        $this->naudotojas_id = $naudotojas_id;
        $this->valgykla_id = $valgykla_id;


    }
}
?>