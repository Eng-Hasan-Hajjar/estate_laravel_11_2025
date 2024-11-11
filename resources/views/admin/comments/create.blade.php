<form action="{{ route('comments.store', $property->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea name="comment" class="form-control" rows="4" placeholder=" add comment"></textarea>
    </div>
    <input type="hidden" name="parent_comment_id" value="{{ $parentCommentId ?? null }}">
    <button type="submit" class="btn btn-primary">إرسال</button>
</form>
