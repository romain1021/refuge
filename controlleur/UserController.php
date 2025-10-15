<?php
declare(strict_types=1);
require_once __DIR__ . '/../model/user.php';
//session_start();

class UserController{
    private User $user;
    private string $dsn;
    private string $dbUser;
    private string $dbPass;

    public function __construct(){
        $this->user = new User();
        // Database credentials - adjust if needed
        $this->dsn = 'mysql:host=localhost;dbname=refuge;charset=utf8mb4';
        $this->dbUser = 'root';
        $this->dbPass = '';
    }

    private function getConnection(): PDO {
        $conn = new PDO($this->dsn, $this->dbUser, $this->dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function login($email, $password){
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT id, password, statut FROM User WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($result && password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_statut'] = $result['statut'];
            header('Location: index.php?page=home');
            return true;
        }

        return false;
    }

    public function register($nom, $prenom, $email, $password, $adresse){
        // Basic validation
        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($adresse)) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $conn = $this->getConnection();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO User (nom, prenom, email, password, adresse) VALUES (:nom, :prenom, :email, :password, :adresse)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':adresse', $adresse);

        return $stmt->execute();
    }

    public function fetchUserData($id){
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT id, nom, prenom, email, adresse, statut FROM User WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne la liste des adoptions d'un utilisateur avec les informations sur l'animal.
     * Structure retournée: array of ['adoption_id', 'user_id', 'animal_id', 'adoption_date', 'animal.*']
     */
    function getAdoptionFromUser($id){
        $conn = $this->getConnection();
    // Récupère les adoptions de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM adoptions WHERE idAdoptant = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $adoptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($adoptions as $adoption) {
            // Récupère l'animal lié à l'adoption
            $stmt = $conn->prepare("SELECT * FROM animaux WHERE id = :animal_id");
            $stmt->bindParam(':animal_id', $adoption['idAnimal']);
            $stmt->execute();
            $animal = $stmt->fetch(PDO::FETCH_ASSOC);

            // Récupère l'utilisateur (optionnel si besoin d'info complète à chaque entrée)
            $user = $this->fetchUserData($id);

            // Fusionne les infos dans une seule variable
            $result[] = [
                'user' => $user,
                'adoption' => $adoption,
                'animal' => $animal
            ];
        }
        return $result;
        }

    public function getProfilAdoptant($iduser){
        $userData = $this->fetchUserData($iduser);
        $adoptionData = $this->getAdoptionFromUser($iduser);

        return ['userData' => $userData, 'adoptions' => $adoptionData];
    }

    public function logout(){
        session_destroy();
        header('Location: index.php?page=connexion');
    }
}

    