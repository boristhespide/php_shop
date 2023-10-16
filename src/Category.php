<?php

namespace Alexa\PhpOopShop;

use PDO;

class Category
{
    private $conn;
    private $table_name = "categories";

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, name FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

    }

    public function readName() {
        $querry = "SELECT name FROM $this->table_name WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row["name"];
    }

}