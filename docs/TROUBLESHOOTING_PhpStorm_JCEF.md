# PhpStorm se cierra al iniciar (Ubuntu 24.04, proyectos grandes con Vue.js)

Este documento describe un problema observado donde PhpStorm se cierra apenas arranca en proyectos con mucho Vue.js. El archivo de error adjunto muestra un fallo nativo en JCEF (el navegador embebido basado en Chromium que usa el IDE) durante la inicialización.

Resumen técnico del fallo:
- Hilo: CefInitialize-thread
- Marco problemático: libstdc++.so.6 (std::__codecvt_utf8_utf16_base<char16_t>::do_unshift)
- Pila: org.cef.* / com.intellij.ui.jcef.* (JCEF) en JBR 21.0.8 (PhpStorm 2025.2.2)
- SO: Ubuntu 24.04.3 LTS

En otras palabras, no es un error del código del proyecto sino un crash nativo del runtime del IDE (JBR/JCEF) que en ciertos sistemas Linux puede darse por GPU/sandbox/locale/driver.

A continuación se listan soluciones y mitigaciones confiables. Recomendamos aplicarlas en orden hasta que el problema desaparezca.

1) Solución directa: deshabilitar JCEF en PhpStorm
- Editar el archivo idea.properties del IDE (usuario):
  - Ruta típica Linux: ~/.config/JetBrains/PhpStorm2025.2/idea.properties (ajusta el número de versión)
  - Si no existe, créalo.
- Agregar esta línea y guardar:
  ide.browser.jcef.enabled=false
- Reiniciar PhpStorm.
- Efecto: el IDE deja de inicializar JCEF (el componente que está fallando) y usa alternativas (por ejemplo el navegador del sistema). Pierdes algunas vistas embebidas (previews), pero el IDE arranca estable.

2) Mitigaciones sin deshabilitar JCEF por completo
Si prefieres mantener JCEF, prueba estas propiedades (puedes combinarlas). Agrega cada línea en ~/.config/JetBrains/PhpStorm<version>/idea.properties y reinicia tras cada cambio:
- Desactivar aceleración de GPU en JCEF (frecuente causa de crashes en Linux):
  ide.browser.jcef.gpu.disable=true
- Desactivar sandbox de JCEF en Linux:
  ide.browser.jcef.sandbox.enable=false
- Forzar software rendering de Chromium (equivalente a --disable-gpu):
  ide.browser.jcef.commandLineSwitches=disable-gpu,disable-gpu-compositing

3) Arranque temporal por consola con variables de entorno
Puedes probar rápidamente sin tocar idea.properties (ajusta la ruta de PhpStorm):

- Deshabilitar JCEF sólo para esta ejecución:
  JB_JCEF_ENABLED=0 /ruta/a/PhpStorm/bin/phpstorm.sh

- O desactivar GPU (si el crash se debe a drivers):
  JCEF_ARGS="--disable-gpu --disable-gpu-compositing" /ruta/a/PhpStorm/bin/phpstorm.sh

4) Actualizar PhpStorm/JBR a una versión corregida
- Verifica si existe 2025.2.3 (o posterior) o un JBR actualizado. JetBrains suele publicar fixes rápidos para crashes de JCEF.
- Changelog/descargas: https://www.jetbrains.com/phpstorm/download/other.html
- Issue tracker JBR (runtime del IDE): https://youtrack.jetbrains.com/issues/JBR

5) Reducir carga inicial en proyectos muy grandes con Vue/JS (mitigación general)
Estas medidas no corrigen el crash nativo, pero ayudan a estabilizar el arranque:
- En Settings > Directories: marca como Excluded carpetas grandes que no necesitas indexar (por ejemplo, dist, coverage, .cache, .output, build). PhpStorm ya excluye node_modules, pero revisa monorepos y subpackages.
- En Settings > TypeScript: desactiva "Use TypeScript Service" externo si no lo necesitas, o apunta a la versión de TS del proyecto; evita que el IDE levante muchas copias del servicio en monorepos.
- Desactiva temporalmente plugins que no uses (Settings > Plugins) para reducir componentes al arranque.

6) Diagnóstico adicional
- Si aún falla, ejecuta el IDE desde terminal y observa la consola:
  /ruta/a/PhpStorm/bin/phpstorm.sh
- Revisa el log de ide en ~/.cache/JetBrains/PhpStorm<version>/log/ y comparte el último idea.log junto con el .log de crash nativo al reportar a JetBrains.

Cómo revertir cambios
- Quita o comenta las líneas agregadas en idea.properties para volver a la configuración original.

Notas
- Este proyecto no puede corregir errores del runtime del IDE, por eso ofrecemos mitigaciones reproducibles y seguras para que puedas continuar trabajando.
- Las propiedades indicadas son soportadas por las IDEs basadas en IntelliJ (2023.x+). Si alguna ruta no coincide, abre Help > Edit Custom Properties dentro del IDE para que cree/abra el idea.properties correcto, y pega allí las líneas.
