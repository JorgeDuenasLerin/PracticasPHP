# Configurando el repositorio git

Pasos a seguir para configurar git

1. Crea el directorio de credenciales ssh
> Siempre desde tu __home__
~~~
$ cd
$ mkdir .ssh
~~~
2. Crea tu clave pública y clave privada. El lugar por defecto no vale
~~~
$ ssh-keygen -t rsa -C "jorge.duenas.lerin.edu@gmail.com"
~~~
3. Sube tu clave a tu cuenta de github.com
