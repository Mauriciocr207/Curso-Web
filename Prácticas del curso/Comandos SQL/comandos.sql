-- SQL - Comandos SQL que debes Conocer y operaciones CRUD
-- //== 229. Crear Base de Datos ==//
-- //== 230. Crear Tabla y Tipos de Datos ==//
    SHOW DATABASES; -- Muestra las bases de datos en el schema seleccionado
    CREATE DATABASE appsalon; -- Crear una base de datos
    USE appsalon; -- Selecciona una base de datos para ingresar a sus tablas
    DROP DATABASE appsalon; -- Borra la base de datos

-- 230. Crear Tabla y tipos de Datos en MySQL
    -- Tipos de datos:
    -- Números -> Enteros y Decimales
    -- Cadenas de Texto -> Desde nombres hasta noticias
    -- Fechas y Horas
    CREATE DATABASE Introduccion_MySQL;
    USE Introduccion_MySQL;
    CREATE TABLE servicios (
        id INT(11) NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(60) NOT NULL,
        precio DECIMAL(6,2) NOT NULL,
        PRIMARY KEY (id)
    );
    SHOW TABLES;
    DESCRIBE servicios; -- Descripción de la tabla;
    DROP TABLE servicios;

-- //== 231. ¿Qué es CRUD? ==//
-- //== 232. Insertar Valores en una Base de Datos ==//
    -- CRUD
    -- Create
    -- Read
    -- Update
    -- Delete
    -- -- -- -- -- -- -- -- -- --
    -- Insertar datos a la tabla
    INSERT INTO servicios(nombre, precio)
        VALUES
            ("Corte de Cabello de Adulto", 80);
    INSERT INTO servicios(nombre, precio)
        VALUES
            ("Corte de Cabello Niño", 60);
    INSERT INTO servicios(nombre, precio)
        VALUES 	
            ("Tinte", 120);
    INSERT INTO servicios(nombre, precio) 
        VALUES 
            ("Peinado Mujer", 80),
            ("Peinado Hombre", 60);

-- //== 233. Selecionar elementos de una Tabla ==//  
-- //== 234. Seleccionar elementos en específico ==// 
    -- SELECT -> selecciona un conjunto de datos de la tabla; FROM -> indica la tabla a la que haremos referencia
    SELECT * FROM servicios; -- * -> referencia a todos
    SELECT nombre FROM servicios;
    SELECT nombre, precio FROM servicios;
    -- ORDER BY ... ASC/DESC -> ordena los elementos por una clave de forma ascendente o descendente
    SELECT id, nombre, precio FROM servicios 
    ORDER BY precio ASC;
    SELECT id, nombre, precio FROM servicios 
    ORDER BY precio DESC;
    SELECT id, nombre, precio FROM servicios LIMIT 2;
    SELECT id, nombre, precio FROM servicios WHERE id = 2;

    -- Cambiar datos en la tabla 
    UPDATE servicios SET precio = 70 WHERE id = 2;
    UPDATE servicios SET nombre = "Corte de Cabello de Niño Actualizado" WHERE id = 2;
    UPDATE servicios SET nombre = "Corte de Cabello de Adulto Actualizado", precio = 120 WHERE id = 1;

-- //== 235. Eliminar Registros ==//
    -- Elliminar registros
    DELETE FROM servicios WHERE id = 1;
    DELETE FROM servicios WHERE id = 4;
    -- insertar registros
    INSERT INTO servicios (nombre, precio) VALUES
        ("Corte de Cabello de Adulto", 120);
    -- Vemos que al insertar un nuevo registro, sql inserta los nuevos registros siempre después del último registro
-- //== 236. Modificar la base de datos ==//
    DESCRIBE servicios;
    ALTER TABLE servicios ADD descripcion VARCHAR(100) NOT NULL;
    SELECT * FROM servicios;
    ALTER TABLE servicios CHANGE descripcion nuevo_nombre VARCHAR(11) NOT NULL;
    DESCRIBE servicios;
    INSERT INTO servicios (nombre, precio, nuevo_nombre) VALUES
        ("Peinado", 100, "Hola");
    ALTER TABLE servicios CHANGE nuevo_nombre descripcion VARCHAR(11) NOT NULL;
    ALTER TABLE servicios DROP COLUMN descripcion;
-- //== 237. Elimnar Tablas ==//
    SHOW TABLES;
    DROP TABLE servicios;
    CREATE TABLE servicios(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(60) NOT NULL,
        precio DECIMAL(6, 2) NOT NULL
    );
    CREATE TABLE reservaciones (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(60) NOT NULL,
        apellido VARCHAR(60) NOT NULL,
        hora TIME DEFAULT NULL,
        fecha DATE DEFAULT NULL,
        servicios VARCHAR(255) NOT NULL
    );
    DESCRIBE reservaciones;
    INSERT INTO reservaciones (nombre, apellido, hora, fecha, servicios) VALUES
        ('Juan', 'De la torre', '10:30:00', '2021-06-28', 'Corte de Cabello Adulto, Corte de Barba' ),
        ('Antonio', 'Hernandez', '14:00:00', '2021-07-30', 'Corte de Cabello Niño'),
        ('Pedro', 'Juarez', '20:00:00', '2021-06-25', 'Corte de Cabello Adulto'),
        ('Mireya', 'Perez', '19:00:00', '2021-06-25', 'Peinado Mujer'),
        ('Jose', 'Castillo', '14:00:00', '2021-07-30', 'Peinado Hombre'),
        ('Maria', 'Diaz', '14:30:00', '2021-06-25', 'Tinte'),
        ('Clara', 'Duran', '10:00:00', '2021-07-01', 'Uñas, Tinte, Corte de Cabello Mujer'),
        ('Miriam', 'Ibañez', '09:00:00', '2021-07-01', 'Tinte'),
        ('Samuel', 'Reyes', '10:00:00', '2021-07-02', 'Tratamiento Capilar'),
        ('Joaquin', 'Muñoz', '19:00:00', '2021-06-28', 'Tratamiento Capilar'),
        ('Julia', 'Lopez', '08:00:00', '2021-06-25', 'Tinte'),
        ('Carmen', 'Ruiz', '20:00:00', '2021-07-01', 'Uñas'),
        ('Isaac', 'Sala', '09:00:00', '2021-07-30', 'Corte de Cabello Adulto'),
        ('Ana', 'Preciado', '14:30:00', '2021-06-28', 'Corte de Cabello Mujer'),
        ('Sergio', 'Iglesias', '10:00:00', '2021-07-02', 'Corte de Cabello Adulto'),
        ('Aina', 'Acosta', '14:00:00', '2021-07-30', 'Uñas'),
        ('Carlos', 'Ortiz', '20:00:00', '2021-06-25', 'Corte de Cabello Niño'),
        ('Roberto', 'Serrano', '10:00:00', '2021-07-30', 'Corte de Cabello Niño'),
        ('Carlota', 'Perez', '14:00:00', '2021-07-01', 'Uñas'),
        ('Ana Maria', 'Igleias', '14:00:00', '2021-07-02', 'Uñas, Tinte'),
        ('Jaime', 'Jimenez', '14:00:00', '2021-07-01', 'Corte de Cabello Niño'),
        ('Roberto', 'Torres', '10:00:00', '2021-07-02', 'Corte de Cabello Adulto'),
        ('Juan', 'Cano', '09:00:00', '2021-07-02', 'Corte de Cabello Niño'),
        ('Santiago', 'Hernandez', '19:00:00', '2021-06-28', 'Corte de Cabello Niño'),
        ('Berta', 'Gomez', '09:00:00', '2021-07-01', 'Uñas'),
        ('Miriam', 'Dominguez', '19:00:00', '2021-06-28', 'Corte de Cabello Niño'),
        ('Antonio', 'Castro', '14:30:00', '2021-07-02', 'Corte de Cabello Adulti'),
        ('Hugo', 'Alonso', '09:00:00', '2021-06-28', 'Corte de Barba'),
        ('Victoria', 'Perez', '10:00:00', '2021-07-02', 'Uñas, Tinte'),
        ('Jimena', 'Leon', '10:30:00', '2021-07-30', 'Uñas, Corte de Cabello Mujer'),
        ('Raquel' ,'Peña', '20:30:00', '2021-06-25', 'Corte de Cabello Mujer');
    INSERT INTO servicios ( nombre, precio ) VALUES
        ('Corte de Cabello Niño', 60),
        ('Corte de Cabello Hombre', 80),
        ('Corte de Barba', 60),
        ('Peinado Mujer', 80),
        ('Peinado Hombre', 60),
        ('Tinte',300),
        ('Uñas', 400),
        ('Lavado de Cabello', 50),
        ('Tratamiento Capilar', 150);
    SELECT *  FROM reservaciones;
-- //== 238. Seleccionar servicios por precio ==//
    SELECT * FROM servicios WHERE precio > 90;
    SELECT * FROM servicios WHERE precio >= 80;
    SELECT * FROM servicios WHERE precio <= 80;
    SELECT * FROM servicios WHERE precio < 80;
    SELECT * FROM servicios WHERE precio BETWEEN 100 AND 200;
-- //== 239. Otros selectores con MySQL ==//
    SELECT COUNT(id), fecha 
    FROM reservaciones
    GROUP BY fecha
    ORDER BY COUNT(id) DESC;
    SELECT SUM(precio) AS total_servicios FROM servicios;
    SELECT MIN(precio) AS precio_menor FROM servicios;
    SELECT MAX(precio) AS precio_mayor, nombre FROM servicios;
    SELECT nombre, precio FROM servicios WHERE precio = (SELECT MAX(precio) FROM servicios);
-- //== 240. Cómo buscar en SQL ==//
    SELECT * FROM servicios;
    SELECT * FROM servicios WHERE nombre LIKE 'Corte%';
    SELECT * FROM servicios WHERE nombre LIKE '%cabello%';
-- //== 241. Concatenar en SQL ==//    
    SELECT CONCAT(nombre, ' ', apellido) AS nombre_completo FROM reservaciones;
    SELECT * FROM reservaciones
    WHERE CONCAT(nombre, ' ', apellido) LIKE '%Ana Preciado%';
    SELECT hora, fecha, CONCAT(nombre, ' ', apellido) AS "Nombre Completop" FROM reservaciones
    WHERE CONCAT(nombre, ' ', apellido) LIKE '%Ana Preciado%';
-- //== 242. Revisar por múltiples condiciones ==//
    SELECT * FROM reservaciones WHERE id IN(1,3);
    SELECT * FROM reservaciones WHERE fecha = "2021-06-28" 
    AND id = 1;