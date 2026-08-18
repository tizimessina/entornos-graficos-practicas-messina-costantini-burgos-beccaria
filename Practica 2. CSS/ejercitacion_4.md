# Ejercitación 4 - Links, fuentes, párrafos

## Declaraciones dadas

```css
* {color:green; }
a:link {color:gray }
a:visited{color:blue }
a:hover {color:fuchsia }
a:active {color:red }
p {font-family: arial,helvetica; font-size: 10px; color:black; }
.contenido{font-size: 14px; font-weight: bold; }
```

## Código 1

```html
<body>
<p class="contenido" style="font-weight: normal;">
Este es un texto ...............</p>
<table>
<tr>
<td>Y esta es una tabla.......</td>
</tr>
<tr>
<td><a href="http://www.google.com.ar">con un enlace</a></td>
</tr>
</table>
</body>
```

### Análisis

**El párrafo `<p class="contenido" style="font-weight: normal;">`** coincide con tres reglas: `*`, `p` y `.contenido`, además de tener un estilo en línea. Para cada propiedad, la cascada resuelve así (de menor a mayor especificidad: universal `*` < elemento `p` < clase `.contenido` < estilo en línea):

- `color`: lo definen `*` (green) y `p` (black). El selector `p` es más específico que `*`, así que gana → **negro**.
- `font-family`: solo lo define `p` → **arial, helvetica**.
- `font-size`: lo define `.contenido` (14px). Ninguna otra regla lo toca → **14px**.
- `font-weight`: lo define `.contenido` (bold), pero hay un **estilo en línea** que fuerza `font-weight: normal`. El estilo en línea siempre gana por ser el de mayor especificidad → **normal** (no negrita).

**Resultado del párrafo:** texto negro, fuente Arial/Helvetica, 14px, sin negrita.

**La tabla y sus celdas (`<td>`)** no coinciden con `p` ni con `.contenido` (no tienen esa clase), solo con el selector universal `*` → **color verde**, con la tipografía y tamaño por defecto del navegador.

**El enlace** dentro de la celda no tiene estado `:visited/:hover/:active` en el momento de cargar la página, por lo que aplica `a:link` → **color gris**, sobrescribiendo el verde heredado de `*` porque `a:link` es más específico que el selector universal.

## Código 2

```html
<body class="contenido">
<p> Este es un texto................</p>
<table>
<tr>
<td>Y esta es una tabla.......</td>
</tr>
<tr>
<td><a href="http://www.google.com.ar">con un enlace</a></td>
</tr>
</table>
</body>
```

### Análisis

Aquí la clase `contenido` **no está en el párrafo sino en el `<body>`**. Como `font-size` y `font-weight` son propiedades que se **heredan**, todos los descendientes del `<body>` (el párrafo, la tabla, las celdas) heredan `font-size: 14px` y `font-weight: bold`, salvo que tengan una regla propia que lo sobrescriba.

**El párrafo `<p>`** (sin clase propia) coincide con `*` y con `p`:

- `color`: gana `p` sobre `*` → **negro**.
- `font-family`: la define `p` → **arial, helvetica**.
- `font-size`: `p` no define `font-size` en este selector... espera, sí lo define (`font-size: 10px`). Como es una declaración **directa sobre el propio elemento** (no heredada), tiene prioridad sobre el valor heredado del body → **10px** (no 14px).
- `font-weight`: `p` no define `font-weight`, así que el párrafo **hereda** el valor de `.contenido` aplicado al body → **bold**.

**Resultado del párrafo:** texto negro, fuente Arial/Helvetica, 10px, **en negrita** (a diferencia del Código 1).

**La tabla y celdas:** no tienen regla propia de color/fuente más que `*` → color verde, pero heredan `font-size: 14px` y `font-weight: bold` del body.

**El enlace:** aplica `a:link` → color gris (igual que en el Código 1), y hereda `font-size: 14px` y `font-weight: bold` del body ya que `a:link` no redefine esas propiedades.

## Comparación entre ambos códigos

| Aspecto | Código 1 (`class` en el `<p>` + `style` inline) | Código 2 (`class` en el `<body>`) |
|---|---|---|
| `font-size` del párrafo | 14px (por `.contenido` directamente en el `<p>`) | 10px (por `p`, que gana sobre el valor heredado 14px) |
| `font-weight` del párrafo | normal (forzado por `style` inline) | bold (heredado del `body`, ya que `p` no lo redefine) |
| Alcance de `.contenido` | Solo afecta al párrafo puntual | Afecta potencialmente a **todos** los descendientes del body (tabla, celdas, etc.) por herencia |

**Conclusión:** este ejercicio muestra tres conceptos clave de CSS trabajando juntos:

1. **Especificidad:** un selector de clase (`.contenido`) le gana a un selector de tipo (`p`), y ambos le pierden a un estilo en línea.
2. **Herencia:** propiedades como `font-size` y `font-weight` se transmiten de padres a hijos si el hijo no tiene una declaración propia.
3. **Declaración directa vs. valor heredado:** cuando un elemento tiene una regla propia para una propiedad (aunque sea de menor especificidad, como el selector `p`), esa declaración directa siempre gana por sobre un valor simplemente heredado de un ancestro.