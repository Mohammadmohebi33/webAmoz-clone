
<div class="comments">
    <div class="comment-main">
        <div class="ct-header">
            <h3>نظرات ( {{count($comments)}} )</h3>
            <p>نظر خود را در مورد این مقاله مطرح کنید</p>
        </div>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <input type="hidden" name="course_id" value="{{$course->id}}">
            <div class="ct-row">
                <div class="ct-textarea"><textarea class="txt ct-textarea-field" name="comment"></textarea></div>
            </div>
            <div class="ct-row">
                <div class="send-comment"><button class="btn i-t">ثبت نظر</button></div>
            </div>

        </form>
    </div>

    <div class="comments-list">

        @foreach($comments as $comment)
            <div id="Modal2" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <p>ارسال پاسخ</p>
                        <div class="close">&times;</div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
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
                <li class="is-comment">
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
                @foreach($comment->replies as $comm)
                <li class="is-answer">
                    <div class="comment-header">
                        <div class="comment-header-avatar">
                            @if($comm->user->image != null)
                                <img src="{{asset('images/'.$comm->user->image)}}">
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
                        <p>
                           {{$comm->body}}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>
