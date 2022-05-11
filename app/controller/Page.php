<?php

namespace app\controller;

use \app\page\View;

class Page{

    public static function getHeader(){
        return View::render('template/home/header');
    }
    
    public static function getFooter(){
        return View::render('template/home/footer');
    }

    public static function getPage($title,$content){

        echo View::render('template/home/page',[
            'title' => $title,
            'content' => $content
        ]);
    }

    public static function getHeaderLogin(){
        return View::render('template/login/header');
    }
    
    public static function getFooterLogin(){
        return View::render('template/login/footer');
    }

    public static function getPageLogin($title,$content){

        echo View::render('template/login/page',[
            'title' => $title,
            'content' => $content
        ]);
    }



    
}