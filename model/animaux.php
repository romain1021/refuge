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

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) $this->id =$data['id'];
        if (isset($data['type'])) $this->type = $data['type'];
        if (isset($data['nom'])) $this->nom = $data['nom'];
        if (isset($data['age'])) $this->age = $data['age'];
        if (isset($data['description'])) $this->description = $data['description'];
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

    function fetchAnimalData($id){
        global $BaseDeDonnees;
        $pdo = new PDO($BaseDeDonnees);
        $stmt = $pdo->prepare("SELECT * FROM animaux WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function createAnimal($type, $nom, $age, $description, $statut){
        global $BaseDeDonnees;
        $pdo = new PDO($BaseDeDonnees);
        $stmt = $pdo->prepare("INSERT INTO animaux (type, nom, age, description, statut) VALUES (:type, :nom, :age, :description, :statut)");
        $stmt->execute([
            'type' => $type,
            'nom' => $nom,
            'age' => $age,
            'description' => $description,
            'statut' => $statut
        ]);
        return $pdo->lastInsertId();
    }

    function getAllAnimalAvailable(){
        global $BaseDeDonnees;
        $pdo = new PDO($BaseDeDonnees);
        $stmt = $pdo->query("SELECT * FROM animaux WHERE statut = 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
}
