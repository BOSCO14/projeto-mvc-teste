<?php

namespace app\model;

use \app\lib\database\Connection;

class Crud{

    public static function create(){

        if(isset($_POST['enviar'])){
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_ADD_SLASHES);
            $password = password_hash($senha, PASSWORD_DEFAULT);
                              
            $con = Connection::getConn();
            $sql = "INSERT INTO usuario (nome,email,senha) VALUES (:nome, :email, :senha)";
            $enviar = $con->prepare($sql);
            $enviar->bindValue(':nome', $nome);
            $enviar->bindValue(':email', $email);
            $enviar->bindValue(':senha', $password);
            $result = $enviar->execute();

            if($result == 0){
                throw new \Exception("Falha na gravação do registro!");
                return false;
            }else{
            return true;
            }
            }
    
    }

    public static function read(){

        $con = Connection::getConn();
        $sql = "SELECT * FROM usuario";
        $enviar = $con->prepare($sql);
        $enviar->execute();

        $count = $enviar->rowCount();
        if($count > 0){
            $result = $enviar->fetchAll();
            return $result;   
        }else{
            throw new \Exception("Não forma encontrados registros!");
            return false;
        }
    }

    public static function getRegistro($id){

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

        $con = Connection::getConn();
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $enviar = $con->prepare($sql);
        $enviar->bindValue(':id', $id);
        $enviar->execute();
        $result = $enviar->fetchAll();

        return $result;     

    }

    public static function update(){

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($senha, PASSWORD_DEFAULT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

        $con = Connection::getConn();
        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $enviar = $con->prepare($sql);
        $enviar->bindValue(':nome', $nome);
        $enviar->bindValue(':email', $email);
        $enviar->bindValue(':senha', $password);
        $enviar->bindValue(':id', $id);
        $result = $enviar->execute();

        if($result == 0){
            throw new \Exception("Falha na gravação do registro!");
            return false;
        }else{
        return true;
        } 

    }

    public static function delete(){

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

        $con = Connection::getConn();
        $sql = "DELETE FROM usuario WHERE id = :id";
        $enviar = $con->prepare($sql);
        $enviar->bindValue(':id', $id);
        $enviar->execute();
        $result = $enviar->fetchAll();

        if($result == 0){
            throw new \Exception("Falha na deleção!");
            return false;
        }
        return true;  

    }

    public static function getEmail(){

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $con = Connection::getConn();

        $sql = "SELECT * FROM usuario WHERE email = :email";
        $enviar = $con->prepare($sql);
        $enviar->bindValue(':email', $email);
        $enviar->execute();
        $result = $enviar->fetch();

        return $result; 
    }
          
    
}