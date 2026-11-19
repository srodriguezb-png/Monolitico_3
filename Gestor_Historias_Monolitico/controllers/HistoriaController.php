
<?php

require_once __DIR__ . "/../models/Historia.php";

class HistoriaController {

    private $historia;

    // Constructor
    public function __construct($conexion) {
        $this->historia = new Historia($conexion);
    }

    // Listar historias
    public function listar() {
        return $this->historia->listar();
    }

    // Registrar historia
    public function crear($datos) {

        $datos['titulo'] = trim($datos['titulo'] ?? '');
        $datos['descripcion'] = trim($datos['descripcion'] ?? '');
        $datos['responsable'] = trim($datos['responsable'] ?? '');

        $estados = ['nueva', 'activa', 'finalizada', 'impedimento'];

        if (
            $datos['titulo'] === '' ||
            $datos['descripcion'] === '' ||
            $datos['responsable'] === '' ||
            empty($datos['sprint_id']) ||
            empty($datos['puntos']) ||
            empty($datos['fecha_creacion'])
        ) {
            return false;
        }

        if (!in_array($datos['estado'], $estados, true)) {
            return false;
        }

        if (!filter_var($datos['puntos'], FILTER_VALIDATE_INT)
            || (int)$datos['puntos'] < 1) {
            return false;
        }

        $datos['sprint_id'] = (int)$datos['sprint_id'];
        $datos['puntos'] = (int)$datos['puntos'];

        if ($datos['estado'] === 'finalizada') {
            $datos['fecha_finalizacion'] = date('Y-m-d');
        } else {
            $datos['fecha_finalizacion'] = null;
        }

        return $this->historia->crear($datos);
    }

    // Buscar historia
    public function buscar($id) {
        return $this->historia->buscar($id);
    }

    // Actualizar historia
    public function actualizar($id, $datos) {

        $datos['titulo'] = trim($datos['titulo'] ?? '');
        $datos['descripcion'] = trim($datos['descripcion'] ?? '');
        $datos['responsable'] = trim($datos['responsable'] ?? '');

        $estados = ['nueva', 'activa', 'finalizada', 'impedimento'];

        if (
            $datos['titulo'] === '' ||
            $datos['descripcion'] === '' ||
            $datos['responsable'] === '' ||
            empty($datos['sprint_id']) ||
            empty($datos['puntos'])
        ) {
            return false;
        }

        if (!in_array($datos['estado'], $estados, true)) {
            return false;
        }

        if (!filter_var($datos['puntos'], FILTER_VALIDATE_INT)
            || (int)$datos['puntos'] < 1) {
            return false;
        }

        $datos['sprint_id'] = (int)$datos['sprint_id'];
        $datos['puntos'] = (int)$datos['puntos'];

        if ($datos['estado'] === 'finalizada') {
            $datos['fecha_finalizacion'] = date('Y-m-d');
        } else {
            $datos['fecha_finalizacion'] = null;
        }

        return $this->historia->actualizar($id, $datos);
    }

    // Eliminar historia
    public function eliminar($id) {
        return $this->historia->eliminar($id);
    }

}

