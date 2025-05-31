<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Получаем номер текущей страницы (по умолчанию 1)
        $page = $request->input('page', 1);

        // Сколько заявок на странице
        $perPage = 1;

        $total = Order::count();
        $orders = Order::skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $totalPages = ceil($total / $perPage);

        // Передаём данные в шаблон
        return view('admin.index', compact('orders', 'page', 'totalPages'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:in_progress,done,cancelled',
            'cancel_reason' => 'nullable|required_if:status,cancelled',
        ]);
        $order->update([
            'status' => $request->status,
            'cancel_reason' => $request->cancel_reason,
        ]);
        return back()->with('success', 'Данные успешно отправлены!');

    }
}
