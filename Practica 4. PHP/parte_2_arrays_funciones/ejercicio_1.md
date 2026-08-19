# Ejercicio 1

## Consigna

Indicar si los siguientes códigos son equivalentes.

```php
<?php
$a = array( 'color'  => 'rojo',
            'sabor'  => 'dulce',
            'forma'  => 'redonda',
            'nombre' => 'manzana',
            4
          );
?>
```

```php
<?php
$a['color']  = 'rojo';
$a['sabor']  = 'dulce';
$a['forma']  = 'redonda';
$a['nombre'] = 'manzana';
$a[]         = 4;
?>
```

## Respuesta

Sí, los dos códigos son equivalentes en cuanto al array que producen. Ambos dejan en `$a` la misma estructura, con las mismas claves, los mismos valores, los mismos tipos y en el mismo orden, al punto que compararlos con el operador de identidad `===`, que en arrays exige coincidencia de pares clave-valor, de tipos y de orden, devuelve verdadero.

El resultado en los dos casos es el siguiente:

```php
array (
  'color'  => 'rojo',
  'sabor'  => 'dulce',
  'forma'  => 'redonda',
  'nombre' => 'manzana',
  0        => 4,
)
```

Lo que el ejercicio busca hacer notar es que en PHP un mismo array puede construirse de dos maneras distintas. La primera es la construcción en bloque mediante `array()`, que enumera todos los elementos de una vez. La segunda es la construcción incremental mediante asignaciones sucesivas a claves individuales, que no requiere declarar el array previamente porque PHP lo crea de forma automática en la primera asignación.

El punto más interesante está en el último elemento de cada versión. En la primera, el valor `4` se escribe sin ninguna clave asociada, en medio de una lista donde todos los demás elementos sí la tienen. En la segunda, se lo agrega con la sintaxis `$a[] = 4`, que significa añadir al final. En ambos casos ese elemento termina teniendo la clave numérica `0`, y el motivo es el mismo: cuando no se indica clave, PHP asigna automáticamente el siguiente entero disponible, calculado como el mayor índice entero ya presente en el array más uno, o cero si todavía no hay ninguna clave entera. Como las cuatro claves previas son cadenas y no intervienen en ese cálculo, el índice que corresponde es el cero.

Esto muestra de paso que los arrays de PHP no se dividen tajantemente en indexados y asociativos, como sugiere la clasificación habitual, sino que un mismo array puede combinar claves numéricas y de cadena sin ningún inconveniente. En rigor todos los arrays de PHP son asociativos, y lo que se llama array indexado no es más que el caso particular en el que las claves resultan ser enteros consecutivos desde cero.

## Diferencia a tener en cuenta

Aunque el resultado sea el mismo, las dos formas no son intercambiables en cualquier contexto, y la diferencia aparece cuando `$a` ya existía antes de estas líneas. La construcción con `array()` crea un array nuevo y lo asigna, descartando por completo cualquier contenido anterior de la variable. Las asignaciones sucesivas, en cambio, operan sobre lo que ya hubiera: si `$a` contenía previamente otros elementos, estos se conservan, las claves que coincidan se sobrescriben y el índice que reciba `$a[] = 4` dependerá de las claves numéricas preexistentes, con lo cual bien podría no ser cero. Y si `$a` existiera pero conteniendo un valor que no es un array, como un número o una cadena, la segunda forma directamente produce un error, mientras que la primera simplemente reemplaza el valor sin protestar.

Dicho de otro modo, son equivalentes partiendo de una variable sin definir, que es el caso del ejercicio, pero no lo son en general.
