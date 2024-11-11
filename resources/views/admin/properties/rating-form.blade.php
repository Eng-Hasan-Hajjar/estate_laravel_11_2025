<!-- Rating Form -->
@if(auth()->check())
    <form action="{{ route('properties.rate', $property->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Your Rating (1-5 Stars)</label>
            <div id="star-rating" class="d-flex align-items-center">
                @for($i = 1; $i <= 5; $i++)
                    <label for="star-{{ $i }}" class="star-label">
                        <input type="radio" name="rating" id="star-{{ $i }}" value="{{ $i }}" style="display: none;">
                        <i class="fas fa-star star-icon" data-value="{{ $i }}"></i>
                    </label>
                @endfor
            </div>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Rating</button>
    </form>
@endif






<script>
    document.addEventListener('DOMContentLoaded', function () {
        const starIcons = document.querySelectorAll('.star-icon');

        starIcons.forEach(star => {
            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('data-value');
                highlightStars(value);
            });

            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.querySelector(`#star-${value}`).checked = true;
                highlightStars(value);
            });

            star.addEventListener('mouseout', function() {
                const checkedStar = document.querySelector('input[name="rating"]:checked');
                if (checkedStar) {
                    highlightStars(checkedStar.value);
                } else {
                    highlightStars(0);
                }
            });
        });

        function highlightStars(value) {
            starIcons.forEach(star => {
                star.classList.remove('text-warning');
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('text-warning');
                }
            });
        }
    });
</script>
