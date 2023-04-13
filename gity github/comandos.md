<!-- Imgagenes -->
[DVCS]: ./img/DVCS.png "DVCS"
[Estados]: ./img/Estados.png "Estados en git"

# Git y GitHub


## El control de versiones

Git es un sistema de control de versiones distribuido. Un control de versiones es un sistema que registra los cambios realizados en un archivo o conjunto de archivos a lo largo del tiempo, de modo que puedas recuperar versiones específicas más adelante. Los sistemas de Control de Versiones Distribuidos (DVCS por sus siglas en inglés) ofrecen soluciones a algunos problemas. En un DVCS (como Git, Mercurial, Bazaar o Darcs), los clientes no solo descargan la última copia instantánea de los archivos, sino que se replica completamente el repositorio. De esta manera, si un servidor deja de funcionar y estos sistemas estaban colaborando a través de él, cualquiera de los repositorios disponibles en los clientes puede ser copiado al servidor 11 con el fin de restaurarlo. Cada clon es realmente una copia completa de todos los datos.

![DVCS][DVCS]

## Los tres estados en git
Git tiene tres estados en los que se pueden encontrar los archivos:
- Confirmado (Commited) $\rightarrow$ Significa que los datos ya están almacenados de forma segura en tu base de datos local.
- Modificado (Modified) $\rightarrow$ Se ha modificado el archivo pero todavía no se ha confirmado a la base de datos.
- Preparado (Staged) $\rightarrow$ Ya se ha marcado un archivo modificado para que vaya a la próxima confirmación.

Esto lleva a las tres secciones principales de un proyecto en Git:
- El directorio Git (Git directory) $\rightarrow$ donde se almacenan los metadatos y la base de datos de objetos para tu proyecto. Es la parte más importante de Git, y es lo que se copia cuando clonas un repositorio desde otra computadora.
- Directorio de trabajo (Working directory) $\rightarrow$ es una copia de una versión del proyecto. Estos archivos se sacan de la base de datos comprimida en el directorio de Git, y se colocan en disco para que los puedas usar o modificar
- Área de preparación (staging area) $\rightarrow$ es un archivo, generalmente contenido en tu directorio de Git, que almacena información acerca de lo que va a ir en tu próxima confirmación. A veces se le denomina índice (“index”), pero se está convirtiendo en estándar el referirse a ella como el área de preparación.

El flujo de trabajo básico en Git es algo así:
1. Modificas una serie de archivos en tu directorio de trabajo.
2. Preparas los archivos, añadiéndolos a tu área de preparación.
3. Confirmas los cambios, lo que toma los archivos tal y como están en el área de
preparación y almacena esa copia instantánea de manera permanente en tu directorio de Git.

![Estados][Estados]

## __! Importante__ 

Para ver ejercicios y prácticas con git que he realizado revisa el siguiente [repositorio](https://github.com/Mauriciocr207/Curso-Git-y-GitHub.git)