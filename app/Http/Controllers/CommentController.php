<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Jobs\VeryLongJob;
use App\Notifications\NewCommentNotify;

class CommentController extends Controller
{
    public function index()
    {
        $page = (isset($_GET['page'])) ? $_GET["page"] : 0;
        $comments = Cache::rememberForever('comments_' . $page, function () {
            return Comment::latest()->paginate(10);
        });
        return view('comment.index', ['comments' => $comments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'min:10|required',
        ]);
        $article = Article::findOrFail($request->article_id);
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->id();
        if ($comment->save()) {
            VeryLongJob::dispatch($article, $comment, auth()->user()->name);
            // Очищаем весь кэш после успешного сохранения (для file-драйвера альтернативы нет)
            Cache::flush();
        }
        return redirect()->route('article.show', $request->article_id)->with('message', "Comment add successful and enter for moderation");
    }

    public function edit(Comment $comment)
    {
        $article = Article::findOrFail($comment->article_id);
        Gate::authorize('comment', $comment);
        return view('comment.edit', ['comment' => $comment, 'article' => $article]);
    }

    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('comment', $comment);
        $request->validate([
            'text' => 'required|string|max:100',
        ]);
        $comment->text = $request->text;
        if ($comment->save()) {
            // Очищаем весь кэш после успешного обновления
            Cache::flush();
        }
        return redirect()->route('article.show', ['article' => $comment->article_id])->with('message', 'Update successful');
    }

    public function delete(Comment $comment)
    {
        Gate::authorize('comment', $comment);
        if ($comment->delete()) {
            // Очищаем весь кэш после успешного удаления
            Cache::flush();
        }
        return redirect()->route('article.show', ['article' => $comment->article_id])->with('message', 'Delete successful');
    }

    public function accept(Comment $comment)
    {
        $comment->accept = true;
        $article = Article::findOrFail($comment->article_id);
        $users = User::where('id', '!=', $comment->user_id)->get();
        if ($comment->save()) {
            // Notification::send($users, new NewCommentNotify($article->title, $article->id));
            // Очищаем весь кэш после успешного принятия
            Cache::flush();
        }
        return redirect()->route('comment.index');
    }

    public function reject(Comment $comment)
    {
        $comment->accept = false;
        if ($comment->save()) {
            // Очищаем весь кэш после успешного отклонения
            Cache::flush();
        }
        return redirect()->route('comment.index');
    }
}
