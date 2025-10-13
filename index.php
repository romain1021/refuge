<link rel="stylesheet" href='style.css'>

<?php
require_once("controlleur/UserController.php");
require_once("controlleur/animalController.php");
require_once("model/animaux.php");
require_once("model/user.php");
session_abort();
session_start();

if(isset($_GET['page'])){
    if ($_GET['page']=="home"){
        require_once('vue/homes.php');
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
        require_once('vue/vueProfilAdoptant.php');
    }

    
}

else{
   $_get=='connexion';
}