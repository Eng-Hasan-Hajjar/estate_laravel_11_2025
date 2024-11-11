@extends('admin.layouts.app')

@section('content')
    <h1>edit the comment </h1>
    <form action="{{ route('comments.update.put', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="comment">your comment: </label>
            <textarea name="comment" id="comment" class="form-control" rows="4">{{ $comment->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">update comment </button>
    </form>
    
@endsection
