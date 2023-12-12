<?php
// Conection.php

class Conection {
    private $server = "mysql:host=localhost; dbname=academiahub";
    private $username = "adan";
    private $password = "Princesa1y";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

    protected $conn;

    public function open() {
        try {
            $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->conn; // Devuelve la conexión

        } catch (PDOException $e) {
            echo "Error en la conexión a la base de datos: " . $e->getMessage();
            return null;
        }
    }

    public function close() {
        $this->conn = null;
    }
}
?>
