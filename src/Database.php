<?php

namespace Alexa\PhpOopShop;
use PDO;
use PDOException;

require 'vendor/autoload.php';
class Database
{
    private $host = "localhost";
    private $db_name = "php_oop_shop";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}