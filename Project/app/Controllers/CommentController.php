<?php

namespace app\Controllers;

use app\Models\Comments\Comment;
use app\View\View;

class CommentController{
    private $view;

    public function __construct(){
        $this->view = new View();
    }

    public function store()
    {
        $comment = new Comment();
        $comment->setText($_POST['text']);
        $comment->setArticleId($_POST['article_id']);
        $comment->setAuthorId(1);
        $comment->save();
        return header('Location: /Project/www/article/' . $_POST['article_id']);
    }

    public function edit($id){
        $comment = Comment::getById($id);
        return $this->view->renderHtml('comment/edit', ['comment'=>$comment]);
    }

    public function update($id)
    {
        $comment = Comment::getById($id);
        $comment->setText($_POST['text']);
        $comment->save();
        return header('Location: /Project/www/article/' . $comment->getArticleId());
    }

    public function delete($id)
    {
        $comment = Comment::getById($id);
        $articleId = $comment->getArticleId();
        $comment->delete($id, 'comments');
        return header('Location: /Project/www/article/' . $articleId);
    }
}