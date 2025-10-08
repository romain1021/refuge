<?php
$BaseDeDonnees = 'mysql:host=localhost;dbname=refuge", "root", ""';
class User
{
    private int $id = 0;
    private string $nom = '';
    private string $prenom = '';
    private string $email = '';
    private string $password = '';
    private string $adresse = '';
    private int $statut = 0;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) $this->id = $data['id'];
        if (isset($data['nom'])) $this->nom = $data['nom'];
        if (isset($data['prenom'])) $this->prenom = $data['prenom'];
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['password'])) $this->password = $data['password'];
        if (isset($data['adresse'])) $this->adresse = $data['adresse'];
        if (isset($data['statut'])) $this->statut = $data['statut'];
    }

    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    // nom
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    // prenom
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    // email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    // password (stocke la valeur fournie)
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    // adresse
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    // statut
    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut(int $statut)
    {
        $this->statut = $statut;
        return $this;
    }

    function testUser($username, $password){

        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT id, password FROM User WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && password_verify($password, $result['password'])) {
                setcookie("user_id", $result['id'], time() + 3600, '/');//utiliser la session
                return true;
            } else {
                return false;
            }
    }

    function register($nom, $prenom, $email, $password, $adresse){
        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO User (nom, prenom, email, password, adresse) VALUES (:nom, :prenom, :email, :password, :adresse)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':adresse', $adresse);
            
            return $stmt->execute();
    }

    function fetchUserData($id){
        $conn = new PDO($BaseDeDonnees);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT id, nom, prenom, email, adresse, statut FROM User WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
