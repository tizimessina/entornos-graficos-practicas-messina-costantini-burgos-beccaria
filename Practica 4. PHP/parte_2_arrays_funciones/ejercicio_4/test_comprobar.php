<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de comprobar_nombre_usuario()</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; line-height: 1.6; }
        h1 { font-size: 1.4rem; }
        h2 { font-size: 1.1rem; margin-top: 2rem; }
        .caso { margin-bottom: 0.4rem; }
        .etiqueta { display: inline-block; min-width: 22rem; font-family: monospace; }
        .ok { color: #14620f; }
        .no { color: #8a1010; }
    </style>
</head>
<body>

<h1>Prueba de la función comprobar_nombre_usuario()</h1>

<?php
require 'comprobar_nombre_usuario.php';

/*
 * Cada caso de prueba se define con el valor a probar, el resultado que se
 * espera y el motivo por el cual se lo incluye. Asi el script no solo ejecuta
 * la funcion sino que ademas verifica que haga lo que deberia hacer.
 */
$casos = array(
    array('valor' => 'andres_perez', 'esperado' => true,  'motivo' => 'nombre valido con guion bajo'),
    array('valor' => 'usuario-01',   'esperado' => true,  'motivo' => 'nombre valido con guion medio y digitos'),
    array('valor' => 'ABC123',       'esperado' => true,  'motivo' => 'mayusculas y digitos, longitud minima superada'),
    array('valor' => 'ana',          'esperado' => true,  'motivo' => 'limite inferior exacto: 3 caracteres'),
    array('valor' => 'aaaaaaaaaaaaaaaaaaaa', 'esperado' => true, 'motivo' => 'limite superior exacto: 20 caracteres'),
    array('valor' => 'ab',           'esperado' => false, 'motivo' => 'demasiado corto: 2 caracteres'),
    array('valor' => '',             'esperado' => false, 'motivo' => 'cadena vacia'),
    array('valor' => 'aaaaaaaaaaaaaaaaaaaaa', 'esperado' => false, 'motivo' => 'un caracter por encima del limite: 21'),
    array('valor' => 'juan perez',   'esperado' => false, 'motivo' => 'contiene un espacio, que no esta permitido'),
    array('valor' => 'user@mail',    'esperado' => false, 'motivo' => 'contiene un caracter especial no permitido'),
    array('valor' => 'jose.perez',   'esperado' => false, 'motivo' => 'el punto no figura entre los permitidos'),
    array('valor' => 'josé',         'esperado' => false, 'motivo' => 'vocal acentuada: ver la observacion sobre UTF-8'),
);

$aciertos = 0;

echo "<h2>Resultado de cada caso</h2>";

foreach ($casos as $caso) {
    // Se captura la salida de la funcion para poder mostrarla ordenada.
    ob_start();
    $devuelto = comprobar_nombre_usuario($caso['valor']);
    $mensaje = ob_get_clean();

    $coincide = ($devuelto === $caso['esperado']);
    if ($coincide) {
        $aciertos++;
    }

    $clase = $coincide ? 'ok' : 'no';
    $veredicto = $coincide ? 'coincide con lo esperado' : 'NO coincide con lo esperado';

    echo '<div class="caso">';
    echo '<span class="etiqueta">' . htmlspecialchars(var_export($caso['valor'], true)) . '</span> ';
    echo 'devolvio ' . var_export($devuelto, true) . ' &rarr; ';
    echo '<span class="' . $clase . '">' . $veredicto . '</span>';
    echo ' <em>(' . $caso['motivo'] . ')</em>';
    echo '<br><small>mensaje de la funcion: ' . $mensaje . '</small>';
    echo '</div>';
}

echo "<h2>Resumen</h2>";
echo "<p>" . $aciertos . " de " . count($casos) . " casos se comportaron como se esperaba.</p>";
?>

<h2>Uso normal de la función</h2>
<?php
// Ejemplo de como se usaria realmente el valor devuelto.
$nombre = "usuario-01";
if (comprobar_nombre_usuario($nombre)) {
    echo "<p>Se puede continuar con el alta de <strong>" . htmlspecialchars($nombre) . "</strong>.</p>";
} else {
    echo "<p>Hay que pedirle al usuario que elija otro nombre.</p>";
}
?>

</body>
</html>
