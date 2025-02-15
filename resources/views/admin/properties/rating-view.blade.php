<!-- Ratings and Reviews -->
<h4>Ratings and Reviews</h4>
@foreach($property->ratings as $rating)
    <div class="border p-3 mb-2">
        <strong>{{ $rating->user->name }}</strong> rated 
        <span class="text-warning">
            @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star{{ $i <= $rating->rating ? '' : '-o' }}"></i>
            @endfor
        </span>
        <small class="text-muted">{{ $rating->created_at->format('Y-m-d H:i') }}</small> <!-- تاريخ ووقت التقييم -->
        <p>{{ $rating->comment }}</p>
    </div>
    
@endforeach