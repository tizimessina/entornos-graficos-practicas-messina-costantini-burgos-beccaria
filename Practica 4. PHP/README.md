# Práctica N°4 — PHP

Entornos Gráficos — UTN Facultad Regional Rosario — Cátedra Díaz / Butti

Esta práctica se compone de dos bloques que en el enunciado numeran sus ejercicios por separado, de modo que hay dos ejercicios 1, dos ejercicios 2 y así sucesivamente. Para evitar confusiones se los separó en dos carpetas.

## Estructura

```
Practica 4. PHP/
├── README.md
├── parte_1_estructuras_control/     PHP: variables, tipos, operadores,
│   ├── ejercicio_1.md               expresiones, estructuras de control
│   ├── ejercicio_2.md
│   ├── ejercicio_3/
│   │   ├── ejercicio_3.md
│   │   ├── documento1.php
│   │   └── documento2.php
│   ├── ejercicio_4/
│   │   ├── ejercicio_4.md
│   │   ├── datos.php
│   │   └── prueba.php
│   └── ejercicio_5/
│       ├── ejercicio_5.md
│       ├── contador.php
│       ├── contador_mejorado.php
│       ├── visitas.php
│       └── contador.dat
└── parte_2_arrays_funciones/        PHP: arrays, funciones
    ├── ejercicio_1.md
    ├── ejercicio_2.md
    ├── ejercicio_3/
    │   ├── ejercicio_3.md
    │   ├── getdate.php
    │   └── sumar.php
    └── ejercicio_4/
        ├── ejercicio_4.md
        ├── comprobar_nombre_usuario.php
        └── test_comprobar.php
```

Los ejercicios puramente teóricos quedaron como un único archivo `.md`. Los que además requieren código propio o conviene ejecutar quedaron en una subcarpeta con el `.md` de la respuesta junto a los archivos `.php` correspondientes, siguiendo la convención ya usada en las prácticas anteriores.

## Cómo ejecutar los archivos PHP con XAMPP

Los archivos `.php` necesitan un servidor con PHP; no alcanza con abrirlos haciendo doble clic, porque el navegador mostraría el código fuente en lugar de ejecutarlo.

Hay que copiar la carpeta de la práctica dentro de `C:\xampp\htdocs\`, abrir el panel de control de XAMPP e iniciar Apache, y luego acceder desde el navegador a `http://localhost/` seguido de la ruta correspondiente. Como el nombre de la carpeta contiene espacios y un punto, la dirección se verá con `%20` en lugar de cada espacio; si resulta incómodo, se puede copiar solamente la subcarpeta del ejercicio a `htdocs` con un nombre corto mientras se lo prueba, ya que ningún archivo depende de dónde esté ubicada la carpeta contenedora.

Estas son las direcciones de cada uno, suponiendo que la práctica se copió completa:

- Tabla generada con bucles: `http://localhost/Practica%204.%20PHP/parte_1_estructuras_control/ejercicio_3/documento1.php`
- Formulario autoprocesado: `.../ejercicio_3/documento2.php`
- Prueba del `include`: `.../ejercicio_4/prueba.php`
- Contador de visitas: `.../ejercicio_5/visitas.php`
- Fecha y hora con `getdate()`: `.../parte_2_arrays_funciones/ejercicio_3/getdate.php`
- Función `sumar()`: `.../ejercicio_3/sumar.php`
- Pruebas de validación de nombre de usuario: `.../ejercicio_4/test_comprobar.php`

## Cuestiones a tener en cuenta al probar

El contador de visitas necesita que `contador.dat` exista y contenga un valor inicial. El archivo ya está incluido con un cero adentro; si en algún momento queda vacío, el script del enunciado corta con un error fatal, porque `fread()` recibiría una longitud de cero bytes. Es exactamente el motivo por el cual la consigna insiste en crearlo con el valor inicial. En Windows los permisos no suelen dar problemas mientras el archivo esté dentro de `htdocs` y no esté marcado como de solo lectura; conviene verificarlo desde las propiedades del archivo si el contador no avanza.

El código del contador en el enunciado abre con la etiqueta corta `<?`, que depende de la directiva `short_open_tag` y viene desactivada por defecto en PHP 8, la versión que trae XAMPP actualmente. Con esa configuración el navegador mostraría el código como texto plano. En los archivos de esta carpeta se usó la etiqueta estándar `<?php`, que funciona siempre; la aclaración figura también en el `.md` del ejercicio.

El ejercicio 4 de la primera parte genera avisos de variable no definida, y eso es parte de la respuesta, no un error a corregir. Si no aparecen en pantalla es porque `display_errors` está desactivado en el `php.ini`. Vale aclarar que en PHP 5 y 7 esos avisos eran de nivel `E_NOTICE` y en PHP 8 pasaron a ser `E_WARNING`.

Todas las salidas indicadas en los archivos `.md` fueron verificadas ejecutando el código en PHP 8.3.

## Punto a revisar antes de entregar

Los análisis y las observaciones de diseño que acompañan a cada respuesta son interpretación propia y no salen de una guía de resolución de la cátedra, así que conviene repasarlos antes de una defensa oral. En particular, en el ejercicio 2 de la primera parte la respuesta sostiene que los códigos son equivalentes en cuanto a la salida pero señala las diferencias de estado y de semántica, que es el matiz que suele preguntarse; si el profesor espera un sí o un no a secas, el argumento está ahí para desarrollarlo.
