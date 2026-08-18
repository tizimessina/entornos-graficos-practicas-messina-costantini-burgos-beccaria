# Ejercitación 2 — Análisis de segmentos de código

## 2.a)

```html
<!-- Código controlado el día 12/08/2009 -->
```

Este segmento es un comentario HTML y puede ubicarse en cualquier sección del documento, tanto dentro del head como del body, ya que no forma parte del contenido interpretado por el navegador. Su efecto es nulo desde el punto de vista visual: el navegador lo ignora por completo y solo resulta visible para quien lee el código fuente, funcionando como una anotación para el desarrollador. No posee elementos ni atributos propiamente dichos; se delimita únicamente con la secuencia de apertura y cierre del comentario, que debe respetarse de forma exacta para que sea interpretado correctamente.

## 2.b)

```html
<div id="bloque1">Contenido del bloque1</div>
```

Este segmento se ubica dentro del body, ya que representa contenido visible del documento. El elemento div es un contenedor genérico de tipo bloque, cuya función es agrupar contenido para poder aplicarle estilos mediante CSS o manipularlo mediante JavaScript, sin aportar ningún significado semántico propio. El atributo id no es obligatorio para el funcionamiento del elemento, pero en este caso se utiliza para asignarle un identificador único, "bloque1", que permite referenciarlo posteriormente desde una hoja de estilos o un script.

## 2.c)

```html
<img src="" alt="lugar imagen" id="im1" name="im1" width="32" height="32" longdesc="detalles.htm" />
```

Este segmento se ubica dentro del body y su efecto es insertar una imagen en el documento; en este caso particular, al estar vacío el atributo src, no habría ninguna imagen visible y el navegador mostraría el texto alternativo o un ícono de imagen rota. El atributo src es obligatorio y define la ruta del archivo de imagen a mostrar, mientras que alt también es obligatorio en la especificación y provee un texto alternativo que se muestra si la imagen no puede cargarse, además de ser fundamental para la accesibilidad. Los atributos id y name son opcionales y sirven para identificar el elemento; width y height son opcionales y definen las dimensiones en píxeles con las que se reserva el espacio de la imagen; longdesc es opcional y permite enlazar a un documento externo con una descripción extendida de la imagen.

## 2.d)

```html
<meta name="keywords" lang="es" content="casa, compra, venta, alquiler " />
<meta http-equiv="expires" content="16-Sep-2019 7:49 PM" />
```

Ambas líneas se ubican dentro del head, ya que son metadatos del documento y no contenido visible. La primera etiqueta meta define palabras clave asociadas al documento mediante el atributo name con valor keywords, empleado históricamente por los buscadores para indexar el contenido; el atributo content, obligatorio en toda etiqueta meta, contiene el listado de palabras separadas por comas, y el atributo lang, opcional, indica el idioma de ese contenido. La segunda etiqueta utiliza http-equiv en lugar de name, simulando una cabecera HTTP de expiración del documento, con el fin de indicar al navegador o a los proxies intermedios hasta qué fecha puede considerarse válida la página en caché; su efecto tampoco es visible en pantalla.

## 2.e)

```html
<a href="http://www.e-style.com.ar/resumen.html" type="text/html" hreflang="es" charset="utf-8" rel="help">Resumen HTML</a>
```

Este segmento se ubica en el body, ya que genera contenido visible e interactivo: un enlace de texto que, al hacer clic, dirige al usuario hacia la URL indicada. El atributo href es obligatorio y define el destino del enlace. Los demás atributos son opcionales: type indica el tipo MIME del recurso de destino, hreflang señala el idioma del documento enlazado, charset especifica la codificación de caracteres del recurso destino (atributo hoy en desuso) y rel describe la relación entre el documento actual y el destino, en este caso "help", indicando que el enlace conduce a un recurso de ayuda.

## 2.f)

```html
<table width="200" summary="Datos correspondientes al ejercicio vencido">
  <caption align="top"> Título </caption>
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">A</th>
    <th scope="col">B</th>
    <th scope="col">C</th>
  </tr>
  <tr>
    <th scope="row">1º</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">2º</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
```

Este segmento se ubica en el body y su efecto es mostrar una tabla de tres columnas de datos más una columna de encabezado de fila, con un título visible arriba y dos filas de datos vacíos. El atributo width es opcional y fija el ancho de la tabla; summary es opcional y describe el propósito de la tabla para tecnologías asistivas, sin efecto visual. El elemento caption es opcional y define el título visible de la tabla, cuya posición puede ajustarse con el atributo align, también opcional. Cada fila se define con tr, y dentro de ella los encabezados se marcan con th, mientras que los datos regulares usan td; el atributo scope, opcional pero recomendado por accesibilidad, indica si un encabezado corresponde a una columna (col) o a una fila (row), permitiendo asociar correctamente cada celda de datos con su encabezado.