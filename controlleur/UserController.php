<?php
declare(strict_types=1);
require_once __DIR__ . '/../model/user.php';
session_start();

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

    public function login($username, $password){
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT id, password FROM User WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
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
        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT * FROM adoptions WHERE user_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $stmt = $conn->prepare("SELECT * FROM animal WHERE id = :idAnimal");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function getProfilAdoptant($iduser){
        $userData = $this->fetchUserData($iduser);
        $adoptionData = $this->getAdoptionFromUser($iduser);

        return ['userData' => $userData, 'adoptions' => $adoptionData];
    }
}

    