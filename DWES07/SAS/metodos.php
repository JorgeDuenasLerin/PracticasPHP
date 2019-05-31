<?php 
class metodos {
    public function cleanInput(string $dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    
    }//cleanInput()

    public function gestionarDatos(string $usuario, string $password){
        
    }

    public function consultaUsuario(string $usuario, string $password){

    }

    public function consultaCorreo(string $email, string $password){
        
    }
}
?>