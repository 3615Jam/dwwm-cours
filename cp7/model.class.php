<?php

/**
 * Mini framework en PHP objet qui permet de réaliser un CRUD sur une table d'une BDD MySQL / MariaDB 
 * Etend la classe Singleton
 */

include_once('singleton.class.php');

class Model extends Singleton
{
    // attributs privés 
    private $db = null;
    private $table = '';

    /**
     * Contructeur de la classe 
     * 
     * @param string $newTable  Nom de la table 
     */

    public function __construct(
        string $newHost,
        string $newPort,
        string $newDbName,
        string $newUser,
        string $newPass,
        string $newTable,
        array $newOptions = array()
    ) {
        parent::setConfiguration(
            $newHost,
            $newPort,
            $newDbName,
            $newUser,
            $newPass,
            $newOptions
        );
        $this->db = parent::getPDO();
        $this->table = $newTable;
    }

    /**
     * Méthode qui renvoie toutes les lignes d'un SELECT sous forme de tableau associatif
     * 
     * @return array Résultat de la requête SELECT
     */

    public function getRows(): array
    {
        try {
            $qry = $this->db->query('SELECT * FROM ' . $this->table);
            return $qry->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(__CLASS__ . ' : ' . $e->getMessage());
        }
    }

    /**
     * Méthode qui renvoie une seule ligne d'un SELECT sous forme de tableau associatif 
     * 
     * @param   string  $pk     Nom de la colonne clé primaire
     * @param   string  $id     Valeur de l'ID recherché 
     * 
     * @return  array           Résultat de la requête SELECT 
     */

    public function getRow(string $pk, string $id): array
    {
        try {
            $qry = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $pk . '=?');
            $qry->execute(array($id));
            return $qry->fetch();
        } catch (PDOException $e) {
            throw new PDOException(__CLASS__ . ' : ' . $e->getMessage());
        }
    }


    // requete INSERT 
    public function insert(array $post = array())
    {
        if empty($post) {
            throw new Exception(__CLASS__ . ' : Le tableau ne doit pas être vide.');
        } else {
            foreach($post as $key=>$val) {
                $vals[":$key"] = $val;
            }
            $sql = 'INSERT INTO ' . $this->table .' VALUES ';
            implode(',', array_keys($vals))
            
        }
    }





    // requete UPDATE 
    public function update(array $post = array()) {

    }
    
}
