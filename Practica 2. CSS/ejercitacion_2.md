# Ejercitación 2 - Análisis de código (ids, clases, fuentes, border, colores)

## Código a analizar

```css
p#normal {
  font-family: arial,helvetica;
  font-size: 11px;
  font-weight: bold;
}
*#destacado {
  border-style: solid;
  border-color: blue;
  border-width: 2px;
}
#distinto {
  background-color: #9EC7EB;
  color: red;
}
```

```html
<p id="normal">Este es un párrafo</p>

<p id="destacado">Este es otro párrafo</p>

<table id="destacado"><tr><td>Esta es una tabla</td></tr></table>

<p id="distinto">Este es el último párrafo</p>
```

## Declaraciones y aplicación de reglas

### Regla `p#normal`
Selecciona un elemento `<p>` que además tenga `id="normal"`. Es un selector **compuesto** (tipo + id).

**Se aplica a:** `<p id="normal">Este es un párrafo</p>`

**Efecto:** el texto se muestra con fuente Arial (o Helvetica si Arial no está disponible), tamaño 11px y en negrita.

### Regla `*#destacado`
El selector universal `*` combinado con `#destacado` selecciona **cualquier elemento**, sin importar su etiqueta, siempre que tenga `id="destacado"`.

**Se aplica a:**
- `<p id="destacado">Este es otro párrafo</p>`
- `<table id="destacado">...</table>`

**Efecto:** ambos elementos reciben un borde sólido, azul, de 2px de grosor. El párrafo queda recuadrado en azul, y la tabla también.

> **Observación importante:** el HTML es inválido porque el atributo `id` debe ser **único** dentro de un documento, y aquí `"destacado"` se repite en el `<p>` y en la `<table>`. Sin embargo, como CSS resuelve por coincidencia de atributos (no valida unicidad), el navegador aplica la regla igualmente a **ambos** elementos que tengan ese id.

### Regla `#distinto`
Selecciona por id, sin restricción de etiqueta (equivale a `*#distinto`).

**Se aplica a:** `<p id="distinto">Este es el último párrafo</p>`

**Efecto:** fondo celeste (`#9EC7EB`) y texto rojo.

## Resumen visual

| Elemento | Reglas que le aplican | Efecto final |
|---|---|---|
| `<p id="normal">` | `p#normal` | Fuente Arial/Helvetica, 11px, negrita |
| `<p id="destacado">` | `*#destacado` | Borde sólido azul de 2px |
| `<table id="destacado">` | `*#destacado` | Borde sólido azul de 2px |
| `<p id="distinto">` | `#distinto` | Fondo celeste, texto rojo |

Ninguna de las reglas colisiona entre sí porque cada `id` es distinto (aunque `"destacado"` esté duplicado en el HTML), por lo que no hace falta resolver conflictos de especificidad en este ejercicio: cada elemento recibe únicamente la regla que coincide con su id.