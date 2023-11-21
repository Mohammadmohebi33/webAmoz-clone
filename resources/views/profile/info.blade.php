@extends('profile.index')

@section('content')

<div class="profile-card personal-info"><!-- start personal info edit box -->
    <p class="font-13">اطلاعات شخصی</p>
    <form>
        <div class="row">
            <div class="col mb-3">
                <label for="name" class="form-label">نام و نام خانوادگی :</label>
                <input type="text" class="form-control form-control-lg" id="name" value="امیرحسین رضایی">
            </div>
            <div class="col mb-3">
                <label for="tell" class="form-label">شماره تلفن همراه : </label>
                <input type="tel" class="form-control form-control-lg" id="tell" value="******0912">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="email" class="form-label">ایمیل :</label>
                <input type="email" class="form-control form-control-lg" id="email" value="test@gmail.com">
            </div>
            <div class="col mb-3">
                <label for="code" class="form-label">کد ملی : </label>
                <input type="number" class="form-control form-control-lg" id="code" value="123456789">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="email" class="form-label">دریافت خبرنامه :</label>
                <select class="form-select">
                    <option>بله</option>
                    <option>خیر</option>
                </select>
            </div>
            <div class="col mb-3">
                <label for="card" class="form-label">شماره کارت : </label>
                <input type="text" class="form-control form-control-lg" id="card" value="**************">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-info text-white font-13 float-end">ثبت اطلاعات  </button>
            </div>
        </div>
    </form>
</div>

@endsection
