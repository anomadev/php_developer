<?php

namespace App;

use App\ShoppingCart\Cart;

class Connection
{
    public $conn;
    private $schema = "CREATE TABLE IF NOT EXISTS carts(id varchar(20), data text)";

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function connect()
    {
        try {
            $conn = new \PDO("mysql:host=mysql;dbname=phpunit", "root", "root");
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $err) {
            echo "Connection failed " . $err->getMessage();
        }
    }

    public function createSchema()
    {
        $this->conn->exec($this->schema);
    }

    public function dropTable(): void
    {
        $this->conn->exec('DROP TABLE carts');
    }

    public function insert(Cart $cart): void
    {
        $data = base64_encode(serialize($cart));
        $sql = "INSERT INTO carts(id, data) VALUES('{$cart->id}', '{$data}')";
        $this->conn->exec($sql);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM carts WHERE carts.id = '{$id}'";
        $stm = $this->conn->query($sql);
        return unserialize(base64_decode($stm->fetch()['data']));
    }
}