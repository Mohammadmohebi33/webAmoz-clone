@extends('home.index')
@section('content')
    <main id="index">
        <article class="container article">

            <div class="posts">
                @foreach($courses as $course)
                <div class="col">
                    <a href="react.html">
                        <div class="course-status">
                            تکمیل شده
                        </div>
                        <div class="discountBadge">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
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
                {{$courses->links()}}
            </div>
        </article>
    </main>
@endsection
