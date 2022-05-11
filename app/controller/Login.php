<?php

namespace app\controller;

use \app\model\Usuario;

class Login{

    //método responsável por iniciar a sessão.
	private static function init(){
		//verifica o status da sessão.
		if(session_status() !== PHP_SESSION_ACTIVE){
			//inicia a sessão.
			session_start();
		}
	}

	public static function getUsuarioLogado(){

		self::init();

		return self::isLogged() ?  $_SESSION['usuario'] : null;

	}

	public static function login($id,$nome,$email){
		//inicia a sessão.
		self::init();

		$_SESSION['usuario'] = [
			'id' => $id,
			'nome' => $nome,
			'email' => $email
		];

		header('Location: ?url=home/home/');
		exit;

	}

	public static function logout(){

		self::init();

		unset($_SESSION['usuario']);

		header('Location: ?url=home/login/');
		exit;

	}


	//método responsável por verificar se o usuário está logado.
	public static function isLogged(){

		self::init();

		return isset($_SESSION['usuario']['id']);

	}

	//método responsável por obrigar o usuário a estar logado para acessar.
	public static function requireLogin(){

		if(!self::isLogged()){
			header('Location: ?url=home/login/');
			exit;
		}

	}


	public static function requireLogout(){

		if(self::isLogged()){
			header('Location: ?url=home/home/');
			exit;
		}

	}

	public static function startSession($user){

			self::init();

			$_SESSION['id'] = $user->id;
			$_SESSION['nome'] = $user->nome;
			$_SESSION['email'] = $user->email;

			header('Location: index.php');
			exit;

	}

    public function check(){
        try {
            Usuario::validate($_POST);
            header('Location: ?url=home/home/');
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/login/"</script>';
        }    
    }

	   
}