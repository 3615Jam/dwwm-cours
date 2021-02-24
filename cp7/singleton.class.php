<?php

// Mini framework perso pour gérer les connexions aux BDD 

class Singleton
{
    // attributs privés
    private static $host    = '';
    private static $port    = '';
    private static $dbname  = '';
    private static $user    = '';
    private static $pass    = '';
    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private static $cnn = null;

    /**
     * constructeur de classe : vide 
     */
    private function __construct()
    {
    }

    /**
     * Méthode permettant de passer les paramètres de connexion à la classe Singleton
     * 
     * @param string $newHost       IP du serveur de la BDD
     * @param int    $newPort       Port de la BDD 
     * @param string $newDbName     Nom de la BDD 
     * @param string $newUser       - 
     * @param string $newPass       - 
     * @param array  $newOptions    - options de connexion 
     */

    public static function setConfiguration(
        string $newHost,
        int $newPort,
        string $newDbName,
        string $newUser,
        string $newPass,
        array $newOptions = array()
    ) {
        self::$host     = $newHost;
        self::$port     = $newPort;
        self::$dbname   = $newDbName;
        self::$user     = $newUser;
        self::$pass     = $newPass;
        self::$options += $newOptions; // on rajoute les options à celles existantes, pour conserver les valeurs par défaut
    }

    private static function hasConfiguration(): bool
    {
        // if (empty(self::$host) || empty(self::$port) || empty(self::$dbname)) {
        //     return false;
        // } else {
        //     return true;
        // }

        // même chose, mais écriture simplifiée
        return self::$host . self::$port . self::$dbname;
    }

    public static function getPDO()
    {
        if (self::$cnn === null) {
            if (!self::hasConfiguration()) {
                throw new Exception(__CLASS__ . ' : aucune configuration définie (hôte, port, nom de BDD).');
            } else {
                try {
                    $dsn = 'mysql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$dbname . ';charset=utf8';
                    self::$cnn = new PDO($dsn, self::$user, self::$pass, self::$options);
                } catch (PDOException $e) {
                    throw new PDOException(__CLASS__ . ' : ' . $e->getMessage());
                }
            }
        }
        return self::$cnn;
    }

    /**
     * destructeur de classe 
     */
    public function __destruct()
    {
        if (self::$cnn !== null) {
            // on ne peut pas utiliser 'unset' ici car $cnn est une variable 'static' 
            self::$cnn = null;
        }
    }

    /**
     * interdiction de cloner la classe  
     */
    public function __clone()
    {
        throw new Exception(__CLASS__ . ' : clonage de cette classe interdit');
    }

    /**
     * Méthode qui renvoie les 2 premières colonnes d'une requête SELECT/SHOW sous la forme d'un composant HTML select
     * 
     * @param string    $id    Attributs id et name du composant HTML select
     * @param string    $sql   Requête SQL préparée de type SELECT/SHOW
     * @param array     $vals  Tableau de paramètres (tableau vide par défaut)
     * 
     * @return string          Code HTML
     */

    public static function getHtmlSelect(string $id, string $sql, array $vals = array())
    {
        if (!self::hasConfiguration()) {
            throw new Exception(__CLASS__ . ' : aucune configuration définie (hôte, port, nom de BDD).');
        } else {
            $stmt = explode(' ', strtolower($sql));
            if ($stmt[0] === 'select' || $stmt[0] === 'show') {
                $qry = self::getPDO()->prepare($sql);
                $qry->execute($vals);
                $html = '<select id="' . $id . '" name="' . $id . '" class"form-control">';
                while ($row = $qry->fetch(PDO::FETCH_NUM)) {
                    if ($qry->columnCount() === 1) {
                        $html .= '<option value=' . $row[0] . '">' . $row[0] . '</option>';
                    } else {
                        $html .= '<option value=' . $row[0] . '">' . $row[1] . '</option>';
                    }
                }
                $html .= '</select>';
                return $html;
            } else {
                throw new Exception(__CLASS__ . ' : la requête doit commencer par SELECT / SHOW.');
            }
        }
    }

    /**
     * Méthode qui renvoie le résultat d'une requête préparée SELECT/SHOW sous la forme d'un composant HTML table
     * 
     * @param   string    $sql   Requête SQL préparée de type SELECT/SHOW
     * @param   array     $vals  Tableau de paramètres (tableau vide par défaut)
     * 
     * @return  string           Code HTML
     */

    public static function getHtmlTable(string $sql, array $vals = array())
    {
        if (!self::hasConfiguration()) {
            throw new Exception(__CLASS__ . ' : aucune configuration définie (hôte, port, nom de BDD).');
        } else {
            $stmt = explode(' ', strtolower($sql));
            if ($stmt[0] === 'select' || $stmt[0] === 'show') {
                $qry = self::getPDO()->prepare($sql);
                $qry->execute($vals);
                $html = '<table class"table table-dark table-striped table-hover"><thead><tr>';
                for ($i = 0; $i < $qry->columnCount(); $i++) {
                    $meta = $qry->getColumnMeta($i);
                    $html .= '<th>' . $meta['name'] . '</th>';
                }
                $html .= '</tr></thead><tbody>';
                while ($row = $qry->fetch()) {
                    $html .= '<tr>';
                    foreach ($row as $key => $val) {
                        $html .= '<td>' . $val . '</td>';
                    }
                    $html .= '</tr>';
                }

                $html .= '</tbody></table>';



                while ($row = $qry->fetch(PDO::FETCH_NUM)) {
                    if ($qry->columnCount() === 1) {
                        $html .= '<option value=' . $row[0] . '">' . $row[0] . '</option>';
                    } else {
                        $html .= '<option value=' . $row[0] . '">' . $row[1] . '</option>';
                    }
                }
                $html .= '</select>';
                return $html;
            } else {
                throw new Exception(__CLASS__ . ' : la requête doit commencer par SELECT / SHOW.');
            }
        }
    }
}
