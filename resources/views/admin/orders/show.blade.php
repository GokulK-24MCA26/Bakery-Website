<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .detail-card { background:#fff; border:1px solid #EDE3D4; border-radius:12px; padding:24px; margin-bottom:20px; }
        .detail-label { font-size:11.5px; font-weight:600; color:#8A7460; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:4px; }
        .detail-value { font-size:15px; color:#3A2519; font-weight:500; }
        .status-badge { display:inline-block; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:600; text-transform:capitalize; }
        .status-pending    { background:#FEF3E2; color:#C98B2E; }
        .status-confirmed  { background:#E3F2FD; color:#1565C0; }
        .status-processing { background:#EDE7F6; color:#5E35B1; }
        .status-delivered  { background:#E8F5E9; color:#2E7D32; }
        .status-cancelled  { background:#FFEBEE; color:#C62828; }
    </style>
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="mb-4">
        <a href="{{ route('orders.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
        </a>
        <h1 class="page-title mt-2">Order #{{ $order->id }}</h1>
    </div>

    @if(session('success'))
        <div class="alert-success-admin">{{ session('success') }}</div>
    @endif

    <div class="row g-4">

        {{-- Order Details --}}
        <div class="col-lg-8">
            <div class="detail-card">
                <h5 style="font-family:'Fraunces',serif;font-size:17px;margin-bottom:20px;">Order Details</h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="detail-label">Product</div>
                        <div class="detail-value">{{ $order->product->name ?? '—' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Category</div>
                        <div class="detail-value">{{ $order->product->category->name ?? '—' }}</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="detail-label">Unit Price</div>
                        <div class="detail-value">₹{{ number_format($order->price, 2) }}</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="detail-label">Quantity</div>
                        <div class="detail-value">{{ $order->quantity }}</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="detail-label">Total</div>
                        <div class="detail-value" style="color:#B23A48;font-size:18px;">₹{{ number_format($order->total_price, 2) }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Ordered On</div>
                        <div class="detail-value">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Current Status</div>
                        <div class="detail-value">
                            <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customer --}}
            <div class="detail-card">
                <h5 style="font-family:'Fraunces',serif;font-size:17px;margin-bottom:20px;">Customer</h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="detail-label">Name</div>
                        <div class="detail-value">{{ $order->user->name ?? '—' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $order->user->email ?? '—' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Role</div>
                        <div class="detail-value" style="text-transform:capitalize;">{{ $order->user->role ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="col-lg-4">
            <div class="detail-card">
                <h5 style="font-family:'Fraunces',serif;font-size:17px;margin-bottom:20px;">Update Status</h5>
                <form method="POST" action="{{ route('orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status"
                                style="width:100%;height:42px;padding:0 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;">
                            @foreach(['pending','confirmed','processing','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-primary-admin" style="width:100%;">
                        <i class="fa-solid fa-rotate me-1"></i> Update Status
                    </button>
                </form>

                <hr style="border-color:#EDE3D4;margin:20px 0;">

                <form method="POST" action="{{ route('orders.destroy', $order) }}"
                      onsubmit="return confirm('Delete this order permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%;padding:9px;background:#FFEBEE;border:1px solid #FFCDD2;border-radius:8px;color:#C62828;font-size:13px;font-weight:600;cursor:pointer;font-family:'Work Sans',sans-serif;">
                        <i class="fa-solid fa-trash me-1"></i> Delete Order
                    </button>
                </form>
            </div>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
