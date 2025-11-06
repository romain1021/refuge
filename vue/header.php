<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
    <title>Refuge Animaux</title>

<?php
session_start();
// Header structure : deux zones pour appliquer le CSS (.header-left / .header-right)
echo '<header>';
echo '<div class="header-left">';
echo '<a href="index.php?page=home" class="logo">Refuge Animaux</a>';
echo '</div>';
echo '<div class="header-right">';
if (!empty($_SESSION)) {
    echo '<nav class="nav"><ul>';
    echo '<li><a href="index.php?page=adoptedAnimals" class="btn btn-adopted">Animaux adoptés</a></li>';
    echo '<li><a href="index.php?page=home" class="btn btn-home">Accueil</a></li>';
    echo '<li><a href="index.php?page=vueProfilAdoptant&iduser=' . $_SESSION['user_id'] . '" class="btn btn-home">Mon Profil</a></li>';

    if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 1) {
        echo '<li><a href="index.php?page=registerAnimalSelect" class="btn btn-register-animal">Enregistrer un animal</a></li>';
    }
    echo '<li><a href="index.php?page=deconnexion" class="btn btn-deconnexion">Se déconnecter</a></li>';
    echo '</ul></nav>';

}
echo '</div>';
echo '</header>';
?>
