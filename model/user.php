<?php
declare(strict_types=1);

/**
 * Classe User minimale avec getters et setters.
 */

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
        if (isset($data['id'])) $this->id = (int)$data['id'];
        if (isset($data['nom'])) $this->nom = (string)$data['nom'];
        if (isset($data['prenom'])) $this->prenom = (string)$data['prenom'];
        if (isset($data['email'])) $this->email = (string)$data['email'];
        if (isset($data['password'])) $this->password = (string)$data['password'];
        if (isset($data['adresse'])) $this->adresse = (string)$data['adresse'];
        if (isset($data['statut'])) $this->statut = (int)$data['statut'];
    }

    // id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    // nom
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    // prenom
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    // email
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // password (stocke la valeur fournie)
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    // adresse
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    // statut
    public function getStatut(): int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    function testUser($username, $password){
        $conn = new PDO("mysql:host=localhost;dbname=CoffreFortNum", "root", "");
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
}
