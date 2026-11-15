<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Gestión de Fincas (Ejercicio N.º 4)</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<div style="margin-bottom: 15px;">
    <a href="?route=fincas.create" class="btn btn-primary">+ Registrar Nueva Finca</a>
</div>

<?php if (empty($fincas)): ?>
    <p>No hay fincas registradas en el sistema todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Superficie</th>
                <th>Propietario / Capataz</th>
                <th>Ubicación</th>
                <th>Líneas de Producción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fincas as $finca): ?>
                <tr>
                    <td class="col-id"><?= htmlspecialchars($finca->id(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><strong><?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?></strong></td>
                    <td>
                        <?= number_format($finca->numHectareas(), 2) ?> ha<br>
                        <small style="color: #666;"><?= number_format($finca->metrosCuadrados(), 2) ?> m²</small>
                    </td>
                    <td>
                        👤 <?= htmlspecialchars($finca->propietario(), ENT_QUOTES, 'UTF-8') ?><br>
                        <small style="color: #666;">Capataz: <?= htmlspecialchars($finca->capataz(), ENT_QUOTES, 'UTF-8') ?></small>
                    </td>
                    <td>
                        📍 <?= htmlspecialchars($finca->ciudad(), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($finca->departamento(), ENT_QUOTES, 'UTF-8') ?><br>
                        <small style="color: #666;"><?= htmlspecialchars($finca->pais(), ENT_QUOTES, 'UTF-8') ?></small>
                    </td>
                    <td>
                        <small>
                            <?= $finca->produceLeche() ? '🥛 Leche ' : '' ?>
                            <?= $finca->produceCereales() ? '🌾 Cereales ' : '' ?>
                            <?= $finca->produceFrutas() ? '🍎 Frutas ' : '' ?>
                            <?= $finca->produceVerduras() ? '🥬 Verduras ' : '' ?>
                        </small>
                    </td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=fincas.show&amp;id=<?= urlencode($finca->id()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm" href="?route=fincas.edit&amp;id=<?= urlencode($finca->id()) ?>">Editar</a>
                        <form method="POST" action="?route=fincas.delete" style="display:inline;"
                            onsubmit="return confirm('¿Está seguro de eliminar la finca <?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?>?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($finca->id(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
