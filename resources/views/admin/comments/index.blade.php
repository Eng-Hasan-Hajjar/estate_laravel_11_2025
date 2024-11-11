@extends('admin.layouts.app')

@section('content')
    <h1>التعليقات</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>comment</th>
                <th>date & time </th>
                <th>procedures</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->comment }}</td>
                <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i') }}</td>
                <td>
                    @if($comment->parent_comment_id)
                        <span class="text-muted">reply to comment : {{ $comment->parent->user->name }}</span>
                    @endif
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">edit</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"onclick="return confirm('Are you sure?')">delete</button>
                    </form>
                </td>
            </tr>
        
            @foreach($comment->replies as $reply)
                <tr>
                    <td>{{ $reply->user->name }}</td>
                    <td>{{ $reply->comment }}</td>
                    <td>{{ \Carbon\Carbon::parse($reply->created_at)->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('comments.edit', $reply->id) }}" class="btn btn-warning">edit</a>
                        <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"onclick="return confirm('Are you sure?')">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
@endsection
