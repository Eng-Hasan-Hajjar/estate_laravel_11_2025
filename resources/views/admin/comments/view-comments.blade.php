<h3>All comments for this property:</h3>

@foreach($comments as $comment)
    <div class="card card-widget mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ $comment->user->name }}</h5>
                <span class="text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i') }}</span>
            </div>
        </div>
        <div class="card-body">
            <p>{{ $comment->comment }}</p>

            <!-- عرض أزرار التعديل والحذف فقط إذا كان المستخدم هو صاحب التعليق -->
            @if(Auth::check() && Auth::user()->id == $comment->user_id)
                <div class="d-flex justify-content-start gap-2">
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            @endif

            <!-- زر الرد على التعليق -->
            @if(Auth::check())
               @include('admin.comments.add-reply')
                <div class="mt-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $comment->id }}" aria-expanded="false" aria-controls="reply-form-{{ $comment->id }}">
                        <i class="fas fa-reply"></i> Reply
                    </button>
                </div>

                <!-- نموذج الرد على التعليق -->
                <div class="collapse mt-2" id="reply-form-{{ $comment->id }}">
                    <form action="{{ route('comments.store', $comment->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="comment" placeholder="Type your reply here" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm mt-2">Submit Reply</button>
                    </form>
                </div>
            @endif

            <!-- عرض الردود على التعليق -->
            @foreach($comment->replies as $reply)





                <div class="card card-widget mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $reply->user->name }}</h5>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($reply->created_at)->format('d-m-Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $reply->comment }}</p>

                        <!-- عرض أزرار التعديل والحذف فقط إذا كان المستخدم هو صاحب الرد -->
                        @if(Auth::check() && Auth::user()->id == $reply->user_id)
                            <div class="d-flex justify-content-start gap-2">
                                <a href="{{ route('comments.edit', $reply->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('comments.destroy', $reply->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reply?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach



        </div>
    </div>
@endforeach
