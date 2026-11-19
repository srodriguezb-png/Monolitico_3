
<?php

require_once __DIR__ . "/../models/Sprint.php";

class SprintController {

    private $sprint;

    // Constructor
    public function __construct($conexion) {
        $this->sprint = new Sprint($conexion);
    }

    // Mostrar todos los sprints
    public function listar() {
        return $this->sprint->listar();
    }

    // Registrar un sprint
    public function crear($datos) {

        $nombre = trim($datos['nombre']);
        $fecha_inicio = $datos['fecha_inicio'];
        $fecha_fin = $datos['fecha_fin'];

        if (
            empty($nombre) ||
            empty($fecha_inicio) ||
            empty($fecha_fin)
        ) {
            return false;
        }

        if ($fecha_fin < $fecha_inicio) {
            return false;
        }

        return $this->sprint->crear(
            $nombre,
            $fecha_inicio,
            $fecha_fin
        );
    }

    // Buscar un sprint
    public function buscar($id) {
        return $this->sprint->buscar($id);
    }

    // Actualizar un sprint
    public function actualizar($id, $datos) {

        $nombre = trim($datos['nombre']);
        $fecha_inicio = $datos['fecha_inicio'];
        $fecha_fin = $datos['fecha_fin'];

        if (
            empty($nombre) ||
            empty($fecha_inicio) ||
            empty($fecha_fin)
        ) {
            return false;
        }

        if ($fecha_fin < $fecha_inicio) {
            return false;
        }

        return $this->sprint->actualizar(
            $id,
            $nombre,
            $fecha_inicio,
            $fecha_fin
        );
    }

    // Eliminar un sprint
    public function eliminar($id) {
        return $this->sprint->eliminar($id);
    }

}
