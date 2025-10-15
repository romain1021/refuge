<?php
require_once 'controlleur/animalController.php';

$animals = getAnimal($_GET['id']);
if ($animals['statut'] != 0) {
    $statut = 'Adopté';
} else {
    $statut = 'Disponible';
}

echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>fiche annimal</title>
</head>
<body>

    <h1>Fiche de l\'animal</h1>
    <p>Nom : ' . htmlspecialchars($animals['nom']) . '</p>
    <p>Type : ' . htmlspecialchars($animals['type']) . '</p>
    <p>Âge : ' . htmlspecialchars($animals['age']) . '</p>
    <p>Description : ' . htmlspecialchars($animals['description']) . '</p>
    

</body>
</html>';