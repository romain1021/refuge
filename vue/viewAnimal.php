<?php
require_once 'controlleur/animalController.php';
$controller = new AnimalController();
$animals = $controller->getAnimalById($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adopter'])) {
    if (isset($_SESSION['user_id'])) {
        $controller->Adopter($animals->getId(),$_SESSION['user_id']);
        header('Location: index.php?page=viewAnimal&id=' . $animals->getId());
        exit;
    } else {
        echo '<p style="color:red;">Vous devez être connecté pour adopter.</p>';
    }
}

echo '<h1>Fiche de l\'animal</h1>';
echo '<p>Nom : ' . htmlspecialchars($animals->getNom()) . '</p>';
echo '<p>Type : ' . htmlspecialchars($animals->getType()) . '</p>';
echo '<p>Âge : ' . htmlspecialchars($animals->getAge()) . '</p>';
echo '<p>Description : ' . htmlspecialchars($animals->getDescription()) . '</p>';
if ($animals->getStatut() !=0) {
    $statut = 'Adopté';
    echo '<p>Statut : ' . htmlspecialchars($statut) . '</p>';
} else {
    $statut = 'Disponible';
    echo '<p>Statut : ' . htmlspecialchars($statut) . '</p>';
    echo '<form method="post">
        <input type="submit" name="adopter" value="Adopter ' . htmlspecialchars($animals->getNom()) . '" />
    </form>';
}



