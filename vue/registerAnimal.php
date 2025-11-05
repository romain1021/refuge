<?php

$listeRace = [];
$controller = new AnimalController();

// normaliser le type depuis le GET (ex: "Chat" ou "Chien")
$type = $_GET['type'];

$listeRace = $controller->getRace();
if (!is_array($listeRace)) {
    $listeRace = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // récupérer les champs POST
    $nom = $_POST['nom'] ?? '';
    $age = $_POST['age'] ?? '';
    $description = $_POST['description'] ?? '';
    $raceSelected = $_POST['race'] ?? null;

    $data = [
        'nom' => $nom,
        'age' => $age,
        'description' => $description,
        'statut' => 0
    ];

    // instancier la bonne classe selon le type
    if ($type === 'Chien') {
        $animal = new Chien($data);
        if ($raceSelected) $animal->setRace($raceSelected);
    } elseif ($type === 'Chat') {
        $animal = new Chat($data);
        if ($raceSelected) $animal->setRace($raceSelected);
    } else {
        echo "<p style='color:red;'>Type d'animal invalide.</p>";
        $animal = null;
    }

    if ($animal !== null) {
        $controller = new AnimalController();
        $controller->addAnimal($animal);
        echo "<h2>Animal ajouté avec succès !</h2>";
        // optionnel : redirection vers la liste ou la fiche
        // header('Location: index.php?page=home'); exit;
    }
}
?>
<body>
    <h1>Inscrire un <?php echo htmlspecialchars($type ?: 'animal'); ?></h1>
    <form method="POST" action="index.php?page=registerAnimal&type=<?php echo htmlspecialchars($type); ?>">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Race :</label><br>
    <select name="race" required>
        <?php
        foreach($listeRace as $race){
            echo '<option value="'.htmlspecialchars($race).'">'.htmlspecialchars($race).'</option>';
        }
        ?>
    </select><br><br>

    <label>Âge :</label><br>
    <input type="text" name="age" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" rows="3" cols="30"></textarea><br><br>

    <label>Statut :</label><br>
        <select name="statut" required>
            <option value="0">Disponible</option>
            <option value="1">Adopté</option>
        </select><br><br>

    <input type="submit" value="Ajouter">

</body>
</html>
