# Ejercicio 4

## Consigna

Analizar la siguiente función, y escribir un script para probar su funcionamiento.

## Archivos incluidos

La función se transcribió sin modificaciones en `comprobar_nombre_usuario.php`, y el script de prueba pedido está en `test_comprobar.php`, que la incorpora mediante `require` y la ejecuta contra doce casos distintos.

## Análisis de la función

La función recibe un único parámetro con el nombre de usuario a validar y devuelve un booleano que indica si ese nombre cumple o no con las reglas establecidas. Además del valor devuelto, imprime un mensaje explicando el veredicto. Responde al problema clásico de validar la entrada de un formulario de registro antes de darla por buena.

La validación se organiza en dos etapas sucesivas, y en ambas se aplica el criterio de salida temprana: en cuanto se detecta un motivo de rechazo se imprime el mensaje y se ejecuta un `return false` que interrumpe la función ahí mismo, sin llegar a evaluar el resto. Solo si se atraviesan las dos etapas sin tropiezos se llega a la última línea, que informa que el nombre es válido y devuelve verdadero.

La primera etapa comprueba la longitud. Mediante `strlen()`, que devuelve la cantidad de caracteres de una cadena, se verifica que el nombre no tenga menos de tres ni más de veinte. Las dos condiciones se combinan con el operador lógico `||`, de modo que basta que se cumpla cualquiera de las dos para que el nombre sea rechazado. Como consecuencia de esta primera comprobación, una cadena vacía también resulta inválida, ya que su longitud es cero y por lo tanto menor que tres.

La segunda etapa comprueba que todos los caracteres pertenezcan a un conjunto permitido. Ese conjunto se define en la variable `$permitidos` como una única cadena que contiene, uno tras otro, las veintiséis letras minúsculas, las veintiséis mayúsculas, los diez dígitos, el guion medio y el guion bajo. Se trata de la técnica conocida como lista blanca, que consiste en enumerar lo que se acepta en lugar de enumerar lo que se rechaza, y que en materia de validación es siempre preferible, porque al aparecer un carácter no previsto el resultado por defecto es rechazarlo en vez de dejarlo pasar.

El recorrido se hace con un bucle `for` que avanza desde la posición cero hasta la última del nombre. En cada vuelta, `substr($nombre_usuario, $i, 1)` extrae un solo carácter, el que está en la posición actual, y `strpos($permitidos, ...)` busca ese carácter dentro de la cadena de permitidos, devolviendo la posición en que lo encuentra o el valor `false` si no aparece.

El punto más delicado de toda la función está en cómo se evalúa ese resultado, y es probablemente el motivo por el cual se la eligió para el ejercicio. La comparación se hace con el operador de identidad `===` y no con el de igualdad `==`. La razón es que `strpos()` devuelve la posición del carácter encontrado, y esa posición puede ser cero cuando el carácter buscado está al principio de la cadena, algo que ocurre concretamente con la letra `a`, que es la primera de `$permitidos`. Como PHP considera que el entero `0` y el booleano `false` son iguales en una comparación no estricta, usar `==` haría que la función interpretara que la letra `a` no fue encontrada y rechazara por error cualquier nombre que la contuviera. El operador `===` compara además el tipo, con lo cual distingue correctamente el cero de un `false` y el problema desaparece. Es un caso tan habitual que el propio manual de PHP lo advierte de forma explícita en la documentación de `strpos()`.

## Observaciones sobre la función

Las pruebas confirman que la función se comporta correctamente en todos los casos previstos, pero hay algunas cuestiones que vale la pena señalar.

La primera y más importante es que `strlen()` no cuenta caracteres sino bytes. Con caracteres del alfabeto inglés ambas cosas coinciden, pero con la codificación UTF-8, que es la habitual hoy, una vocal acentuada o una eñe ocupan dos bytes. Eso tiene dos consecuencias: por un lado el conteo de longitud se distorsiona, de modo que un nombre como `josé` cuenta cinco y no cuatro; por otro lado, y más grave, `substr()` parte esos caracteres por la mitad y entrega bytes sueltos que nunca van a encontrarse en la lista de permitidos, con lo cual todo nombre con tilde o eñe resulta rechazado. Puede argumentarse que ese rechazo es intencional, ya que los nombres de usuario suelen restringirse deliberadamente al alfabeto inglés, pero si se quisiera admitirlos habría que usar las funciones multibyte `mb_strlen()` y `mb_substr()`.

La segunda observación es de diseño: la función mezcla la validación con la presentación, porque además de devolver el veredicto imprime un mensaje en HTML con una etiqueta `<br>` incrustada. Eso la vuelve difícil de reutilizar, ya que no hay manera de validar un nombre en silencio, por ejemplo dentro de un proceso por lotes o en una API que responde en otro formato. Lo apropiado sería que la función se limitara a devolver el booleano, o eventualmente un mensaje de error como texto, y que la decisión sobre cómo mostrarlo quedara del lado de quien la invoca. En el script de prueba esto se sorteó capturando la salida con `ob_start()` y `ob_get_clean()`, que es un recurso válido pero que no haría falta si la función estuviera mejor separada.

La tercera es que el nombre se imprime tal como llegó, sin pasarlo por `htmlspecialchars()`. Si el valor proviene de un formulario, un usuario podría enviar código HTML o JavaScript que terminaría ejecutándose en la página, que es la vulnerabilidad de cross-site scripting ya mencionada en otro ejercicio.

Por último, la misma validación podría escribirse en una sola línea con una expresión regular mediante `preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $nombre_usuario)`, más breve y más clara. La versión con bucle del enunciado es sin embargo más adecuada como ejercicio, porque obliga a recorrer la cadena carácter por carácter y a razonar sobre el valor devuelto por `strpos()`.

## El script de prueba

El script `test_comprobar.php` no se limita a invocar la función unas cuantas veces, sino que define para cada caso el valor a probar, el resultado que se espera obtener y el motivo por el cual ese caso se incluye. Luego los recorre con un `foreach`, compara lo devuelto contra lo esperado y muestra si coinciden, cerrando con un resumen de cuántos casos se comportaron correctamente. De ese modo el script no solo ejecuta la función sino que verifica que haga lo que debería, que es lo que se espera de una prueba.

Los doce casos elegidos cubren tres situaciones distintas. Están los nombres que deben aceptarse, que incluyen combinaciones con guion bajo, guion medio, mayúsculas y dígitos. Están los valores límite, que son los que suelen delatar los errores de comparación: un nombre de exactamente tres caracteres y otro de exactamente veinte, que deben aceptarse, junto con uno de dos y otro de veintiuno, que deben rechazarse. Y están los nombres que deben rechazarse por su contenido, entre ellos uno con espacio, uno con arroba, uno con punto y uno con vocal acentuada, este último incluido justamente para dejar a la vista el comportamiento con UTF-8 comentado más arriba.

Al ejecutarlo, los doce casos se comportan como se esperaba.
