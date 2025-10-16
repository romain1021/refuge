<?php

$controller = new AnimalController();
$animaux = $controller->getAnimalListAdopted();
var_dump($animaux); // debug si besoin
if (!empty($animaux)) {
	echo '<div class="animal-list">';
	foreach ($animaux as $animal) {
		$statut = ($animal['user_id'] === null) ? 'Disponible' : 'Adopté';
		echo '<div class="animal">';
		echo '<p><strong>Type :</strong> ' . htmlspecialchars($animal['type']) . '</p>';
		echo '<p><strong>Nom :</strong> ' . htmlspecialchars($animal['nom']) . '</p>';
		echo '<p><strong>Âge :</strong> ' . htmlspecialchars($animal['age']) . '</p>';
		echo '<p><strong>Description :</strong> ' . htmlspecialchars($animal['description']) . '</p>';
		echo '<p><strong>Statut :</strong> ' . htmlspecialchars($statut) . '</p>';
		if ($statut === 'Adopté') {
			$iduser = htmlspecialchars($animal['user_id']);
			$nomAdoptant = htmlspecialchars($animal['user_nom']);
			echo '<p><strong>Adopté par :</strong> <a href="index.php?page=vueProfilAdoptant&iduser=' . $iduser . '">' . $nomAdoptant . '</a> (ID: ' . $iduser . ')</p>';
			echo '<p><strong>Date d\'adoption :</strong> ' . htmlspecialchars($animal['date_adoption']) . '</p>';
		}
		echo '<a href="index.php?page=viewAnimal&id=' . htmlspecialchars($animal['id']) . '">Voir la fiche</a>';
		echo '</div><hr>';
	}
}