<?php
require_once __DIR__ . '/../model/animaux.php';
require_once __DIR__ . '/../model/chien.php';
require_once __DIR__ . '/../model/chat.php';
//session_start();

class AnimalController {
    private Animaux $animal;
    private PDO $conn;
    
    public function __construct() {
        $BaseDeDonnees = "mysql:host=localhost;dbname=refuge";
        $this->conn = new PDO($BaseDeDonnees, "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$this->animal = new Animaux();
    }



    function addAnimal(Animaux $animal) {
        $type = $animal->getType();
        $nom = $animal->getNom();
        $age = $animal->getAge();
        $description = $animal->getDescription();
        $statut = $animal->getStatut();
        $race = $animal->getRace();

            $result = $this->conn->prepare("INSERT INTO animaux (type, race, nom, age, description, statut)VALUES (:type, :race, :nom, :age, :description, :statut)");
            $result->bindParam(':type', $type);
            $result->bindParam(':nom', $nom);
            $result->bindParam(':age', $age);
            $result->bindParam(':description', $description);
            $result->bindParam(':statut', $statut);
            $result->bindParam(':race', $race);
            $result->execute();
            return $animal;

        
    }

    function editAnimal(Animaux $animal) {
        $result = $this->conn->prepare("UPDATE animaux SET type = :type, nom = :nom, age = :age, description = :description, statut = :statut WHERE id = :id");
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
        $sql = "SELECT a.*, u.id AS user_id, u.nom AS user_nom, ad.date AS date_adoption
            FROM animaux a
            LEFT JOIN adoptions ad ON a.id = ad.idAnimal
            LEFT JOIN user u ON ad.idAdoptant = u.id
            WHERE ad.date IS NULL
               OR ad.date >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $animaux = [];
        foreach ($rows as $row) {
            $animaux[] = new Animaux($row);
        }
        return $animaux;
    }

function getAnimalById($id) {
        $result = $this->conn->prepare("SELECT * FROM animaux WHERE id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        $infos = $result->fetch(PDO::FETCH_ASSOC);
        return new Animaux($infos);
    }

    function getAnimalListAdopted(){
        $sql = "SELECT a.*, u.id AS user_id, u.nom AS user_nom, ad.date AS date_adoption
            FROM animaux a
            INNER JOIN adoptions ad ON a.id = ad.idAnimal
            INNER JOIN user u ON ad.idAdoptant = u.id
            WHERE ad.date IS NOT NULL";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $animaux = [];
        foreach ($rows as $row) {
            $animaux[] = new Animaux($row);
        }
        return $animaux;
    }

    function getRace(){
        $type = $_GET['type'];
        if($type == 'Chien'){
            return Chien::getRaces();
        }
        elseif($type == 'Chat'){
            return Chat::getRaces();
        }
    }


}