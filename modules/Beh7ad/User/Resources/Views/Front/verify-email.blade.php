@extends('User::Front.master')

@section('title', 'تایید ایمیل')

@section('content')
<form method="POST" action="{{ route('verification.send') }}" class="form">
    @csrf
    <a class="account-logo" href="{{url('/')}}">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        @if (session('status') == 'verification-link-sent')
            <p class="text-success">یک پیوند تأیید جدید به آدرس ایمیلی که هنگام ثبت نام ارائه کرده اید ارسال شده است.</p>
        @endif
        <p>از ثبت نام شما سپاسگزاریم! قبل از شروع، آیا می توانید آدرس ایمیل خود را با کلیک کردن روی پیوندی که به تازگی برای شما ایمیل کرده ایم تأیید کنید؟ اگر ایمیلی را دریافت نکردید، با کمال میل یک ایمیل دیگر برای شما ارسال خواهیم کرد.</p>
        <br>
        <button type="submit" class="btn btn-recoverpass">ارسال ایمیل بازیابی</button>
    </div>
    <div class="form-footer">
        <a href="{{ url('/') }}">بازگشت به صفحه اصلی</a>
    </div>
</form>
@endsection
