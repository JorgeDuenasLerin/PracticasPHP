<?php 
class metodos {
    public function cleanInput(string $dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    
    }//cleanInput()

    public function gestionarDatos(string $usuario, string $password){
        $usuario = clearInput($usuario);
        $password = clearInput($password);

        if(strpos("@", $usuario)){
            gestionarCorreo($usuario, $password);
        } else {
            gestionarUsuario($usuario, $password);
        }
    }

    public function gestionarUsuario(string $usuario, string $password){
        
    }

    public function gestionarCorreo(string $email, string $password){
        
    }
}
?>