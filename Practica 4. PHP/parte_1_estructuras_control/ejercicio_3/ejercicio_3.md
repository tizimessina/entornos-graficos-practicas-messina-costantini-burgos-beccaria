# Ejercicio 3

## Consigna

Explicar para qué se utiliza el siguiente código.

Los dos códigos del enunciado se transcribieron sin modificaciones en `documento1.php` y `documento2.php`, de manera que puedan ejecutarse en el servidor y contrastar la explicación con el resultado real.

## Apartado a) — Documento 1

El código genera dinámicamente una tabla HTML desde PHP, en lugar de escribirla a mano en el documento. La idea de fondo es que las etiquetas HTML son, para PHP, simple texto: el script no hace otra cosa que ir imprimiendo cadenas que el navegador recibe y luego interpreta como marcado.

El primer `echo` abre la tabla y fija sus atributos de ancho y borde. Inmediatamente después se definen dos variables, `$row` con valor 5 y `$col` con valor 2, que son las que determinan las dimensiones de la tabla y concentran en un solo lugar los valores que habría que tocar si se quisieran otras dimensiones. A continuación viene el núcleo del ejercicio, que es un par de bucles `for` anidados. El bucle exterior se repite tantas veces como filas se pidieron y en cada vuelta imprime una etiqueta de apertura de fila, luego cede el control al bucle interior y finalmente imprime la etiqueta de cierre. El bucle interior se repite tantas veces como columnas se pidieron e imprime en cada vuelta una celda completa. Terminados ambos bucles, un último `echo` cierra la tabla.

El resultado es una tabla de cinco filas por dos columnas, es decir diez celdas en total, todas vacías. Que se vean como celdas y no como espacio en blanco se debe al contenido `&nbsp;`, que es la entidad HTML del espacio de no separación: sin ella muchas celdas vacías no se dibujarían con su borde en los navegadores más antiguos, y es por ese motivo que se la incluye. Los `\n` que aparecen dentro de las cadenas son saltos de línea reales, pero solo afectan al código fuente que recibe el navegador, no a la página que se muestra, ya que HTML ignora los saltos de línea del marcado; su única finalidad es que el código generado quede legible al mirar el fuente de la página.

Este es el ejemplo típico de lo que aporta un lenguaje de servidor frente al HTML estático: la estructura del documento deja de estar escrita literalmente y pasa a construirse en función de datos. Cambiando el valor de dos variables se obtiene una tabla de cualquier tamaño sin tocar una línea más, y en un caso real esos valores no serían constantes sino que provendrían de un formulario o de una consulta a la base de datos.

Vale señalar, sin que sea el punto del ejercicio, que el atributo de ancho está escrito sin comillas, algo que los navegadores toleran pero que no es HTML válido, y que tanto `width` como `border` son atributos de presentación que hoy están obsoletos y corresponderían a una hoja de estilos, en línea con lo trabajado en la práctica de CSS.

## Apartado b) — Documento 2

El código implementa un formulario autoprocesado, es decir un formulario que se envía a la misma página que lo contiene, de modo que un único archivo cumple los dos roles que normalmente se repartirían entre dos: mostrar el formulario al usuario y procesar los datos que este envía.

El mecanismo que permite distinguir un momento del otro es la condición `!isset($_POST['submit'])`. La función `isset()` determina si una variable está definida, y `$_POST` es el arreglo asociativo en el que PHP deposita los valores enviados por un formulario que usa el método `post`. La primera vez que se accede a la página, el usuario llega mediante un enlace o escribiendo la dirección, no hay ningún envío previo y por lo tanto `$_POST` está vacío: la condición resulta verdadera y se ejecuta la rama que dibuja el formulario. Cuando el usuario completa el campo y presiona el botón, el navegador vuelve a pedir la misma página pero esta vez por `post` y con los datos adjuntos, entre ellos el propio botón, que tiene atributo `name` con valor `submit` y por eso viaja junto con el resto; ahora la condición resulta falsa y se ejecuta la rama `else`, que procesa la información.

El atributo `action` del formulario se completa con `$_SERVER['PHP_SELF']`, una variable predefinida que contiene la ruta del script que se está ejecutando. Es justamente lo que hace posible que el formulario se envíe a sí mismo sin necesidad de escribir el nombre del archivo a mano, con la ventaja de que si el archivo se renombra o se mueve el formulario sigue funcionando.

El procesamiento propiamente dicho es sencillo: se recupera el valor del campo desde `$_POST['age']`, se lo guarda en `$age` y se lo compara contra 21 con un `if` que imprime uno de dos mensajes posibles.

También conviene observar cómo se alternan los bloques de PHP y de HTML. El script abre un bloque PHP, evalúa la condición, cierra el bloque para escribir el formulario directamente como HTML plano, y vuelve a abrirlo para cerrar la llave del `if` y continuar con el `else`. Es una técnica muy habitual y perfectamente válida, porque las llaves de una estructura de control no necesitan estar dentro del mismo bloque PHP, aunque a costa de que el código resulte más difícil de seguir.

Hay tres observaciones que exceden lo que pide la consigna pero que vale la pena registrar. La primera es que el umbral de 21 años no corresponde a la mayoría de edad en Argentina, que es de 18 años desde la reforma del Código Civil de 2009, por lo que el ejemplo está tomado de una fuente extranjera. La segunda es que el valor recibido no se valida en absoluto: si el usuario deja el campo vacío o escribe texto, la comparación se realiza igual con resultados poco previsibles, y lo correcto sería verificar que se trate de un número antes de compararlo. La tercera es que volcar `$_SERVER['PHP_SELF']` directamente en el atributo `action` es una vulnerabilidad conocida de tipo cross-site scripting, ya que un atacante puede manipular la dirección para inyectar código en la página; la solución habitual es pasar el valor por `htmlspecialchars()` o, más simple todavía, dejar el atributo `action` vacío, que produce el mismo efecto de enviar el formulario a la propia página.

## Cómo probarlos

Ambos archivos requieren un servidor con PHP, no alcanza con abrirlos desde el explorador de archivos. Las instrucciones para XAMPP están en el README de la práctica.
