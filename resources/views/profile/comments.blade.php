@extends('profile.index')


@section('content')
    <div class="profile-card"><!-- start comment list -->
        <p class="font-13">نظرات من</p>

        <div class="row">

            @foreach($comments as $comment)
            <div class="col-12 profile-comment">
                <!-- start comment box -->
                <div class="card d-flex flex-row mb-3 pe-1">
                    <a href="product.html"><img src="{{'http://localhost:8000/storage/images/'.$comment->course->title.'/'. $comment->course->image[0]}}" class="fav-list-pic"></a>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="product.html" class="fav-list-title">{{$comment->course->title}}</a>
                            @if($comment->status  == 'active')
                            <p class="badge bg-success m-2 text-white p-1 px-2 me-4">تایید شده</p>
                            @elseif($comment->status  == 'pending')
                                <p class="badge bg-warning m-2 text-white p-1 px-2 me-4">در انتظار تایید</p>
                            @else
                                <p class="badge bg-danger m-2 text-white p-1 px-2 me-4">رد شده</p>
                            @endif

                        </div>
                        <p>
                            <span> پیام شما : </span>{{$comment->body}}
                        </p>
                        <i class="fa fa-trash me-4"></i>
                    </div>
                </div>
            </div>
        @endforeach
            <!-- end comment box -->

        </div>
    </div>
@endsection
