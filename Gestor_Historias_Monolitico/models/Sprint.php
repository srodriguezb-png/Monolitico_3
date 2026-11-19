
<?php

require_once __DIR__ . "/../config/conexion.php";

class Sprint {

    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Mostrar todos los sprints
    public function listar() {

        $sql = "SELECT * FROM sprints ORDER BY id DESC";

        $consulta = $this->db->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar un sprint
    public function crear($nombre, $fecha_inicio, $fecha_fin) {

        $sql = "INSERT INTO sprints
                (nombre, fecha_inicio, fecha_fin)
                VALUES (?, ?, ?)";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([
            $nombre,
            $fecha_inicio,
            $fecha_fin
        ]);
    }

    // Buscar un sprint por su ID
    public function buscar($id) {

        $sql = "SELECT * FROM sprints WHERE id = ?";

        $consulta = $this->db->prepare($sql);
        $consulta->execute([$id]);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un sprint
    public function actualizar($id, $nombre, $fecha_inicio, $fecha_fin) {

        $sql = "UPDATE sprints
                SET nombre = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?
                WHERE id = ?";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([
            $nombre,
            $fecha_inicio,
            $fecha_fin,
            $id
        ]);
    }

    // Eliminar un sprint
    public function eliminar($id) {

        $sql = "DELETE FROM sprints WHERE id = ?";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([$id]);
    }

}
