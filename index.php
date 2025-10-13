<link rel="stylesheet" href='style.css'>

<?php
require_once("controlleur/UserController.php");
require_once("controlleur/animalController.php");
require_once("model/animaux.php");
require_once("model/user.php");


if(isset($_GET['page'])){
    if ($_GET['page']=="home"){
        require_once('vue/homes.php');
    }

    if ($_GET['page']=='inscription'){

        require_once('vue/register.php');
        echo'test';
    }

    if ($_GET['page']=='profil'){
        require_once('vue/vueProfilAdoptant.php');
    }

    
}

else{
   // require("vue/login.php");
}