<?php
declare(strict_types=1);
require_once __DIR__ . '/../controlleur/UserController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $userController = new UserController();
    $loginOK = $userController->login($username, $password);
    if ($loginOK) {
        header('Location: index.php?page=home');
        exit;
    } else {
        $error = "Erreur : identifiant ou mot de passe incorrect.";
    }
}
?>

<?php if (!empty($error)): ?>
    <p style='color:red;'><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username" required />

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required />
    <br>

    <input type="submit" value="Se connecter" />

    <button type="button" onclick="location.href='inscription.php'">Créer un compte</button>
</form>