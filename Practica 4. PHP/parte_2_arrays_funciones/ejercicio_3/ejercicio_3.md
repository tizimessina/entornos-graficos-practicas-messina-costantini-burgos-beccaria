# Ejercicio 3

## Consigna

En cada caso, indicar las salidas correspondientes.

## Apartado a)

```php
<?php
$fun = getdate();
echo "Has entrado en esta pagina a las $fun[hours] horas, con $fun[minutes] minutos y $fun[seconds] segundos, del $fun[mday]/$fun[mon]/$fun[year]";
?>
```

La salida es una frase con la fecha y la hora del momento en que se ejecuta el script, con el siguiente formato:

```
Has entrado en esta pagina a las 22 horas, con 25 minutos y 3 segundos, del 19/8/2026
```

A diferencia de los ejercicios anteriores, aquí no existe una salida única y fija: los valores concretos cambian en cada ejecución, porque dependen del reloj del servidor. Lo que sí es fijo es la estructura del texto y el criterio con que se obtiene cada número.

La función `getdate()` devuelve un array asociativo con la información de fecha y hora desglosada en componentes. Si se la invoca sin argumentos, como en este caso, toma la hora local actual; opcionalmente puede recibir una marca de tiempo y devolver los datos correspondientes a ese instante. El array que produce incluye las claves `seconds`, `minutes` y `hours` para la hora, `mday` para el día del mes, `wday` para el día de la semana numerado desde cero para el domingo, `mon` para el mes numerado desde uno, `year` para el año en cuatro dígitos, `yday` para el día del año, `weekday` y `month` con los nombres en inglés, y la clave numérica `0` con la marca de tiempo Unix.

El `echo` recupera seis de esas claves y las intercala dentro de una cadena entre comillas dobles. Es importante notar que las claves aparecen escritas sin comillas, como `$fun[hours]` en lugar de `$fun['hours']`. Esto funciona porque dentro de una cadena entre comillas dobles PHP aplica la llamada sintaxis simple de interpolación, en la cual una clave sin comillas se interpreta como cadena literal. Fuera de una cadena esa misma escritura sería incorrecta: PHP buscaría una constante llamada `hours` y, al no encontrarla, en las versiones actuales produce un error fatal. La forma segura y recomendada, tanto dentro como fuera de la cadena, es escribir siempre la clave entre comillas y, si se la usa dentro de un texto, encerrar la expresión completa entre llaves, como en `{$fun['hours']}`.

Vale también señalar que los valores se muestran sin relleno de ceros, de modo que una hora temprana aparece como un solo dígito. Si se buscara un formato de fecha presentable convendría usar `date()` con una cadena de formato en lugar de armar el texto componente por componente.

## Apartado b)

```php
<?php
function sumar($sumando1,$sumando2){
  $suma=$sumando1+$sumando2;
  echo $sumando1."+".$sumando2."=".$suma;
}
sumar(5,6);
?>
```

La salida es `5+6=11`.

La función se define con dos parámetros, calcula la suma en una variable local y muestra el resultado en forma de igualdad. El operador `.` que aparece cuatro veces en el `echo` es el de concatenación de cadenas, que une los valores con los signos `+` y `=` intercalados como texto literal. Corresponde no confundir ese `+` escrito entre comillas, que es simplemente un carácter dentro de una cadena, con el `+` de la línea anterior, que sí es el operador aritmético que realiza la suma.

La invocación pasa los valores 5 y 6, que se asocian a los parámetros según el orden en que aparecen, de modo que `$sumando1` recibe 5 y `$sumando2` recibe 6.

Hay una observación de diseño que el ejercicio permite discutir, y es que esta función muestra el resultado pero no lo devuelve, ya que carece de `return`. Eso significa que el valor calculado se pierde apenas termina la ejecución y que quien la invoca no puede reutilizarlo para nada; de hecho, si se escribiera `$total = sumar(5,6)`, la variable `$total` quedaría valiendo `null`. Lo habitual es que una función de cálculo devuelva el resultado mediante `return` y deje la decisión de cómo mostrarlo a cargo de quien la llama, separando así el cálculo de la presentación. La variable `$suma` es además local a la función y no existe fuera de ella.

## Archivos incluidos

Los dos códigos están transcriptos en `getdate.php` y `sumar.php` para poder ejecutarlos y verificar las salidas.
