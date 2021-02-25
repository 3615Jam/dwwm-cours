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
            $sql = 'SELECT * FROM ' . $this->table;
            $qry = $this->db->query($sql);
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
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $pk . '=?';
            $qry = $this->db->prepare($sql);
            $qry->execute(array($id));
            return $qry->fetch();
        } catch (PDOException $e) {
            throw new PDOException(__CLASS__ . ' : ' . $e->getMessage());
        }
    }


    /**
     * Méthode qui insère une ligne dans la table en cours 
     * 
     * @param array $post - tableau du type $_POST
     */

    public function insert(array $post = array()): int
    {
        if (empty($post)) {
            throw new Exception(__CLASS__ . ' : Le tableau ne doit pas être vide.');
        } else {
            foreach ($post as $key => $val) {
                $vals[":$key"] = $val;
            }
            $sql = 'INSERT INTO ' . $this->table . '(' . implode(',', array_keys($post)) . ') VALUES(' . implode(',', array_keys($vals)) . ')';
            // $sql = sprintf(
            //     $sql,
            //     implode(',', array_keys($post)),
            //     implode(',', array_keys($vals))
            // );
            try {
                $qry = $this->db->prepare($sql);
                $qry->execute($vals);
                return $qry->rowCount();
            } catch (PDOException $err) {
                throw new PDOException(__CLASS__ . ' : ' . $err->getMessage());
            }
        }
    }



    /**
     * Méthode qui met à jour une ligne dans la table 
     * 
     * @param   array   $post   Tableau du type $_POST
     * @param   string  $pk     Colonne clé primaire
     * @param   string  $id     Valeur de la l'ID recherché
     * 
     * @return  int             Nombre de lignes impactées (défaut 1)
     */

    public function update(array $post, string $pk, string $id): int
    {
        foreach ($post as $key => $val) {
            $vals[":$key"] = $val;
            $set[] = $key . '=:' . $key;
        }
        $vals[':id'] = $id;
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $set) . ' WHERE ' . $pk . '=:id';
        try {
            $qry = $this->db->prepare($sql);
            $qry->execute($vals);
            return $qry->rowCount();
        } catch (PDOException $err) {
            throw new PDOException(__CLASS__ . ' : ' . $err->getMessage());
        }
    }

    /**
     * Méthode qui supprime une ligne de la table en cours  
     * 
     * @param   string  $pk     Colonne clé primaire
     * @param   string  $id     Valeur de la l'ID recherché
     * 
     * @return  int             Nombre de ligne supprimée (1 par défaut)
     */

    public function delete(string $pk, string $id): int
    {
        try {
            $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $pk . '=?';
            $qry = $this->db->prepare($sql);
            $qry->execute(array($id));
            return $qry->rowCount();
        } catch (PDOException $e) {
            throw new PDOException(__CLASS__ . ' : ' . $e->getMessage());
        }
    }
}
