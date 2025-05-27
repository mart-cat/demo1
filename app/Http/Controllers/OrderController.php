<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $orders = auth()->user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create() {
        $services = Service::all();
        return view('orders.create', compact('services'));
    }

    public function store(Request $request) {
        $request->validate([
            'address' => 'required',
            'phone' => ['required', 'regex:/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/'],
            'service_id' => 'nullable|exists:services,id',
            'other_service' => 'nullable|string|max:255',
            'service_time' => 'required|date',
            'payment_type' => 'required|in:cash,card',
        ]);

        if(!$request->service_id && !$request->other_service) {
            return back()->withErrors(['other_service' => 'Опишите услугу'])->withInput();
        }

        Order::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'other_service' => $request->other_service,
            'address' => $request->address,
            'phone' => $request->phone,
            'service_time' => $request->service_time,
            'payment_type' => $request->payment_type,
            'status' => 'new',
        ]);
        return redirect('/orders')->with('success', 'Заявка отправлена');
    }
}
