<?php
require_once __DIR__ . '/animaux.php';

class Chien extends Animaux
{
    // Race choisie pour l'instance (optionnelle)
    protected ?string $race = null;

    // Liste statique des races de chiens disponibles
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
}
