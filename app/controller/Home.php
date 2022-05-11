<?php

namespace app\controller;

use \app\controller\Login;
use \app\page\View;
use \app\controller\Admin;

class Home extends Page{

    public function home(){
        Login::requireLogin();
        parent::getHeader();
        $content = View::render('home',[]);
        parent::getFooter();
        return parent::getPage('Home',$content);
    }

    public function consultar(){
        Login::requireLogin();
        parent::getHeader();
        $conteudo = array();
        $conteudo['registros'] = Admin::showList();
        //echo "<br>"; print_r($conteudo); echo "</br>"; exit;
        $content = View::render('consulta', $conteudo);
        parent::getFooter();
        return parent::getPage('Consulta',$content);
    }

    public function cadastrar(){
        Login::requireLogin();
        parent::getHeader();
        $content = View::render('cadastro', []);
        parent::getFooter();
        return parent::getPage('Cadastro',$content);
    }
    
    public function editar($id){
        Login::requireLogin();
        parent::getHeader();
        $conteudo = array();
        $conteudo['registros'] = Admin::showEdit($id);
        //echo "<br>"; print_r($conteudo); echo "</br>"; exit;
        $content = View::render('alterar', $conteudo);
        parent::getFooter();
        return parent::getPage('Alterar',$content);
    }

    public function deletar($id){
        Login::requireLogin();
        parent::getHeader();
        $conteudo = array();
        $conteudo['registros'] = Admin::showEdit($id);
        //echo "<br>"; print_r($conteudo); echo "</br>"; exit;
        $content = View::render('excluir', $conteudo);
        parent::getFooter();
        return parent::getPage('Excluir',$content);
    }

    public function login(){
        parent::getHeaderLogin();
        $content = View::render('login',[]);
        parent::getFooter();
        return parent::getPageLogin('Login',$content);
    }
    
    
}