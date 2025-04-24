<?php

class Database {
    private $host = 'localhost';
    private $port = '3306';
    private $dbname = 'sys';
    private $username = 'root';
    private $password = '123456';
    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        // DSN oluştur
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;
        
        // PDO seçenekleri
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        );

        // PDO instance oluştur
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo 'Bağlantı hatası: ' . $this->error;
            die();
        }
    }

    // Sorgu hazırla
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Parametreleri bağla
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Sorguyu çalıştır
    public function execute() {
        return $this->stmt->execute();
    }

    // Birden fazla kayıt getir
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Tek kayıt getir
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Kayıt sayısını getir
    public function rowCount() {
        return $this->stmt->rowCount();
    }
} 