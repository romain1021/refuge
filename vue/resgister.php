<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription utilisateur</title>
</head>
<body>

<h2>Formulaire d'inscription </h2>

<!-- Le formulaire -->
<form method="POST" action="resgister.php">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Prénom :</label><br>
    <input type="text" name="prenom" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <label>Adresse :</label><br>
    <input type="text" name="adresse" required><br><br>

    <input type="submit" name="register" value="S'inscrire">
</form>

<?php
// Quand on clique sur "S'inscrire"
if (isset($_POST['register'])) {

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "refuge");

    // Vérifier la connexion
    if ($conn->connect_error) {
        echo "Erreur de connexion : " . $conn->connect_error;
    }

    // Récupérer les valeurs du formulaire
    $id=$_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adresse = $_POST['adresse'];

    // Ajouter l'utilisateur dans la base
    $sql = "INSERT INTO user (id ,nom, prenom, email, password, adresse)
            VALUES ('$id','$nom', '$prenom', '$email', '$password', '$adresse')";

    // Vérifier si l’ajout a fonctionné
    if ($conn->query($sql) === TRUE) {
        echo "<p>Inscription réussie </p>";
    } else {
        echo "<p>Erreur : " . $conn->error . "</p>";
    }

    // Fermer la connexion
    $conn->close();
}
?>

</body>
</html>
