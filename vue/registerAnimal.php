<?php

$listeRace = [];
$controller = new AnimalController();
$listeRace = $controller->getRace();
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data=[
        'nom'=>$_POST['nom'],
        'type'=>$_POST['type'],
        'age'=>$_POST['age'],
        'description'=>$_POST['description'],
        'statut'=>0 
    ];

    $animal=new Animaux($data);
    $controller = new AnimalController();
    $controller->addAnimal($animal);

    echo "<h2>Animal ajouté avec succès !</h2>";

}
?>
<body>
    <h1>Inscrire un <?php echo htmlspecialchars($_GET['type']); ?></h1>
    <form method="POST" action="index.php?page=registerAnimal">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Race :</label><br>
    <select name="type" required>
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
