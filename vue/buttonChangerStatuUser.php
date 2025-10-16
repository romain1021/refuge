<form method="post" action="index.php?page=change_statu_user&iduser=<?php echo htmlspecialchars($_GET['iduser']); ?>">
    <input type="hidden" name="iduser" value="<?php echo htmlspecialchars($_GET['iduser']); ?>">
    <input type="submit" value="Changer le statut de l'utilisateur">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('controlleur/UserController.php');
    $controller = new UserController();
    $iduser = $_POST['iduser'];
    $controller->changeUserStatut($iduser);
    header('Location: index.php?page=vueProfilAdoptant&iduser=' . $iduser);
    exit;
}