# Tienda Alonso - Sistema de Gestión de Productos

Una moderna aplicación web para gestión de tienda virtual desarrollada en PHP con arquitectura MVC.

## Características

- **Página Principal**: Muestra productos disponibles con diseño moderno
- **Gestión de Productos**: CRUD completo (Crear, Leer, Actualizar, Eliminar)
- **Categorización**: Sistema de categorías para organizar productos
- **Control de Inventario**: Gestión de stock y disponibilidad
- **Diseño Responsivo**: Compatible con dispositivos móviles y desktop
- **Interfaz Moderna**: Paleta de colores azul y blanco con tipografía Inter

## Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Servidor**: Apache (XAMPP)
- **Arquitectura**: MVC (Modelo-Vista-Controlador)

## Instalación

### Prerrequisitos

- XAMPP instalado y funcionando
- PHP 7.4 o superior
- MySQL 5.7 o superior

### Pasos de Instalación

1. **Clonar o descargar el proyecto** en la carpeta `htdocs` de XAMPP:
   ```
   c:\xampp\htdocs\tiendaAzure\
   ```

2. **Iniciar servicios de XAMPP**:
   - Apache
   - MySQL

3. **Crear la base de datos**:
   - Abrir phpMyAdmin (http://localhost/phpmyadmin)
   - Ejecutar el script SQL ubicado en `app/database/db.sql`

4. **Configurar conexión a base de datos** (si es necesario):
   - Editar `app/Models/Tienda.php`
   - Modificar las credenciales de conexión:
     ```php
     private $host = 'localhost';
     private $dbname = 'tiendaAlonso';
     private $username = 'root';
     private $password = '';
     ```

5. **Acceder a la aplicación**:
   - Abrir navegador web
   - Ir a: `http://localhost/tiendaAzure`

## Estructura del Proyecto

```
tiendaAzure/
├── app/
│   ├── Controllers/
│   │   ├── TiendaController.php    # Controlador principal
│   │   └── index.php               # Manejador de rutas
│   ├── Models/
│   │   └── Tienda.php              # Modelo de datos
│   ├── Views/
│   │   ├── index.php               # Página principal
│   │   └── Tienda/
│   │       ├── crear.php           # Formulario crear producto
│   │       ├── editar.php          # Formulario editar producto
│   │       └── listar.php          # Lista de productos
│   └── database/
│       └── db.sql                  # Script de base de datos
├── index.php                      # Punto de entrada
└── README.md                      # Este archivo
```

## Uso de la Aplicación

### Página Principal
- Muestra todos los productos disponibles
- Navegación intuitiva con navbar
- Diseño de tarjetas para cada producto

### Gestión de Productos
1. **Agregar Producto**: Clic en "Registrar Producto"
2. **Ver Productos**: Ir a "Gestionar Productos"
3. **Editar Producto**: Clic en "Editar" en la tabla de productos
4. **Eliminar Producto**: Clic en "Eliminar" con confirmación

### Campos de Producto
- **Nombre**: Nombre del producto
- **Precio**: Precio en formato decimal
- **Stock**: Cantidad disponible
- **Categoría**: Selección de categoría existente
- **Imagen**: URL de imagen del producto
- **Disponible**: Estado de disponibilidad

## Base de Datos

### Tablas Principales

**categorias**
- `id`: Clave primaria
- `nombre`: Nombre de la categoría

**productos**
- `id`: Clave primaria
- `nomproducto`: Nombre del producto
- `precio`: Precio decimal
- `stock`: Cantidad en inventario
- `disponible`: Estado booleano
- `imagen`: URL de la imagen
- `created_at`: Fecha de creación
- `updated_at`: Fecha de actualización
- `categoria_id`: Clave foránea a categorias

## Características Técnicas

### Seguridad
- Validación de datos en servidor
- Escape de caracteres HTML
- Consultas preparadas (PDO)

### Diseño
- Responsive design
- Paleta de colores azul y blanco
- Tipografía moderna (Inter)
- Efectos hover y transiciones

### Funcionalidades
- Vista previa de imágenes
- Confirmación de eliminación
- Mensajes de estado
- Manejo de errores

## Solución de Problemas

### Error de Conexión a Base de Datos
- Verificar que MySQL esté ejecutándose
- Comprobar credenciales en `Tienda.php`
- Asegurar que la base de datos `tiendaAlonso` existe

### Imágenes No Se Muestran
- Verificar que las URLs de imágenes sean válidas
- Comprobar conexión a internet para imágenes externas

### Errores de PHP
- Verificar versión de PHP (7.4+)
- Comprobar que Apache esté ejecutándose
- Revisar logs de error de Apache

## Contribución

Para contribuir al proyecto:
1. Fork del repositorio
2. Crear rama para nueva característica
3. Commit de cambios
4. Push a la rama
5. Crear Pull Request

## Licencia

Este proyecto es de uso educativo y demostrativo.

## Contacto

Para soporte o consultas sobre el proyecto, contactar al desarrollador.
