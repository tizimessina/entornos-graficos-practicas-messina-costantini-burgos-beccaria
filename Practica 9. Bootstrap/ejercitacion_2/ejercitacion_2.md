# Ejercitación 2 - Sistema de grilla o rejillas

## Consigna

**Punto 1:** Utilizar la grilla de Bootstrap para crear un div de clase
`container`, que contenga dos filas. Para todas las resoluciones, excepto
para `sm`, la primera fila deberá tener una columna que ocupe el 100% del
ancho, y en la segunda deberá haber 2 columnas que ocupen el 50% del ancho
cada una. Para `sm` y resoluciones más pequeñas, deberán haber 3 filas con
1 columna que ocupe el 100% del ancho en cada una.

**Punto 2:** Crear la estructura básica de un sitio web (sidebar + grilla
de rectángulos + 2 rectángulos celestes al pie), utilizando el segundo
mockup (apilado en una sola columna) para el tamaño `sm`.

## Archivos

- `grilla.html` → punto 1
- `estructura.html` → punto 2

## Decisiones

### grilla.html

Para que la fila 2 (de 2 columnas al 50%) colapse a columnas apiladas al
100% justo en el corte "sm y menores" que pide la consigna, se usó la clase
`col-md-6` en lugar de `col-sm-6`.

Esto es porque las clases de grilla de Bootstrap son "mobile-first": una
columna con `col-md-6` ocupa el 100% del ancho en cualquier resolución por
debajo de `md` (o sea, tanto en `sm` como en `xs`), y recién a partir de
`md` (≥768px) toma el 50%. Como el enunciado pide que el colapso a 3 filas
completas ocurra "para sm y resoluciones más pequeñas", la clase correcta
para lograr ese corte exacto es `col-md-*`, no `col-sm-*` (si hubiese usado
`col-sm-*`, el colapso ocurriría recién por debajo de 576px, y entre 576px
y 768px seguiría viéndose partido al 50%, lo cual no coincide con lo
pedido).

La fila 1 usa `col-12`, que nunca colapsa (siempre ocupa el 100%), tal como
corresponde ya que se pide que sea así "para todas las resoluciones".

### estructura.html

Estructura general (fila de 12 columnas):
- Header (barra superior): `col-sm-12`.
- Sidebar: `col-sm-3`.
- Contenido principal (a la derecha del sidebar): `col-sm-9`, que contiene
  internamente:
  - Barra verde: `col-sm-12` (ocupa las 9 columnas disponibles del padre).
  - 6 rectángulos: dos filas de tres `col-sm-3` cada una (3+3+3 = 9 por
    fila).
  - 2 rectángulos celestes: uno `col-sm-3` y otro `col-sm-6` (3+6 = 9,
    tal como pide la consigna: "El rectángulo celeste de la esquina
    inferior derecha deberá tener un tamaño de 6").

Se usó el prefijo `col-sm-*` en todos los elementos (en vez de `col-*` sin
prefijo) porque la consigna pide explícitamente "utilizar el segundo
mockup para el tamaño sm", es decir, que en resoluciones menores a `sm`
(<576px) todo colapse y se apile en una sola columna. Con `col-*` sin
prefijo esto nunca colapsaría (según el material de la cátedra: "cuando
utilizamos las clases col-* nunca colapsarán las columnas").

**Nota sobre colores:** son arbitrarios, elegidos solo para diferenciar
visualmente cada bloque (la consigna no especifica colores exactos, aunque
los mockups de la cátedra usan tonos violeta, verde, gris/mauve y celeste,
que se intentaron respetar de forma aproximada).