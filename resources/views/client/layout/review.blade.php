<form>
    @csrf
    <div id="reviews">
        @foreach ($comments as $comment)
            <ul class="reviews">
                <li>
                    <div class="review-heading">
                        <h5 class="name">{{$comment->user->fullname}}</h5>
                        <p class="date">{{$comment->created_at}}</p>
                        <div class="review-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o empty"></i>
                        </div>
                    </div>
                    <div class="review-body">
                        <p>{{$comment->comment}}</p>
                    </div>
                </li>
            
        @endforeach
    </div>
</form>
