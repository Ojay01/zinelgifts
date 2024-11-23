<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col md:flex-row">
                <h3 class="text-lg font-semibold text-gray-300">
                    User Carts Overview
                </h3>
                <div class="mt-4 md:mt-0">
                    <span class="text-gray-400">
                        Total Items in All Carts: 
                        <span class="text-yellow-500">{{ $cartItems->sum('quantity') }}</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-t border-slate-700 bg-slate-800/50">
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Product</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden md:table-cell">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($cartItems as $item)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                           
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-yellow-500">
                                <a href="{{ route('profile.user', $item->user->id) }}" 
                                   class="hover:text-blue-400 transition-colors">
                                    {{ $item->user->name }}
                                </a>
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300">
                                {{ $item->product->name }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden md:table-cell">
                                {{ $item->quantity }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-slate-400">
                                No products in user carts.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
