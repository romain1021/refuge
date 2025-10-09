<?php
declare(strict_types=1);
require_once ('../model/user.php');
session_start();

class UserController{
    private User $user;

    public function __construct(){
        $this->user = new User(); 
    }

    function login($username, $password){

        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT id, password FROM User WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                return true;
            } else {
                return false;
            }
    }



    function register($nom,$prenom,$email,$password,$adresse){

         $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO User (nom, prenom, email, password, adresse) VALUES (:nom, :prenom, :email, :password, :adresse)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':adresse', $adresse);
            
            return $stmt->execute();
        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($adresse)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

    }
    
    function fetchUserData($id){
        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT id, nom, prenom, email, adresse, statut FROM User WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

    