<?php

namespace app\page;

class View{

    public static function render($view, $vars=array()){

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load($view.'.html');

        $dados = array();
        $dados = $vars;
        if(!isset($dados)){
            $dados = '';
        }else{
            $dados = $vars;
        }
        echo $template->render($dados);
    }
    
}