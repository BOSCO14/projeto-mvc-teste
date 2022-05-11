<?php

namespace app\model;

use app\controller\Login;
use \app\lib\database\Connection;

class Usuario{

    public static function validate(){

        //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        //$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $con = Connection::getConn();

        $sql = "SELECT * FROM usuario WHERE email = :email";

        $login = $con->prepare($sql);
        $login->bindValue(':email', $email);
        $login->execute();

        $count = $login->rowCount();

        if($count == 1){
            $result = $login->fetch();
            //foreach ($result as $row) {
              $user_pass = $result['senha'];
              $user_id = $result['id'];
              $user_name = $result['nome'];
              $user_email = $result['email'];
            //}
            if(password_verify($senha, $user_pass)){
                //session_start();
                //$_SESSION['id_usuario'] = $user_id;
                //$_SESSION['nome_usuario'] = $user_name;
                Login::login($user_id, $user_name, $user_email);
                return true;
            } else {
                throw new \Exception("Senha Inválida");
                return false;
            }
        }else{
            throw new \Exception("E-mail Inválido");
            return false;
        }
    }

}
