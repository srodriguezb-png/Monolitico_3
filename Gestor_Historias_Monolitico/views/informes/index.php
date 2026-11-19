
<?php

require_once __DIR__ . "/../../config/conexion.php";

$conexion = new Conexion();
$db = $conexion->conectar();

// Consultar resumen general
$sql = "SELECT
            COUNT(*) AS total,
            SUM(estado = 'finalizada') AS finalizadas,
            SUM(estado = 'nueva') AS nuevas,
            SUM(estado = 'activa') AS activas,
            SUM(estado = 'impedimento') AS impedimentos
        FROM historias";

$consulta = $db->query($sql);
$resumen = $consulta->fetch(PDO::FETCH_ASSOC);

// Consultar historias agrupadas por responsable
$sqlResponsables = "SELECT
                        responsable,
                        COUNT(*) AS total,
                        SUM(estado = 'finalizada') AS finalizadas,
                        SUM(estado IN ('nueva', 'activa')) AS pendientes,
                        SUM(estado = 'impedimento') AS impedimentos
                    FROM historias
                    GROUP BY responsable
                    ORDER BY responsable";

$consultaResponsables = $db->query($sqlResponsables);
$responsables = $consultaResponsables->fetchAll(PDO::FETCH_ASSOC);

// Consultar historias agrupadas por Sprint
$sqlSprints = "SELECT
                    s.nombre AS sprint,
                    COUNT(h.id) AS total,
                    SUM(h.estado = 'finalizada') AS finalizadas,
                    SUM(h.estado IN ('nueva', 'activa')) AS pendientes,
                    SUM(h.estado = 'impedimento') AS impedimentos
                FROM sprints s
                LEFT JOIN historias h ON s.id = h.sprint_id
                GROUP BY s.id, s.nombre
                ORDER BY s.id";

$consultaSprints = $db->query($sqlSprints);
$sprints = $consultaSprints->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Informes del proyecto</h2>

<h3>Resumen general</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Total</th>
        <th>Finalizadas</th>
        <th>Nuevas</th>
        <th>Activas</th>
        <th>Impedimentos</th>
    </tr>

    <tr>
        <td><?php echo $resumen['total']; ?></td>
        <td><?php echo $resumen['finalizadas']; ?></td>
        <td><?php echo $resumen['nuevas']; ?></td>
        <td><?php echo $resumen['activas']; ?></td>
        <td><?php echo $resumen['impedimentos']; ?></td>
    </tr>
</table>

<h3>Informe por responsable</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Responsable</th>
        <th>Total</th>
        <th>Finalizadas</th>
        <th>Pendientes</th>
        <th>Impedimentos</th>
    </tr>

    <?php foreach ($responsables as $responsable): ?>
        <tr>
            <td><?php echo htmlspecialchars($responsable['responsable']); ?></td>
            <td><?php echo $responsable['total']; ?></td>
            <td><?php echo $responsable['finalizadas']; ?></td>
            <td><?php echo $responsable['pendientes']; ?></td>
            <td><?php echo $responsable['impedimentos']; ?></td>
        </tr>
    <?php endforeach; ?>

    <h3>Informe por Sprint</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Sprint</th>
        <th>Total</th>
        <th>Finalizadas</th>
        <th>Pendientes</th>
        <th>Impedimentos</th>
    </tr>

    <?php foreach ($sprints as $sprint): ?>
        <tr>
            <td><?php echo htmlspecialchars($sprint['sprint']); ?></td>
            <td><?php echo $sprint['total']; ?></td>
            <td><?php echo $sprint['finalizadas']; ?></td>
            <td><?php echo $sprint['pendientes']; ?></td>
            <td><?php echo $sprint['impedimentos']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</table>
