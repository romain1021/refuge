<?php
declare(strict_types=1);
require_once 'model/animaux.php';
session_start();

class animalController{
    private animaux $animal;

    function __construct(){
        $this->animal = new Animaux(); 
    }
    
    function addAnimal($type, $nom, $age, $description, $statut){
        if (empty($type)||empty($nom)||empty($age)||empty($description)||empty($statut)){
            return false;
        }
        return $this->animal->addAnimal($type, $nom, $age, $description, $statut);

    }

}