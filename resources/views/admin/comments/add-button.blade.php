<!-- تأكد من أن المستخدم مسجل الدخول قبل السماح له بالتعليق -->
@if(Auth::check())
    <button class="btn btn-primary" data-toggle="modal" data-target="#commentModal">add comment </button>
@else
    <p>To add a comment, please<a href="{{ route('login') }}">login</a></p>
@endif




<!-- نافذة منبثقة لإضافة تعليق -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">add comment </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comments.store', $property->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment"></label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your comment here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">send comment </button>
                </form>
            </div>
        </div>
    </div>
</div>
