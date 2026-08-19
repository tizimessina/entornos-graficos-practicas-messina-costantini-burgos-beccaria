# Ejercicio 2

## Consigna

En cada caso, indicar las salidas correspondientes.

## Apartado a)

```php
<?php
$matriz = array("x" => "bar", 12 => true);
echo $matriz["x"];
echo $matriz[12];
?>
```

La salida es `bar1`.

El array declarado combina una clave de cadena y una clave numérica explícita, lo que confirma que ambos tipos de clave pueden convivir. El primer `echo` accede a la clave `"x"` e imprime el texto `bar` sin ninguna particularidad.

El segundo `echo` accede a la clave `12`, que contiene el valor booleano `true`, e imprime `1`. El motivo es la conversión automática de tipos: cuando un booleano verdadero se convierte a cadena para ser mostrado, PHP produce el carácter `1`. Vale la pena retener el caso complementario, porque es el que suele sorprender: un booleano falso se convierte en cadena vacía, de modo que un `echo` sobre él no imprime absolutamente nada y a simple vista parece que la sentencia no se hubiera ejecutado. Si se quisiera ver el valor real de la variable habría que recurrir a `var_dump()`, que muestra tipo y contenido.

Como las dos salidas se imprimen sin separación, el resultado final aparece concatenado en `bar1`.

## Apartado b)

```php
<?php
$matriz = array("unamatriz" => array(6 => 5, 13 => 9, "a" => 42));

echo $matriz["unamatriz"][6];
echo $matriz["unamatriz"][13];
echo $matriz["unamatriz"]["a"];
?>
```

La salida es `5942`.

Se trata de un array multidimensional, es decir de un array cuyo elemento es a su vez otro array. La estructura tiene un solo elemento en el nivel exterior, bajo la clave `"unamatriz"`, y ese elemento contiene un array de tres posiciones con claves `6`, `13` y `"a"`.

El acceso a los elementos anidados se hace encadenando corchetes, uno por cada nivel de profundidad que se quiera atravesar. El primer par de corchetes selecciona el array interior y el segundo selecciona el elemento buscado dentro de él. Los tres `echo` recuperan respectivamente los valores 5, 9 y 42, que al imprimirse sin separador producen la secuencia `5942`. Nuevamente el resultado resulta ambiguo a la vista, ya que podría leerse de varias maneras, pero se determina sin dificultad conociendo los valores.

También conviene observar que las claves numéricas del array interior, 6 y 13, no guardan relación alguna con la posición que los elementos ocupan dentro de la estructura: son claves arbitrarias elegidas por el programador, no posiciones. Un array de PHP no obliga a que los índices sean consecutivos ni a que empiecen en cero.

## Apartado c)

```php
<?php
$matriz = array(5 => 1, 12 => 2);
$matriz[] = 56;
$matriz["x"] = 42; unset($matriz[5]); unset($matriz);
?>
```

Este fragmento no produce ninguna salida, porque no contiene ningún `echo`, `print` ni ninguna otra sentencia que muestre información por pantalla. La respuesta a la consigna es entonces que la salida es vacía, y lo que corresponde analizar es cómo evoluciona la estructura del array a lo largo de las cuatro operaciones.

El array se declara con dos elementos de claves numéricas explícitas y no consecutivas, quedando como `[5 => 1, 12 => 2]`.

La sentencia `$matriz[] = 56` agrega un elemento sin indicar clave, de modo que PHP asigna automáticamente la siguiente disponible. Esa clave se calcula como el mayor índice entero presente más uno, y como el mayor es 12, el nuevo elemento recibe la clave 13. Este es el punto central del apartado: es un error frecuente suponer que el elemento agregado tomará la clave 2 por ser el tercero, o la clave 0 por ser el primero sin nombre. El array queda como `[5 => 1, 12 => 2, 13 => 56]`.

Luego `$matriz["x"] = 42` agrega un cuarto elemento, esta vez con clave de cadena, que se ubica al final y no altera en nada el conteo de índices numéricos. El array queda como `[5 => 1, 12 => 2, 13 => 56, "x" => 42]`.

La sentencia `unset($matriz[5])` elimina el elemento cuya clave es 5. Es importante notar que eliminar un elemento no reindexa el array ni desplaza a los demás: las claves restantes conservan exactamente el valor que tenían y queda un hueco en la secuencia. El array queda como `[12 => 2, 13 => 56, "x" => 42]`. Si se quisiera reindexar habría que recurrir a `array_values()`.

Finalmente `unset($matriz)` se aplica a la variable completa en lugar de a un elemento, con lo cual el array entero deja de existir. A partir de esa línea `$matriz` queda sin definir, y cualquier intento posterior de usarla produciría un aviso de variable no definida; una comprobación con `isset()` devolvería falso.
