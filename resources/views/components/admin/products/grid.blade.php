<div class="bg-slate-800 border border-slate-700 rounded-lg transition-all hover:shadow-lg">
    <div class="relative">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
        @if($product->featured)
            <div class="absolute top-2 right-2 bg-amber-500 text-white rounded-full h-8 w-8 flex items-center justify-center">
                <i class="fas fa-star"></i>
            </div>
        @endif
        @if($product->discount)
            <div class="absolute top-2 left-2 bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs font-medium">
                {{ $product->discount }}% OFF
            </div>
        @endif
    </div>
    <div class="p-4">
        <div class="flex justify-between items-start">
            <h3 class="font-medium text-gray-300 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
            <span class="text-gray-300 font-bold">₣{{ number_format($product->price, 2) }}</span>
        </div>
        <div class="mt-2 flex items-center text-xs text-gray-500">
            <i class="fas fa-folder mr-1"></i> {{ $product->category->name }}
        </div>
        <div class="mt-4 flex justify-between items-center">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="cursor-pointer inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
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
            <div class="flex space-x-2">
                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-400 hover:text-blue-300 p-1" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" target="_blank" class="text-slate-400 hover:text-slate-300 p-1" title="View">
                    <i class="fas fa-eye"></i>
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="text-slate-400 hover:text-slate-300 p-1"
                        title="More Options"
                    >
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    
                    <div 
                        x-show="open" 
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-slate-700 ring-1 ring-black ring-opacity-5 z-50"
                    >
                        <div class="py-1">
                            <a href="#" 
                            onclick="event.preventDefault(); document.getElementById('grid-toggle-featured-{{ $product->id }}').submit();"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-600">
                                <div class="flex items-center">
                                    <i class="fas fa-star mr-2"></i>
                                    {{ $product->featured ? 'Unmark Featured' : 'Mark Featured' }}
                                </div>
                            </a>
                            
                            <form id="grid-toggle-featured-{{ $product->id }}" 
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
                            
                            <hr class="my-1 border-slate-600">
                            <a href="#" 
                               class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-600">
                                <div class="flex items-center">
                                    <i class="fas fa-copy mr-2"></i>
                                    Duplicate
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>