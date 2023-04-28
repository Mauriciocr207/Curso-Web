-- //== 247. ¿Qué es la cardinalidad y diagramas ER ==//
    DROP TABLE reservaciones;
    CREATE TABLE clientes(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(60) NOT NULL,
        apellido VARCHAR(60) NOT NULL,
        telefono VARCHAR(10) NOT NULL,
        email VARCHAR(30) NOT NULL UNIQUE
    );

    INSERT INTO clientes (nombre, apellido, telefono, email) VALUES
        ("Juan", "De la Torre", 1231231233, "correo@correo.com");
-- //== 248. Relacionar 2 Tablas ==//
    CREATE TABLE citas(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fecha DATE NOT NULL,
        hora TIME NOT NULL,
        id_cliente INT(11) NOT NULL,
        KEY id_cliente (id_cliente),
        CONSTRAINT id_cliente_FK FOREIGN KEY (id_cliente)
        REFERENCES clientes (id)
    );
    DESCRIBE citas;
    SELECT * FROM clientes;
    INSERT INTO citas (fecha, hora, id_cliente) VALUES
        ('2021-06-28', '10:30:00', 1);

    SELECT * FROM citas;
-- //= 249. Unir 2 tablas en una consulta ==//
    SELECT
        clientes.nombre,
        clientes.apellido,
        citas.fecha,
        citas.hora  
    FROM citas
    INNER JOIN clientes ON clientes.id = citas.id_cliente;
-- //== 250. Crear una Tabla Pivote ==//
    CREATE TABLE citas__servicios (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        id_cita INT(11) NOT NULL,
        id_servicio INT(11) NOT NULL,
        KEY id_cita (id_cita),
        CONSTRAINT id_cita_FK FOREIGN KEY (id_cita)
        REFERENCES citas (id),
        KEY id_servicio (id_servicio),
        CONSTRAINT id_servicio_FK FOREIGN KEY (id_servicio)
        REFERENCES servicios (id)
    );
    INSERT INTO citas__servicios (id_cita, id_servicio) VALUES
        (2,8);
    SELECT * FROM clientes;
    SELECT * FROM servicios;
    SELECT * FROM citas;
    SELECT * FROM citas__servicios;
-- //== 251. Consultar la información de la tabla pivote ==//
    SELECT 
        CONCAT(clientes.nombre, ' ', clientes.apellido),
        clientes.telefono,
        clientes.email,
        citas.fecha,
        citas.hora,
        servicios.nombre,
        servicios.precio
    FROM citas__servicios
    LEFT JOIN citas ON citas.id = citas__servicios.id_cita
    LEFT JOIN clientes ON clientes.id = citas.id_cliente
    LEFT JOIN servicios ON servicios.id = citas__servicios.id_servicio;
    
    INSERT INTO citas (fecha, hora, id_cliente) VALUES
        ("2021-06-29", "10:30:00", 1);
    INSERT INTO citas__servicios (id_cita, id_servicio) VALUES (3, 7);

    SELECT 
        clientes.nombre,
        clientes.apellido,
        clientes.telefono,
        clientes.email,
        SUM(servicios.precio) AS "Total"
    FROM citas__servicios
    LEFT JOIN citas ON citas.id = citas__servicios.id_cita
    LEFT JOIN clientes ON clientes.id = citas.id_cliente
    LEFT JOIN servicios ON servicios.id = citas__servicios.id_servicio
    GROUP BY clientes.id;

