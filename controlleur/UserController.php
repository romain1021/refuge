<?php
declare(strict_types=1);
require_once 'model/User.php';
session_start();

class UserController{
    private User $user;

    public function __construct(){
        $this->user = new User(); 
    }
    
    public function login(string $username, string $password){
        
        $isValid = $this->user->testUser($username, $password);

        if ($isValid) {
            $userId = $_COOKIE['id_user'];

            if ($userId) {
                $data = $this->user->fetchUserData($userId);
                $this->user = new User($data); 

                $_SESSION['id_user'] = $this->user->getId();
                $_SESSION['statut'] = $this->user->getStatut(); 

                return true;
            } 
        }

        return false;
    }


    function register($nom,$prenom,$email,$password,$adresse){
        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($adresse)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

    }
    
    function getUserById(){
        if (isset($_SESSION['id_user'])) {
            $data = $this->user->fetchUserData($_SESSION['id_user']);
            return new User($data);
        }
    }
}

    