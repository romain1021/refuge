<?php
require_once __DIR__ . '/animaux.php';

class Chien extends Animaux
{
    private string $race = '';
    
    public static array $races = ['Labrador','Golden Retriever','Berger Allemand','Bouledogue Français','Beagle','Teckel','Yorkshire','Border Collie','Bichon Frisé','Rottweiler'];

    public static function getRaces(): array{
        return self::$races;
    }

    public function setRace(string $race){

        $this->race = $race;
        return $this;
    }

    public function getRace(): ?string{
        return $this->race;
    }

    public function getType(): string {
        return 'Chien';
    }
    
    public function afficher(){
        return "Chien : " . $this->getNom() . ", " . $this->getAge() . " ans, " . $this->getDescription(). ", " .$this->getStatut();
    }
    
}
