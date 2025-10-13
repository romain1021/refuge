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
require_once('controller/UserController.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['email'])){

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $adresse=$_POST['adresse'];
    $password=$_POST['password'];

$userController=new UserController();

$registerOK=$userController->register($nom,$prenom,$email,$password,$adresse);

if($registerOK){
    echo "<p style='color:green;'>Inscription réussie !</p>";
}else{
    echo "<p style='color:red;'>Erreur : email déjà utilisé ou données incorrectes.</p>";
        }
    }
}
?>

</body>
</html>
