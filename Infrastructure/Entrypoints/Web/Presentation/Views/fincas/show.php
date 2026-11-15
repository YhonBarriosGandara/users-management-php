<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de Finca: <?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?></h1>

<div style="background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #e1e1e1; margin-bottom: 20px;">
    <p><strong>Identificador (ID):</strong> <?= htmlspecialchars($finca->id(), ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Nombre del Predio:</strong> <?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Superficie Total:</strong> <?= number_format($finca->numHectareas(), 2) ?> Hectáreas (<?= number_format($finca->metrosCuadrados(), 2) ?> m²)</p>
    <p><strong>Propietario:</strong> <?= htmlspecialchars($finca->propietario(), ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Capataz / Administrador:</strong> <?= htmlspecialchars($finca->capataz(), ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Ubicación Geográfica:</strong> <?= htmlspecialchars($finca->ciudad(), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($finca->departamento(), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($finca->pais(), ENT_QUOTES, 'UTF-8') ?></p>
    
    <div style="margin-top: 15px;">
        <strong>Líneas Productivas:</strong>
        <ul>
            <li>Producción de Leche: <?= $finca->produceLeche() ? '✅ Sí' : '❌ No' ?></li>
            <li>Producción de Cereales: <?= $finca->produceCereales() ? '✅ Sí' : '❌ No' ?></li>
            <li>Producción de Frutas: <?= $finca->produceFrutas() ? '✅ Sí' : '❌ No' ?></li>
            <li>Producción de Verduras: <?= $finca->produceVerduras() ? '✅ Sí' : '❌ No' ?></li>
        </ul>
    </div>
</div>

<div>
    <a href="?route=fincas.edit&amp;id=<?= urlencode($finca->id()) ?>" class="btn btn-warning">Editar</a>
    <a href="?route=fincas.index" class="btn">Volver al Listado</a>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
