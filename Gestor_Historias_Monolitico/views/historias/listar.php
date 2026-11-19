
<?php

require_once __DIR__ . "/../../controllers/HistoriaController.php";

$controlador = new HistoriaController($db);

// Eliminar historia
if (isset($_GET['eliminar'])) {

    $controlador->eliminar((int)$_GET['eliminar']);

    header("Location: index.php?pagina=historias");
    exit;
}

// Consultar historias
$historias = $controlador->listar();

?>

<h1>Historias de Usuario</h1>

<a href="index.php?pagina=crear_historia">
    Registrar nueva historia
</a>

<br><br>

<table border="1" cellpadding="8">

    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Responsable</th>
            <th>Sprint</th>
            <th>Puntos</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
            <th>Fecha de finalización</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($historias as $historia): ?>

            <tr>

                <td><?= $historia['id'] ?></td>

                <td>
                    <?= htmlspecialchars($historia['titulo']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($historia['responsable']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($historia['nombre_sprint']) ?>
                </td>

                <td><?= $historia['puntos'] ?></td>

                <td>
                    <?= htmlspecialchars($historia['estado']) ?>
                </td>

                <td><?= $historia['fecha_creacion'] ?></td>

                <td>
                    <?= $historia['fecha_finalizacion'] ?? 'Pendiente' ?>
                </td>

                <td>

                    <a href="index.php?pagina=editar_historia&id=<?= $historia['id'] ?>">
                        Editar
                    </a>

                    |

                    <a
                        href="index.php?pagina=historias&eliminar=<?= $historia['id'] ?>"
                        onclick="return confirm('¿Eliminar esta historia?')"
                    >
                        Eliminar
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        <?php if (empty($historias)): ?>

            <tr>
                <td colspan="9">No hay historias registradas.</td>
            </tr>

        <?php endif; ?>

    </tbody>

</table>
