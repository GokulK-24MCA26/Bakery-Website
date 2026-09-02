<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ── Admin ──────────────────────────────────────

    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,delivered,cancelled',
        ]);
        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Order status updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }

    // ── Public (customer) ──────────────────────────

    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total   = $product->price * $request->quantity;

        Order::create([
            'user_id'     => Auth::id(),
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'price'       => $product->price,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        return redirect()->route('orders.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        return view('orders.success');
    }

    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()->get();
        return view('orders.show', compact('orders'));
    }
}
