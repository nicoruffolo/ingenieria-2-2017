<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link href="estilos.css" rel="stylesheet">
    <title>Agregar vehículo</title>
</head>
<body>
<a href="admin.php">Volver al admin</a>
<?php include("part-header2.php"); ?>
<form action="agregarVehiculo.php" method="post" class="form" enctype="multipart/form-data">
    <input type="hidden" name="agregarVehiculo" value="1"/>
    <fieldset>
        <legend>Opciones de  vehículo</legend>

        <div>
            <select name="modelo">
                <option value="">Eliga un Modelo</option>
                <?php while ($modelo = mysqli_fetch_array($modelos)) {
                    echo '<option value="' . $modelo['idModelo'] . '"';
                    if (isset($_POST['modelo']) and $modelo['idModelo'] == $_POST['modelo'])
                        echo ' selected="selected"';
                    echo '>' . $modelo['Modelo'] . '</option>';
                } ?>
            </select>
            <select name="tipo">
                <option value="">Eliga un Tipo</option>
                <?php while ($tipo = mysqli_fetch_array($tipos)) {
                    echo '<option value="' . $tipo['idTipo'] . '"';
                    if (isset($_POST['tipo']) and $tipo['idTipo'] == $_POST['tipo'])
                        echo ' selected="selected"';
                    echo '>' . $tipo['Tipo'] . '</option>';
                } ?>
            </select>
        </div>
        <div>
            <label for="anio">Año:</label>
            <input type="text" name="anio" id="anio" placeholder="xxxx"
                   value="<?php if (isset($_POST['anio'])) echo htmlentities($_POST['anio']); ?>">
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" placeholder="$xxxx"
                   value="<?php if (isset($_POST['precio'])) echo htmlentities($_POST['precio']); ?>">
        </div>
        <div>
            <label for="dominio">Dominio:</label>
            <input type="text" name="dominio" id="dominio" placeholder="XXX-XXX"
                   value="<?php if (isset($_POST['dominio'])) echo htmlentities($_POST['dominio']); ?>">
        </div>

        <div>
            <?php while ($caracteristica = mysqli_fetch_array($caracteristicas)) {
                echo '<label><input type="checkbox" name="caracteristicas[]" value="' . $caracteristica['idCaracteristica'] . '"';
                if (isset($_POST['caracteristicas']) and in_array($caracteristica['idCaracteristica'], $_POST['caracteristicas']))
                    echo ' checked="checked" '; // si una esta seleccionada como cheked manttiene el cheked
                echo '>' . $caracteristica['Caracteristica'] . '</label><br>';
            } ?>
        </div>

        <div>
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/*"/>
        </div>

        <?php if (isset($errorAltaVehiculo)) { ?>
            <p><?php echo $errorAltaVehiculo; ?></p>
        <?php } ?>

        <button type="submit">Agregar vehículo</button>
    </fieldset>
</form>
</body>
</html>