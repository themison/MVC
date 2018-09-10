<?php

namespace Controllers;

use Views\View;
use Models\Article;
use Models\User;

class ArticlesController
{
    private $view;

    public function __construct() 
    {   
        $this->view = new View();
    } 

    public function article($id)
    {   
        $article = Article::find($id);
        if ($article === null) {
            return $this->view->renderHtml('/messages/message.php', ['message'=>'Page does not found'], 404);
        }
        
        return $this->view->renderHtml('/pages/article.php',['article'=>$article], 200);
    }

    public function edit($id) 
    {
        $article = Article::find($id);
        if ($article === null) {
            return $this->view->renderHtml('/messages/message.php', ['message'=>'Page does not found'], 404);
        } 

        $article->setTitle('Heeeeey brother tell me now');
        $article->setBody('Tell me tell me tell me yooooo just tell me tell me tell me yoooo');

        $article->save($id);
        var_dump($article);
    }

    public function add() 
    {
        $article = new Article;

        $article->setTitle('How are u bro?');
        $article->setBody('Tell me your story maaan');
        $article->setUser(User::find(1));

        $article->save();
        var_dump($article);
    }

    public function delete($id) 
    {
        $article = Article::find($id);
        if ($article === null) {
            return $this->view->renderHtml('/messages/message.php', ['message'=>'Page does not found'], 404);
        } 

        $article->delete($id);
    }

}

    