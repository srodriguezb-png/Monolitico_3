
<?php
require_once __DIR__ . "/../models/Historia.php";
require_once __DIR__ . "/../models/Sprint.php";

$historiaModelo = new Historia($db);
$sprintModelo = new Sprint($db);

$historias = $historiaModelo->listar();
$sprints = $sprintModelo->listar();

// Calcular cantidades de historias
$totalHistorias = count($historias);
$nuevas = 0;
$activas = 0;
$finalizadas = 0;
$impedimentos = 0;

foreach ($historias as $historia) {
    switch ($historia['estado']) {
        case 'nueva':
            $nuevas++;
            break;
        case 'activa':
            $activas++;
            break;
        case 'finalizada':
            $finalizadas++;
            break;
        case 'impedimento':
            $impedimentos++;
            break;
    }
}

$totalSprints = count($sprints);
?>

<h1>Gestor de Historias de Usuario</h1>

<p>
    Bienvenido al sistema de gestión de historias de usuario por Sprint.
</p>

<h2>Resumen general</h2>

<div class="dashboard-resumen">

    <div class="tarjeta">
        <h3>Total de historias</h3>
        <p><?= $totalHistorias ?></p>
    </div>

    <div class="tarjeta">
        <h3>Nuevas</h3>
        <p><?= $nuevas ?></p>
    </div>

    <div class="tarjeta">
        <h3>Activas</h3>
        <p><?= $activas ?></p>
    </div>

    <div class="tarjeta">
        <h3>Finalizadas</h3>
        <p><?= $finalizadas ?></p>
    </div>

    <div class="tarjeta">
        <h3>Impedimentos</h3>
        <p><?= $impedimentos ?></p>
    </div>

    <div class="tarjeta">
        <h3>Sprints registrados</h3>
        <p><?= $totalSprints ?></p>
    </div>

</div>

<h2>Accesos rápidos</h2>

<ul>
    <li>
        <a href="index.php?pagina=crear_historia">
            Registrar una historia
        </a>
    </li>

    <li>
        <a href="index.php?pagina=historias">
            Consultar historias
        </a>
    </li>

    <li>
        <a href="index.php?pagina=sprints">
            Gestionar Sprints
        </a>
    </li>

    <li>
        <a href="index.php?pagina=informes">
            Consultar informes
        </a>
    </li>
</ul>
