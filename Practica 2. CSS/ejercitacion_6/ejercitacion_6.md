# Ejercitación 6 - Aplicación siguiendo estilos visuales

## Consigna

Dados los códigos de `principal.html` (con hoja de estilo **interna**) y `estilo2.css` (hoja de estilo **externa**), realizar las modificaciones necesarias en el documento HTML para reemplazar la hoja de estilo interna por la externa `estilo2.css` (**sin modificarla**) y obtener la misma salida en el navegador.

## Estrategia

`estilo2.css` no es idéntica a la hoja de estilo interna original: algunos selectores fueron renombrados o reorganizados. Como no se puede tocar el `.css`, hubo que **adaptar el HTML** para que sus `id` y `class` coincidan con los selectores que espera `estilo2.css`, manteniendo el mismo resultado visual.

## Cambios realizados en `principal.html`

1. **Se quitó el bloque `<style>...</style>` interno** del `<head>` y se reemplazó por el enlace a la hoja externa:

   ```html
   <link rel="StyleSheet" href="estilo2.css" type="text/css">
   ```

2. **`<DIV id=titulo>` → `<DIV id=encabezado>`**
   El selector `#titulo` del CSS original pasó a llamarse `#encabezado` en `estilo2.css`, así que se renombró el `id` en el HTML.

3. **`<UL>` → `<UL class="vineta">`**
   Originalmente el selector `ul` (sin clase) definía `list-style-type: square`. En `estilo2.css` ese mismo estilo está en `ul.vineta`, por lo que fue necesario agregar `class="vineta"` a la lista de enlaces.

4. **`<DIV id=menu class=navBar>` → `<DIV id=menu>`**
   En la hoja interna original, los estilos de espaciado (`margin`, `padding`, `font-size`) del menú de navegación estaban en la clase `.navBar`. En `estilo2.css` esas mismas propiedades ya están incluidas directamente dentro de `#menu`, así que la clase `navBar` ya no es necesaria y se quitó del `<DIV>`.
   (El efecto `.navBar a:hover { background-color: #dddddd; }` también se resuelve igual, porque en `estilo2.css` esa regla es simplemente `a:hover`, genérica para todos los enlaces del documento — que en este caso son únicamente los del menú.)

5. **`<DIV id=pie>` → `<DIV id=pie class="estilopie">`**
   En la hoja interna original, `#pie` incluía `border`, `font-size` y `color` además del `clear` y `text-align`. En `estilo2.css`, esas tres propiedades (`border`, `font-size`, `color`) se separaron en una clase nueva llamada `.estilopie`, mientras que `#pie` solo conserva `clear`, `text-align` y `padding`. Por eso fue necesario agregar `class="estilopie"` al `<DIV id=pie>` para no perder el borde ni el color de ese bloque.

## Resultado

Con estos 5 cambios en el HTML —y sin tocar una sola línea de `estilo2.css`— la página se ve exactamente igual que con la hoja de estilo interna original: fondo general amarillo claro, encabezado con fondo verde claro, contenido flotando a la derecha con los párrafos "resaltados" en rojo, menú de enlaces con fondo naranja claro (subrayado quitado y fondo gris al pasar el mouse), y pie de página centrado con borde y texto verde azulado.