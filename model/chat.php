<?php
require_once __DIR__ . '/animaux.php';

class Chat extends Animaux
{
    // Race choisie pour l'instance (optionnelle)
    protected ?string $race = null;

    // Liste statique des races de chats disponibles
    public static array $Listeraces = ['Siamois','Persan','Maine Coon','British Shorthair','Bengal','Sphynx','Ragdoll','Norvégien','Européen','Scottish Fold'
    ];

    public static function getRaces(): array{
        return self::$Listeraces;
    }

    public function setRace(string $race){
        $this->race = $race;
        return $this;
    }

    public function getRace(): ?string{
        return $this->race;
    }
}
