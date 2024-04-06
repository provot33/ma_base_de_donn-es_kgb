<?php

namespace App\Db;

class Mysql
{
    private $dsn;
    private $host;
    private $port;
    private $database;
    private $user;
    private $password;
    private $pdo = null;
    private static $_instance = null;

    private function __construct()
    {
        if (getenv('JAWSDB_MARIA_URL') !== false) {
            // Serveur Heroku
            $dbparts = parse_url(getenv('JAWSDB_MARIA_URL'));

            $this->host = $dbparts['host'];
            $this->port = $dbparts['port'];
            $this->user = $dbparts['user'];
            $this->password = $dbparts['pass'];
            $this->database = ltrim($dbparts['path'], '/');
        } else {
            // Configuration par défaut = env local
            $conf = require_once _ROOTPATH_.'/db_config.php';

            if (isset($conf['host'])) {
                $this->host = $conf['host'];
            }
            if (isset($conf['port'])) {
                $this->port = $conf['port'];
            }
            if (isset($conf['user'])) {
                $this->user = $conf['user'];
            }
            if (isset($conf['password'])) {
                $this->password = $conf['password'];
            }
            if (isset($conf['database'])) {
                $this->database = $conf['database'];
            }
        }
        $this->dsn = 'mysql:dbname=' . $this->database . ';host=' . $this->host . ';' . $this->port;
    }

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mysql();
        }
        return self::$_instance;
    }

    public function getPDO(): \PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new \PDO($this->dsn, $this->user, $this->password);
        }
        return $this->pdo;
    }

}
