
<?php

class Historia {

    private $db;

    // Constructor
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Listar todas las historias
    public function listar() {

        $sql = "SELECT historias.*, sprints.nombre AS nombre_sprint
                FROM historias
                INNER JOIN sprints
                ON historias.sprint_id = sprints.id
                ORDER BY historias.id DESC";

        $consulta = $this->db->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar una historia
    public function crear($datos) {

        $sql = "INSERT INTO historias
                (titulo, descripcion, responsable, estado,
                puntos, fecha_creacion, fecha_finalizacion, sprint_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([
            $datos['titulo'],
            $datos['descripcion'],
            $datos['responsable'],
            $datos['estado'],
            $datos['puntos'],
            $datos['fecha_creacion'],
            $datos['fecha_finalizacion'],
            $datos['sprint_id']
        ]);
    }

    // Buscar una historia por ID
    public function buscar($id) {

        $sql = "SELECT * FROM historias WHERE id = ?";

        $consulta = $this->db->prepare($sql);
        $consulta->execute([$id]);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar una historia
    public function actualizar($id, $datos) {

        $sql = "UPDATE historias SET
                titulo = ?,
                descripcion = ?,
                responsable = ?,
                estado = ?,
                puntos = ?,
                fecha_finalizacion = ?,
                sprint_id = ?
                WHERE id = ?";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([
            $datos['titulo'],
            $datos['descripcion'],
            $datos['responsable'],
            $datos['estado'],
            $datos['puntos'],
            $datos['fecha_finalizacion'],
            $datos['sprint_id'],
            $id
        ]);
    }

    // Eliminar una historia
    public function eliminar($id) {

        $sql = "DELETE FROM historias WHERE id = ?";

        $consulta = $this->db->prepare($sql);

        return $consulta->execute([$id]);
    }

}
