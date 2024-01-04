@extends('profile.index')


@section('content')

    <div class="profile-card"><!-- start recent order list -->
        <p class="font-13">دوره های من </p>
        <div class="table-responsive">
            <table class="text-center table table-custom table-bordered font-13">
                <thead class="thead-custom">
                <tr>
                    <td>#</td>
                    <td>نام دوره</td>
                    <td>تصویر دوره</td>
                    <td>تاریخ اخرین بروز رسانی</td>
                    <td>مبلغ کل</td>
                    <td>جزییات</td>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $key => $value)
                <tr>
                    <td>{{$key +1 }}</td>
                    <td>{{$value->title}}</td>
                    <td><img src="{{'http://localhost:8000/storage/images/'.$value->title.'/'. $value->image[0]}}"></td>
                    <td>{{$value->updated_at}}</td>
                    <td>{{$value->price}}</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>
                @endforeach

                </tbody></table>
        </div>
    </div>

@endsection
