# Ejercitación 1 — Cuestionario

## 1. ¿Qué es HTML, cuándo fue creado, cuáles fueron las distintas versiones y cuál es la última?

HTML (HyperText Markup Language) es el lenguaje de marcado utilizado para estructurar el contenido de las páginas web, definiendo elementos como títulos, párrafos, enlaces, imágenes, tablas y formularios mediante etiquetas. Fue creado por Tim Berners-Lee en 1991 en el CERN, como una aplicación derivada de SGML pensada originalmente para compartir documentos científicos de forma hipertextual entre investigadores.

A partir de esa primera versión informal, el lenguaje fue evolucionando a través de distintas especificaciones formalizadas por el IETF primero y por el W3C después: HTML 2.0 en 1995, HTML 3.2 en 1997 (ya como recomendación del W3C), HTML 4.0 ese mismo año y su revisión HTML 4.01 en 1999, que fue la versión que se mantuvo como estándar de referencia durante más de una década. En paralelo surgió XHTML, una reformulación de HTML bajo las reglas estrictas de XML, con las versiones XHTML 1.0 y 1.1.

Posteriormente el desarrollo del estándar pasó a manos de WHATWG, un grupo conformado por los principales fabricantes de navegadores, que impulsó HTML5 como una revisión mucho más amplia del lenguaje, incorporando etiquetas semánticas, multimedia nativa y APIs para aplicaciones web. El W3C publicó HTML5 como recomendación oficial en 2014. Desde 2019, W3C y WHATWG llegaron a un acuerdo por el cual WHATWG quedó como el único mantenedor del estándar, que hoy se conoce como HTML Living Standard: una especificación viva que se actualiza de forma continua en lugar de publicarse en versiones numeradas cerradas, y que constituye la referencia vigente en la actualidad.

## 2. ¿Cuáles son los principios básicos que el W3C recomienda seguir para la creación de documentos con HTML?

El W3C recomienda separar claramente la estructura del contenido de su presentación visual, utilizando HTML únicamente para describir el significado y la organización de la información, y dejando el aspecto visual (colores, tipografías, espaciados) a cargo de hojas de estilo CSS. Esto favorece la mantenibilidad del sitio y permite aplicar distintos estilos a un mismo contenido según el dispositivo o medio de salida.

Otro principio central es el uso de marcado semántico, es decir, elegir las etiquetas según el significado del contenido que envuelven y no según el efecto visual que producen; por ejemplo, usar una etiqueta de énfasis en lugar de forzar una negrita solo por estética. A esto se suma la exigencia de generar documentos válidos, que respeten la gramática definida por el DTD o esquema correspondiente, ya que esto garantiza una interpretación consistente entre distintos navegadores.

El W3C también pone énfasis en la accesibilidad, de modo que el contenido pueda ser comprendido por personas con distintas capacidades y por tecnologías asistivas como lectores de pantalla, y en la independencia de dispositivo, buscando que un mismo documento funcione correctamente sin importar el navegador, el sistema operativo o el tamaño de pantalla utilizado.

## 3. En las especificaciones de HTML, ¿cuándo un elemento o atributo se considera desaprobado? ¿Y obsoleto?

Un elemento o atributo se considera desaprobado (deprecated) cuando la especificación indica que su uso ya no es recomendado porque existe una alternativa más adecuada, generalmente basada en CSS, pero se mantiene disponible en la especificación por razones de compatibilidad con documentos existentes. Un elemento desaprobado todavía es reconocido y renderizado por los navegadores, aunque su empleo en documentos nuevos debe evitarse.

Un elemento u atributo se considera obsoleto cuando ha sido directamente eliminado de la especificación vigente; ya no forma parte del estándar y no debería utilizarse bajo ningún concepto en un documento nuevo. La diferencia con lo desaprobado es de grado: lo desaprobado todavía convive con el estándar como una opción no recomendada, mientras que lo obsoleto queda fuera de él, aunque en la práctica algunos navegadores sigan interpretándolo por compatibilidad histórica con páginas antiguas.

## 4. ¿Qué es el DTD y cuáles son los posibles DTD contemplados en la especificación de HTML 4.01?

El DTD (Document Type Definition) es un documento que define formalmente la gramática de un lenguaje de marcado: establece qué elementos existen, qué atributos puede tener cada uno, cuáles son obligatorios y cómo pueden anidarse entre sí. Un documento HTML declara al inicio, mediante la instrucción DOCTYPE, contra qué DTD debe validarse, lo que permite a los navegadores y a las herramientas de validación verificar si el marcado utilizado es correcto según esas reglas.

La especificación de HTML 4.01 contempla tres DTD posibles. El DTD Strict exige un marcado limpio, sin elementos ni atributos desaprobados y sin la posibilidad de usar frames, delegando toda la presentación a CSS. El DTD Transitional permite, además de todo lo anterior, el uso de elementos y atributos de presentación desaprobados, pensado para dar compatibilidad a documentos que todavía mezclan estructura y estilo. El DTD Frameset es una variante del Transitional que además habilita el uso de conjuntos de marcos (frameset), necesario para los documentos que dividen la ventana del navegador en distintas subventanas.

## 5. ¿Qué son los metadatos y cómo se especifican en HTML?

Los metadatos son información sobre el propio documento que no se muestra como contenido visible dentro de la página, pero que resulta útil para el navegador, los buscadores u otras herramientas que procesan el documento. Incluyen datos como el idioma del documento, su codificación de caracteres, una descripción breve del contenido, palabras clave, el autor o instrucciones de comportamiento para el navegador, entre otros usos posibles.

En HTML, los metadatos se especifican principalmente dentro de la sección head del documento mediante la etiqueta meta, que admite dos formas de uso: con los atributos name y content, para describir una propiedad del documento (como keywords o description), o con los atributos http-equiv y content, para simular el valor de una cabecera HTTP (como la fecha de expiración de la página). También se consideran metadatos otros elementos ubicados en el head, como title, que define el título del documento, o link, que establece relaciones con recursos externos como hojas de estilo o íconos.