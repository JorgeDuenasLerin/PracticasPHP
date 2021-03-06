# GITHUB COMANDOS EN TERMINAL (clonar, configurar credenciales, status, add, pull, commit, push...)
***
** (requiere tener instalado git) **
### Clonar
1. Copia el enlace del repositorio que quieres trabajar en "Clone or download"
+ SSH (la que usamos en nuestro caso):
  - git@github.com:JorgeDuenasLerin/PracticasPHP.git
+ HTTPS:
  - https://github.com/JorgeDuenasLerin/PracticasPHP.git

***
### Configurar credenciales (usuario y correo)
Lo primero que deberías hacer cuando instalas Git es establecer tu nombre de usuario y dirección de correo electrónico. Esto es importante porque las confirmaciones de cambios (commits) en Git usan esta información, y es introducida de manera inmutable en los commits que envías:
~~~
$ git config --global user.name "Roger Federer"
$ git config --global user.email rogerfederer@example.com
~~~

***
### status (ver el estado en el que estan los archivos en local vs master)
~~~
$ git stattus
~~~

***
### Hacer pull (actualizar en local los archivos al último commit del proyecto)
~~~
$ git config --global user.name "Roger Federer"
~~~

***
## add (agregar los archivos cambios que quieras para el commit)
1. Agregar todos los cambios realizados (no se debería de usar)
~~~
$ git add . 
~~~

***
### Commit (titulo de los cambios que has hechos)
~~~
$ git commit -m 'Titulo del commit'
~~~

***
### Push (subir los cambios al respositorio master del proyecto)
~~~
$ git push
~~~

***
### Blame (Muestra qué revisión y autor modificaron por última vez cada línea de un archivo.)
~~~
$ git blame 'NombreArchivo'
~~~

***
### Stash (Congela el estado en el que se encuentra el proyecto en un momento determinado, con todos los cambios que tenemos sin "commit", y lo guarda en una pila provisional brindando la posibilidad de poder recuperarlo más adelante.)
~~~
$ git stash 
~~~

***
### Stash apply(Recupera los cambios almacenados en la pila provisional.)
~~~
$ git stash apply
~~~

***
### Checkout(Cambia ramas o restaura archivos de árbol de trabajo.)
~~~
$ git checkout
~~~

***
### Checkout master(Vuelve a la rama principal
.)
~~~
$ git checkout master
~~~



