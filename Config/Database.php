<?php

class Database 
{
    private static $instance = null;
    private $pdo;

    private $host       = '127.0.0.1';
    private $dbname     = 'products_base';
    private $username   = 'root';
    private $password   = '';

    private function __construct()
    {
        try {
            $dsn        = "mysql:host=$this->host;dbname=$this->dbname;";
            $options    = [
                PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES      => false,
            ];  
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
?>
