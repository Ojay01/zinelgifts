<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <!-- Dashboard Card -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg overflow-hidden">
            <!-- Header Section with Gradient -->
            <div class="bg-gradient-to-r from-slate-800 to-slate-700 p-5 sm:p-6 flex justify-between items-center flex-col md:flex-row border-b border-slate-700">
                <h3 class="text-lg font-semibold text-gray-200 flex items-center">
                    <i class="fas fa-shopping-cart text-blue-400 mr-2"></i>
                    User Carts Overview
                </h3>
                <div class="mt-4 md:mt-0 bg-slate-700/50 py-2 px-4 rounded-full flex items-center">
                    <i class="fas fa-cubes text-yellow-500 mr-2"></i>
                    <span class="text-gray-300">
                        Total Items: 
                        <span class="text-yellow-500 font-semibold">{{ $cartItems->sum('quantity') }}</span>
                    </span>
                </div>
            </div>
            
            <!-- Table Section with Enhanced Styling -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/30">
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-slate-500 mr-2"></i>
                                    User
                                </div>
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-box text-slate-500 mr-2"></i>
                                    Product
                                </div>
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden md:table-cell">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag text-slate-500 mr-2"></i>
                                    Quantity
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/70">
                        @forelse($cartItems as $item)
                        <tr class="hover:bg-slate-700/40 transition-colors duration-200">
                            <td class="px-4 sm:px-6 py-4 w-1/5">
                                <a href="{{ route('profile.user', $item->user->id) }}" 
                                   class="flex items-center text-yellow-500 hover:text-blue-400 transition-colors">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    <span class="hover:underline">{{ $item->user->name }}</span>
                                </a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-gray-300">
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-slate-500 mr-2"></i>
                                    {{ $item->product->name }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-gray-300 hidden md:table-cell">
                                <div class="flex items-center">
                                    <span class="bg-slate-700 text-yellow-500 py-1 px-3 rounded-full text-xs font-medium">
                                        {{ $item->quantity }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-8 text-slate-400">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-shopping-cart text-slate-600 text-4xl mb-3"></i>
                                    <p>No products in user carts</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Footer with Pagination if needed -->
            <div class="bg-slate-800/80 p-4 border-t border-slate-700">
                <div class="flex justify-center">
                    <!-- Pagination would go here -->
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>