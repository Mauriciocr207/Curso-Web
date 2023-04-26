// Mi centésimo hola mundo
console.log('hola mundo!');

// ESTARÉ COLOCANDO EL NUMERO DE LOS VIDEOS. 
// POR EJEMPLO -> 104. VARIABLES EN JS
// !!! COMENCEMOS !!! 

// 104. VARIABLES EN JS
// 105. Variables con let y const
    function variables() {
        // tres tipos:
        // javascript no tiene tipado -> no se declara el tipo de variables.

        // var -> ya no se utiliza 
            var producto = "Audífonos Gamer";
            var disponible; // iniciamos la variable pero sin valor
            producto = true; // se reasigna el valor de la variable
            // Esilos de variables
            var nombre_producto = 'Monitor HD'; // undercase
            var nombreProducto = 'Monitor HD'; // CamelCase
            var NombreProducto = 'Monitor HD'; // Pascal Case
            var nombreproducto = 'Monitor HD'; // no muy utilizado 
            console.log(nombre_producto);
            console.log(nombreProducto);
            console.log(NombreProducto);
            console.log(nombreproducto);
        // let -> las variables let son parecidas a var en cuestion de estructura, pero no de scope.
        // let te permite declarar variables limitando su alcance (scope) al bloque, 
        // declaración, o expresión donde se está usando. a diferencia de la palabra 
        // clave var la cual define una variable global o local en una función sin 
        // importar el ámbito del bloque.
            let newProduct = 'Audífonos Gamer nuevos';
            let oldProducto;
            oldProducto = 'Audífonos Gamer viejos';
            console.log(`
                Se borra ${oldProducto} y añade ${newProduct}
            `);
        // const
            // las variables son constantes -> no se reinician sin valor y tampoco se pueden reasignar sus valores
            const piValue = 3.14159;
            const g_Constant = 9.8;
    }; //variables();


// 106. Strings o Cadenas de Texto
// 107. Métodos para los Strings
    function practicaConStrings() {
        //  formas de declaración de strings:
        const string = 'nuevo string'; // -> mejor práctica
        const string2 = String('nuevo string')
        const string3 = new String('nuevo string');
        console.log(string2);
        console.log(typeof string);
        // Para declarar un string sin valor:
        const stringSinValor = ''; // -> buena práctica
        const stringSinValor2 = new String(''); // -> mala práctica
        
        // Métodos y propiedades de strings
        const producto = 'Monitor de 2"';
        const producto2 = 'Monitor HD';
        
        // length -> devuelve el largo de la cadena
        console.log(producto.length);
        // indexOf -> devuelve la posicion de la palabra buscada
        console.log(producto.indexOf('M'));
        // includes -> devuelve true / false si existe el caracter o palabra en el string
        console.log(producto.includes('o'));
    }; //practicaConStrings()


// 108. Números y Operadores
// 109. El Objeto Math en JS
//  110. Controlar el Orden de las operaciones 
    function numeros() {
        const num1 = 300;
        const num2 = 200;
        // Operadores
        console.log(num1 + num2); // suma
        console.log(num1 - num2); // resta
        console.log(num1 * num2); // multiplicacion
        console.log(num1 / num2); // division
        console.log(num1 % num2); // módulo o residuo de la division

        // Objeto Math
        let resultado = 0;
        resultado = Math.PI;
        resultado = Math.round(2); // redondeo
        resultado = Math.ceil(2.1); // redondeo hacia arriba
        resultado = Math.floor(2.9); // reondeo hacai abajo
        resultado = Math.sqrt(144); // raíz cuadrada
        resultado = Math.abs(-2.54); // valor absoluto
        resultado = Math.min(1,3,2,-1,-100,5,8);
        resultado = Math.max(1,3,2,-1,-100,5,8);
        resultado = Math.random();
        resultado = Math.floor( Math.random() * 100)
        
        // Orden de las operaciones
        resultado = ( 20 + 80 ) * 1.16;
        
        console.log(resultado);

        // incrementosa
        let puntaje = 10;
        puntaje++;
        ++puntaje;
        puntaje--;
        --puntaje;

        puntaje += 5
        puntaje *= 5
        puntaje -= 5
        puntaje /= 5


        console.log(++puntaje);

    } //numeros();


// 111. concatenación y Template Strings
    function templateStrings() {
        const nombre = 'Juan';
        const email = 'correo@correo.com';

        // Formas de concatenar
        console.log(nombre + email);
        console.log("Nombre Cliente: " + nombre + " Email: " + email); // -> esta forma no es muy eficiente
        // Template Strings
        console.log(`Nombre cliente: ${nombre}, Email: ${email}`);
    }; // templateStrings()


// 112. Booleans
    function boooleans() {
        // La ventaja de usar booleanos es que el tamaño de este tipo de dato es menor
        const frase = 'hola mundo';
        const number = 10;
        const bool = true;
        // NOTA:
        //  Los boleanos se pueden operar con numeros o se pueden concatenar con strings, javascript realiza las operaciones por debajo. 

        console.log(
            bool, 
            true + true, 
            (true + true) * number,
            false + frase
        );
    } // boooleans();


// 113. Objetos
// 114. Modificar Objetos
// 115. Destructuring de Objetos 
// 116. Object Methods
// 117. Unir dos objetos con el Spread Operator
    function objects() {
        'use strict' // Correr JS en modo stricto
        // Creacion de un objeto
        const producto = {
            name: 'Monitor 20"',
            price: 300,
            available: true
        }
        // Formas de acceder a las propiedades de los objetos
        console.log(producto.price);
        console.log(producto['name']);    

        // Modificar objetos
        // Agregar propiedades
        producto.img = 'imagen.jpg';
        // Eliminar propiedades
        delete producto.available;

        console.log(producto)

        // Destructuring objetos
        // Forma creando variables externas
        const precioProducto = producto.price;
        console.log(precioProducto);
        // Con destructuring
        const {price, name} = producto;
        console.log(price, name);

        // Métodos de objetos
        const newProduct = {
            name: "KeyCaps",
            price: 1000,
            available: true
        }
        // Para no modificar las propiedades de un objeto
        Object.freeze(newProduct);
        // newProduct.img = 'imagen.jpg'
        console.log(newProduct.img, newProduct); // no se agrega la propiedad
        // newProduct.stock = 300; // -> en use strict una modificacion al string daría un error

        // Para saber si un objeto está congelado
        console.log(Object.isFrozen(newProduct));

        const oldProduct = {
            name: "Monitor",
            price: 1000,
            available: false
        }
        Object.seal(oldProduct);
        oldProduct.price = 2000;
        console.log(Object.isSealed(oldProduct), oldProduct);

        // Diferencia entre freeze y seal
        const carro_city = {
            name: 'city',
            price: 10
        }
        const carro_vento = {
            name: 'vento',
            price: 15
        }
        // freeze y seal te permiten no agregar ni borrar propiedades de un objeto
        Object.freeze(carro_city); 
        Object.seal(carro_vento);
        // carro_city.name = 'hola'; // -> freeze no permite modificar propiedades de un objeto
        carro_vento.name = 'nuevo vento'; // -> seal sí permite modificar propiedades de un objeto

        console.log(carro_vento);


        // Uni dos objetos con el spreado operator
        const precios = {
            price: 50,
            descuento: {
                general: 10,
                membresy: 50, 
            }
        }
        const size = {
            widht: 20,
            heigth: 10,
            unit: 'ft',
            general: {
                value: 20,
                unit: 'ft'
            }
        }
        // Se crea un televisor con las propiedades de precios y size 
        const televisor = {
            ...precios,
            ...size
        }
        console.log(televisor);

    }; // objects();


// 118. Arrays
// 119. Métodos para los Arrrays
// 120. Más Métodos de Arrays
    function arrays() {
        // declaracion de arreglo
        const nums = [10,20,30,40,50];
        console.table(nums);

        // Otra forma de declarar un arreglo
        const mes = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo');
        console.table(mes);


        // Los arreglos pueden ser de varios tipos
        const arr = [true, 'hola', 1, 5, 'a', {name: 'Carlos', last: 'Moreno'}, null, undefined, [1,2,3]];
        console.log(arr);
        console.log(arr[5]);

        // Como saber la extensión de un arreglo
        console.log(arr.length);

        // forEach() -> para recorrer arreglos
        arr.forEach( (e) => {
            console.log('mostrando: ' + e);
        });

        // Agregar elementos a un arreglo
        arr[20] = 'elemento 20';
        console.log(arr);
        // NOTA: en JS puedes agregar elementos a cualquier índice fuera del arreglo,
        // lo que pasará es que, por defecto, los espacios que no se estén utilizando
        // se colocarán como vacíos
        console.log(arr[15]);
        console.log(typeof arr[15]);
        // Vemos que, el dato en el índice arr[15] -> undefined
        // y su tipo de dato también lo es typeof arr[15] -> undefined

        // Otra forma de agregar valores a un arreglo es:
        const newArr = [1,2,3,4];
        newArr.push({frase: 'final'}); // Agrega al final del arreglo
        newArr.unshift({frase: 'inicio'}); //  Agrega al inicio de un arrgeglo
        console.log(newArr)

        // Eliminar elementos de un arreglo
        const marcas = ['Apple', 'Microsoft','Tesla', 'Amazon', 'Google'];
        marcas.pop(); // Elimina el último elemento de un arreglo
        marcas.shift(); // Elimina el primer elemento de un arreglo
        marcas.splice(1,2); // Elimina varios elementos a partir de una posicion
        // NOTA: Estos métodos modifican el arreglo original
        console.log(marcas);

        // Buenas prácticas -> mantener el arreglo original
        const marcas_old = ['Apple', 'Microsoft','Tesla', 'Amazon', 'Google'];
        const marcas_new = ['YouTube', ...marcas_old, 'Facebook'];
        console.log(marcas_new);


        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
        const carrito = [
            {nombre: 'Monitor 20"', precio: 500},
            {nombre: 'Televisión 50"', precio: 700},
            {nombre: 'Tablet', precio: 300},
            {nombre: 'Audífonos', precio: 200},
            {nombre: 'Teclado', precio: 50},
            {nombre: 'Celular', precio: 500},
            {nombre: 'Bocinas', precio: 300},
            {nombre: 'Laptop', precio: 800},
            {nombre: 'Celular', precio: 700},
        ]

        // forEach
        meses.forEach( e => {
            if(e == 'Marzo' ) console.log('Marzo si existe');
        });

        // Este código es equivalente al anterior con forEach
        meses.includes('Marzo') ? console.log('Marzo si existe'): console.log('Marzo no existe');

        // Cuando tienes un arreglo de objetos, no se puede usar includes, es mejor usar some
        carrito.some( e => e.nombre == 'Laptop' ) ? console.log('si existe') : console.log('no existe');

        // reduce
        let resultado = carrito.reduce( (total, e) => total + e.precio , 0);
        console.log(resultado);

        // filter 
        resultado = carrito.filter( e => e.precio > 400);
        console.table(resultado);

        resultado = carrito.filter( e => e.nombre == 'Celular' );
        
        console.table(resultado);
    }; // arrays();


// 121. Funciones en JavaScript
// 122. Diferencias entre el tipo de funciones
// 123. Diferencia de un Método y una funcion
// 124. Funciones con parámetros y argumentos
// 125. Funcionees que retornan valores
// 126. Métodos de propiedad
// 127. Arrow functions
    function funcion() {
    
        // formas de declarar funciones
        // Declarativa
        function sum() {
            console.log(10*10);
        }
        sum();
        // Expresion de la funcion
        const multiplicacion = function() {
            console.log(10+10);
        }
        multiplicacion();

        // Funciones IIFE -> se llaman a si mismas 
        (function() {
            console.log('funcion IIFE');
        })();
        (() => {
            console.log('otra funcion IIFE')
        })();

        // HOISTING
        // El hoisting es la doble ejecucion de JS
        // JS se ejecuta en dos vueltas;
        // vuelta 1 -> se registran funciones y variables
        // vuelta 2 -> se ejecuta el código
        resta();
        function resta() {
            console.log(5-3);
        }

        // resta2();
        const resta2 = function() {
            console.log(5-3);
        }

        // Por tanto, las funciones declarativas si pueden ser llamadas antes de su declaracion. 
        // Sin embargo las funciones expresadas en variables no se pueden llamar antes de su creacion, porque están guardadas en variables, y los valores asignados a las variables solo existen en la segunda vuelta. por tanto en la segunda vuelta estaríamos llamando una funcion, y luego creandola, en la primera vuelta solo se registraría la variable. Es por esto que nos da un error.


        const num1 = 20;
        const num2 = '25'
        console.log(parseInt(num2)); // parseInt es una funcion 
        console.log(num1.toString()) // .toString() es un método
        // La diferencia es que un método son funciones propias de un objeto en particular
        // Las funciones en general no son parte de un objeto.  


        // Fuciones con parámetros
        function saludar(nombre = 'desconocido') {
            console.log(`Hola ${nombre}!`);
        }
        // saludar('Mauricio');
        // saludar('Carlos');
        // saludar('Cristian');
        saludar();

        // Funciones que retornan un valor
        function horneaar(minutos = 0) {
            console.log('Horneando...');
            console.log(`Tardará ${minutos} min`);
            return  'horneado';
        }
        console.log(horneaar(5));

        let total = 0;
        function agregarCarrito(precio) {
            return total += precio;
        }
        function impuesto(vaalor) {
            return 1.15*vaalor;
        }
        agregarCarrito(200);
        agregarCarrito(500);
        agregarCarrito(700);
        console.log(total);
        const total_final = impuesto(total);
        console.log(total_final);

        // Métodos de propiedada
        const reproductor = {
            reproducir: function(id) {
                console.log(`reproduciendo ${id}`);
            },
            pausar: function() {
                console.log(`pausaando`);
            },
            crearPlayList: function(nombre) {
                console.log(`Creando la playlist ${nombre}`);
            },
            reproducirPlayList: function(nombre) {
                console.log(`Reproduciendo la playlist ${nombre}`);
            }
        }
        reproductor.reproducir(134);
        reproductor.pausar();
        reproductor.borrarCancion = function(id) {
            console.log(`Eliminando cancion con el id ${id}`)
        };
        reproductor.crearPlayList('Un verano sin ti');
        reproductor.reproducirPlayList('Un verano sin ti');


        // Arrow functions
        const dividir = (a, b) => {
            return a / b;
        }
        const dividir2 = (a,b) => a / b;
        const saludo = name => console.log(`Hola ${name}`);
        console.log(
            dividir(10, 5),
            dividir2(10,5),
            saludo('mau') // En esta funcion, no sólo se ejecuta el console.log(`Hola ${name}`); sino que también se retorna, por eso obtenemos un undefined en el console.log
        )
    }; // funcion();


// 128. Estructuras de control
// 129. Switch
    function estructura_de_control() {
        const puntaje = "1000";
        if(puntaje == 1000) console.log('puntaaje es similar o igual a 1000');
        if(puntaje === "1000") console.log('puntaaje es estrictamente igual a 1000');

        if(!true) {
            console.log('valor true');
        } else {
            console.log('valor false');
        }

        const efectivo = 1000;
        const carrito = 800;
        if(efectivo > carrito) {
            console.log('El usuario puede pagar');
        } else {
            console.log('Saldo insuficiente');
        }

        const rol = 'ADMINISTRADOR JR';
        if(rol =='ADMINISTRADOR') console.log('Acceso aceptadoa');
        else if(rol == 'ADMINISTRADOR JR') console.log('Acceso aceptaadoa');
        else console.log('Acceso denegado');


        // Switch
        const metodoPago = 'Tarjeta';
        switch(metodoPago) {
            default: 
                console.log('Aun no has pagado');
            case 'Tarjeta':
                console.log('Pagaste con tarjeta');
                break
            case 'Efectivo': 
                console.log('Pagaste con efectivo');
                break
            case 'Vales':
                console.log('Pagaste con vales');
                break
        }
    }; // estructura_de_control();


// 130. For Loops
// 131 While y Do While
// 132. forEach y map
    function iteradores() {
        // For Loop
        for (let i = 10; i > 3; i--) {
            console.log(i);
        };  

        for (let i = 0; i < 10; i++) {
            if( i % 2 === 0) {
                console.log(`${i} es par`);
            };
        };  

        const carrito = [
            {nombre: 'Monitor 20"', precio: 500},
            {nombre: 'Televisión 50"', precio: 700},
            {nombre: 'Tablet', precio: 300},
            {nombre: 'Audífonos', precio: 200}
        ]
        const precios = {
            price: 50,
            descuento: {
                general: 10,
                membresy: 50, 
            }
        };

        for (let i = 0; i < carrito.length; i++) {
            console.log(carrito[i].nombre);
        };

        // for of -> recorre los índices iterables de un objeto // para objetos que son arrays
        for (const i of carrito) {
            console.log(i);
        }
        // for in -> recorre las propiedades de un objeto // para todo tipo de objetos
        for (const i in precios) {
            console.log(i);
        }

        // While y Do While
        let i = 1;
        while (i <= 3) {
            console.log('iterando');
            i++;
        }; // -> evalua la condicion, ejecuta y aumenta el iterador

        let j = 1;
        do {
            console.log('iterando');
            j++;
        } while(j <= 3); // -> ejecuta, aumenta el iterador, evalua la condicion
 

        // forEach y map
        // for Each -> itera los elementos de un arreglo
        carrito.forEach( e => {
            console.log(e);
        })

        // map -> itera un arreglo y retorna un nuevo arreglo
        const carrito_actualizado = carrito.map( e => {
            return {...e, descuento: e.nombre == 'Tablet' ? true : false};
        });
        console.log(carrito_actualizado);
    }; // iteradores();


// 133. this en JavaScript
    function palabra_this() {
        // this hace referencia al contexto        
        const reservacion = {
            nombre: 'Juan',
            apellido: 'De la Torre',
            total: 5000,
            pagado: false,
            informacion: function() {
                console.log(this, `El cliente ${this.nombre} ${this.apellido} presenta un saldo ${this.pagado ? 'pagado' : 'no pagado'} por ${this.total}`);
            },
            informacion2: () => {
                console.log(this, `El cliente ${this.nombre} ${this.apellido} presenta un saldo ${this.pagado ? 'pagado' : 'no pagado'} por ${this.total}`);
            }
        }
        reservacion.informacion();
        reservacion.informacion2();
        // NOTA:
        // En general, el valor de this está determinado por cómo se invoca a la función. 
        // No puede ser establecida mediante una asignación en tiempo de ejecución, 
        // y puede ser diferente cada vez que la función es invocada. ES5 introdujo 
        // el método bind() para establecer el valor de la función this independientemente 
        // de como es llamada, y ES2015 introdujo las funciones flecha que no proporcionan 
        // su propio "binding" de this (se mantiene el valor de this del contexto léxico que 
        // envuelve a la función)
        //  -> como el arrow function en reservacion.informacion2() no proporciona su contexto, this se mantiene con el contexto en donde se encuentra la funcion, que en este caso es window
    }; // palabra_this();


// 134. Object Constructor y Object Literal
    function object_constructor_y_object_literal() {
        //== Object literal ==//
        //  -> se construye un objeto declarando explícitamente un obejto
        const producto = {
            nombre: 'Tablet',
            precio: 500,
        }

        //== Object Constructor ==//
        // -> esta funcion corresponde a una funcion constructor, es decir que establece las propiedades de la clase para crear con dichas propiedades cada objeto nuevo que pertenezca a esa clase
        function Producto(nombre, precio) {
            this.nombre = nombre;
            this.precio = precio;
            
        }
        const prod1 = new Producto('Tablet', 500);
        const prod2 = new Producto('Monitor 20"', 5000);
        console.log(prod1, prod2);
    }; // object_constructor_y_object_literal();


// 135. ¿Qué son los Prototypes?
    function prototypes() {
        // Creamos la clase producto
        function Producto(nombre, precio) {
            this.nombre = nombre;
            this.precio = precio;
        } 
        // Creamos un producto
        const prod1 = new Producto('Tablet', 500);
        // Creamos una funcion para producto
        function formatearProducto(producto) {
            return `${producto.nombre} cuesta ${producto.precio}`;
        };
        console.log(formatearProducto(prod1));
        // Creamos una clase cliente
        function Cliente(nombre, apellido) {
            this.nombre = nombre,
            this.apellido = apellido
        }
        // Creamos un cliente
        const cliente1 = new Cliente('Mauricio', 'Carrillo');
        // Utilizamos una funcion creada para Producto en Cliente
        console.log(formatearProducto(cliente1));
        // El problema de este código es que al crear formatearProducto() no creamos una funcion exclusiva para la clase Producto
        // Prototypes resuelve este problema.

        // De esta formaa creamos una funcion exclusiva para la clase producto
        Producto.prototype.formatearProducto = function() {
                return `${this.nombre} cuesta ${this.precio}`;
        };
        console.log(prod1.formatearProducto());
        Cliente.prototype.formatearCliente = function() {
            return `El cliente es${this.nombre} ${this.apellido}`;
        };
        cliente1.formatearCliente();
    }; // prototypes();


// 136. POO - Clases en JaavaaScript
// 137. POO - Herencia
    function clases() {
        // Antes se utilizaba la palabra reservada function para creaar clases
        // A partir de la version de 2015 ya se puede utilizar la palabra reservada class}
        
        // De laa sigieunte forma se declara una clase
        class Producto {
            constructor(nombre, precio) {
                this.nombre = nombre, 
                this.precio = precio
            }
            info() {
                return `${this.nombre} cuesta ${this.precio}`;
            }
        }

        const tablet = new Producto('Tablet', 300);
        console.log(tablet);

        // Recordemos que en versiones anteriores, los constructores de las clases se definian como funciones y la palabra clave this. 
        function Producto_nuevo(nombre, precio) {
            this.nombre = nombre;
            this.precio = precio;
        }
        Producto_nuevo.prototype.formatearProducto = function() {
            return `${this.nombre} cuesta ${this.precio}`;
        }
        const tablet_nueva = new Producto_nuevo;
        console.log(tablet_nueva);

        // Veamos el tipo de dato que son Producto y Producto_nuevo
        console.log(
            typeof Producto,
            typeof Producto_nuevo,
            typeof Aray
        )
        // Como vemos las clases son un tipo de dato function, con lo cual vemos que crear una clase con funciones o con la palabra class resulta en lo mismo. 
        // La palabra reservada class es solamente azúcar sintáctica 


        //== NOTA IMPORTANTE ==//
        // COMPARACION
        // Programacion orientada a objetos
        // VS
        // Prograamacion basada en prototipos:

        //== Objetos de clases ==//
        // Una clase definida por su código fuente es estática.
        // Representa una definición abstracta del objeto.
        // Cada objeto es una instancia de una clase.
        // El legado se encuentra en las clases.

        //== Objetos prototipos==//
        // Un prototipo definido en su código fuente es mutable.
        // Es en sí mismo un objeto, así como otros.
        // Tiene una existencia física en la memoria.
        // Puede ser modificado y llamado.
        // Debe ser nombrado.
        // Un prototipo puede ser visto como un modelo ejemplar de una familia objeto.
        // Un objeto hereda propiedades (valores y métodos) de su prototipo.


        // Herencia 
        // Declaramos un nuevo objeto libro
        class Libro {
            constructor(nombre, precio, isbn) {
                this.nombre = nombre,
                this.precio = precio,
                this.isbn = isbn
            }
        }
        const libro1 = new Libro('JavaScript la Revolución', 120, '12898198171');
        // Como vemos, la clase Libro tiene algunas propiedades que también tiene la clase Producto.
        // Usamos la herenica para ahorrarnos código y no repetir las mismas propiedades.
        class Libreta extends Producto{
            constructor(nombre, precio, codigo) {
                super(nombre, precio);
                this.codigo = codigo
            }
            info() {
                return `${super.info()} y su código es: ${this.codigo}`;
            }
        }
        const libreta1 = new Libreta('Zinc', 200, 12312312);
        console.log(libreta1.info());
    }; // clases();


// 138. ¿Que es try catch?
    function try_catch() {
        const num1 = 20;
        const num3 = 30;

        console.log(num1);
        //console.log(num2); // -> da un error porque num2 no está definido.
        console.log(num3);

        // Este error se soluciona con un tryCatch
        try {
            console.log(num2);
        } catch (err) {
            console.log(err);
        }
        // el código se sigue ejecutando y el código no se detiene.
    }; // try_catch();


// 139. Promises en JavaScrip
    function promesas() {
        const usuarioAutenticado = new Promise( (resolve, reject) => {
            if(true) {
                resolve('Autenticado'); // el promise se cumple
            } else {
                reject('No autenticado'); // el promise no se cumple
            }
        });

        usuarioAutenticado
            .then( res => console.log(res) )
            .catch( err => console.log(err) );

        // En las promesas existen tres valores
        // Pending: No se ha cumplido ni rechazado
        // Fulfilled: Se umple la promesa
        // Rejected: Se ha rechaazado o no se pudo cumplir
    }; // promesas();


// 140. Notification API
    function notificacion() {
        const button = document.querySelector('#button');

        button.addEventListener('click', () => {
            Notification.requestPermission() // es una api
                .then( res => console.log('El resultado es: ', res) )
                .catch( err => console.log(err) );
        });

        if(Notification.permission == 'granted') {
            new Notification('Esto es una notificacion', {
                icon: 'img/noti.avif'
            });
        }
    }; // notificacion();


// 141. Async / Await 
// 142. Cómo trabajar con dos consultas async / await
    function async_await() {
        function descargarClientes() {
            return new Promise( resolve => {
                console.log('Descargando clientes... espere');
    
                setTimeout(() => {
                    resolve('Los Clientes fueron Descargados');
                }, 5000);
            });
        };

        async function app() {
            try {
                const resultado = await descargarClientes();
                console.log('Este código sí se bloquea');
                console.log(resultado);
            } catch(err) {
                console.log(err);
            }
        }
        // app();
        console.log('este código no se bloquea');

        // dos consultas async / await
        function descargarPedidos() {
            return new Promise( (resolve, reject) => {
                console.log('Descargando pedidos... espere');
    
                setTimeout(() => { 
                    resolve('Los pedidos si fueron Descargados');
                }, 5000);
            });
        };

        async function app2() {
           try {
                const resultado = await Promise.all([
                    descargarClientes(),
                    descargarPedidos()
                ]);
                console.log(resultado[0]);
                console.log(resultado[1]);
           } catch (err) {
                console.log(err);
           }
        }; // app2();

        // descargarPedidos()
        //     .then(res => {
        //         console.log(res);
        //     })
        //     .catch(err => {
        //         console.log(err);
        //     })
        // descargarClientes()
        //     .then(res => {
        //         console.log(res);
        //     })
        //     .catch(err => {
        //         console.log(err);
        //     })

        // app();
    }; //async_await();


// 143. Fetch API
    function fetch_API() {
        /*async*/ function obtenerEmpleados() {
            const url = 'empleados.json';
            //== Con promises ==//
            fetch(url)
                .then( res => res.json() )
                .then( data => {
                    console.log(data);
                    const {empleados} = data;
                    console.log(empleados);
                    const filtro = empleados.filter( e => e.nombre == 'Mauricio');
                    const cliente = filtro[0];

                    console.log(cliente);
                });
            //== Con async / await ==//
            // try {
            //     const res = await fetch(url);
            //     const data = await res.json();
            //     console.log(data);
            // } catch (err) {
            //     console.log(err);
            // }
        }; obtenerEmpleados();
    }; // fetch_API();

    //== PRÁCTICA CON FETCH API ==//
    function practicaFetch() {
        const url = 'empleados.json';
        const toAppend = document.querySelector('#resultado');
        function createTextP(text) {
            const  p = document.createElement('P');
            p.textContent = text;
            toAppend.appendChild(p);
        }
        async function getFilter(nombre) {
            document.querySelector('#busquedaStatus').textContent = 'Realizando busqueda...';
            try {
                const response = await fetch(url);
                const data = await response.json();
                document.querySelector('#busquedaStatus').textContent = '';
                const { empleados } = data;
                const result = empleados.filter( e => `${e.nombre}`.includes(nombre) );
                console.log(result);
                const result_format = result.map(e => {
                    return `${e.nombre}  ||  ${e.id}  ||  ${e.puesto}`;
                });

                result_format.forEach( e => {
                    createTextP(e);
                });
            } catch (err) {
                document.querySelector('#busquedaStatus').textContent = 'x error x';
                console.log(err);
            }
        };
        const button = document.querySelector('#buscar');
        button.addEventListener('click', () => {
            const nombre = document.querySelector('#busqueda').value;
            console.log(nombre);
            while (toAppend.hasChildNodes()) {
                toAppend.removeChild(toAppend.firstChild);
            };
            getFilter(nombre);
        })
        
    }; practicaFetch();