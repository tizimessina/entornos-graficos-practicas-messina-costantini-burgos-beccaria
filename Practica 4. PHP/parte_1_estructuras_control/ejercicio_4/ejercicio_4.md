# Ejercicio 4

## Consigna

Si el archivo `datos.php` contiene el código que sigue, indicar las salidas que produce el siguiente código y justificar.

```php
<?php
$color = 'blanco';
$flor = 'clavel';
?>
```

```php
<?php
echo "El $flor $color \n";
include 'datos.php';
echo " El $flor $color";
?>
```

## Salida

```
El   
 El clavel blanco
```

La primera línea consiste en el texto `El` seguido de tres espacios y un salto de línea. La segunda es el texto ` El clavel blanco`, precedido de un espacio. Además de eso, PHP emite dos avisos correspondientes a las dos variables no definidas de la primera línea.

## Justificación

La clave del ejercicio está en el orden en que se ejecutan las sentencias. PHP interpreta el script de arriba hacia abajo, y el primer `echo` se ejecuta antes de que la sentencia `include` haya incorporado el archivo con las definiciones. En ese momento `$flor` y `$color` no existen todavía.

Cuando una variable inexistente se interpola dentro de una cadena entre comillas dobles, PHP la reemplaza por una cadena vacía. Por eso la primera línea conserva únicamente el texto literal y los espacios que hay entre las variables: donde debía aparecer `clavel` no aparece nada, donde debía aparecer `blanco` tampoco, y quedan a la vista el espacio que separaba `El` de la primera variable, el que separaba ambas variables y el que precedía al `\n`. De ahí los tres espacios consecutivos. El `\n` sí se interpreta como salto de línea, porque las secuencias de escape se procesan dentro de las comillas dobles, aunque conviene recordar que ese salto se ve en el código fuente pero no en la página renderizada, ya que HTML ignora los saltos de línea del marcado; para verlo en el navegador habría que usar `<br>`.

Esa sustitución silenciosa no es completamente silenciosa: PHP avisa del acceso a variables no definidas. En PHP 5 y 7 se trata de un aviso de nivel `E_NOTICE` y en PHP 8, que es la versión que trae XAMPP actualmente, pasó a ser un `E_WARNING`. En cualquiera de los dos casos el mensaje se muestra o no según cómo esté configurada la directiva `display_errors` en el `php.ini`, motivo por el cual el mismo script puede verse distinto en la máquina del alumno y en la del profesor. El script no se interrumpe en ningún caso, y esa es precisamente la razón por la que llega a producirse la primera línea de salida.

La sentencia `include` incorpora y evalúa el archivo indicado en el punto exacto en que aparece. Un detalle importante del comportamiento de `include` es que el archivo incluido hereda el ámbito de variables de la línea desde la cual se lo incluye, de modo que las variables que ese archivo define quedan disponibles en el script que lo incluyó, como si hubieran sido escritas allí mismo. Por eso, a partir de esa línea, `$flor` vale `clavel` y `$color` vale `blanco`.

El segundo `echo`, ejecutado ya con las variables definidas, imprime el texto completo con los valores correspondientes. El espacio inicial que se ve en la salida es el que está escrito literalmente dentro de la cadena, entre la comilla de apertura y la palabra `El`.

## Observación adicional

Si en lugar de `include` se hubiera utilizado `require`, el resultado sería idéntico en este caso. La diferencia entre ambas construcciones aparece únicamente cuando el archivo solicitado no puede encontrarse: `include` emite un aviso y permite que el script continúe, mientras que `require` provoca un error fatal y detiene la ejecución. Se prefiere `require` cuando el archivo es imprescindible para que la página tenga sentido, que suele ser el caso de los archivos de configuración o de conexión a la base de datos.
