
<body>
    <h1>Inscrire un animal</h1>
    <form method="post" action="registerAnimal.php?page=ajoute_animal">
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

