<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
<h2>Editar Cliente</h2>
<form method="post" action="/modificarCliente">
    <input type="hidden" name="clientuuid" value="<?= $cliente->getUuid() ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="clientname" id="nombre" value="<?= $cliente->getNombre() ?>"><br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="clientaddress" id="direccion" value="<?= $cliente->getDireccion() ?>"><br>
    <label for="coste">Coste:</label>
    <input type="number" name="clientcost" id="coste" step="0.01" value="<?= $cliente->getCoste() ?>"><br>
    <label for="abierto">¿Abierto?:</label>
    <select name="clientisopen" id="abierto">
        <option value="1" <?= $cliente->isAbierto() ? 'selected' : '' ?>>Sí</option>
        <option value="0" <?= !$cliente->isAbierto() ? 'selected' : '' ?>>No</option>
    </select><br>
    <input type="submit" value="Guardar Cambios">
</form>
</body>
</html>
