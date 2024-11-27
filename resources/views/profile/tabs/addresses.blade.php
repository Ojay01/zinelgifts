@extends('profile.index')
@section('profile-content')
<div class="space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500">My Addresses</h2>
            <button 
                id="add-address-btn" 
                class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300"
                onclick="openAddAddressModal()"
            >
                Add New Address
            </button>
        </div>

        @if($addresses->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                You have no saved addresses.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($addresses as $address)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out group relative overflow-hidden">
                    <div class="p-6 pr-12">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $address->number }}, {{ $address->neighborhood }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 -mt-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v2H7V5zm6 4H7v2h6V9zm-6 4h6v2H7v-2z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $address->city }}
                                </p>
                                
                                @if($address->complement)
                                    <div class="text-gray-500 dark:text-gray-400 text-xs flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                        </svg>
                                        {{ $address->complement }}
                                    </div>
                                @endif
                            </div>
                            
                            <button 
                                onclick="openDeleteModal({{ $address->id }})"
                                class="absolute top-4 right-4 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
            
                    <!-- Subtle hover effect overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-gray-700 dark:to-gray-800 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                </div>
            @endforeach
            </div>
        @endif

        <!-- Add Address Modal -->
            <div 
            id="add-address-modal" 
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white dark:bg-gray-800 rounded-lg p-8 w-full max-w-md shadow-2xl transform transition-all duration-300 ease-in-out scale-95 hover:scale-100">
                <div class="flex items-center mb-6">
                    <i class="fas fa-map-marker-alt text-yellow-500 mr-3 text-2xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-yellow-500">Add New Address</h3>
                </div>
                <form id="add-address-form" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-city mr-2 text-gray-500"></i>City
                            </label>
                            <div class="relative">
                                <i class="fas fa-circle-info absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="city" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Enter city name"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-home mr-2 text-gray-500"></i>Neighborhood
                            </label>
                            <div class="relative">
                                <i class="fas fa-location-dot absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="neighborhood" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Enter neighborhood"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-hashtag mr-2 text-gray-500"></i>Number
                            </label>
                            <div class="relative">
                                <i class="fas fa-sort-numeric-up absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="number" 
                                    name="number" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Address number"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-plus-circle mr-2 text-gray-500"></i>Complement (Optional)
                            </label>
                            <div class="relative">
                                <i class="fas fa-comment-dots absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="complement" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Additional address details"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-4">
                        <button 
                            type="button" 
                            onclick="closeAddAddressModal()"
                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white flex items-center"
                        >
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300 flex items-center"
                        >
                            <i class="fas fa-save mr-2"></i>Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Address Modal -->
        <div 
            id="delete-address-modal" 
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white dark:bg-gray-800 rounded-lg p-8 w-72 md:w-96 max-w-full">
                <h3 class="text-xl font-semibold text-red-600 dark:text-red-500 mb-6">Confirm Delete</h3>
                <p class="mb-6 text-gray-700 dark:text-gray-300">Are you sure you want to delete this address?</p>
                <form id="delete-address-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-4">
                        <button 
                            type="button" 
                            onclick="closeDeleteModal()"
                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition duration-300"
                        >
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddAddressModal() {
            document.getElementById('add-address-modal').classList.remove('hidden');
            document.getElementById('add-address-modal').classList.add('flex');
        }
    
        function closeAddAddressModal() {
            document.getElementById('add-address-modal').classList.remove('flex');
            document.getElementById('add-address-modal').classList.add('hidden');
        }
    
        function openDeleteModal(addressId) {
            const deleteForm = document.getElementById('delete-address-form');
            deleteForm.action = `/account/addresses/${addressId}`;
            document.getElementById('delete-address-modal').classList.remove('hidden');
            document.getElementById('delete-address-modal').classList.add('flex');
        }
    
        function closeDeleteModal() {
            document.getElementById('delete-address-modal').classList.remove('flex');
            document.getElementById('delete-address-modal').classList.add('hidden');
        }
    </script>
</div>
@endsection