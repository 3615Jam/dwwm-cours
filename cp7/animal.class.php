<?php

class Animal
{

    // - - - definition des propriétés - - - // 

    // propriétés publiques 
    public $name = "";

    // propriétés privées 
    private $type = "";
    private $color = "";
    protected $weight = 0.0;
    private $dob = "";

    // propriétés statiques 
    protected static $nb = 0;

    // - - - definition des constantes de classes - - - // 

    const TYPE_AIR = "aérien";
    const TYPE_WATER = "marin";
    const TYPE_GROUND = "terrestre";
    const TYPE_ELSE = "autre";


    // - - - definition du constructeur - - - //

    public function __construct(
        // on définit les propriétés du constructeur
        string $newName = "",
        string $newType = self::TYPE_ELSE,
        string $newColor = "Blanc",
        float $newWeight = 0.02,
        string $newDob = "1970-01-02"
    ) {
        // on assigne les valeurs des arguments aux propriétés 
        $this->name = $newName;
        $this->setType($newType);
        $this->setColor($newColor);
        $this->setWeight($newWeight);
        $this->setDob($newDob);
        // on incrémente notre compteur d'instance ('$nb', propriété statique)
        self::$nb++;
    }

    // méthode statique pour afficher le nombre d'instances 
    public static function getNb(): int
    {
        return self::$nb;
    }


    // - - - definition du destructeur - - - //

    public function __destruct()
    {
        // on RAZ les propriétés privées de l'animal
        $this->type = self::TYPE_ELSE;
        $this->color = "";
        $this->weight = 0.0;
        // on décrémente notre compteur d'instance ('$nb', propriété statique)
        self::$nb--;
    }


    // - - - definition des accesseurs / mutateurs (getters / setters) - - - //

    // #1 getter pour la variable 'type' : permet de récupérer la valeur d'une variable private
    public function getType(): string
    {
        return $this->type;
    }
    // #2 setter pour la variable 'type' : permet modifier la valeur d'une variable private
    public function setType(string $newType)
    {
        // on veut vérouiller que le type de 'Animal' ne soit qu'une des constantes de classes définies + haut 
        $newType = strtolower($newType);
        if ($newType === self::TYPE_GROUND || $newType === self::TYPE_AIR || $newType === self::TYPE_WATER) {
            $this->type = $newType;
        } else {
            $this->type = self::TYPE_ELSE;
        }
    }

    // getter pour la variable 'color' :
    public function getColor(): string
    {
        return $this->color;
    }
    // setter pour la variable 'color' :
    public function setColor(string $newColor)
    {
        $this->color = $newColor;
    }

    // getter pour la variable 'weight' :
    public function getWeight(): float
    {
        return $this->weight;
    }
    // setter pour la variable 'weight' :
    public function setWeight(float $newWeight)
    {
        if ($newWeight >= 0.02 && $newWeight <= 1100) {
            $this->weight = $newWeight;
        } else {
            throw new Exception('Le poids doit être compris entre 0.02 et 1100 kg');
        }
    }
    // getter pour la variable 'dob' :
    public function getDob(): string
    {
        return $this->dob;
    }
    // setter pour la variable 'dob' :
    public function setDob(string $newDob)
    {
        if ($this->isDate($newDob)) {
            $this->dob = $newDob;
        } else {
            throw new Exception('L\'argument passé en paramètre n\'est pas une date !');
        }
    }


    // - - - definition des méthodes - - - // 

    // #1 : méthode pour le déplacement 
    public function move(): string
    {
        $type = $this->getType();
        switch ($type) {
            case self::TYPE_WATER:
                return 'Je nage';
                break;
            case self::TYPE_GROUND:
                return 'Je marche';
                break;
            case self::TYPE_AIR:
                return 'Je vole';
                break;
            default:
                return 'Je me déplace';
                break;
        }
    }

    // #2 : méthode pour l'alimentation 
    public function eat(Animal $proie)
    {
        // un animal mange un autre animal : 
        // le prédateur gagne le poids de la proie
        $this->weight += $proie->getWeight();
        // la proie perd son poids
        $proie->weight = 0.0;
    }


    // - - - definition des fonctions - - - // 

    // fonctions privées = pour usage interne
    private function isDate($arg): bool
    {
        return (bool) strtotime($arg);
    }

    // fonctions publiques = pour tout le monde 
    public function getAge(): int
    {
        $d1 = strtotime($this->getDob());
        $d2 = strtotime(date('Y-m-d'));
        $diff = $d2 - $d1;
        return floor($diff / 60 / 60 / 24 / 365.25);
    }
}
