<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
      public function index() {
        $orders = Order::with('user', 'service')->latest()->get();
        return view('admin.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order) {
        $request->validate([
            'status' => 'required|in:in_progress,done,cancelled',
            'cancel_reason' => 'nullable|required_if:status,cancelled',
        ]);
        $order->update([
            'status' => $request->status,
            'cancel_reason' => $request->cancel_reason,
        ]);
        return back();
    }
}
