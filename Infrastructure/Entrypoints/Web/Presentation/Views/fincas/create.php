<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar Nueva Finca</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=fincas.store">
    <div>
        <label for="id">Identificador único (Código / ID):</label>
        <input type="text" id="id" name="id" required placeholder="Ej: FINCA-101" value="<?= htmlspecialchars($_POST['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div>
        <label for="nombre">Nombre de la finca:</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Ej: Hacienda La Primavera" value="<?= htmlspecialchars($_POST['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="num_hectareas">Número de Hectáreas:</label>
            <input type="number" step="0.01" id="num_hectareas" name="num_hectareas" required placeholder="Ej: 120.5" value="<?= htmlspecialchars($_POST['num_hectareas'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="metros_cuadrados">Metros Cuadrados (opcional, auto-calculado):</label>
            <input type="number" step="0.01" id="metros_cuadrados" name="metros_cuadrados" placeholder="1 ha = 10,000 m²" value="<?= htmlspecialchars($_POST['metros_cuadrados'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="propietario">Propietario:</label>
            <input type="text" id="propietario" name="propietario" required placeholder="Nombre del propietario" value="<?= htmlspecialchars($_POST['propietario'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="capataz">Capataz:</label>
            <input type="text" id="capataz" name="capataz" required placeholder="Nombre del capataz" value="<?= htmlspecialchars($_POST['capataz'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="flex: 1;">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" required value="<?= htmlspecialchars($_POST['pais'] ?? 'Colombia', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required placeholder="Ej: Antioquia, Bolívar, Cundinamarca" value="<?= htmlspecialchars($_POST['departamento'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div style="flex: 1;">
            <label for="ciudad">Ciudad / Municipio:</label>
            <input type="text" id="ciudad" name="ciudad" required placeholder="Ej: Rionegro, Turbaco, Facatativá" value="<?= htmlspecialchars($_POST['ciudad'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <fieldset style="margin: 15px 0; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        <legend><strong>Líneas de Producción Activa:</strong></legend>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_leche" value="1" <?= !empty($_POST['produce_leche']) ? 'checked' : '' ?>> Produce Leche
        </label>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_cereales" value="1" <?= !empty($_POST['produce_cereales']) ? 'checked' : '' ?>> Produce Cereales
        </label>
        <label style="margin-right: 15px;">
            <input type="checkbox" name="produce_frutas" value="1" <?= !empty($_POST['produce_frutas']) ? 'checked' : '' ?>> Produce Frutas
        </label>
        <label>
            <input type="checkbox" name="produce_verduras" value="1" <?= !empty($_POST['produce_verduras']) ? 'checked' : '' ?>> Produce Verduras
        </label>
    </fieldset>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Guardar Finca</button>
        <a href="?route=fincas.index" class="btn">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
