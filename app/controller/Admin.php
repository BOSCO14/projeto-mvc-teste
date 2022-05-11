<?php

namespace app\controller;

use \app\model\Crud;

class Admin{

    public static function insert(){

        try {
            Crud::create($_POST);
            echo '<script>alert("Registro gravado com sucesso!");</script>';
            echo '<script>location.href="?url=home/cadastrar/"</script>';
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/cadastrar/"</script>';
        }    
    }

    public static function showList(){

        try {
            $dados = Crud::read();
            return $dados;
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/home/"</script>';
        }    
    }

    public static function showEdit($id){

        try {
            $dados = Crud::getRegistro($id);
            return $dados;
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/home/"</script>';
        }    
    }

    public static function saveEdit(){

        try {
            Crud::update($_POST);
            echo '<script>alert("Registro alterado com sucesso!");</script>';
            echo '<script>location.href="?url=home/consultar/"</script>';
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/editar/"</script>';
        }    

    }

    public static function confirmaDelete(){

        try {
            Crud::delete($_POST);
            echo '<script>alert("Registro deletado com sucesso!");</script>';
            echo '<script>location.href="?url=home/consultar/"</script>';
        } catch (\Exception $e) {
            echo '<script>alert(" '.$e->getMessage().' ");</script>';
            echo '<script>location.href="?url=home/deletar/"</script>';
        }    

    }
    
}