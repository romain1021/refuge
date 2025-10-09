<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil du refuge</title>
</head>
<body>

<h2>Animaux disponibles </h2>
<form method="POST" action="homes.php">
    <h3>Ajouter un animal</h3>
    <label>Nom:</label>
    <input type="text"name="nom" required><br><br>

    <label>Espèce:</label>
    <input type="text" name="nom" required><br><br>

    <label> Age:</label>
    <input type="number" name="age"required><br><br>

    <label>Description:</label>
    <input type="text" name="description" required><br><br>

</body>
</html>
<?php
require_once('../controlleur/animalControlleur.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['nom'])){
         $type = $_POST['type'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $description = $_POST['description'];
        $statut=1; //satut1 = disponible

    $animalController=new animalController();
    $ajoutOK=$animalController->addAnimal($type,$nom,$age,$description,$statut);

    if($ajoutOK){
        echo "<p style='color:green;'>Animal ajouté avec succès !</p>";
    }else{
        echo "<p style='color:red;'>Erreur lors de l'ajout.</p>";
    }

    }


}

?>
