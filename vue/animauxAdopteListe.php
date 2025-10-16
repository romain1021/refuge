<?php


$controller = new AnimalController();
$animaux = $controller->getAnimalListAdopted();
if (!empty($animaux)) {
    echo '<div class="animal-list">';
    foreach ($animaux as $animal) {
        $statut = ($animal->getUserId() === 0) ? 'Disponible' : 'Adopté';
        echo '<div class="animal">';
        echo '<p><strong>Type :</strong> ' . htmlspecialchars($animal->getType()) . '</p>';
        echo '<p><strong>Nom :</strong> ' . htmlspecialchars($animal->getNom()) . '</p>';
        echo '<p><strong>Âge :</strong> ' . htmlspecialchars($animal->getAge()) . '</p>';
        echo '<p><strong>Description :</strong> ' . htmlspecialchars($animal->getDescription()) . '</p>';
        echo '<p><strong>Statut :</strong> ' . htmlspecialchars($statut) . '</p>';
        if ($statut === 'Adopté') {
            $iduser = htmlspecialchars($animal->getUserId());
            $nomAdoptant = htmlspecialchars($animal->getUserNom());
            echo '<p><strong>Adopté par :</strong> <a href="index.php?page=vueProfilAdoptant&iduser=' . $iduser . '">' . $nomAdoptant . '</a></p>';
        }
        echo '<a href="index.php?page=viewAnimal&id=' . htmlspecialchars($animal->getId()) . '">Voir la fiche</a>';
        echo '</div><hr>';
    }
}