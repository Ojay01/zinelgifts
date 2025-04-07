
<table class="w-full">
    <thead>
        <tr class="border-t border-slate-700 bg-slate-800/50">
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">
                <div class="flex items-center cursor-pointer">
                    ID <i class="fas fa-sort ml-1"></i>
                </div>
            </th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Image</th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                <div class="flex items-center cursor-pointer">
                    Name <i class="fas fa-sort ml-1"></i>
                </div>
            </th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden md:table-cell">
                <div class="flex items-center cursor-pointer">
                    Price <i class="fas fa-sort ml-1"></i>
                </div>
            </th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden xl:table-cell">
                <div class="flex items-center cursor-pointer">
                    Category <i class="fas fa-sort ml-1"></i>
                </div>
            </th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">Status</th>
            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-slate-700">
        @forelse($products as $product)
        <tr class="hover:bg-slate-700/50 transition-colors">
            <td class="px-3 sm:px-6 py-2 sm:py-4 hidden lg:table-cell">
                <span class="text-gray-400">#{{ $product->id }}</span>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4 cursor-pointer">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="h-12 w-12 object-cover rounded-lg">
                    @if($product->featured)
                        <div class="absolute -top-1 -right-1 bg-amber-500 text-white rounded-full h-5 w-5 flex items-center justify-center">
                            <i class="fas fa-star text-xs"></i>
                        </div>
                    @endif
                </div>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 cursor-pointer">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <div class="max-w-24 lg:max-w-[200px] truncate" title="{{ $product->name }}">
                            {{ $product->name }}
                        </div>
                        @if($product->discount)
                            <span class="flex-shrink-0 px-2 py-1 text-xs bg-green-500/20 text-green-400 rounded-full">
                                {{ $product->discount }}% OFF
                            </span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500 md:hidden">
                        ₣{{ number_format($product->price, 2) }}
                    </span>
                </div>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden md:table-cell">
                <div class="flex flex-col">
                    <span class="font-medium">₣{{ number_format($product->price, 2) }}</span>
                    @if($product->old_price)
                        <span class="text-xs text-gray-500 line-through">₣{{ number_format($product->old_price, 2) }}</span>
                    @endif
                </div>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden xl:table-cell">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-700 text-gray-300">
                    {{ $product->category->name }}
                </span>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4 hidden lg:table-cell">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="cursor-pointer inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                        {{ $product->status === 1 ? 'bg-green-500/20 text-green-400' : 
                        ($product->status === 3 ? 'bg-gray-500/20 text-gray-400' : 'bg-red-500/20 text-red-400') }}">
                        <i class="fas fa-circle text-xs mr-1"></i> 
                        {{ $product->status === 1 ? 'Active' : ($product->status === 3 ? 'Draft' : 'Inactive') }}
                    </button>
                    <div x-show="open" 
                         @click.away="open = false"
                         class="absolute mt-1 w-32 rounded-md shadow-lg bg-slate-700 ring-1 ring-black ring-opacity-5 z-50">
                        <div class="py-1">
                            <form action="{{ route('products.updateStatus', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="status-change block w-full text-left px-4 py-2 text-sm {{ $product->status === 1 ? 'text-green-400' : 'text-gray-300 hover:bg-slate-600' }}">
                                    <i class="fas fa-circle text-xs mr-1 text-green-400"></i> Active
                                </button>
                            </form>
                            
                            <form action="{{ route('products.updateStatus', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="status-change block w-full text-left px-4 py-2 text-sm {{ $product->status === 0 ? 'text-red-400' : 'text-gray-300 hover:bg-slate-600' }}">
                                    <i class="fas fa-circle text-xs mr-1 text-red-400"></i> Inactive
                                </button>
                            </form>
                            
                            <form action="{{ route('products.updateStatus', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="3">
                                <button type="submit" class="status-change block w-full text-left px-4 py-2 text-sm {{ $product->status === 3 ? 'text-gray-400' : 'text-gray-300 hover:bg-slate-600' }}">
                                    <i class="fas fa-circle text-xs mr-1 text-gray-400"></i> Draft
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-3 sm:px-6 py-2 sm:py-4">
                <div class="flex items-center gap-2">
                    <a href="{{ route('products.edit', $product->id) }}" 
                       class="text-blue-400 hover:text-blue-300 p-1.5" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" target="_blank"
                       class="text-slate-400 hover:text-slate-300 p-1.5" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open"
                            class="text-slate-400 hover:text-slate-300 p-1.5"
                            title="More Options"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        
                        <div 
                            x-show="open" 
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-slate-700 ring-1 ring-black ring-opacity-5 z-50"
                        >
                            <div class="py-1">
                                <a href="#" 
                                onclick="event.preventDefault(); document.getElementById('toggle-featured-{{ $product->id }}').submit();"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-600">
                                    <div class="flex items-center">
                                        <i class="fas fa-star mr-2"></i>
                                        {{ $product->featured ? 'Unmark Featured' : 'Mark Featured' }}
                                    </div>
                                </a>
                                
                                <form id="toggle-featured-{{ $product->id }}" 
                                      action="{{ route('products.toggleFeatured', $product->id) }}" 
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                
                                <hr class="my-1 border-slate-600">
                                <button 
                                    onclick="productManager.openConfirmModal('{{ route('products.destroy', $product->id) }}')"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-600"
                                >
                                    <div class="flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Delete
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center py-8 text-slate-400">
                <x-admin.products.empty />
            </td>
        </tr>
           
        @endforelse
    </tbody>
</table>