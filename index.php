<link rel="stylesheet" href='style.css'>

<?php
require_once("controlleur/UserController.php");
require_once("controlleur/animalController.php");
require_once("model/animaux.php");
require_once("model/user.php");
session_abort();
session_start();
require_once('tests/DEBUG.php');
if(isset($_GET['page'])){
    if ($_GET['page']=="home"){
        require_once('vue/deconnection.php');
        require_once('vue/homes.php');
        require_once('vue/listeAnnimal.php');
    }

    if ($_GET['page']=='inscription'){

        require_once('vue/register.php');
        echo'test';
    }

    if ($_GET['page']=='connexion'){
        require_once('vue/login.php');
    }

    if ($_GET['page']=='profil'){
        require_once('vue/vueProfilAdoptant.php');
    }

    if ($_GET['page']=='registerAnimal'){
        require_once('vue/registerAnimal.php');
    }

    if ($_GET['page']=='viewAnimal'){
        require_once('vue/viewAnimal.php');
    }

    if ($_GET['page']=='vueProfilAdoptant'){
        if($_SESSION['user_statut'] == 0){
            header('Location: index.php?page=home');
        }
        else{
            require_once('vue/vueProfilAdoptant.php');

        }
    }

    if ($_GET['page']=='deconnexion'){
        $userController= new UserController();
        $userController->logout();
    }

    
}

else{
   $_GET['page']=='connexion';
   header('Location: index.php?page=connexion');
}

