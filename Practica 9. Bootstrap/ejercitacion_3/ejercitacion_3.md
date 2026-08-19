# Ejercitación 3 - Componentes

## Consigna

1. En el div de color verde creado en el ejercicio anterior, agregarle un
   componente de alerta que tenga la clase `alert-success` con un texto
   cualquiera.
2. Dentro del sidebar, añadir un botón. Al presionar el botón deberá
   desplegarse un modal con 2 botones: uno para cerrarlo y otro que diga
   "guardar cambios".
3. Crear un componente de tipo `card` para cada uno de los 4 rectángulos
   violetas (imagen, título, texto descriptivo y un botón "Link").
4. En el rectángulo celeste más grande (el de la esquina inferior derecha),
   añadir un slider con 3 imágenes.
5. En un nuevo documento, crear un formulario de contacto con los campos
   nombre, email, teléfono, asunto y cuerpo del mensaje. Todos los campos
   menos el cuerpo del mensaje (que será un textarea) deberán ser inputs de
   texto. Añadir un botón para enviar dicho formulario.

## Archivos

- `componentes.html` → puntos 1 a 4 (parte de la estructura de la
  ejercitación 2, ya con los componentes incorporados)
- `formulario.html` → punto 5 (documento nuevo, separado)

## Decisiones

### Javascript

El modal (punto 2) y el slider (punto 4) **no funcionan solo con CSS**:
requieren la librería Javascript de Bootstrap. Por eso `componentes.html`
importa, al final del `<body>` y en este orden, los tres archivos que
indica el material de la cátedra: jQuery, Popper.js y `bootstrap.min.js`.
`formulario.html` no los necesita, así que no los incluye.

### Punto 1 - alert

El `alert alert-success` se colocó **dentro** del div verde (no
reemplazándolo), tal como pide la consigna ("en el div de color verde ...
agregarle un componente de alerta"). Se le agregó `mb-0` para que el
margen inferior propio del alert no descuadre el bloque verde que lo
contiene.

### Punto 2 - modal

El botón vive dentro del sidebar y dispara el modal mediante los atributos
`data-toggle="modal"` y `data-target="#modalSidebar"`.

El `div` del modal se colocó **fuera** del `container`, al final del
`<body>`. Bootstrap lo recomienda así para evitar que otros elementos con
posicionamiento (como el sidebar) interfieran con la superposición del
modal. Funciona igual estando anidado, pero fuera es la práctica correcta.

El pie del modal tiene los 2 botones pedidos: "Cerrar" (con
`data-dismiss="modal"`) y "Guardar cambios". La "X" de la cabecera es
adicional y viene del componente estándar.

### Punto 3 - cards

Cada card respeta el modelo del mockup: imagen arriba (`card-img-top`),
título (`card-title`), texto descriptivo (`card-text`) y un botón azul con
la leyenda "Link" (`btn btn-primary`).

### Punto 4 - slider

Se usó el componente `carousel` de Bootstrap sobre el rectángulo celeste
grande, con `carousel-indicators` (los puntitos), tres `carousel-item` y
los controles anterior/siguiente. El atributo `data-ride="carousel"` hace
que arranque a rotar solo.

### Imágenes

Tanto las cards como el slider usan **imágenes SVG embebidas como data
URI** en vez de archivos externos o servicios online de placeholders. La
ventaja es que el HTML es autocontenido: se ve igual aunque no haya
conexión a internet y no hay que subir archivos de imagen al repositorio.
Si se prefiere, se pueden reemplazar por rutas a imágenes reales sin
tocar nada más de la estructura.

### Punto 5 - formulario

Se armó como documento aparte (`formulario.html`), como pide la consigna.
Se usó el formulario vertical de Bootstrap: cada par label + control va
envuelto en un `div` con clase `form-group`, y cada control lleva
`form-control`.

Los cinco campos son nombre, email, teléfono, asunto y cuerpo del mensaje.
Los primeros cuatro son `input type="text"` — **incluido el email**, ya
que la consigna dice textualmente que "todos los campos menos el cuerpo
del mensaje deberán ser inputs de texto". (Nota: en un sitio real
convendría usar `type="email"` y `type="tel"` para aprovechar la
validación del navegador, pero acá se respetó lo pedido al pie de la
letra.) El cuerpo del mensaje es un `textarea`, y el botón de envío es un
`button type="submit"` con clase `btn btn-primary`.