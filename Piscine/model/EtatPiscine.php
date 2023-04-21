<?php
class EtatPiscine
{
    private $id;
    private $label;
    
    public function getId()
    {
        return $this->id;
    }
    public function getLabel()
    {
        return $this->label;
    }

    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }
}