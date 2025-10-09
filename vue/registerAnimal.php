<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription d'un animal</title>
</head>
<body>

    <h1>Inscrire un animal</h1>
    <form method="POST" action="registerAnimal.php">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Espèce :</label><br>
    <select name="type" required>
        <option value="chien">Chien</option>
        <option value="chat">Chat</option>
    </select><br><br>

    <label>Âge :</label><br>
    <input type="text" name="age" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" rows="3" cols="30"></textarea><br><br>

    <input type="submit" value="Ajouter">

   

</body>
</html>
<?php
<<<<<<< HEAD
require_once('../controlleur/AnimalController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'])) {

        $type = $_POST['type'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $description = $_POST['description'];

        $animalController = new AnimalController();

        $registerOK = $animalController->registerAnimal($type, $nom, $age, $description);

        if ($registerOK) {
            echo "<p style='color:green;'>Animal ajouté avec succès !</p>";
        } else {
            echo "<p style='color:red;'>Erreur : impossible d’ajouter l’animal.</p>";
        }
    }
}
=======
>>>>>>> 224653ebac13587dadec11f4d97b868084c01720
?>
