# Ejercicio 5

## Consigna

Analizar el siguiente ejemplo: contador de visitas a una página web. En la misma carpeta, crear el archivo de texto `contador.dat`, con el valor inicial del contador y con permisos de lectura y escritura.

## Archivos incluidos

En esta carpeta están `contador.php`, `visitas.php` y `contador.dat`, ya inicializado en cero. Se agrega además `contador_mejorado.php`, que no forma parte del enunciado y se incluye únicamente para mostrar cómo se resolverían los problemas señalados al final del análisis; el archivo original se conserva sin cambios de lógica.

La única modificación respecto del enunciado es la etiqueta de apertura. El código original usa la etiqueta corta `<?`, que depende de la directiva `short_open_tag` del `php.ini` y viene desactivada por defecto en las versiones actuales de PHP, con lo cual el navegador mostraría el código fuente como texto plano en lugar de ejecutarlo. Se reemplazó por la etiqueta estándar `<?php`, que funciona siempre.

## Qué hace el ejemplo

El conjunto implementa el clásico contador de visitas, que lleva la cuenta de cuántas veces se solicitó una página y muestra el total. Como PHP no conserva información entre una petición y otra, el número tiene que guardarse en algún lugar persistente, y en este caso se recurre a la forma más elemental de persistencia, que es un archivo de texto plano en el disco del servidor. El ejercicio sirve entonces como introducción a la gestión básica de archivos.

El reparto de responsabilidades entre los dos archivos es el que se usaría en un sitio real. En `contador.php` está toda la lógica y en `visitas.php` está la página que la consume, incorporando esa lógica mediante `include`. La ventaja del planteo es que el contador se escribe una sola vez y puede insertarse en cuantas páginas se quiera con una sola línea, en lugar de repetir el código en cada una de ellas.

## Análisis paso a paso de contador.php

La primera sentencia guarda en `$archivo` el nombre del archivo de datos. Tenerlo en una variable en lugar de repetir el literal en cada llamada evita errores al modificarlo y es una buena práctica elemental.

A continuación se abre el archivo en modo lectura con `fopen($archivo, "r")`. Esta función devuelve un identificador, que es una variable de tipo `resource`, es decir una referencia a un recurso externo. Ese identificador es el que reciben todas las funciones posteriores para saber sobre qué archivo trabajar.

La lectura se hace con `fread($abrir, filesize($archivo))`, que lee una cantidad determinada de bytes. Como segundo argumento se pasa el tamaño del archivo obtenido mediante `filesize()`, con lo cual se lee el contenido completo de una sola vez. El valor leído es una cadena, no un número, aunque eso no dará problemas más adelante por lo que se explica enseguida.

Terminada la lectura se cierra el archivo con `fclose()` y se lo vuelve a abrir, esta vez con `fopen($archivo, "w")`. Este segundo modo es el de escritura y tiene una característica decisiva: al abrir el archivo en modo `w` su contenido anterior se elimina por completo y el puntero queda al principio. Es la razón por la cual el valor tuvo que leerse antes, en una operación separada, y no puede leerse después.

El incremento se realiza con `$cont = $cont + 1`. Aquí interviene la conversión automática de tipos de PHP: `$cont` contiene la cadena leída del archivo, pero al aplicarle un operador aritmético el lenguaje la convierte a número, hace la suma y devuelve un entero. Es un ejemplo directo del tipado dinámico y de la conversión implícita.

El nuevo valor se graba con `fwrite($abrir, $cont)`, que escribe la cadena indicada dentro del archivo y devuelve la cantidad de bytes escritos, valor que aquí se guarda en `$guardar` pero nunca se usa. Se cierra el archivo por segunda vez y, finalmente, un `echo` muestra el total al usuario concatenando el número dentro de un fragmento de HTML.

## Análisis de visitas.php

Es una página HTML mínima cuyo único contenido dinámico es la línea `include("contador.php")`, ubicada dentro del cuerpo. En el momento en que el intérprete llega a esa línea, incorpora y ejecuta el contador, de modo que la salida de este queda insertada exactamente en ese punto del documento. Es la aplicación práctica de lo visto en el ejercicio anterior sobre `include`.

## Problemas del código y cómo se resolverían

El código funciona, pero tiene varias debilidades que conviene señalar porque son justamente las que el ejercicio permite discutir.

La más inmediata es que no verifica en ningún momento el resultado de `fopen()`. Si el archivo no existe, si la ruta es incorrecta o si el usuario del servidor web no tiene permisos sobre él, `fopen()` devuelve `false` y todas las operaciones siguientes fallan en cadena. De ahí la insistencia del enunciado en crear el archivo previamente y con permisos de lectura y escritura.

Relacionado con lo anterior, el archivo debe además contener un valor inicial y no puede quedar vacío. Si `contador.dat` existe pero está vacío, `filesize()` devuelve cero y `fread()` recibe una longitud de cero bytes, lo cual en PHP 8 produce directamente un error fatal que corta la ejecución de la página. Ese es el motivo concreto por el que el enunciado pide crearlo con el valor inicial y no simplemente crearlo.

Un tercer problema, menos visible pero más serio en un sitio con tráfico, es que el archivo se abre y se cierra dos veces sin ningún tipo de bloqueo. Entre la lectura y la escritura hay una ventana de tiempo durante la cual otra visita simultánea puede leer el mismo valor antiguo, con lo que ambas escribirán el mismo número y una visita se perderá. Es la condición de carrera clásica. La forma correcta de resolverlo es abrir el archivo una sola vez en modo `r+`, que permite leer y escribir sin truncar, y protegerlo con `flock()` mientras dura la operación.

Por último, la etiqueta `<font>` empleada para dar formato al texto está obsoleta desde HTML 4.01 y fue eliminada del estándar en HTML5. Corresponde reemplazarla por un elemento genérico con estilos aplicados desde CSS, en línea con la separación entre estructura y presentación trabajada en la práctica anterior.

El archivo `contador_mejorado.php` incluido en esta carpeta aplica estas cuatro correcciones: crea el archivo si no existe, lo abre una única vez en modo `r+`, lo protege con `flock()` y reemplaza `<font>` por un elemento con estilo. Se lo puede ejecutar y comparar con el original.
