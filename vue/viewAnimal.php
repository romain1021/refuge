<?php
require_once 'controlleur/animalController.php';
$controller = new AnimalController();
$animals = $controller->getAnimalById($_GET['id']);
if ($animals['statut'] != 0) {
    $statut = 'Adopté';
} else {
    $statut = 'Disponible';
}

echo '
    <h1>Fiche de l\'animal</h1>
    <p>Nom : ' . htmlspecialchars($animals['nom']) . '</p>
    <p>Type : ' . htmlspecialchars($animals['type']) . '</p>
    <p>Âge : ' . htmlspecialchars($animals['age']) . '</p>
    <p>Description : ' . htmlspecialchars($animals['description']) . '</p>
    

</body>
</html>';