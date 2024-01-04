@extends('home.index')
@section('content')
    <main id="index">
        <article class="container article">

            <div class="posts">
                @foreach($courses as $course)
                <div class="col">
                    <a href="{{route('show' , $course->id)}}">
                        <div class="course-status">
                            {{$course->isCompleted}}
                        </div>
                        <div class="discountBadge">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="card-img"><img src="{{'http://localhost:8000/storage/images/'.$course->title.'/'. $course->image[3]}}" alt="reactjs"></div>
                        <div class="card-title"><h2>{{$course->title}}</h2></div>
                        <div class="card-body">
                            <img src="{{'http://localhost:8000/storage/user/'.$course->user->image}}" alt="محمد نیکو">
                            <span>{{$course->user->name}}</span>
                        </div>
                        <div class="card-details">
                            <div class="time">{{ gmdate("H:i:s", $course->time) }}</div>
                            <div class="price">
{{--                                <div class="discountPrice">159,000</div>--}}
                                <div class="endPrice">{{$course->price}}  تومان </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="pagination">
                <div class="pagination">
                    @if ($courses->currentPage() > 1)
                        <a href="{{ $courses->previousPageUrl() }}">قبلی</a>
                    @endif

                    @for ($i = 1; $i <= $courses->lastPage(); $i++)
                        @if ($courses->currentPage() === $i)
                            <a href="{{ $courses->url($i) }}" class="page current">{{ $i }}</a>
                        @else
                            <a href="{{ $courses->url($i) }}" class="page">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($courses->hasMorePages())
                        <a href="{{ $courses->nextPageUrl() }}">بعدی</a>
                    @endif
                </div>
            </div>
        </article>
    </main>
@endsection
