<!-- profile/tabs/orders.blade.php -->
@extends('profile.index')

@section('profile-content')
@php
$orders = collect([
    (object)[
        'id' => 1,
        'number' => 'ORD-2024-001',
        'created_at' => now()->subDays(5),
        'status' => 'delivered',
        'total' => 299.99,
        'can_track' => true
    ],
    (object)[
        'id' => 2,
        'number' => 'ORD-2024-002',
        'created_at' => now()->subDays(3),
        'status' => 'processing',
        'total' => 149.50,
        'can_track' => false
    ],
    (object)[
        'id' => 3,
        'number' => 'ORD-2024-003',
        'created_at' => now()->subDays(1),
        'status' => 'shipped',
        'total' => 499.99,
        'can_track' => true
    ],
    (object)[
        'id' => 4,
        'number' => 'ORD-2024-004',
        'created_at' => now()->subDays(0),
        'status' => 'cancelled',
        'total' => 89.99,
        'can_track' => false
    ]
]);

// Add paginate() method to the collection for demo purposes
// $orders = $orders->paginate(10);
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500">Order History</h2>
        <div class="flex space-x-2">
            <select name="status" 
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">All Orders</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <select name="timeframe" 
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">All Time</option>
                <option value="last_month">Last Month</option>
                <option value="last_3_months">Last 3 Months</option>
                <option value="last_6_months">Last 6 Months</option>
                <option value="last_year">Last Year</option>
            </select>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="text-center py-8">
            <div class="text-gray-400 dark:text-gray-500 mb-4">
                <i class="fas fa-shopping-bag fa-3x"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No orders found</h3>
            <p class="text-gray-600 dark:text-gray-400">Start shopping to see your orders here!</p>
            <a href="{{ route('shop.index') }}" class="mt-4 inline-block bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                Browse Products
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b dark:border-gray-700">
                        <th class="pb-4 text-gray-600 dark:text-gray-400">Order ID</th>
                        <th class="pb-4 text-gray-600 dark:text-gray-400">Date</th>
                        <th class="pb-4 text-gray-600 dark:text-gray-400">Status</th>
                        <th class="pb-4 text-gray-600 dark:text-gray-400">Total</th>
                        <th class="pb-4 text-gray-600 dark:text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-4 text-gray-800 dark:text-gray-300">{{ $order->number }}</td>
                            <td class="py-4 text-gray-800 dark:text-gray-300">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($order->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 text-gray-800 dark:text-gray-300">${{ number_format($order->total, 2) }}</td>
                            <td class="py-4">
                                <div class="flex space-x-3">
                                    <a href="#" 
                                       class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300">
                                        <i class="fas fa-eye"></i>
                                        <span class="ml-1">View</span>
                                    </a>
                                    @if($order->can_track)
                                        <a href="#" 
                                           class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            <i class="fas fa-truck"></i>
                                            <span class="ml-1">Track</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <div class="mt-6">
            {{ $orders->links() }}
        </div> --}}
    @endif
</div>
@endsection