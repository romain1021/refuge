<form action="" method="post">
        <label for="email">Nom d'utilisateur :</label>
        <input type="text" name="email" id="email" required />
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required />
        <br>
        
        <input type="submit" value="Se connecter" />

        <button type="button" onclick="location.href='inscription.php'">Créer un compte</button>
    </form>
</body>
</html>
    
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login($_POST['email'], $_POST['password']);
}
?>