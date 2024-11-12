@foreach($comments as $comment)
    <div class="comment">
        <p><strong>{{ $comment->user->name }}</strong>:</p>
        <p>{{ $comment->comment }}</p>
        
        <!-- تحقق من تسجيل الدخول لتمكين الرد -->
        @if(Auth::check())
            <!-- زر الرد مع نافذة منبثقة -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#replyModal-{{ $comment->id }}">Reply</button>
        @else
            <p>To reply, please <a href="{{ route('login') }}">login</a></p>
        @endif
    </div>
    
    <!-- نافذة منبثقة للرد -->
    <div class="modal fade" id="replyModal-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel-{{ $comment->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel-{{ $comment->id }}">Reply to comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comments.store', $property->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                        <div class="form-group">
                            <label for="comment"></label>
                            <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your reply here"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
