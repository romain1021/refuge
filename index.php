<?php
require_once("vue/header.php");
require_once("controlleur/UserController.php");
require_once("controlleur/animalController.php");
require_once("model/animaux.php");
require_once("model/user.php");
echo "<link rel=stylesheet href='style.css'>";
session_abort();
session_start();
if(isset($_GET['page'])){
    if ($_GET['page']=="home"){
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
            require_once('vue/buttonChangerStatuUser.php');

        }
    }

    if ($_GET['page']=='deconnexion'){
        $userController= new UserController();
        $userController->logout();
    }

    if ($_GET['page']=='adoptedAnimals'){
        require_once('vue/animauxAdopteListe.php');
    }

    
}

else{
   $_GET['page']=='connexion';
   header('Location: index.php?page=connexion');
}

require_once("vue/footer.php");
