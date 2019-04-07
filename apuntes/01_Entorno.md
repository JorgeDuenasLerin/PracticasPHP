# Configurando el repositorio git

Pasos a seguir para configurar git

1. Crea el directorio oculto donde guardarás tús credenciales de ssh
> Siempre desde tu __home__
~~~
$ cd
$ mkdir .ssh
~~~
2. Crea tu clave pública(id_rsa.pub) y clave privada(id_rsa). El lugar por defecto no vale
~~~
$ ssh-keygen -t rsa -C "jorge.duenas.lerin.edu@gmail.com"
~~~
3. Sube tu clave a tu cuenta de github.com 
 "Settings" en el menú desplegable de tu perfil > SSH and GPG keys > New SSH key

***

# Servidor de desarrollo para php en terminal
Esto nos permitirá ejecutar nuestro codigo php y ver las paginas en el navegador sin necesidad de tener el apache instalado.
1. Servidor en escucha para peticiones de recursos a traves del puerto que le pongas (requiere tener instalado php7.2-cli)
~~~
$ php -S localhost:8080
~~~
** Ten en cuenta que desde el directorio donde lo ejecutes tendrás que solicitar en el navegador por los recursos desde esa ubicación **
   
