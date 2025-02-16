<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Clients Say!</h1>
            <p></p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">

            @foreach ($comments as $comment)
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>{{ $comment->content }}</p>
                        <div class="d-flex align-items-center">

                             <img class="img-fluid flex-shrink-0 rounded" src="{{asset('website/img/testimonial-1.jpg')}}" style="width: 45px; height: 45px;">

                          
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">{{ $comment->user->name }}</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
       
        </div>
    </div>
</div>