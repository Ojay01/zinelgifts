<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-white">Edit Category</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-800 rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-white mb-2">Category Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $category->name) }}"
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-white mb-2">Description (Optional)</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2"
                >{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-white mb-2">Category Image (Optional)</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image"
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2"
                >
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if($category->image)
                    <div class="mt-2">
                        <p class="text-white mb-2">Current Image:</p>
                        <img 
                            src="{{ Storage::url($category->image) }}" 
                            alt="{{ $category->name }}" 
                            class="h-32 w-auto rounded"
                        >
                    </div>
                @endif
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>