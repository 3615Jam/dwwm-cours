<?php

include_once('animal.class.php');

class Human extends Animal
{
    // - - - definition des propriétés privées - - - //
    private $fname = '';


    // - - - definition du constructeur - - - //
    public function __construct(string $newFname, string $newDob)
    {
        // on valorise les attributs
        $this->setFName($newFname);
        $this->setDob($newDob);
        // on incrémente le nombre d'instances
        parent::$nb++;
    }


    // - - - definition des getters / setters - - - //

    // on "surcharge" le mutateur 'setWeight' de 'Animal' pour l'adapter à 'Human'
    public function setWeight($newWeight)
    {
        if (
            $newWeight >= 1 && $newWeight <= 300
        ) {
            $this->weight = $newWeight;
        } else {
            throw new Exception('Le poids doit être compris entre 1 et 300 kg');
        }
    }

    // getter pour 'fname'
    public function getFName(): string
    {
        return $this->fname;
    }

    // setter pour 'fname'
    public function setFName(string $newFname)
    {
        $this->fname = $newFname;
    }
}
