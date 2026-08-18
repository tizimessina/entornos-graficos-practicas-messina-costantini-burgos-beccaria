# Ejercitación 3 - Prioridades y clases múltiples

## Código a analizar

```css
p.quitar {
  color: red;
}
*.desarrollo {
  font-size: 8px;
}
.importante {
  font-size: 20px;
}
```

```html
<p class="desarrollo">
  En este primer párrafo trataremos lo siguiente:
  <br />xxxxxxxxxxxxxxxxxxxxxxxxx
</p>
<p class="quitar">
  Este párrafo debe ser quitado de la obra…
  <br />xxxxxxxxxxxxxxxxxxxxxxxxx
</p>
<p>
  En este otro párrafo trataremos otro tema:<br />
  xxxxxxxxxxxxxxxxxxxxxxxxx
</p>
<p class="importante">
  Y este es el párrafo más importante de la obra…
  <br />xxxxxxxxxxxxxxxxxxxxxxxxx
</p>

<h1 class="quitar">Este encabezado también debe ser quitado de la obra</h1>

<p class="quitar importante">Se pueden aplicar varias clases a la vez</p>
```

## Análisis elemento por elemento

### `<p class="desarrollo">`
Coincide con `*.desarrollo` (selector universal + clase, aplica a cualquier etiqueta con `class="desarrollo"`).

**Efecto:** `font-size: 8px`. No hay color especial, se muestra con el color por defecto del navegador (negro).

### `<p class="quitar">`
Coincide con `p.quitar` (selector compuesto: etiqueta `p` **y** clase `quitar`).

**Efecto:** `color: red`. El tamaño de fuente queda en el valor por defecto.

### `<p>` (sin clase)
No coincide con ninguna de las tres reglas (todas requieren una clase específica).

**Efecto:** se muestra con el estilo por defecto del navegador, sin ninguna modificación de CSS.

### `<p class="importante">`
Coincide con `.importante` (cualquier elemento con esa clase, sin restricción de etiqueta).

**Efecto:** `font-size: 20px`.

### `<h1 class="quitar">`
**No coincide con `p.quitar`**, porque ese selector exige específicamente que el elemento sea un `<p>`. Como es un `<h1>`, la regla **no se aplica**.

**Efecto:** se muestra con el estilo por defecto de `<h1>` del navegador (sin color rojo). Esto probablemente **no** es lo que se buscaba lograr con el nombre de la clase `"quitar"`, y es un buen ejemplo de por qué conviene usar selectores de clase "puros" (`.quitar`) en lugar de compuestos con la etiqueta (`p.quitar`) cuando se quiere que la regla sea reutilizable en distintos tipos de elementos.

### `<p class="quitar importante">`
Este elemento tiene **dos clases a la vez**, separadas por un espacio dentro del atributo `class`. Esto significa que el elemento pertenece simultáneamente a la clase `quitar` **y** a la clase `importante`.

Coincide con:
- `p.quitar` → `color: red;`
- `.importante` → `font-size: 20px;`

Como ambas reglas afectan **propiedades distintas** (una el color, la otra el tamaño de fuente), no hay conflicto entre ellas: **se combinan** y el resultado final es texto rojo de 20px.

## Conclusión

- Un elemento puede recibir estilos de **varias reglas a la vez**, siempre que coincida con sus selectores; si las propiedades no se superponen, los estilos se combinan sin conflicto.
- Cuando un selector combina etiqueta + clase (`p.quitar`), solo se aplica a elementos de **esa etiqueta exacta** con esa clase; si la clase se usa en otra etiqueta (como el `<h1>`), la regla no aplica.
- Un mismo elemento HTML puede tener **múltiples clases** listadas dentro del atributo `class`, separadas por espacios, y recibirá los estilos de todas las reglas cuyo selector coincida con alguna de ellas.