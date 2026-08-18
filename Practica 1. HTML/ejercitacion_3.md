# Ejercitación 3 — Diferencias entre segmentos de código y sus visualizaciones

## 3.a)

```html
<a href="http://www.google.com.ar">Click aquí para ir a Google</a>
<a href="http://www.google.com.ar" target="_blank">Click aquí para ir a Google</a>
<a href="http://www.google.com.ar" type="text/html" hreflang="es" charset="utf-8" rel="help">
<a href="#">Click aquí para ir a Google</a>
<a href="#arriba">Click aquí para volver arriba</a>
<a name="arriba" id="arriba"></a>
```

El primer enlace lleva a Google abriendo el destino en la misma ventana o pestaña actual. El segundo hace lo mismo pero incorpora el atributo target con valor _blank, por lo cual el destino se abre en una ventana o pestaña nueva, manteniendo la página original abierta. El tercero está mal formado, ya que carece del texto visible y de la etiqueta de cierre; además incorpora atributos adicionales como type, hreflang y charset que aportan metadatos sobre el recurso enlazado sin cambiar su comportamiento básico. El cuarto enlaza a "#", que equivale a la propia página sin un destino específico, por lo que al hacer clic no se produce una navegación real. El quinto y el sexto trabajan en conjunto: el enlace a "#arriba" apunta a un ancla interna dentro del mismo documento, identificada por el atributo name o id con valor "arriba" en el último elemento; al hacer clic, el navegador se desplaza automáticamente hasta esa posición del documento en lugar de cargar una página nueva.

## 3.b)

```html
<p><img src="im1.jpg" alt="imagen1" /><a href="http://www.google.com.ar">Click aquí</a></p>
<p><a href="http://www.google.com.ar"><img src="im1.jpg" alt="imagen1" /></a> Click aquí</p>
<p><a href="http://www.google.com.ar"><img src="im1.jpg" alt="imagen1" />Click aquí</a></p>
<p><a href="http://www.google.com.ar"><img src="im1.jpg" alt="imagen1" /></a> <a href="http://www.google.com.ar">Click aquí</a></p>
```

En el primer caso la imagen se muestra como elemento independiente, sin ser clickeable, y solo el texto "Click aquí" funciona como enlace. En el segundo caso ocurre lo inverso a nivel de agrupación: la imagen queda envuelta por el enlace y por lo tanto es clickeable, mientras que el texto queda afuera del enlace y no lo es. En el tercer caso tanto la imagen como el texto quedan dentro de la misma etiqueta de ancla, formando una única zona clickeable que combina imagen y texto. En el cuarto caso existen dos enlaces independientes que apuntan al mismo destino: uno envuelve solo la imagen y otro envuelve solo el texto, logrando que ambos sean clickeables por separado aunque visualmente se vean contiguos.

## 3.c)

```html
<ul><li>xxx</li><li>yyy</li><li>zzz</li></ul>

<ol><li>xxx</li><li>yyy</li><li>zzz</li></ol>

<ol><li>xxx</li></ol>
<ol><li value="2">yyy</li></ol>
<ol><li value="3">zzz</li></ol>

<blockquote><p>1. xxx<br />2. yyy<br />3. zzz</p></blockquote>
```

La primera lista es no ordenada, por lo que sus tres ítems se muestran con viñetas sin numeración implícita. La segunda es una lista ordenada, y el navegador numera automáticamente cada ítem de forma correlativa a partir de 1. La tercera variante divide lo que semánticamente sería una sola lista en tres listas ordenadas independientes; sin el atributo value cada una reiniciaría su numeración en 1, por lo que se utiliza value para forzar manualmente el número de continuación en cada una y simular una secuencia continua, aunque estructuralmente sigan siendo listas separadas. La última variante no utiliza ningún elemento de lista: es un bloque de cita (blockquote) que contiene un único párrafo con la numeración escrita manualmente como texto; visualmente puede parecerse a una lista, pero carece de la semántica de lista real, lo que afecta la interpretación que hacen de ella los lectores de pantalla u otras herramientas.

## 3.d)

```html
<table border="1" width="300">
  <tr><th>Columna 1</th><th>Columna 2</th></tr>
  ...
</table>

<table border="1" width="300">
  <tr><td><div align="center"><strong>Columna1</strong></div></td>
      <td><div align="center"><strong>Columna 2</strong></div></td></tr>
  ...
</table>
```

La primera tabla utiliza la etiqueta th para marcar semánticamente las celdas de encabezado, lo cual además de centrarlas y mostrarlas en negrita por defecto, las identifica como encabezados ante navegadores y tecnologías asistivas, asociándolas correctamente con las celdas de datos de su columna. La segunda tabla logra un efecto visual similar, centrado y en negrita, pero utilizando celdas de datos comunes (td) con un div centrado y un strong para forzar el estilo; visualmente puede resultar parecida, pero pierde por completo la semántica de encabezado, ya que para el navegador esas celdas son datos regulares y no encabezados de columna.

## 3.e)

```html
<table width="200">
  <caption>Título</caption>
  <tr>...filas de datos...</tr>
</table>

<table width="200">
  <tr><td colspan="3"><div align="center">Título</div></td></tr>
  <tr>...filas de datos...</tr>
</table>
```

La primera tabla utiliza el elemento caption para definir el título, que el navegador ubica y estiliza automáticamente por fuera del área de celdas, reconociéndolo semánticamente como el título de la tabla. La segunda tabla simula el mismo efecto visual insertando una fila adicional cuya única celda ocupa todo el ancho mediante colspan y centra el texto con un div; el resultado visual es similar, pero esa celda sigue siendo una fila de datos común dentro de la tabla y no un título reconocido semánticamente como tal.

## 3.f)

```html
<table width="200">
  <tr><td colspan="3">Título</td></tr>
  <tr><td rowspan="2">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>

<table width="200">
  <tr><td colspan="3">Título</td></tr>
  <tr><td colspan="2">&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
```

En la primera tabla, la primera celda de la segunda fila utiliza rowspan="2", por lo que esa celda se extiende verticalmente ocupando el espacio de dos filas, y en consecuencia la tercera fila tiene una columna menos porque ese espacio ya está ocupado. En la segunda tabla, en cambio, se utiliza colspan="2" en la segunda fila, por lo que la celda se extiende horizontalmente fusionando dos columnas dentro de esa misma fila, mientras que la tercera fila conserva sus tres columnas completas. Ambas tablas logran fusionar celdas, pero en direcciones distintas: una en sentido vertical y otra en sentido horizontal, lo que cambia por completo la disposición final de la grilla.

## 3.g)

```html
<table width="200" border="1">
  <tr><td colspan="3">Título</td></tr>
  <tr><td colspan="2" rowspan="2">&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td width="50%">&nbsp;</td></tr>
</table>

<table width="200" border="1" cellpadding="0" cellspacing="0">
  <tr><td colspan="2">Título</td></tr>
  <tr><td rowspan="2">&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td width="50%">&nbsp;</td></tr>
</table>
```

Ambas tablas combinan colspan y rowspan para fusionar celdas tanto horizontal como verticalmente, pero difieren en la cantidad de columnas base: la primera está pensada sobre una grilla de tres columnas y la celda fusionada ocupa dos de ellas además de dos filas, mientras que la segunda está pensada sobre una grilla de dos columnas, por lo que el título ocupa colspan="2" en lugar de tres y la celda combinada solo aplica rowspan sin colspan adicional. Además, la segunda tabla agrega los atributos cellpadding="0" y cellspacing="0", que eliminan el espacio interno de las celdas y la separación entre ellas respectivamente, dando como resultado una tabla visualmente más compacta y con las celdas pegadas entre sí, a diferencia de la primera que conserva los espaciados por defecto del navegador.

## 3.h)

```html
<form id="form1" action="procesar.php" method="post" target="_blank">
  <fieldset><legend>LOGIN</legend>
    Usuario: <input type="text" name="usu1" value="xxx" /><br />
    Clave: <input type="password" name="clave1" value="xxx" />
  </fieldset>
  <input type="submit" value="Enviar" />
</form>

<form id="form2" action="" method="get" target="_blank">
  LOGIN<br />
  <label>Usuario: <input type="text" name="usu2" /></label><br />
  <label>Clave: <input type="text" name="clave2" /></label><br />
  <input type="submit" value="Enviar" />
</form>

<form id="form3" action="mailto:xx@xx.com" enctype="text/plain" method="post" target="_blank">
  <fieldset><legend>LOGIN</legend>
    Usuario: <input type="text" name="usu3" /><br />
    Clave: <input type="password" name="clave3" />
  </fieldset>
  <input type="reset" value="Enviar" />
</form>
```

El primer formulario envía sus datos por método post hacia un script del servidor (procesar.php), lo cual mantiene los valores enviados ocultos en el cuerpo de la petición y no visibles en la URL; agrupa sus campos visualmente con fieldset y legend, y el campo clave utiliza type="password", por lo que su contenido se oculta en pantalla mientras se escribe. El segundo formulario utiliza método get, lo que hace que los datos ingresados se agreguen como parámetros visibles en la URL de destino; además no agrupa los campos con fieldset sino que los envuelve con label para asociar el texto a cada input, y el campo de clave está definido como type="text" en lugar de password, por lo que el valor ingresado queda visible en pantalla, lo cual constituye una falla de seguridad frente al primer formulario. El tercer formulario no envía los datos a un servidor sino que utiliza como action una dirección mailto, junto con enctype="text/plain", lo que provoca que al enviarse se abra el cliente de correo del usuario con los datos del formulario incluidos como cuerpo del mensaje; además, su botón final es de tipo reset y no submit, por lo que en realidad no envía el formulario sino que limpia todos los campos a sus valores iniciales, a pesar de tener como valor visible el texto "Enviar".

## 3.i)

```html
<label>Botón 1
  <button type="button">
    <img src="logo.jpg" alt="Botón con imagen" width="30" height="20" /><br />
    <b>CLICK AQUÍ</b>
  </button>
</label>

<label>Botón 2
  <input type="button" value="CLICK AQUÍ" />
</label>
```

El primer botón utiliza el elemento button, que a diferencia de input permite incluir contenido HTML enriquecido en su interior, en este caso una imagen y un texto en negrita combinados dentro del mismo botón. El segundo botón utiliza input de tipo button, un elemento vacío que solo admite texto plano definido a través del atributo value, sin posibilidad de incluir imágenes ni marcado adicional dentro de él. Ambos producen un control clickeable sin comportamiento de envío de formulario, pero difieren en la riqueza del contenido visual que pueden mostrar.

## 3.j)

```html
<p><label><input type="radio" name="opcion" id="X" value="X" />X</label><br />
<label><input type="radio" name="opcion" id="Y" value="Y" />Y</label></p>

<p><label><input type="radio" name="opcion1" id="X" value="X" />X</label><br />
<label><input type="radio" name="opcion2" id="Y" value="Y" />Y</label></p>
```

En el primer segmento ambos radio buttons comparten el mismo valor en el atributo name ("opcion"), lo que los agrupa como un mismo conjunto de opciones mutuamente excluyentes: al seleccionar uno, el otro se deselecciona automáticamente. En el segundo segmento cada radio button tiene un name distinto ("opcion1" y "opcion2"), por lo que, aunque visualmente se vean igual, el navegador los trata como dos grupos independientes de un solo elemento cada uno, permitiendo que ambos queden seleccionados al mismo tiempo, ya que no existe relación de exclusión entre ellos.

## 3.k)

```html
<select name="lista">
  <optgroup label="Caso 1">...</optgroup>
  <optgroup label="Caso 2">...</optgroup>
</select>

<select name="lista[]" multiple="multiple">
  <optgroup label="Caso 1">...</optgroup>
  <optgroup label="Caso 2">...</optgroup>
</select>
```

El primer select genera una lista desplegable convencional donde solo puede elegirse una opción a la vez, agrupadas visualmente bajo los rótulos "Caso 1" y "Caso 2" mediante optgroup, aunque esa agrupación es únicamente organizativa y no cambia el comportamiento de selección única. El segundo select incorpora el atributo multiple, lo que transforma el control en una lista donde pueden seleccionarse varias opciones a la vez, generalmente mostrando varias filas visibles en lugar de un desplegable; además su atributo name utiliza la notación "lista[]", convención típica para indicar en el procesamiento del lado servidor que se recibirá un conjunto de valores en lugar de uno solo, coherente con la posibilidad de selección múltiple.