<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar Finca: <?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=fincas.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($finca->id(), ENT_QUOTES, 'UTF-8') ?>">

    <div>
        <label>ID:</label>
        <input type="text" value="<?= htmlspecialchars($finca->id(), ENT_QUOTES, 'UTF-8') ?>" disabled>
    </div>

    <div>
        <label for="nombre">Nombre de la finca:</label>
        <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($finca->nombre(), ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="num_hectareas">Número de Hectáreas:</label>
            <input type="number" step="0.01" id="num_hectareas" name="num_hectareas" required value="<?= htmlspecialchars((string) $finca->numHectareas(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="metros_cuadrados">Metros Cuadrados:</label>
            <input type="number" step="0.01" id="metros_cuadrados" name="metros_cuadrados" value="<?= htmlspecialchars((string) $finca->metrosCuadrados(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="propietario">Propietario:</label>
            <input type="text" id="propietario" name="propietario" required value="<?= htmlspecialchars($finca->propietario(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="capataz">Capataz:</label>
            <input type="text" id="capataz" name="capataz" required value="<?= htmlspecialchars($finca->capataz(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" required value="<?= htmlspecialchars($finca->pais(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required value="<?= htmlspecialchars($finca->departamento(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="ciudad">Ciudad / Municipio:</label>
            <input type="text" id="ciudad" name="ciudad" required value="<?= htmlspecialchars($finca->ciudad(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <fieldset style="margin: 15px 0; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        <legend><strong>Líneas de Producción Activa:</strong></legend>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_leche" value="1" <?= $finca->produceLeche() ? 'checked' : '' ?>> Produce Leche
        </label>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_cereales" value="1" <?= $finca->produceCereales() ? 'checked' : '' ?>> Produce Cereales
        </label>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_frutas" value="1" <?= $finca->produceFrutas() ? 'checked' : '' ?>> Produce Frutas
        </label>
        <label>
            <input type="checkbox" name="produce_verduras" value="1" <?= $finca->produceVerduras() ? 'checked' : '' ?>> Produce Verduras
        </label>
    </fieldset>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Actualizar Finca</button>
        <a href="?route=fincas.index" class="btn">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
