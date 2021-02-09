<?php
class Animal
{

    // - - - definition des propriétés - - - // 

    // propriétés publiques 
    public $name = "";

    // propriétés privées 
    private $type = "";
    private $color = "";
    private $weight = 0.0;


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
        float $newWeight = 0.02
    ) {
        // on assigne les valeurs des arguments aux propriétés 
        $this->name = $newName;
        $this->type = $newType;
        $this->color = $newColor;
        $this->weight = $newWeight;
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


    // - - - definition des fonctions - - - // 

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
                return 'Je Vole';
                break;
            default:
                return 'Je me déplace';
                break;
        }
    }

    public function eat(Animal $proie)
    {

        $this->weight += $proie->getWeight();
        $proie->weight = 0.0;
    }
}

// $weight = $this->getWeight();
// $this->setWeight($weight += $proie->weight);