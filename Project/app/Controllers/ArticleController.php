<?php

namespace app\Controllers;
use app\View\View;
use app\Models\Articles\Article;
use app\Models\Comments\Comment;
use app\config\Db;

class ArticleController extends Article
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;
        $this->id = 1;//int
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
        $comment = Comment::getByFildName('article_id', $article->getId());

        if ($article == []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }

        $this->view->renderHtml('article/show', ['article'=>$article, 'comments'=>$comment]);
    }

    public function edit($id){
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }


    public function update($id){
        $article = Article::getById($id);
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->save();
        return header('Location: /Project/www/article/' . $article->getId());
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }

    public function store(){
        $article = new Article;
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        return header('Location:http://localhost/Project/www/index.php');
    }

    public function delete(int $id, $tablename = 'articles'){
        $article = Article::getById($id);
        $comments = Comment::getByFildName('article_id', $id);
        foreach ($comments as $comment) {
            $comment->delete($comment->getId(), 'comments');
        }
        $article->delete($id, $tablename);
        return header('Location:http://localhost/Project/www/index.php');
    }


    public function setAuthorId(string $authorId) {
        $this->authorId = $authorId;
    }

    public function setArticleId(string $articleId) {
        $this->articleId = $articleId;
    }

}