# 📚 Chuletillas PHP - Repaso para Examen

Colección de 8 ejercicios de repaso para el examen de PHP - 2º DAW Primer Trimestre

## 📋 Índice de Ejercicios

### 🔢 Ejercicio 1: Calculadora con Sesiones
**Archivo:** `ejercicio1.php`

**Conceptos que practica:**
- Sesiones en PHP (`session_start()`, `$_SESSION`)
- Formularios POST
- Operaciones matemáticas
- Validación de datos
- Arrays en sesión
- Estructuras if/elseif/else

**Funcionalidades:**
- Calculadora con 4 operaciones básicas
- Historial de operaciones guardado en sesión
- Validación de división por cero
- Limpieza de historial

---

### 🍪 Ejercicio 2: Sistema de Preferencias
**Archivo:** `ejercicio2.php`

**Conceptos que practica:**
- Cookies (`setcookie()`, `$_COOKIE`)
- Persistencia de datos en el navegador
- Arrays asociativos
- Estilos dinámicos con PHP
- Input type="color"

**Funcionalidades:**
- Guardar nombre de usuario
- Selección de color favorito
- Preferencia de idioma
- Preview visual de preferencias
- Información sobre cookies activas

---

### 👤 Ejercicio 3: Login con Sesiones
**Archivo:** `ejercicio3.php`

**Conceptos que practica:**
- Sistema de autenticación básico
- Sesiones para mantener login
- Validación de credenciales
- Contador de intentos fallidos
- Logout con destrucción de sesión

**Funcionalidades:**
- Login con usuarios predefinidos
- Información de sesión activa
- Contador de intentos fallidos
- Cierre de sesión
- 3 usuarios de prueba incluidos

---

### 📋 Ejercicio 4: Lista de Tareas (CRUD)
**Archivo:** `ejercicio4.php`

**Conceptos que practica:**
- CRUD completo (Create, Read, Update, Delete)
- Arrays complejos en sesión
- Función `uniqid()` para IDs únicos
- `array_filter()` y `array_values()`
- Paso de datos por referencia (`&$variable`)

**Funcionalidades:**
- Agregar tareas con prioridad
- Marcar como completada/pendiente
- Eliminar tareas individuales
- Limpiar todas las tareas
- Estadísticas (total, completadas, pendientes)
- Sistema de prioridades con colores

---

### 🎲 Ejercicio 5: Juego de Adivinanza
**Archivo:** `ejercicio5.php`

**Conceptos que practica:**
- Generación de números aleatorios (`rand()`)
- Lógica de juego
- Contador de intentos
- Historial de intentos
- Funciones `min()` y `max()`

**Funcionalidades:**
- Adivinar número entre 1 y 100
- Pistas (mayor/menor)
- Contador de intentos
- Historial visual de intentos
- Estadísticas del juego
- Reiniciar juego

---

### 🛒 Ejercicio 6: Carrito de Compras
**Archivo:** `ejercicio6.php`

**Conceptos que practica:**
- Combinación de sesiones y cookies
- Carrito de compras funcional
- Arrays multidimensionales
- Cálculos con decimales
- `number_format()` para formatear precios

**Funcionalidades:**
- Catálogo de 6 productos
- Agregar productos al carrito
- Actualizar cantidades
- Eliminar productos
- Calcular total
- Recordar nombre de usuario con cookie
- Vaciar carrito completo

---

### 📊 Ejercicio 7: Encuesta con Resultados
**Archivo:** `ejercicio7.php`

**Conceptos que practica:**
- Formularios con múltiples tipos de input
- Checkboxes múltiples
- Procesamiento de arrays de formularios
- Estadísticas y porcentajes
- `array_sum()` y `arsort()`
- Cookies para evitar votos duplicados

**Funcionalidades:**
- Encuesta de desarrollo web
- Selección múltiple (checkboxes)
- Resultados en tiempo real
- Barras de progreso visuales
- Prevención de votos duplicados
- Reinicio de resultados

---

### 🎨 Ejercicio 8: Personalizador de Tema
**Archivo:** `ejercicio8.php`

**Conceptos que practica:**
- CSS dinámico con PHP
- Input type="color" y type="range"
- Múltiples cookies relacionadas
- Estilos inline generados por PHP
- Temas predefinidos

**Funcionalidades:**
- 4 temas predefinidos (Oscuro, Naturaleza, Océano, Atardecer)
- Personalización manual de colores
- Ajuste de tamaño de fuente
- Vista previa en tiempo real
- Guardar preferencias en cookies
- Restablecer a valores por defecto

---

## 🎯 Conceptos Clave Cubiertos

### Sesiones
- `session_start()` - Iniciar sesión
- `$_SESSION['clave']` - Guardar datos en sesión
- `session_destroy()` - Destruir sesión
- Persistencia durante la navegación

### Cookies
- `setcookie(nombre, valor, expiracion, ruta)` - Crear cookie
- `$_COOKIE['nombre']` - Leer cookie
- Expiración de cookies
- Borrado de cookies (tiempo negativo)

### Formularios
- `$_SERVER['REQUEST_METHOD']` - Detectar método HTTP
- `$_POST['campo']` - Recibir datos POST
- `$_GET['parametro']` - Recibir datos GET
- Validación de datos
- `isset()` y operador `??` (null coalescing)

### Arrays
- Arrays simples y asociativos
- Arrays multidimensionales
- `array_filter()`, `array_values()`, `array_sum()`
- `arsort()` - Ordenar array manteniendo claves
- `min()`, `max()` - Valores mínimo y máximo

### Estructuras de Control
- `if / elseif / else` (NO se usa `exit`)
- Bucles `foreach`
- Operador ternario `? :`

### Funciones Útiles
- `htmlspecialchars()` - Escapar HTML (seguridad)
- `trim()` - Eliminar espacios
- `is_numeric()` - Validar números
- `intval()`, `floatval()` - Convertir a número
- `number_format()` - Formatear números
- `date()` - Fecha y hora
- `rand()` - Números aleatorios
- `uniqid()` - IDs únicos

### Seguridad
- Siempre usar `htmlspecialchars()` al mostrar datos del usuario
- Validar datos antes de procesarlos
- Verificar que existen las claves antes de usarlas

---

## 🚀 Cómo Usar

1. Accede a `index.php` para ver todos los ejercicios
2. Cada ejercicio es independiente
3. Los datos se guardan en sesión o cookies según el ejercicio
4. Puedes reiniciar/limpiar datos en cada ejercicio

## 💡 Consejos para el Examen

1. **Sesiones**: Siempre inicia con `session_start()` al principio del archivo
2. **Cookies**: Recuerda que `setcookie()` debe ir ANTES de cualquier salida HTML
3. **Validación**: Siempre valida los datos del usuario
4. **Arrays**: Verifica que exista una clave antes de usarla con `isset()`
5. **Seguridad**: Usa `htmlspecialchars()` al mostrar datos del usuario
6. **Estructura**: Usa if/elseif/else en lugar de exit
7. **POST vs GET**: POST para formularios que modifican datos, GET para consultas

## 📝 Estructura de Archivos

```
chuletillas/
├── index.php           # Página principal con enlaces
├── styles.css          # Estilos compartidos
├── ejercicio1.php      # Calculadora
├── ejercicio2.php      # Preferencias
├── ejercicio3.php      # Login
├── ejercicio4.php      # Lista de tareas
├── ejercicio5.php      # Juego adivinanza
├── ejercicio6.php      # Carrito
├── ejercicio7.php      # Encuesta
├── ejercicio8.php      # Personalizador
└── README.md           # Este archivo
```

## 🎓 Nivel de Dificultad

- ⭐ Ejercicio 1: Medio - Sesiones básicas
- ⭐ Ejercicio 2: Medio - Cookies básicas
- ⭐⭐ Ejercicio 3: Medio-Alto - Autenticación
- ⭐⭐⭐ Ejercicio 4: Alto - CRUD completo
- ⭐⭐ Ejercicio 5: Medio-Alto - Lógica de juego
- ⭐⭐⭐ Ejercicio 6: Alto - Carrito completo
- ⭐⭐⭐ Ejercicio 7: Alto - Estadísticas
- ⭐⭐ Ejercicio 8: Medio-Alto - CSS dinámico

---

**¡Buena suerte en tu examen! 🍀**

Creado para estudiantes de 2º DAW - Desarrollo de Aplicaciones Web
