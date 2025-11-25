@extends('layout')

@section('content')
<ul class="list-group mb-3">
  @foreach($errors->all() as $error)
  <li class="list-group-item list-group-item-danger">{{$error}}</li>
  @endforeach
</ul>
<form action="{{route('comment.update', ['article' => $article -> id, 'comment' => $comment -> id])}}" method="POST">
  @CSRF
  @METHOD('PUT')
  <div class="mb-3">
    <label for="text" class="form-label">Commentary</label>
    <input type="text" class="form-control" id="text" name="text" value="{{$comment -> text}}">
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection