<?php
require_once('/../controlleur/UserController.php');

$iduser = $_GET['iduser'];

$controller = new UserController();
$profile = $controller->getProfilAdoptant($iduser);
$user = $profile['userData'];
$adoptions = $profile['adoptions'];

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profil adoptant</title>
</head>
<body>

<h1>Profil de l'adoptant</h1>

<?php if ($user): ?>
    <div class="profile">
        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom'] ?? '') ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom'] ?? '') ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse'] ?? '') ?></p>
        <p><strong>Statut :</strong> <?= htmlspecialchars($user['statut'] ?? '') ?></p>
    </div>
<?php else: ?>
    <p>Profil introuvable.</p>
<?php endif; ?>

<h2>Adoptions</h2>

<?php if (!empty($adoptions)): ?>
    <?php foreach ($adoptions as $ad): ?>
        <div class="adoption">
            <h4><?= htmlspecialchars($ad['animal_nom'] ?? ('Animal #' . ($ad['animal_id'] ?? ''))) ?></h4>
            <p><strong>Espèce :</strong> <?= htmlspecialchars($ad['espece'] ?? '') ?></p>
            <p><strong>Âge :</strong> <?= htmlspecialchars($ad['age'] ?? '') ?></p>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($ad['description'] ?? '')) ?></p>
            <p><strong>Date d'adoption :</strong> <?= htmlspecialchars($ad['adoption_date'] ?? '') ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune adoption trouvée pour cet utilisateur.</p>
<?php endif; ?>

</body>
</html>
