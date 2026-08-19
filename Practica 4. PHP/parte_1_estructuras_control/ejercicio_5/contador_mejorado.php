<?php
/*
 * Version corregida del contador, incluida como complemento del analisis.
 * No reemplaza a contador.php, que se conserva tal como lo da el enunciado.
 */
$archivo = __DIR__ . DIRECTORY_SEPARATOR . "contador.dat";

// Si el archivo no existe se crea con el valor inicial, en lugar de fallar.
if (!file_exists($archivo)) {
    file_put_contents($archivo, "0");
}

// Se abre una sola vez en modo lectura y escritura, sin truncar.
$fp = fopen($archivo, "r+");

if ($fp === false) {
    echo "No se pudo abrir el contador.";
} else {
    // Bloqueo exclusivo: evita que dos visitas simultaneas se pisen entre si.
    flock($fp, LOCK_EX);

    $contenido = stream_get_contents($fp);
    $cont = (int) $contenido;   // una cadena vacia se convierte en 0
    $cont = $cont + 1;

    // Se vuelve al principio y se trunca antes de escribir el nuevo valor.
    rewind($fp);
    ftruncate($fp, 0);
    fwrite($fp, (string) $cont);
    fflush($fp);

    flock($fp, LOCK_UN);
    fclose($fp);

    echo '<span style="font-family: arial; font-size: 1rem;">';
    echo 'Cantidad de visitas: ' . $cont;
    echo '</span>';
}
?>
