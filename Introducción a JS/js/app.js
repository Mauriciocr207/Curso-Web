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
            {nombre: 'Laptop', precio: 800}
        ]

        // forEach
        meses.forEach( e => {
            if(e == 'Marzo' ) console.log('Marzo si existe');
        });

        // Este código es equivalente al anterior con forEach
        meses.includes('Marzo') ? console.log('Marzo si existe'): console.log('Marzo no existe');

        // Cuando tienes un arreglo de objetos, no se puede usar includes, es mejor usar some
        carrito.some( e => e.nombre == 'Laptop' ) ? console.log('si existe') : console.log('no existe');



    }; arrays();