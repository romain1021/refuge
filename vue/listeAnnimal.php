<?php

$controller = new AnimalController();
$animaux = $controller->getAllAnnimaux();
if (!empty($animaux)) {
	echo '<div class="animal-list">';
	foreach ($animaux as $animal) {
		echo '<div class="animal">';
		echo '<p><strong>Type :</strong> ' . htmlspecialchars($animal['type']) . '</p>';
		echo '<p><strong>Nom :</strong> ' . htmlspecialchars($animal['nom']) . '</p>';
		echo '<p><strong>Âge :</strong> ' . htmlspecialchars($animal['age']) . '</p>';
		echo '<p><strong>Description :</strong> ' . htmlspecialchars($animal['description']) . '</p>';
		echo '<p><strong>Statut :</strong> ' . htmlspecialchars($animal['statut']) . '</p>';
		echo '</div><hr>';
	}
} 
