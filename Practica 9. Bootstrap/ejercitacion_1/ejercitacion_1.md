# Ejercitación 1 - Introducción / instalar Bootstrap

## Consigna

1. Importar Bootstrap en el proyecto actual, ya sea descargando Bootstrap
   localmente, o llamándolo de manera remota.
2. Crear un div de clase `container`, con una fila que contenga 1 columna.
3. Crear un archivo CSS que se llame `estilo.css`, y llamarlo desde el
   archivo donde estemos trabajando. Crear una clase que se llame
   `contenedor`, con un color de fondo cualquiera, y añadirle esa clase al
   div con clase `container` que creamos en el ejercicio anterior.

## Archivos

- `index.html`
- `estilo.css`

## Decisiones

- Bootstrap se importa vía **CDN** (jsDelivr, versión 4.6.2), en lugar de
  descargarlo localmente. Es la opción que recomienda el material de la
  cátedra como "más sencilla" y evita tener que gestionar carpetas `css/`
  y `js/` con los archivos descargados.
- La estructura pedida (`container` > `row` > `col`) se armó como:
  ```html
  <div class="container contenedor">
    <div class="row">
      <div class="col">
        ...
      </div>
    </div>
  </div>
  ```
- La clase `.contenedor` se definió en `estilo.css` con un color de fondo
  lila (`#e8dff5`) y un poco de padding para que se note el efecto. El
  color es arbitrario, no está especificado en la consigna.
- La clase `.contenedor` se agregó **junto a** `container` en el mismo div
  (no en un div aparte), tal como pide el punto 3 del enunciado ("añadirle
  esa clase al div con clase container que creamos en el ejercicio
  anterior").