<?php
$BaseDeDonnees = 'mysql:host=localhost;dbname=refuge", "root", ""';
abstract class User
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

    abstract public function getRole();

    
}
