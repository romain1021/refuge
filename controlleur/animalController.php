<?php
require_once ('../model/animaux.php'); 
session_start();

class AnimalController {
    private Animaux $animal;
    private PDO $conn;
    
    public function __construct() {
        $BaseDeDonnees = "mysql:host=localhost;dbname=refuge;charset=utf8";
        $this->conn = new PDO($BaseDeDonnees);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->animal = new Animaux();
    }

    function addAnimal($type, $nom, $age, $description, $statut) {
        if (empty($type) || empty($nom) || empty($age) || empty($description) || empty($statut)) {
            return false; 
        }
        else{
            $result = $this->conn->prepare("INSERT INTO animaux (type, nom, age, description, statut)VALUES (:type, :nom, :age, :description, :statut)");
            $result->bindParam(':type', $type);
            $result->bindParam(':nom', $nom);
            $result->bindParam(':age', $age);
            $result->bindParam(':description', $description);
            $result->bindParam(':statut', $statut);
            return $result->execute();
        }
        
    }

    function editAnimal($id,$type, $nom, $age, $description, $statut) {
        $result = $this->conn->prepare("UPDATE animaux SET type = :type, nom = :nom, age = :age, description = :description, statut = :statut WHERE id = :id");
        $result->bindParam(':type',$type);
        $result->bindParam(':nom',$nom);
        $result->bindParam(':age',$age);
        $result->bindParam(':description',$description);
        $result->bindParam(':statut',$statut);        
        return $result->execute();
    }

    function changerStatut($id) {
        $result = $this->conn->prepare("SELECT statut FROM animaux WHERE id = $id");
        $result->bindParam(':id',$id);
        $result->execute();
        $statutActuel = $result->fetchColumn();

        if($statutActuel==1){
            $nouveauStatut=0;
        }
        else{
            $nouveauStatut=1;
        }

        $modif=$this->conn->prepare("UPDATE animaux SET statut = :statut WHERE id = :id");
        $modif->bindParam(':statut', $nouveauStatut);
        $modif->bindParam(':id', $id);
        $modif->execute();
    }

}

