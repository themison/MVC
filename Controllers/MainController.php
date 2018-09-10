<?php

namespace Controllers;

use Views\View;
use Models\Article;

class MainController
{
    private $view;

    public function __construct() 
    {   
        $this->view = new View();
    } 
    
    // If page empty
    public function emptyPage()
    {   
        return $this->view->renderHtml('/messages/message.php', ['message'=>'Page does not found'], 404);
    }

    public function index()
    {   
        $wtf = Article::findAll();
        return $this->view->renderHtml('/pages/main.php',['wtf'=>$wtf],200);
    }

}
