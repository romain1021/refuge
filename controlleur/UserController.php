<?php 
require_once("../Models/user.php");
session_start();

class UserController{
    function login($identifiants, $mdp){
        $user= getPasswordfromUser($identifiants);

        if(!$user){
            return false;
        }

        if(password_verify($mdp, $user['password'])){
            $_SESSION['id_user']=$user['id'];
            $_SESSION['statut_user']=$user['statut'];
            return true;
        }
        return false;
    }

}