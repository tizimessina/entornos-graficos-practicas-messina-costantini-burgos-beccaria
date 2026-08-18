# Ejercitación 1 - Introducción a CSS

## 1. ¿Qué es CSS y para qué se usa?

CSS (**C**ascading **S**tyle **S**heets, Hojas de Estilo en Cascada) es un lenguaje de hojas de estilo que permite describir **la presentación** de un documento HTML: colores, tipografías, tamaños, márgenes, bordes, espaciado, disposición de los elementos en la página, etc.

No es un lenguaje de programación ni de marcado. Su función es separar el **contenido** (definido en el HTML) de la **forma o presentación** (definida en el CSS), lo que permite:

- Mantener el código HTML más limpio y semántico.
- Reutilizar un mismo estilo en muchas páginas.
- Modificar la apariencia de todo un sitio cambiando un solo archivo.

## 2. CSS utiliza reglas para las declaraciones de estilo, ¿cómo funcionan?

Una regla CSS está formada por un **selector** y un **bloque de declaraciones** entre llaves `{ }`:

```css
selector {
  propiedad: valor;
  propiedad: valor;
}
```

- El **selector** indica a qué elemento(s) del documento se le aplicará el estilo.
- Cada **declaración** está compuesta por una **propiedad** (qué aspecto se modifica) y un **valor** (cómo se modifica), separados por dos puntos `:` y finalizados con punto y coma `;`.

Ejemplo:

```css
h1 {
  color: red;
  font-size: 20px;
}
```

Aquí el selector `h1` le dice al navegador que la regla se aplica a todos los elementos `<h1>`, y las declaraciones indican que el texto debe ser rojo y de tamaño 20px.

## 3. ¿Cuáles son las tres formas de dar estilo a un documento?

1. **Estilos en línea (inline):** se definen directamente sobre la etiqueta HTML usando el atributo `style`. Es la forma más rápida pero la menos recomendada, ya que mezcla contenido con presentación y solo afecta a ese elemento puntual.

   ```html
   <h1 style="color:#ff0000; background-color:#ffff00">Título</h1>
   ```

2. **Estilos internos (embebidos):** se definen dentro de la sección `<head>` del documento HTML, encerrados entre las etiquetas `<style>` y `</style>`. Afectan a toda esa página.

   ```html
   <head>
     <style>
       h1 { color: #ff0000; background-color: #ffff00; }
     </style>
   </head>
   ```

3. **Estilos externos:** se definen en un archivo aparte con extensión `.css`, y se enlazan al documento HTML mediante la etiqueta `<link>` dentro del `<head>`. Es la forma más recomendada porque permite reutilizar la hoja de estilo en varias páginas y aprovechar el caché del navegador.

   ```html
   <head>
     <link rel="StyleSheet" href="estilos.css" type="text/css">
   </head>
   ```

## 4. ¿Cuáles son los distintos tipos de selectores más utilizados? Ejemplifique cada uno.

- **Selector universal**: selecciona todos los elementos.
  ```css
  * { margin: 0; }
  ```

- **Selector de tipo (o de etiqueta)**: selecciona todos los elementos de un tipo HTML determinado.
  ```css
  p { color: black; }
  ```

- **Selector de clase**: selecciona todos los elementos que tengan asignado un atributo `class` con ese nombre. Se antepone un punto `.`.
  ```css
  .destacado { color: red; }
  ```

- **Selector de id**: selecciona el elemento con ese atributo `id`. Se antepone un numeral `#`. En teoría el id debería ser único en el documento.
  ```css
  #menu { background-color: gray; }
  ```

- **Selector de atributo**: selecciona elementos que poseen un atributo determinado (con o sin un valor específico).
  ```css
  a[href] { color: blue; }
  ```

- **Selector descendiente**: selecciona elementos que están dentro de otro elemento (a cualquier nivel de profundidad), separados por un espacio.
  ```css
  div p { color: green; }
  ```

- **Selector de hijo directo**: selecciona elementos que son hijos directos de otro, separados por `>`.
  ```css
  div > p { color: green; }
  ```

- **Selector agrupado**: aplica la misma regla a varios selectores a la vez, separados por comas.
  ```css
  h1, h2, h3 { color: red; }
  ```

- **Pseudo-clases**: seleccionan un elemento según un estado especial (ver punto 5).
  ```css
  a:hover { color: fuchsia; }
  ```

## 5. ¿Qué es una pseudo-clase? ¿Cuáles son las más utilizadas aplicadas a vínculos?

Una **pseudo-clase** es un calificador que se agrega a un selector (separado por `:`) y que permite aplicar un estilo según un **estado o característica especial** de un elemento, que no depende directamente de un atributo del HTML sino de la situación en la que se encuentra (por ejemplo, si el mouse está sobre él, si ya fue visitado, si es el primer hijo, etc.).

Las pseudo-clases más utilizadas aplicadas a vínculos (`<a>`) son:

- `a:link` — enlace no visitado.
- `a:visited` — enlace ya visitado por el usuario.
- `a:hover` — cuando el mouse pasa por encima del enlace.
- `a:active` — mientras el enlace está siendo "clickeado" (en el momento del click).

Es importante respetar el **orden LVHA** (`:link`, `:visited`, `:hover`, `:active`) al declararlas, porque al tener la misma especificidad, en caso de superposición gana la última regla escrita en la cascada.

## 6. ¿Qué es la herencia?

La **herencia** es el mecanismo por el cual ciertas propiedades CSS aplicadas a un elemento "padre" son heredadas automáticamente por sus elementos "hijos", salvo que estos tengan una regla propia que las sobrescriba.

No todas las propiedades se heredan: generalmente se heredan las relacionadas al texto (`color`, `font-family`, `font-size`, `text-align`, etc.), mientras que propiedades como `border`, `margin`, `padding` o `background-color` **no se heredan** por defecto.

Ejemplo: si se define `color: black;` en `body`, todos los textos dentro del `body` (párrafos, títulos, listas, etc.) serán negros a menos que se indique explícitamente otro color para alguno de ellos.

## 7. ¿En qué consiste el proceso denominado cascada?

La **cascada** es el mecanismo que utiliza el navegador para decidir, cuando **varias reglas CSS aplican a un mismo elemento**, cuál es el valor final que se debe utilizar para cada propiedad. El orden de resolución es, a grandes rasgos:

1. **Origen e importancia:** los estilos del autor tienen prioridad sobre los del navegador, y una declaración marcada con `!important` tiene prioridad sobre las demás.
2. **Especificidad del selector:** cuanto más específico es un selector, mayor prioridad tiene. El orden de especificidad (de menor a mayor) es aproximadamente: selector universal (`*`) → selector de tipo → selector de clase / atributo / pseudo-clase → selector de id → estilo en línea (`style="..."`).
3. **Orden de aparición:** si dos reglas tienen la misma especificidad, gana la que fue declarada **última** en el código (o la hoja de estilo enlazada más tarde).

Gracias a la cascada, es posible combinar reglas generales (por ejemplo a nivel de sitio) con reglas más específicas (a nivel de página o de un elemento puntual), sabiendo de antemano cuál va a prevalecer.