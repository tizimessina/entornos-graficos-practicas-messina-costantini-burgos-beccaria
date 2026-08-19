# Ejercicio 1

## Consigna

Identificar en el código las variables y su tipo, los operadores, las funciones y sus parámetros, las estructuras de control, y cuál es la salida por pantalla.

```php
<?php
function doble($i) {
    return $i*2;
}
$a = TRUE;
$b = "xyz";
$c = 'xyz';
$d = 12;
echo gettype($a);
echo gettype($b);
echo gettype($c);
echo gettype($d);
if (is_int($d)) {
    $d += 4;
}
if (is_string($a)) {
    echo "Cadena: $a";
}
$d = $a ? ++$d : $d*3;
$f = doble($d++);
$g = $f += 10;
echo $a, $b, $c, $d, $f , $g;
?>
```

## Variables y su tipo

El script declara cuatro variables de forma explícita y genera otras tres durante la ejecución. La variable `$a` recibe el valor `TRUE` y es por lo tanto de tipo `boolean`. Las variables `$b` y `$c` reciben ambas el texto `xyz` y son de tipo `string`; la diferencia entre ellas es únicamente el tipo de comillas empleado, ya que `$b` usa comillas dobles y `$c` comillas simples, lo cual afecta a si PHP interpola variables y secuencias de escape dentro de la cadena, pero no al tipo resultante ni al contenido en este caso puntual, porque el texto `xyz` no contiene ni variables ni secuencias de escape. La variable `$d` recibe el entero `12` y es de tipo `integer`; su valor se modifica varias veces a lo largo del script pero conserva ese tipo hasta el final.

Además de esas cuatro, aparece `$i`, que no es una variable global sino el parámetro formal de la función `doble()`. Su ámbito está limitado al cuerpo de la función y su tipo depende del argumento que se le pase en cada invocación; en la única llamada que hace el script recibe un entero. Por último, `$f` y `$g` se crean como resultado de sendas asignaciones y son ambas de tipo `integer`, ya que `doble()` devuelve el producto de un entero por otro entero.

Conviene notar que PHP es un lenguaje de tipado dinámico, de modo que el tipo de una variable no se declara sino que queda determinado por el valor que se le asigna y puede cambiar durante la ejecución del script.

## Operadores

El operador que más aparece es el de asignación simple `=`, que se usa para dar valor inicial a `$a`, `$b`, `$c` y `$d`, y más adelante para asignar el resultado del ternario a `$d`, el retorno de la función a `$f` y el valor de `$f` a `$g`. Junto a él aparece el operador de asignación compuesta `+=`, que se emplea dos veces: en `$d += 4`, equivalente a `$d = $d + 4`, y en `$f += 10`.

Hay dos usos del operador de incremento, que es unario. El primero es el incremento prefijo `++$d`, dentro del ternario, que incrementa la variable y devuelve el valor ya incrementado. El segundo es el incremento sufijo `$d++`, en el argumento de la llamada a `doble()`, que devuelve el valor previo al incremento y recién después modifica la variable. Esta distinción es la que explica buena parte del resultado final del script.

Aparece también el operador aritmético binario de multiplicación `*`, tanto dentro de la función, en `$i*2`, como en la rama no ejecutada del ternario, en `$d*3`. Y aparece el operador ternario `?:`, único operador de tres operandos del lenguaje, en la expresión `$a ? ++$d : $d*3`, que evalúa la condición `$a` y devuelve el segundo operando si resulta verdadera o el tercero si resulta falsa.

Las comas de la línea `echo $a, $b, $c, $d, $f , $g;` no son un operador aritmético sino el separador de argumentos que admite la construcción `echo`, la cual puede recibir varias expresiones y las imprime una tras otra sin ningún separador entre ellas.

## Funciones y sus parámetros

El script define una función propia, `doble()`, que recibe un único parámetro `$i` pasado por valor, que es el comportamiento por defecto de PHP, y devuelve mediante `return` el resultado de multiplicar ese parámetro por dos. Al pasarse por valor, cualquier modificación de `$i` dentro de la función no afectaría a la variable original que se usó como argumento.

Se utilizan además tres funciones predefinidas del lenguaje. La primera es `gettype()`, que recibe una variable como único parámetro y devuelve una cadena con el nombre de su tipo; se la invoca cuatro veces, sobre `$a`, `$b`, `$c` y `$d`. La segunda es `is_int()`, que recibe una variable y devuelve un booleano según si contiene o no un entero. La tercera es `is_string()`, análoga a la anterior pero para cadenas de texto.

Merece aclararse que `echo` no es una función sino una construcción del lenguaje, motivo por el cual no requiere paréntesis y admite varios argumentos separados por comas. Lo mismo ocurre con `print`, que sí se comporta como una expresión que devuelve siempre el valor `1` pero tampoco es formalmente una función.

## Estructuras de control

El script contiene dos sentencias condicionales `if` simples, sin rama `else`. La primera evalúa `is_int($d)` y, como la condición resulta verdadera, ejecuta el incremento de `$d` en cuatro unidades. La segunda evalúa `is_string($a)` y, como `$a` contiene un booleano y no una cadena, la condición resulta falsa y el bloque no llega a ejecutarse nunca.

A esas dos se suma el operador ternario, que si bien es formalmente un operador y no una estructura de control, cumple la misma función que un `if` con `else` y suele analizarse junto a ellas por ser una forma abreviada de escribir una selección entre dos alternativas. Dentro de la función aparece también la sentencia `return`, que interrumpe la ejecución de la función y devuelve un valor al punto desde el cual fue invocada.

No hay en este código ninguna estructura repetitiva, es decir, ningún bucle.

## Traza de la ejecución

Las cuatro llamadas a `gettype()` imprimen, en ese orden, `boolean`, `string`, `string` e `integer`, que se concatenan en la salida sin ningún separador porque `echo` no agrega ninguno.

El primer `if` comprueba que `$d` sea un entero, lo cual es cierto, de modo que `$d` pasa de valer 12 a valer 16. El segundo `if` comprueba si `$a` es una cadena; como `$a` contiene el booleano `TRUE`, la condición es falsa y el texto `Cadena:` no se imprime.

En el ternario se evalúa `$a`, que vale `TRUE`, por lo que se ejecuta la rama del medio: el incremento prefijo lleva `$d` de 16 a 17 y devuelve 17, valor que se asigna nuevamente a `$d`. La rama `$d*3` no se evalúa.

En la línea siguiente se invoca `doble($d++)`. Al tratarse de un incremento sufijo, lo que se pasa efectivamente como argumento es el valor previo, 17, y solo después de eso `$d` pasa a valer 18. La función devuelve 34, que queda en `$f`.

La última asignación es encadenada. Primero se evalúa `$f += 10`, que lleva `$f` de 34 a 44; como toda asignación en PHP es una expresión cuyo valor es el valor asignado, el resultado de esa operación es 44, que a su vez se asigna a `$g`. Ambas variables quedan entonces valiendo 44.

## Salida por pantalla

```
booleanstringstringinteger1xyzxyz184444
```

La primera parte de la salida, `booleanstringstringinteger`, corresponde a las cuatro llamadas a `gettype()`. La segunda parte corresponde al `echo` final. Allí `$a`, que contiene `TRUE`, se imprime como `1`, ya que al convertir un booleano verdadero a cadena PHP produce el carácter `1`; si hubiese valido `FALSE` se habría impreso una cadena vacía y no habría dejado rastro visible. Luego se imprimen `xyz` y `xyz` correspondientes a `$b` y `$c`, y finalmente los números 18, 44 y 44 correspondientes a `$d`, `$f` y `$g`, que al concatenarse sin separador producen la secuencia `184444`, ambigua a simple vista pero perfectamente determinada por la traza.

Cabe aclarar que este resultado supone que el script se ejecuta sin que los avisos de PHP interfieran, y que la salida se observa en el navegador, donde además el código se imprime en una sola línea porque no hay etiquetas `<br>` ni saltos que HTML respete.
