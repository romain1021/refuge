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
if (!empty($_SESSION)) {
    echo '<p>Bienvenue!</p>';
    echo '<button onclick="location.href=\'index.php?page=deconnexion\'" class="btn-deconnexion">Se déconnecter</button>';
    echo '<button onclick="location.href=\'index.php?page=adoptedAnimals\'" class="btn-adopted">Animaux adoptés</button>';
    echo '<button onclick="location.href=\'index.php?page=home\'" class="btn-home">Accueil</button>';
}
    
?>
