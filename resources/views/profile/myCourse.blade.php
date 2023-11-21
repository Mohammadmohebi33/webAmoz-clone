@extends('profile.index')


@section('content')

    <div class="profile-card"><!-- start recent order list -->
        <p class="font-13">آخرین سفارش‌ها </p>
        <div class="table-responsive">
            <table class="text-center table table-custom table-bordered font-13">
                <thead class="thead-custom">
                <tr>
                    <td>#</td>
                    <td>شماره سفارش</td>
                    <td>تاریخ ثبت سفارش</td>
                    <td>مبلغ قابل پرداخت</td>
                    <td>مبلغ کل</td>
                    <td>عملیات پرداخت</td>
                    <td>جزییات</td>
                </tr>
                </thead>
                <tbody><tr>
                    <td>1</td>
                    <td>DKC-57262900</td>
                    <td>1 فروردین 1402</td>
                    <td>0</td>
                    <td>4,300,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>DKC-57262900</td>
                    <td>8 اسفند 1400</td>
                    <td>0</td>
                    <td>1,360,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>DKC-57262900</td>
                    <td>5 بهمن 1400 </td>
                    <td>0</td>
                    <td>540,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>DKC-57262900</td>
                    <td>12 آبان 1400 </td>
                    <td>0</td>
                    <td>600,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>DKC-57262900</td>
                    <td>8 آذر 1399 </td>
                    <td>0</td>
                    <td>1,200,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>

                <tr>
                    <td>6</td>
                    <td>DKC-57262900</td>
                    <td>24 فروردین 1399</td>
                    <td>0</td>
                    <td>430,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>
                </tbody></table>
        </div>
    </div>

@endsection
