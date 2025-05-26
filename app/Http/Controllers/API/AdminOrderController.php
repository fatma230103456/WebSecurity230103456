<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Check if the authenticated user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $orders = Order::with(['user', 'orderItems.product'])->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
    }

    public function show(Order $order)
    {
        // Check if the authenticated user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->load(['user', 'orderItems.product']); // Load relationships

        return response()->json($order);
    }

    public function update(Request $request, Order $order)
    {
        // Check if the authenticated user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Define allowed order statuses
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:' . implode(',', $allowedStatuses),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->status = $request->status;
        $order->save();

        $order->load(['user', 'orderItems.product']);

        return response()->json($order);
    }

    public function destroy(string $id)
    {
        
    }
}
