# Ejercitación 2 - Sistema de grilla o rejillas

## Consigna

**Punto 1:** Utilizar la grilla de Bootstrap para crear un div de clase
`container`, que contenga dos filas. Para todas las resoluciones, excepto
para `sm`, la primera fila deberá tener una columna que ocupe el 100% del
ancho, y en la segunda deberá haber 2 columnas que ocupen el 50% del ancho
cada una. Para `sm` y resoluciones más pequeñas, deberán haber 3 filas con
1 columna que ocupe el 100% del ancho en cada una.

**Punto 2:** Crear la estructura básica de un sitio web como se muestra en
el mockup. La barra lateral (sidebar) deberá tener un tamaño de 3, al igual
que los 6 rectángulos del centro del diseño. El rectángulo celeste de la
esquina inferior derecha deberá tener un tamaño de 6. Utilizar el segundo
mockup para el tamaño `sm`.

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
para lograr ese corte exacto es `col-md-*`, no `col-sm-*` (si se usara
`col-sm-*`, el colapso ocurriría recién por debajo de 576px, y entre 576px
y 768px se seguiría viendo partido al 50%, lo cual no coincide con lo
pedido).

La fila 1 usa `col-12`, que nunca colapsa (siempre ocupa el 100%), tal como
corresponde ya que se pide que sea así "para todas las resoluciones".

### estructura.html

**Estructura general.** Una fila principal con dos columnas: el sidebar
(`col-md-3`) y el contenido principal (`col-md-9`). Dentro del contenido
principal se anidan las filas de la barra verde, los rectángulos del centro
y los rectángulos celestes.

**Sobre los "tamaños" que pide la consigna.** El enunciado dice que el
sidebar y los 6 rectángulos son de "tamaño 3" y el celeste grande de
"tamaño 6". Esos valores están expresados respecto a la grilla de 12
columnas de **la página completa**. Como los rectángulos van anidados
dentro de un `col-md-9`, en clases reales quedan:

| Elemento | Tamaño en la página | Clase real (dentro del col-md-9) |
|---|---|---|
| Sidebar | 3 | `col-md-3` (está en la fila principal) |
| Rectángulos del centro | 3 c/u | `col-md-4` (3 de 9 = 4 de 12 internas) |
| Celeste chico | 3 | `col-md-4` |
| Celeste grande | 6 | `col-md-8` (6 de 9 = 8 de 12 internas) |

Es decir: visualmente cada rectángulo mide efectivamente 3 unidades de la
grilla de la página (entran 3 por fila a lo ancho del contenido, igual que
en el mockup), y el celeste grande mide 6. La diferencia en el número de
la clase se debe únicamente al anidamiento, que es el mecanismo normal de
Bootstrap ("Nestable: Yes" en la tabla de la presentación de la cátedra).

**Comportamiento responsive.** Se usó el prefijo `col-md-*` combinado con
`col-6` para reproducir el segundo mockup ("Diseño para sm"). Observando
ese mockup con atención, en `sm` **no colapsa todo a una sola columna**:

- la barra violeta, el sidebar y la barra verde pasan a ancho completo;
- los rectángulos del centro quedan de a **2 por fila**;
- los dos rectángulos celestes quedan **uno al lado del otro**, mitad y
  mitad.

Por eso los rectángulos llevan `col-md-4 col-6`: 3 por fila en `md` y
mayores, 2 por fila en `sm` y menores. Los celestes llevan `col-md-4 col-6`
y `col-md-8 col-6` respectivamente, con el mismo criterio.

El corte se hace en `md` (y no en `sm`) por la misma razón explicada en el
punto 1: para que el cambio de diseño abarque `sm` y todo lo más chico.
