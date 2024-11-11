


@if(auth()->check())
    <form action="{{ route('properties.rate', $property->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Your Rating (1-5 Stars)</label>
            <select name="rating" id="rating" class="form-select">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Rating</button>
    </form>
@endif
