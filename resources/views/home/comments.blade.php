 <div class="comments-list">
        @foreach($comments as $comment)
            <div id="Modal2" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <p>ارسال پاسخ</p>
                        <div class="close">&times;</div>
                    </div>

                    {{--TODO : parent_id is wrong--}}
                    <div class="modal-body">
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="parent_id" value="{{ $comment->replies->last() ? $comment->replies->last()->id : $comment->id }}">
                            <textarea name="comment" class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                            <button class="btn i-t">ثبت پاسخ</button>
                        </form>
                    </div>
                </div>
            </div>
            <ul class="comment-list-ul">
                <div class="div-btn-answer">
                    <button class="btn-answer">پاسخ به دیدگاه</button>
                </div>
                <li class="{{$comment->parent_id == null ? 'is-comment' : 'is-answer'}}">
                    <div class="comment-header">
                        <div class="comment-header-avatar">
                            @if($comment->user->image != null)
                                <img src="{{asset('images/'.$comment->user->image)}}">
                            @else
                                <img src="img/profile.jpg">
                            @endif
                        </div>
                        <div class="comment-header-detail">
                            <div class="comment-header-name">کاربر : {{$comment->user->name}}</div>
                            <div class="comment-header-date">تاریخ : {{\Morilog\Jalali\Jalalian::fromDateTime($comment->created_at)->ago()}}</div>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>{{$comment->body}}</p>
                    </div>
                </li>
                @include('home.comments' , ['comments' => $comment->replies])
            </ul>
        @endforeach
    </div>
