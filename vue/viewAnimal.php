<?php
require_once 'controlleur/animalController.php';
$controller = new AnimalController();
$animals = $controller->getAnimalById($_GET['id']);
if ($animals->getStatut() != 0) {
    $statut = 'Adopté';
} else {
    $statut = 'Disponible';
}

echo '
    <h1>Fiche de l\'animal</h1>
    <p>Nom : ' . htmlspecialchars($animals->getNom()) . '</p>
    <p>Type : ' . htmlspecialchars($animals->getType()) . '</p>
    <p>Âge : ' . htmlspecialchars($animals->getAge()) . '</p>
    <p>Description : ' . htmlspecialchars($animals->getDescription()) . '</p>

';