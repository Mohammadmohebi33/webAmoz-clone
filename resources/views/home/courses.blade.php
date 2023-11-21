@extends('home.index')
@section('content')

    <article class="container article">
        <div class="ads">
            <a href="" rel="nofollow noopener"><img src="home/img/ads/1440px/test.jpg" alt=""></a>
        </div>
        <div class="posts">
            @if(count($courses) == 0)
                    <div class="text-center">
                        <h1 style="text-align: center">هیچ دوره ای وجود ندارد</h1>
                    </div>
            @else
            @foreach($courses as $course)
                <div class="col">
                    <a href="{{route('show' , $course->id)}}">
{{--                                                <div class="discountBadge">--}}
{{--                                                    <p>45%</p>--}}
{{--                                                    تخفیف--}}
{{--                                                </div>--}}
                        <div class="card-img">
                            @if($course->image == null)
                                <img src="{{asset('/home/img/banner/lara.png')}}" alt="php">
                            @else
                                <img src="/images/{{$course->image}}">
                            @endif
                        </div>
                        <div class="card-title"><h2>{{$course->title}}</h2></div>
                        <div class="card-body">

                            <span>{{$course->user->name}}</span>
                        </div>
                        <div class="card-details">
                            <div class="time">{{gmdate("H:i:s", $course->time)}}</div>
                            <div class="price">
{{--                                                                <div class="discountPrice">159,000</div>--}}
                                <div class="endPrice">تومان{{$course->price}}</div>
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
    @endif
@endsection
