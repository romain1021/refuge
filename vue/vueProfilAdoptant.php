<?php
require_once('controlleur/UserController.php');
//le lien pour acceder a cette pageindex.php?page=vueProfilAdoptant&iduser=2
$iduser = $_GET['iduser'];
$controller = new UserController();

$adoptions = $controller->getAdoptionFromUser($iduser);
$user = !empty($adoptions) ? $adoptions[0]['user'] : $controller->fetchUserData($iduser);
?>
<h1>Profil de l'adoptant</h1>

<?php if ($user): ?>
    <div class="profile">
        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom'] ?? '') ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom'] ?? '') ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse'] ?? '') ?></p>
    </div>
<?php else: ?>
    <p>Profil introuvable.</p>
<?php endif; ?>

<h2>Adoptions</h2>


<?php if (!empty($adoptions)): ?>
    <?php foreach ($adoptions as $ad): ?>
        <h4>---------</h4>
        <?php $animal = $ad['animal'] ?? [];
              $adoption = $ad['adoption'] ?? [];
        ?>
        <div class="adoption">
            <h4>Nom : <?= htmlspecialchars($animal['nom'] ?? ('Animal #' . ($animal['id'] ?? ''))) ?></h4>
            <p><strong>Espèce :</strong> <?= htmlspecialchars($animal['type'] ?? '') ?></p>
            <p><strong>Âge :</strong> <?= htmlspecialchars($animal['age'] ?? '') ?></p>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($animal['description'] ?? '')) ?></p>
            <p><strong>Date d'adoption :</strong> <?= htmlspecialchars($adoption['date'] ?? '') ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune adoption trouvée pour cet utilisateur.</p>
<?php endif; ?>