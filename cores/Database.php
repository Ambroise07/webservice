<?php

namespace App;

use PDO;

class Database
{
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    protected $db;

    public function __construct()
    {
        $this->DB_HOST = 'localhost';
        $this->DB_USER = 'root';
        $this->DB_PASS = 'root';
        $this->DB_NAME = 'webservice';
        try {
            $this->db = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME.';charset=utf8', $this->DB_USER, $this->DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]
        );
        } catch (\PDOException $e) {
            die('Impossible de se connecter à la base de donnée '.$e->getMessage().'<br>');
        }
    }

    public function fakerDb()
    {
        return $this;
    }

    public static function pdo(): PDO
    {
        try {
            return new PDO('mysql:host='.'localhost'.';dbname='.'FiBotStore'.';charset=utf8', 'ambroise', 'root',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]
        );
        } catch (\PDOException $e) {
            die('Impossible de se connecter à la base de donnée '.$e->getMessage().'<br>');
        }
    }

    /**
     * Using to select data from DataBase.
     *
     * @param string $query
     * @param bool   $fetchAll
     * @param array  $value
     * @param int    $fetchmod
     * @param string $classname
     */
    public function select(string $query, bool $fetchAll = true, array $value = null, int $fetchmod = null, string $classname = null)
    {
        if (isset($value)) {
            $query = $this->db->prepare($query);
            $query->execute($value);
            if (!$fetchAll) {
                if (isset($fetchmod)) {
                    $query->setFetchMode($fetchmod, $classname);

                    return $query->fetch();
                } else {
                    return $query->fetch();
                }
            } else {
                if (isset($fetchmod)) {
                    return $query->fetchAll($fetchmod, $classname);
                }

                return $query->fetchAll();
            }
        }
        $query = $this->db->query($query);
        if (!$fetchAll) {
            if (isset($fetchmod)) {
                $query->setFetchMode($fetchmod, $classname);

                return $query->fetch();
            } else {
                return $query->fetch();
            }
        } else {
            if (isset($fetchmod)) {
                return $query->fetchAll($fetchmod, $classname);
            }

            return $query->fetchAll();
        }
    }

    public function insert(string $query, array $value, bool $lastInsertId = false)
    {
        $toBd = $this->db->prepare($query);
        if ($toBd->execute($value)) {
            if ($lastInsertId) {
                return  (int) $this->db->lastInsertId();
            }

            return true;
        } else {
            return false;
        }
    }

    public function delect(string $query, array $value): bool
    {
        $delect = $this->db->prepare($query)->execute($value);
        if ($delect) {
            return true;
        }

        return false;
    }

    public function update(string $query, array $value):bool
    {
        $update = $this->db->prepare($query);
        if ($update->execute($value)) {
            return true;
        }
        return false;
    }
}
