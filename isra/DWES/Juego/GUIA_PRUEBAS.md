# Guía Rápida de Pruebas - Juego de Preguntas

## 🚀 Inicio Rápido

### URL de Acceso
```
http://localhost/isra/DWES/Juego/index.php
```

### Credenciales de Prueba
- **Usuario:** `elchocas`
- **Contraseña:** `chocas123`

## ✅ Checklist de Pruebas

### 1. Página de Inicio (index.php)
- [ ] Ver página de bienvenida sin login
- [ ] Verificar que las opciones están deshabilitadas
- [ ] Ver instrucciones del juego
- [ ] Ver categorías disponibles

### 2. Sistema de Login
- [ ] Iniciar sesión con elchocas/chocas123
- [ ] Verificar que aparece nombre y avatar
- [ ] Verificar que se habilitan las opciones del menú
- [ ] Cerrar sesión y verificar que se destruye la sesión

### 3. Perfil (perfil.php)
- [ ] Acceder a la página de perfil
- [ ] Ver formulario con datos de elchocas
- [ ] Cambiar nombre completo
- [ ] Seleccionar país del desplegable
- [ ] Probar validación de teléfono (debe ser 9 cifras: 6XX, 7XX o 9XX)
- [ ] Probar validación de correo (formato x@y.z)
- [ ] Seleccionar avatar predefinido
- [ ] Subir avatar personalizado (JPG, PNG o GIF)
- [ ] Guardar perfil y verificar que se actualiza jugadores.csv

### 4. Editar Preguntas (editar.php)
**Solo accesible como elchocas**

- [ ] Verificar acceso restringido (probar con otro usuario)
- [ ] Ver lista de preguntas existentes (10 preguntas de ejemplo)
- [ ] Añadir nueva pregunta:
  - [ ] Completar todos los campos
  - [ ] Seleccionar opción correcta
  - [ ] Seleccionar categoría
  - [ ] Guardar y verificar que aparece en la lista
- [ ] Modificar pregunta existente:
  - [ ] Seleccionar pregunta del desplegable
  - [ ] Modificar datos
  - [ ] Guardar y verificar cambios
- [ ] Probar validación (dejar campos vacíos)

### 5. Jugar (jugar.php)
- [ ] Iniciar partida
- [ ] Verificar que se muestra:
  - [ ] Puntuación actual (0)
  - [ ] Preguntas respondidas (0)
  - [ ] Preguntas acertadas (0)
  - [ ] Valor siguiente pregunta (10)
- [ ] Responder pregunta correctamente:
  - [ ] Verificar mensaje de acierto
  - [ ] Verificar que suma puntos (10)
  - [ ] Verificar que siguiente vale el doble (20)
- [ ] Responder pregunta incorrectamente:
  - [ ] Verificar mensaje de error con respuesta correcta
  - [ ] Verificar que racha se resetea a 10
- [ ] Continuar racha de aciertos:
  - [ ] Verificar progresión: 10, 20, 40, 80, 160...
- [ ] Navegar a otra página y volver:
  - [ ] Verificar que se mantiene el progreso
- [ ] Finalizar partida manualmente:
  - [ ] Confirmar finalización
  - [ ] Verificar que NO recibe bonus de 100
  - [ ] Verificar que se guarda en partidas.csv
- [ ] Completar todas las preguntas:
  - [ ] Verificar bonus de 100 puntos
  - [ ] Verificar mensaje de felicitación
  - [ ] Verificar que se guarda en partidas.csv
- [ ] Iniciar nueva partida:
  - [ ] Verificar que se resetea todo
  - [ ] Verificar que preguntas están en orden aleatorio

### 6. Mejores Jugadores (mejores.php)
- [ ] Ver ranking vacío (si no hay partidas)
- [ ] Jugar al menos una partida
- [ ] Ver ranking con datos:
  - [ ] Nombre del jugador
  - [ ] Partidas jugadas
  - [ ] Puntos totales
  - [ ] Preguntas respondidas
  - [ ] Preguntas acertadas
  - [ ] Porcentaje de acierto
  - [ ] Promedio puntos/partida
- [ ] Verificar que usuario actual está destacado
- [ ] Verificar medallas para top 3
- [ ] Ver estadísticas generales

### 7. Navegación General
- [ ] Verificar banner en todas las páginas
- [ ] Verificar menú funcional en todas las páginas
- [ ] Verificar footer con copyright en todas las páginas
- [ ] Verificar estilos consistentes
- [ ] Verificar que se puede volver a inicio desde todas las páginas

### 8. Archivos CSV
- [ ] Verificar jugadores.csv se actualiza al guardar perfil
- [ ] Verificar preguntas.txt se actualiza al añadir/modificar preguntas
- [ ] Verificar partidas.csv se actualiza al finalizar partidas

## 🐛 Posibles Problemas y Soluciones

### Error: "Headers already sent"
- **Causa:** Espacios o saltos de línea antes de `<?php`
- **Solución:** Verificar que no hay espacios antes de la etiqueta de apertura PHP

### Error: "Call to undefined function"
- **Causa:** No se incluye funciones.php
- **Solución:** Verificar que header.php incluye `require_once __DIR__ . '/funciones.php';`

### Error: "Permission denied" al subir avatar
- **Causa:** Carpeta img/avatar no tiene permisos de escritura
- **Solución:** `chmod 755 img/avatar`

### Las preguntas no se guardan
- **Causa:** preguntas.txt no tiene permisos de escritura
- **Solución:** `chmod 644 preguntas.txt`

### Los CSV no se actualizan
- **Causa:** Archivos CSV no tienen permisos de escritura
- **Solución:** `chmod 644 *.csv`

## 📝 Notas de Desarrollo

### Formato de Datos

**jugadores.csv:**
```
usuario,contraseña,nombre_completo,pais,telefono,correo,avatar
```

**preguntas.txt:**
```
enunciado|opcion1|opcion2|opcion3|correcta|categoria
```

**partidas.csv:**
```
fecha,jugador,puntuacion,preguntas_totales,preguntas_acertadas
```

### Categorías Disponibles
1. Matemáticas (azul)
2. Ciencias (verde)
3. Historia (naranja)
4. Literatura (morado)
5. Geografía (turquesa)

### Sistema de Puntuación
- Primera acertada: 10 puntos
- Racha: cada acierto duplica (10 → 20 → 40 → 80 → 160 → 320...)
- Fallo: resetea a 10 puntos
- Bonus completar: +100 puntos

## 🎯 Escenarios de Prueba Recomendados

### Escenario 1: Usuario Nuevo
1. Registrarse con usuario nuevo
2. Completar perfil
3. Jugar una partida completa
4. Ver ranking

### Escenario 2: Administrador
1. Login como elchocas
2. Añadir 2-3 preguntas nuevas
3. Modificar una pregunta existente
4. Jugar partida con las nuevas preguntas
5. Ver ranking

### Escenario 3: Validaciones
1. Intentar guardar perfil con teléfono inválido
2. Intentar guardar perfil con correo inválido
3. Intentar guardar pregunta incompleta
4. Verificar mensajes de error

### Escenario 4: Persistencia
1. Iniciar partida
2. Responder 3-4 preguntas
3. Ir a perfil
4. Volver a jugar
5. Verificar que continúa donde lo dejó

## ✨ Características Destacadas

- ✅ Sin base de datos (solo archivos CSV/TXT)
- ✅ Código simple y comentado en español
- ✅ Validaciones en servidor
- ✅ Diseño responsive
- ✅ Sistema de sesiones PHP
- ✅ Subida de archivos
- ✅ Control de acceso por roles
- ✅ Persistencia de datos
- ✅ Interfaz intuitiva
- ✅ Feedback visual inmediato
