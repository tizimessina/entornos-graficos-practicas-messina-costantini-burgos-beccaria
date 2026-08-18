# Ejercitación 5 - Colores, clases anidadas, titulares, listas

Para cada caso se pide declarar una regla CSS que produzca el efecto indicado.

## 1. Los textos enfatizados (`<em>`) dentro de cualquier título deben ser rojos.

Se usa un selector descendiente para cada nivel de título, agrupados con coma:

```css
h1 em, h2 em, h3 em, h4 em, h5 em, h6 em {
  color: red;
}
```

## 2. Cualquier elemento que tenga asignado el atributo `href` y que esté dentro de cualquier párrafo que a su vez esté dentro de un bloque debe ser color negro.

Se combina un selector de atributo (`[href]`) con dos niveles de anidamiento (bloque `div` → párrafo `p` → elemento con `href`):

```css
div p [href] {
  color: black;
}
```

## 3. El texto de las listas no ordenadas que estén dentro del bloque identificado como "ultimo" debe ser amarillo, pero si es un enlace a otra página debe ser azul.

```css
#ultimo ul {
  color: yellow;
}

#ultimo ul a {
  color: blue;
}
```

La segunda regla es más específica que la primera (tiene un selector adicional, `a`), por lo que los enlaces dentro de la lista quedan en azul aunque el resto del texto de la lista sea amarillo, sin importar el orden en que se escriban ambas reglas.

## 4. Los elementos identificados como "importante" dentro de cualquier bloque deben ser verdes, pero si están dentro de un título deben ser rojos.

```css
div .importante {
  color: green;
}

h1 .importante, h2 .importante, h3 .importante,
h4 .importante, h5 .importante, h6 .importante {
  color: red;
}
```

> **Nota sobre el orden:** ambas reglas tienen la misma especificidad (elemento + clase descendiente), por lo que en caso de que un elemento `.importante` estuviera dentro de un título que a su vez está dentro de un `div`, **gana la última regla declarada** en la hoja de estilos. Por eso la regla de los títulos debe escribirse **después** de la regla de `div`, para asegurar que el rojo prevalezca sobre el verde cuando corresponda.

## 5. Todos los elementos `h1` que especifiquen el atributo `title`, cualquiera que sea su valor, deben ser azules.

Se usa un selector de atributo sin especificar valor, lo cual selecciona el elemento sin importar qué valor tenga ese atributo:

```css
h1[title] {
  color: blue;
}
```

## 6. El color de los enlaces en las listas ordenadas debe ser azul para los no visitados, y violeta para los ya visitados, y además no deben aparecer subrayados.

```css
ol a:link {
  color: blue;
  text-decoration: none;
}

ol a:visited {
  color: violet;
  text-decoration: none;
}
```