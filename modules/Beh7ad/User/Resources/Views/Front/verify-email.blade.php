@extends('User::Front.master')

@section('title', 'تایید ایمیل')

@section('content')
    <form action="{{ route('verification.verify') }}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="card-header">
            <p class="activation-code-title">کد فرستاده شده به ایمیل <span>{{auth()->user()->email}}</span>
                را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
            </p>
        </div>
        <div class="form-content form-content1">
            <input name="verify_code" required class="activation-code-input" placeholder="فعال سازی">
            @error('verify_code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <button class="btn i-t">تایید</button>

            <a href="#" onclick="event.preventDefault();
            document.getElementById('resend-code').submit()">ارسال مجدد کد فعالسازی</a>

        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ثبت نام</a>
        </div>
    </form>

    <form id="resend-code" action="{{route('verification.send')}}" method="POST">
        @csrf
    </form>
@endsection
@section('js')
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/activation-code.js"></script>
@endsection
