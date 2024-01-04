@extends('profile.index')

@section('content')

<div class="profile-card personal-info"><!-- start personal info edit box -->
    <p class="font-13">اطلاعات شخصی</p>
    <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label for="name" class="form-label">نام و نام خانوادگی :</label>
                <input name="name" type="text" class="form-control form-control-lg" id="name" value="{{$authUser->name}}">
            </div>
            <div class="col mb-3">
                <label for="tell" class="form-label">شماره تلفن همراه : </label>
                <input name="number" type="tel" class="form-control form-control-lg" id="tell" value="******0912">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="email" class="form-label">ایمیل :</label>
                <input name="email" disabled type="email" class="form-control form-control-lg" id="email" value="{{$authUser->email}}">
            </div>

        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="email" class="form-label">درباره من :</label>
                <input name=about_me type="text" class="form-control form-control-lg" id="email" value="{{$authUser->about_me}}">
            </div>

        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-info text-white font-13 float-end">ثبت اطلاعات  </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-2">
                <input type="file" name="image">
            </div>

        </div>
    </form>
</div>

@endsection
