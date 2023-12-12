@extends('home.index')
@section('content')
<main id="index">
    <article class="container article">
        <div class="ads d-none">
            <a href="" rel="nofollow noopener"><img src="img/ads/1440px/test.jpg" alt=""></a>
        </div>
        <div class="top-info">
            <div class="slideshow">
                <div class="slide"><img src="{{asset('home-file/img/slideshow/p-1.jpg')}}" alt=""></div>
                <div class="slide"><img src="{{asset('home-file/img/slideshow/p-2.jpg')}}" alt=""></div>
                <div class="slide"><img src="{{asset('home-file/img/slideshow/p-3.jpg')}}" alt=""></div>
                <div class="slide"><img src="{{asset('home-file/img/slideshow/p-4.jpg')}}" alt=""></div>
                <div class="slide"><img src="{{asset('home-file/img/slideshow/p-5.jpg')}}" alt=""></div>

                <a class="prev" onclick="move(-1)"><span>&#10095</span></a>
                <a class="next" onclick="move(1)"><span>&#10094</span></a>

                <div class="items">
                    <div class="item">
                        <div class="item-inner"></div>
                    </div>
                    <div class="item">
                        <div class="item-inner"></div>
                    </div>
                    <div class="item">
                        <div class="item-inner"></div>
                    </div>
                    <div class="item">
                        <div class="item-inner"></div>
                    </div>
                    <div class="item">
                        <div class="item-inner"></div>
                    </div>
                </div>
            </div>
            <div class="optionals">
                <div><img src="{{asset('home-file/img/banner/laravel-payment-processing.jpg')}}" alt=""></div>
                <div><img src="{{asset('home-file/img/banner/laravel-payment-processing.jpg')}}" alt=""></div>
            </div>
        </div>
        <div class="box-filter">
            <div class="b-head">
                <h2>جدید ترین دوره ها</h2>
                <a href="{{route('all' , ['course_parameter'=>'created_at'])}}">مشاهده همه</a>
            </div>

            <div class="posts">
                @foreach($latestCourse as $course)
                    <div class="col">
                        <a href="{{route('show' , $course->id)}}">
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="course-status">
                               {{$course->isCompleted}}
                            </div>
                            <div class="card-img"><img src="{{asset('images/'.$course->title.'/'.$course->image[2])}}" alt="php"></div>
                            <div class="card-title"><h2>php course</h2></div>
                            <div class="card-body">
                                <img src="{{asset('images/'.$course->title.'/'.$course->image[0])}}" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">{{$course->price}}</div>
                                    <div class="endPrice">{{$course->price}}تومان </div>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="box-filter">
            <div class="b-head">
                <h2>پر مخاطب ترین دوره ها</h2>
                <a href="{{route('all' , ['course_parameter' => 'total_sales'])}}">مشاهده همه</a>
            </div>
            <div class="posts">
                @foreach($popularCourse as $course)
                    <div class="col">
                        <a href="react.html">
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
                                <img src="{{asset('images/'.$course->title.'/'.$course->image[0])}}" alt="محمد نیکو">
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
        </div>
    </article>
    <article class="container blog">
        <div class="b-head">
            <h2>آخرین مقالات</h2>
            <a href="https://webamooz.net/blog">مشاهده همه</a>
        </div>
        <div class="articles">
            <div class="col">
                <a href="{{route('show' , $course->id)}}">
                    <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                    <div class="card-title"><h2>
                            فاسد در فریم ورک لاراول
                        </h2></div>
                    <div class="card-body">

                    </div>
                    <div class="card-details">
                        <span class="b-view">80</span>
                        <span class="b-category">دسته بندی : وب</span>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="react.html">
                    <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                    <div class="card-title"><h2>
                            فاسد در فریم ورک لاراول
                        </h2></div>
                    <div class="card-body">

                    </div>
                    <div class="card-details">
                        <span class="b-view">80</span>
                        <span class="b-category">دسته بندی : وب</span>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="react.html">
                    <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                    <div class="card-title"><h2>
                            فاسد در فریم ورک لاراول
                        </h2></div>
                    <div class="card-body">

                    </div>
                    <div class="card-details">
                        <span class="b-view">80</span>
                        <span class="b-category">دسته بندی : وب</span>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="react.html">
                    <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                    <div class="card-title"><h2>
                            فاسد در فریم ورک لاراول
                        </h2></div>
                    <div class="card-body">

                    </div>
                    <div class="card-details">
                        <span class="b-view">80</span>
                        <span class="b-category">دسته بندی : وب</span>
                    </div>
                </a>
            </div>
        </div>
    </article>
</main>

@endsection
