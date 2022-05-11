<?php

namespace app\controller;

use \app\page\View;

class Page{

    public static function getHeader(){
        return View::render('template/header');
    }
    
    public static function getFooter(){
        return View::render('template/footer');
    }

    public static function getPage($title,$content){

        echo View::render('template/page',[
            'title' => $title,
            'content' => $content
        ]);
    }


    
}