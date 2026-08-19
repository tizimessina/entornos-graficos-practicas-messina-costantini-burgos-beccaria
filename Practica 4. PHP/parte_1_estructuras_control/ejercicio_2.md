# Ejercicio 2

## Consigna

Indicar si los siguientes códigos son equivalentes.

## Apartado a)

```php
<?php $i = 1; while ($i <= 10) { print $i++; } ?>
<?php $i = 1; while ($i <= 10): print $i; $i++; endwhile; ?>
<?php $i = 0; do { print ++$i; } while ($i<10); ?>
```

Los tres fragmentos producen exactamente la misma salida por pantalla, que es la secuencia `12345678910`, de modo que si el criterio de equivalencia es el resultado visible, la respuesta es que sí son equivalentes.

El primero utiliza un `while` con sintaxis de llaves y aprovecha el incremento sufijo dentro del propio `print`, de manera que en cada vuelta imprime el valor actual de la variable y recién después la incrementa. El segundo hace lo mismo pero separa ambas operaciones en dos sentencias y emplea la sintaxis alternativa del `while`, la que reemplaza las llaves por dos puntos y termina el bloque con `endwhile`. Esa sintaxis alternativa es puramente una cuestión de escritura y no cambia en absoluto el comportamiento; existe sobre todo porque resulta más legible cuando el bloque PHP se intercala con fragmentos de HTML. El tercero parte de cero en lugar de uno y usa un `do..while` con incremento prefijo, de modo que incrementa antes de imprimir y así compensa el valor inicial distinto.

Hay sin embargo dos diferencias que conviene tener presentes, porque son las que suelen preguntarse. La primera es el estado en que queda la variable de control una vez terminado el bucle: en los dos primeros fragmentos `$i` termina valiendo 11, porque la condición se comprueba con `$i` ya incrementado y esa última comprobación es la que corta el bucle, mientras que en el tercero `$i` termina valiendo 10, porque la comprobación se hace al final de la iteración y el incremento ocurre antes de imprimir. Si el código continuara usando `$i` después del bucle, los tres fragmentos dejarían de ser intercambiables.

La segunda diferencia es estructural y no llega a manifestarse con estos valores concretos, pero es la que distingue conceptualmente a las dos construcciones: el `while` es un bucle de precondición, que evalúa la condición antes de la primera iteración y por lo tanto puede no ejecutar el cuerpo ni una sola vez, mientras que el `do..while` es de postcondición y garantiza siempre al menos una ejecución del cuerpo. Si en lugar de partir de valores que hacen verdadera la condición inicial se partiera, por ejemplo, de un valor mayor que diez, los dos primeros fragmentos no imprimirían nada y el tercero imprimiría un valor.

## Apartado b)

```php
<?php for ($i = 1; $i <= 10; $i++) { print $i; } ?>
<?php for ($i = 1; ;$i++) { if ($i > 10) { break; } print $i; } ?>
<?php $i = 1; for (;;) { if ($i > 10) { break; } print $i; $i++; } ?>
<?php for ($i = 1; $i <= 10; print $i, $i++) ; ?>
```

Los cuatro fragmentos son equivalentes, tanto en la salida que producen, que vuelve a ser `12345678910`, como en el estado final de la variable de control, que en los cuatro casos queda valiendo 11. En este apartado la equivalencia es entonces más completa que en el anterior.

Lo que cambia es dónde se ubica cada una de las tres partes que componen un `for`. El primer fragmento es la forma canónica, con la inicialización, la condición y el incremento en sus lugares habituales dentro del paréntesis. El segundo deja vacía la sección de la condición, lo cual en PHP equivale a una condición permanentemente verdadera, y traslada el corte al interior del cuerpo mediante un `if` con `break`, sentencia que escapa de la estructura repetitiva actual. El tercero lleva ese mismo criterio al extremo dejando vacías las tres secciones del `for`, con lo que la inicialización pasa a hacerse antes del bucle y el incremento al final del cuerpo, de modo que el `for` queda reducido a un bucle infinito controlado enteramente por el `break`.

El cuarto es el más particular de los cuatro y merece una explicación aparte. Su cuerpo es una sentencia vacía, indicada por el punto y coma solitario que sigue al paréntesis, es decir que el bucle no hace nada en el cuerpo propiamente dicho. Todo el trabajo ocurre en la tercera sección del `for`, que admite una lista de expresiones separadas por comas y las evalúa de izquierda a derecha. Allí se colocan primero el `print` y después el incremento. Como esa tercera sección se ejecuta al terminar cada iteración y no antes, el primer valor impreso es 1 y no 2, que es la duda razonable que suele surgir al leerlo. Se trata de una escritura compacta y perfectamente válida, aunque bastante desaconsejable desde el punto de vista de la legibilidad.

## Apartado c)

```php
<?php
if ($i == 0) { print "i equals 0"; }
elseif ($i == 1) { print "i equals 1"; }
elseif ($i == 2) { print "i equals 2"; }
?>
```

```php
<?php
switch ($i) {
  case 0: print "i equals 0"; break;
  case 1: print "i equals 1"; break;
  case 2: print "i equals 2"; break;
}
?>
```

Ambos códigos son equivalentes. Los dos comparan la misma variable contra los valores 0, 1 y 2, imprimen el mismo texto en cada caso y, si la variable no coincide con ninguno de los tres, no imprimen nada, ya que la primera versión no tiene una rama `else` final y la segunda no tiene una etiqueta `default`. La comparación también es la misma en los dos casos, porque `switch` utiliza comparación no estricta, la del operador `==`, exactamente igual que los `if`; si en cambio se quisiera comparación estricta habría que escribir los `if` con `===`, y en ese caso las dos estructuras dejarían de comportarse igual frente a valores de tipos distintos.

La diferencia práctica está en el `break`. En un `switch` la ejecución entra por la etiqueta que coincide y continúa hacia abajo atravesando las etiquetas siguientes hasta encontrar un `break` o hasta llegar al final de la estructura, comportamiento conocido como caída o fall-through. Los `break` presentes en el código son justamente los que evitan esa caída y hacen que el `switch` se comporte como la cadena de `if` y `elseif`; si se los quitara, un valor de 0 imprimiría los tres textos y la equivalencia se rompería. En la cadena de condicionales, en cambio, la exclusividad entre las ramas es automática y no hace falta ninguna sentencia adicional para conseguirla.

Hay también una diferencia menor en cuanto a la evaluación: el `switch` evalúa su expresión una sola vez y luego compara ese resultado contra cada etiqueta, mientras que la cadena de `if` y `elseif` vuelve a evaluar la expresión en cada comparación. Con una variable simple como `$i` esto es irrelevante, pero pasaría a importar si en lugar de una variable hubiera una llamada a función con efectos colaterales o de cómputo costoso.

Como criterio general, el `switch` resulta más claro cuando se compara una misma expresión contra muchos valores concretos, mientras que la cadena de `if` es la única opción cuando las condiciones son de otra naturaleza, por ejemplo comparaciones por rango o condiciones sobre variables distintas.
