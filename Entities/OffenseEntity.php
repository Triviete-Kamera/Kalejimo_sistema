<?php
class OffenseEntity
{
    public $id;
    public $tipas;
    public $data;
    public $kalinys_id;
    
    function __construct($id, $tipas, $data, $kalinys_id) {
        $this->tipas = $tipas;
        $this->id = $id;
        $this->data = $data;
        $this->kalinys_id = $kalinys_id;

    }
}
?>