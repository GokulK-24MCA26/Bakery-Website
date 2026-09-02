@extends('layouts.app')

@section('title', 'My Orders — ' . config('app.name'))

@push('styles')
<style>
    .orders-section { padding: 60px 0; background: #FBF3E4; min-height: 80vh; }
    .orders-heading { font-family:'Fraunces',serif; font-size:30px; font-weight:500; color:#2C1810; margin-bottom:6px; }
    .order-row {
        background:#fff; border-radius:12px;
        border:1px solid #EDE3D4; padding:20px 24px;
        margin-bottom:14px; display:flex;
        align-items:center; gap:16px; flex-wrap:wrap;
    }
    .order-img { width:56px; height:56px; border-radius:8px; object-fit:cover; flex-shrink:0; }
    .order-img-ph { width:56px; height:56px; border-radius:8px; background:#EDE3D4; display:flex; align-items:center; justify-content:center; color:#B8A489; flex-shrink:0; }
    .order-name { font-weight:600; font-size:15px; color:#2C1810; }
    .order-meta { font-size:12.5px; color:#8A7460; margin-top:2px; }
    .order-total { font-family:'Fraunces',serif; font-size:18px; color:#B23A48; font-weight:500; margin-left:auto; }
    .status-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; text-transform:capitalize; }
    .status-pending    { background:#FEF3E2; color:#C98B2E; }
    .status-confirmed  { background:#E3F2FD; color:#1565C0; }
    .status-processing { background:#EDE7F6; color:#5E35B1; }
    .status-delivered  { background:#E8F5E9; color:#2E7D32; }
    .status-cancelled  { background:#FFEBEE; color:#C62828; }
</style>
@endpush

@section('content')
<section class="orders-section">
    <div class="container" style="max-width:720px;">
        <h1 class="orders-heading">My Orders</h1>
        <p style="color:#8A7460;margin-bottom:28px;">Track all your orders here.</p>

        @forelse($orders as $order)
        <div class="order-row">
            @if($order->product && $order->product->image)
                <img src="{{ asset('storage/' . $order->product->image) }}" class="order-img" alt="">
            @else
                <div class="order-img-ph"><i class="fa-solid fa-bread-slice"></i></div>
            @endif
            <div>
                <div class="order-name">{{ $order->product->name ?? 'Product removed' }}</div>
                <div class="order-meta">
                    Qty: {{ $order->quantity }} &nbsp;·&nbsp;
                    ₹{{ number_format($order->price, 2) }} each &nbsp;·&nbsp;
                    {{ $order->created_at->format('d M Y') }}
                </div>
                <div style="margin-top:6px;">
                    <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                </div>
            </div>
            <div class="order-total">₹{{ number_format($order->total_price, 2) }}</div>
        </div>
        @empty
        <div style="text-align:center;padding:60px 0;color:#8A7460;">
            <i class="fa-solid fa-bag-shopping" style="font-size:40px;margin-bottom:14px;display:block;"></i>
            No orders yet. <a href="{{ route('home') }}" style="color:#B23A48;">Browse products</a>
        </div>
        @endforelse
    </div>
</section>
@endsection
