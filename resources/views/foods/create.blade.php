<x-app-layout> 
    <x-slot name="header"> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> 
            {{ __('Add New Food') }} 
        </h2> 
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Category --}}
                    <div class="mb-4">
                        <label for="category_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Category
                        </label>
                        <select name="category_id" id="category_id" 
                                class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Food Name --}}
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Food Name
                        </label>
                        <input type="text" name="name" id="name" 
                               class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="Enter food name" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3" 
                                  class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                  placeholder="Enter food description (Optional)"></textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label for="price" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Price (₦)
                        </label>
                        <input type="number" name="price" id="price" step="0.01" 
                               class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="Enter price" required>
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label for="image" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Food Image
                        </label>
                        <input type="file" name="image" id="image" 
                               class="w-full mt-1 text-gray-800 dark:text-gray-100">
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow">
                            Save Food
                        </button>
                        <a href="{{ route('foods.index') }}" 
                           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
