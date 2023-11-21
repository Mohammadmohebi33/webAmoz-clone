<div class="episodes-list">
    <div class="episodes-list--title">فهرست جلسات</div>
    <div class="episodes-list-section">


        @foreach($course->episodes as  $key => $episode)
            <div class="episodes-list-item
                @if($episode->status == "lock" && !\Illuminate\Support\Facades\Auth::check())
                lock
                @elseif($episode->status == "lock" && !$course->isPurchase(\Illuminate\Support\Facades\Auth::user()->id))
                lock
                 @endif">
                <div class="section-right">
                    <span class="episodes-list-number">{{$key + 1}}</span>
                    <div class="episodes-list-title">
                        <a href="php-ep-1.html">{{$episode->title}}</a>
                    </div>
                </div>
                <div class="section-left">
                    <div class="episodes-list-details">
                        <div class="episodes-list-details">
                            @if($episode->status == "free")
                                <span class="detail-type">رایگان</span>
                            @endif
                            <span class="detail-time">{{ gmdate("i:s", $episode->time) }}</span>
                            <a class="detail-download">
                                <i class="icon-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
