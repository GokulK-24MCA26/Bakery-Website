@extends('layouts.app')

@section('title', 'Order — ' . $product->name)

@push('styles')
<style>
    .order-section { padding: 60px 0; background: #FBF3E4; min-height: 80vh; }
    .order-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #EDE3D4;
        box-shadow: 0 8px 32px rgba(44,24,16,0.08);
        overflow: hidden; max-width: 560px; margin: 0 auto;
    }
    .order-product-banner {
        background: linear-gradient(135deg, #2B1B14, #4a2c1a);
        padding: 24px; display: flex; align-items: center; gap: 16px;
    }
    .order-product-img {
        width: 72px; height: 72px; border-radius: 10px;
        object-fit: cover; flex-shrink: 0;
    }
    .order-product-placeholder {
        width: 72px; height: 72px; border-radius: 10px;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        color: #B8A489; font-size: 24px; flex-shrink: 0;
    }
    .order-product-name { font-family:'Fraunces',serif; font-size:18px; color:#F6E9D3; font-weight:500; }
    .order-product-price { color:#F4C430; font-size:15px; font-weight:600; margin-top:2px; }
    .order-body { padding: 28px; }
    .o-label { display:block; font-size:12.5px; font-weight:600; color:#3A2519; margin-bottom:6px; }
    .o-input {
        width:100%; height:44px; padding:0 14px;
        border-radius:8px; border:1px solid #E6D8BF;
        background:#FFFDF9; font-family:'Work Sans',sans-serif;
        font-size:14px; color:#3A2519;
        transition: border-color .15s, box-shadow .15s;
    }
    .o-input:focus { outline:none; border-color:#B23A48; box-shadow:0 0 0 3px rgba(178,58,72,0.12); }
    .total-box {
        background:#FBF3E4; border-radius:10px;
        padding:16px 18px; margin:20px 0;
        display:flex; justify-content:space-between; align-items:center;
    }
    .total-label { font-size:13px; color:#8A7460; }
    .total-value { font-family:'Fraunces',serif; font-size:22px; color:#B23A48; font-weight:500; }
    .btn-order {
        width:100%; padding:13px; background:#B23A48; color:#fff;
        border:none; border-radius:8px; font-family:'Work Sans',sans-serif;
        font-size:15px; font-weight:600; cursor:pointer; transition:background .15s;
    }
    .btn-order:hover { background:#98303D; }
</style>
@endpush

@section('content')
<section class="order-section">
    <div class="container">
        <div class="order-card">

            {{-- Product banner --}}
            <div class="order-product-banner">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="order-product-img" alt="{{ $product->name }}">
                @else
                    <div class="order-product-placeholder"><i class="fa-solid fa-bread-slice"></i></div>
                @endif
                <div>
                    <div class="order-product-name">{{ $product->name }}</div>
                    <div class="order-product-price">₹{{ number_format($product->price, 2) }} per item</div>
                </div>
            </div>

            <div class="order-body">
                @if($errors->any())
                    <div style="background:#FCEBEB;color:#A32D2D;border:1px solid #F0A0A0;border-radius:8px;padding:12px 14px;font-size:13px;margin-bottom:18px;">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div style="margin-bottom:18px;">
                        <label class="o-label">Quantity</label>
                        <input type="number" name="quantity" id="qty" class="o-input"
                               value="{{ old('quantity', 1) }}" min="1" max="99" required>
                    </div>

                    <div class="total-box">
                        <span class="total-label">Total Amount</span>
                        <span class="total-value" id="totalDisplay">₹{{ number_format($product->price, 2) }}</span>
                    </div>

                    <button type="submit" class="btn-order">
                        <i class="fa-solid fa-bag-shopping me-2"></i> Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const price = {{ $product->price }};
    document.getElementById('qty').addEventListener('input', function () {
        const total = (price * (parseInt(this.value) || 1)).toFixed(2);
        document.getElementById('totalDisplay').textContent = '₹' + parseFloat(total).toLocaleString('en-IN', {minimumFractionDigits:2});
    });
</script>
@endpush
