@extends('home.index')
@section('content')
    <main id="index">
        <article class="container article">

            <div class="posts">
                @foreach($courses as $course)
                <div class="col">
                    <a href="{{route('show' , $course->id)}}">
                        <div class="course-status">
                            تکمیل شده
                        </div>
                        <div class="discountBadge">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="card-img"><img src="{{asset('images/'.$course->title.'/'.$course->image[2])}}" alt="reactjs"></div>
                        <div class="card-title"><h2>دوره مقدماتی تا پیشرفته reactJs</h2></div>
                        <div class="card-body">
                            <img src="img/profile.jpg" alt="محمد نیکو">
                            <span>محمد نیکو</span>
                        </div>
                        <div class="card-details">
                            <div class="time">135:40:00</div>
                            <div class="price">
                                <div class="discountPrice">159,000</div>
                                <div class="endPrice">270,000</div>
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
