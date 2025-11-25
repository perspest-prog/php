<br> <hr> <br>
<form action="{{ route('save_comment', $article->id) }}" method="POST">
  @CSRF
  <label for="text" class="form-label">Leave a comment:</label>
  <div style="margin: 10px 0; display: flex; flex-direction: row; gap: 10px">
    <input type="text" class="form-control" id="text" name="text">
    <button type="submit" class="btn btn-outline-primary me-3">Save</button>
  </div>
</form>

@if($comments -> isEmpty())
    <p>It's so lonely here...</p>
@else
    <ul>
        @foreach($comments as $comment)
          <div class="card mb-3">
            <div class="card-body">
              <li class="card-text">{{$comment -> text}}</li>
              <br>
              @can('comment', $comment)
              <a href="{{route('comment.edit', ['article' => $article -> id, 'comment' => $comment -> id])}}" class="btn btn-primary me-3">Edit comment</a>
              <form action="{{route('comment.destroy', ['article' => $article -> id, 'comment' => $comment -> id])}}" method="post">
                @METHOD("DELETE")
                @CSRF
                <button type="submit" class="btn btn-warning me-3">Delete comment</button>
              </form>
              @endcan
            </div>
          </div>
        @endforeach
    </ul>
@endif