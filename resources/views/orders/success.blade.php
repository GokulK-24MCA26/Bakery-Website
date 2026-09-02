@extends('layouts.app')

@section('title', 'Order Placed — ' . config('app.name'))

@push('styles')
<style>
    .success-section {
        min-height: 80vh; background: #FBF3E4;
        display: flex; align-items: center; justify-content: center;
        padding: 60px 20px;
    }
    .success-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #EDE3D4; padding: 48px 40px;
        text-align: center; max-width: 440px; width: 100%;
        box-shadow: 0 8px 32px rgba(44,24,16,0.08);
    }
    .success-icon {
        width: 72px; height: 72px; border-radius: 50%;
        background: #E8F5E9; display: flex;
        align-items: center; justify-content: center;
        font-size: 30px; color: #2E7D32;
        margin: 0 auto 20px;
    }
    .success-title { font-family:'Fraunces',serif; font-size:26px; font-weight:500; color:#2C1810; margin-bottom:10px; }
    .success-text { color:#8A7460; font-size:14.5px; line-height:1.7; margin-bottom:28px; }
</style>
@endpush

@section('content')
<section class="success-section">
    <div class="success-card">
        <div class="success-icon"><i class="fa-solid fa-check"></i></div>
        <h1 class="success-title">Order Placed!</h1>
        <p class="success-text">
            Thank you for your order. We've received it and will start preparing it shortly.
            You'll be notified once it's ready.
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('orders.my') }}"
               style="padding:10px 22px;background:#B23A48;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                View My Orders
            </a>
            <a href="{{ route('home') }}"
               style="padding:10px 22px;background:#FBF3E4;color:#3A2519;border:1px solid #EDE3D4;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
