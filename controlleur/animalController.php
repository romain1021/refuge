<?php
require_once ('../model/animaux.php');
//session_start();

class AnimalController {
    private Animaux $animal;
    private PDO $conn;
    
    public function __construct() {
        $BaseDeDonnees = "mysql:host=localhost;dbname=refuge";
        $this->conn = new PDO($BaseDeDonnees, "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->animal = new Animaux();
    }



    function addAnimal(Animaux $animal) {
        $type = $animal->getType();
        $nom = $animal->getNom();
        $age = $animal->getAge();
        $description = $animal->getDescription();
        $statut = $animal->getStatut();

       if (!isset($type) || !isset($nom) || !isset($age) || !isset($description) ||!isset($statut)) {
            return false; 
        }
        else{
            $result = $this->conn->prepare("INSERT INTO animaux (type, nom, age, description, statut)VALUES (:type, :nom, :age, :description, :statut)");
            $type = $animal->getType();
            $nom = $animal->getNom();
            $age = $animal->getAge();
            $description = $animal->getDescription();
            $statut = $animal->getStatut();

            $result->bindParam(':type', $type);
            $result->bindParam(':nom', $nom);
            $result->bindParam(':age', $age);
            $result->bindParam(':description', $description);
            $result->bindParam(':statut', $statut);
            return $animal;
        }
        
    }

    function editAnimal(Animaux $animal) {
        $result = $this->conn->prepare("UPDATE animaux SET type = :type, nom = :nom, age = :age, description = :description, statut = :statut WHERE id = :id");
        $result->bindParam(':type',$animal->getType());
        $result->bindParam(':nom',$animal->getNom());
        $result->bindParam(':age',$animal->getAge());
        $result->bindParam(':description',$animal->getDescription());
        $result->bindParam(':statut',$animal->getStatut());        
        $result->execute();
        
        $modifie = $this->conn->prepare("SELECT * FROM animaux WHERE id = :id");
        $modifie->bindParam(':id', $animal->getId());
        $modifie->execute();
        $infos = $modifie->fetch(PDO::FETCH_ASSOC);

        return new Animaux($infos);
       
    }

    function changerStatut($id) {
        $result = $this->conn->prepare("SELECT statut FROM animaux WHERE id = :id");
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
        return $nouveauStatut;
    }

    function getAllAnnimaux() {
        $result = $this->conn->prepare("SELECT * FROM animaux");
        $result->execute();
        $ligne = $result->fetchAll(PDO::FETCH_ASSOC);
       
        $animaux = []; 
        foreach ($ligne as $infos){
            $animaux[] = new Animaux($infos);
        }
        return $animaux;
    }   
    
    function getAnimalListHome(){
        $sql = "SELECT a.* FROM animaux a
            LEFT JOIN adoptions ad ON a.id = ad.idAnimal
            WHERE ad.date IS NULL
            OR ad.date >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


}

