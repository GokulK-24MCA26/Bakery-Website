<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .status-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; text-transform:capitalize; }
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
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title">Orders</h1>
            <p class="page-sub mb-0">Manage all customer orders.</p>
        </div>
        {{-- Stats --}}
        <div class="d-flex gap-3">
            <div style="text-align:center;background:#fff;border:1px solid #EDE3D4;border-radius:10px;padding:10px 20px;">
                <div style="font-size:20px;font-weight:700;color:#3A2519;">{{ $orders->count() }}</div>
                <div style="font-size:11px;color:#8A7460;">Total</div>
            </div>
            <div style="text-align:center;background:#FEF3E2;border:1px solid #F0D9A0;border-radius:10px;padding:10px 20px;">
                <div style="font-size:20px;font-weight:700;color:#C98B2E;">{{ $orders->where('status','pending')->count() }}</div>
                <div style="font-size:11px;color:#C98B2E;">Pending</div>
            </div>
            <div style="text-align:center;background:#E8F5E9;border:1px solid #A5D6A7;border-radius:10px;padding:10px 20px;">
                <div style="font-size:20px;font-weight:700;color:#2E7D32;">{{ $orders->where('status','delivered')->count() }}</div>
                <div style="font-size:11px;color:#2E7D32;">Delivered</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success-admin">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $order->user->name ?? '—' }}</div>
                        <div style="font-size:12px;color:#8A7460;">{{ $order->user->email ?? '' }}</div>
                    </td>
                    <td>{{ $order->product->name ?? '—' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>₹{{ number_format($order->price, 2) }}</td>
                    <td style="font-weight:600;">₹{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                    </td>
                    <td style="font-size:12.5px;">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="action-btn edit" title="View">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('orders.destroy', $order) }}" style="display:inline"
                              onsubmit="return confirm('Delete this order?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;color:#8A7460;padding:32px;">No orders yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
