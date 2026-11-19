
<?php

class Conexion {

    private $host = "localhost";
    private $base_datos = "gestor_historias_db";
    private $usuario = "root";
    private $password = "";

    public function conectar() {

        try {

            $conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->base_datos};charset=utf8mb4",
                $this->usuario,
                $this->password
            );

            $conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexion;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }
    }
}
