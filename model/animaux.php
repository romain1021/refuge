<?php
$BaseDeDonnees = 'mysql:host=localhost;dbname=refuge", "root", ""';
class Animaux
{
    private int $id = 0;
    private string $type = '';
    private string $nom = '';
    private string $age = '';
    private string $description = '';
    private int $statut = 0;
    private int $user_id = 0;
    private string $user_nom = '';

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) $this->id =$data['id'];
        if (isset($data['type'])) $this->type = $data['type'];
        if (isset($data['nom'])) $this->nom = $data['nom'];
        if (isset($data['age'])) $this->age = $data['age'];
        if (isset($data['description'])) $this->description = $data['description'];
        if (isset($data['statut'])) $this->statut = $data['statut'];
        if (isset($data['user_id'])) $this->user_id = $data['user_id'];
        if (isset($data['user_nom'])) $this->user_nom = $data['user_nom'];
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

    // type
    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    // nom
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    // age
    public function getAge(): string
    {
        return $this->age;
    }

    public function setAge(string $age)
    {
        $this->age = $age;
        return $this;
    }

    // description
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
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

    // user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    // user_nom
    public function getUserNom()
    {
        return $this->user_nom;
    }

    public function setUserNom(string $user_nom)
    {
        $this->user_nom = $user_nom;
        return $this;
    }
}
