@extends('home.index')

@section('content')

    <div class="content">

        <div class="container">
            <article class="article">
                <div class="ads mb-10">
                    <a href="" rel="nofollow noopener"><img src="{{asset('home/img/ads/1440px/test.jpg')}}" alt=""></a>
                </div>
                <div class="h-t">
                    <h1 class="title">{{$course->title}}</h1>
                </div>

            </article>
        </div>


        <div class="main-row container">
            <div class="sidebar-right">
                <div class="sidebar-sticky" style="top: 104px;">


            @if(\Illuminate\Support\Facades\Auth::check())

                        @if($course->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                            <div class="product-info-box">
                                <p class="mycourse">شما مدرس این دوره هستید</p>
                            </div>
                        @elseif($course->isPurchase(\Illuminate\Support\Facades\Auth::user()->id))
                            <p class="mycourse ">شما این دوره رو خریداری کرده اید</p>
                        @else
                            <div class="product-info-box">
                                {{--                        <div class="discountBadge">--}}
                                {{--                            <p>45%</p>--}}
                                {{--                            تخفیف--}}
                                {{--                        </div>--}}
                                <div class="sell_course">
                                    <strong>قیمت :</strong>
                                    {{--                            <del class="discount-Price">900,000</del>--}}
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{$course->price}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                    </p>
                                </div>

                                <form method="post" action="{{route('purchase')}}">
                                    @csrf
                                    <input type="hidden" value="{{$course->id}}" name="course_name">
                                    <button class="mycourse btn buy">خرید دوره</button>
                                </form>
                                <p class="mycourse d-none">شما مدرس این دوره هستید</p>
                                <p class="mycourse d-none">شما این دوره رو خریداری کرده اید</p>

                            </div>
                        @endif

            @else
                        <div class="product-info-box">
                            {{--                        <div class="discountBadge">--}}
                            {{--                            <p>45%</p>--}}
                            {{--                            تخفیف--}}
                            {{--                        </div>--}}
                            <div class="sell_course">
                                <strong>قیمت :</strong>
                                {{--                            <del class="discount-Price">900,000</del>--}}
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{$course->price}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>

                            <a href="{{route('login')}}" class="mycourse btn buy">خرید دوره</a>
                        </div>
            @endif

                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                تعداد دانشجو : <span>{{$course->userCourse()->count()}}</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">تعداد جلسات منتشر شده :  </span>
                                <span class="vlaue">{{$course->episodes->count()}}</span>
                            </div>
                            <div class="meta-info-unit two">
                                <span class="title">مدت زمان دوره تا الان : </span>
                                <span class="vlaue">{{ gmdate("H:i:s", $totalTime) }}</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">مدرس دوره : </span>
                                <span class="vlaue">{{$course->user->name}}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">وضعیت دوره : </span>
                                <span class="vlaue">{{$course->isCompleted}}</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">پشتیبانی : </span>
                                <span class="vlaue">دارد</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-teacher-details">
                        <div class="top-part">
                            <a href="https://webamooz.net/tutor/mohammadnikoo/"><img alt="محمد نیکو" class="img-fluid lazyloaded" src="{{'http://localhost:8000/storage/user/'.$course->user->image}}" loading="lazy">
                                <noscript>
                                    <img src="{{'http://localhost:8000/storage/user/'.$course->user->image}}"></noscript>
                            </a>
                            <div class="name">
                                <a href="https://webamooz.net/tutor/mohammadnikoo/" class="btn-link"><h6>{{$course->user->name}}</h6>
                                </a>
                                <span class="job-title">مدرس و توسعه دهنده</span>
                            </div>
                        </div>
                        <div class="job-content">
                            <!--                        <p>عاشق برنامه نویسی</p>-->
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>لینک کوتاه</span>
                            <input class="short--link" value="webamooz.net/c/Y33x3">
                            <a href="" class="short-link-a" data-link="https://webamooz.net/c/Y33x3"></a>
                        </div>
                    </div>
{{--                    <di class="sidebar-banners">--}}

{{--                        <div class="sidebar-pic">--}}
{{--                            <a href="https://t.me/webmooz_net"><img src="{{asset('home/img/telgram.png')}}" alt="کانال تلگرام"></a>--}}
{{--                        </div>--}}

{{--                        <div class="sidebar-pic">--}}
{{--                            <a href="https://t.me/webmooz_net"><img src="{{asset('home/img/laravel-tel.png')}}" alt="کانال تلگرام"></a>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-pic">--}}
{{--                            <a href="https:webamooz.net/blog"><img src="{{asset('home/img/podcast.png')}}" alt="وبلاگ وب آموز"></a>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-pic">--}}
{{--                            <a href="https://t.me/webmooz_net"><img src="{{asset('home/img/workinja.png')}}" alt="کانال تلگرام"></a>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-pic">--}}
{{--                            <a href="https://t.me/webmooz_net"><img src="{{asset('home/img/blog-pic.png')}}" alt="کانال تلگرام"></a>--}}
{{--                        </div>--}}
{{--                    </di>--}}



                </div>
            </div>
            <div class="content-left">
                <div class="preview">
                    <video width="100%" controls="">

                        <source src="{{ route('getVideo', $course->introduction) }}" type="video/mp4">
                    </video>
                </div>
{{--                <a href="{{route('download.file' , [ , 'introduction_course'])}}" class="episode-download">دانلود اشنایی با دوره</a>--}}
          {{--                توضیحات دوره--}}
                <div class="course-description">
                    <div class="course-description-title">توضیحات دوره</div>
                    {!! $course->description !!}
                    <div class="tags">
                        <ul>
                            <li><a href="">ری اکت</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">جاوااسکریپت</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">reactjs چیست</a></li>
                        </ul>
                    </div>
                </div>
          {{--                فهرست جلسات--}}
                @include('home.show_episode')
            </div>
        </div>

        <div class="container">
            @if(\Illuminate\Support\Facades\Auth::check())
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
            @include('home.comments')
                </div>
            @else
                <h2>ابتدا لاگین کنید</h2>
            @endif
        </div>
    </div>
@endsection
