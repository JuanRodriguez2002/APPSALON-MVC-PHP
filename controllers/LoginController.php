<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    //verificar el usuario
                    if($usuario->comprobarPaswordVerification($auth->password)){
                        //autenticar al usuario

                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionamiento
                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }


                        debuguear($_SESSION);
                    }
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout(Router $router){
        session_start();
        
        $_SESSION = [];

        header('Location: /');
    }
    public static function olvide(Router $router){
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                
                if ($usuario && $usuario -> confirmado === "1") {
                    //generar token de un solo uso

                    $usuario->crearToken();

                    $usuario->guardar();

                    //alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu email');

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                } else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                }
            }

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }
    
    public static function recuperar(Router $router){
        $alertas = [];

        $error = false;
        
        $token = s($_GET['token']);

        $usuario = Usuario::where('token',$token);

        if(empty($usuario)){
            //mostrar mensaje error
            Usuario::setAlerta('error', 'Token No Valido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $password = new Usuario($_POST);

            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashpassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar', [
            'alertas'=> $alertas,
            'error' => $error
            
        ]);
    }
    public static function crear(Router $router){
        $usuario = new Usuario($_POST);

        //alertas vacias
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //revisar que alertas este vacio

            if(empty($alertas)){
                //verificar que el usuario no este registrado

                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = $usuario::getAlertas();
                } else{

                    //hashear el password
                    $usuario->hashpassword();

                    //generar token unico
                    $usuario->crearToken();

                    //enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    

                    $email->enviarConfrimacionEmail();

                    //guardar el usuario en DB
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }

                }

            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario'=> $usuario,
            'alertas'=> $alertas
            
        ]);
    }

    public static function confirmar(Router $router){
        $alertas=[];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token',$token);

        if(empty($usuario)){
            //m,ostrar mensaje error
            Usuario::setAlerta('error', 'Token No Valido');
        }else{

            $usuario->confirmado = "1";
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Token Valido');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmado', [
            'alertas'=>$alertas
        ]);
    }
    public static function mensaje(Router $router){

        $router->render('auth/mensaje', [
        ]);
    }
}