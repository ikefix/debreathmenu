<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Food') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h3>Edit Food Item</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Do NOT use @method('PUT') since your route uses POST --}}
            
            <div class="mb-3">
                <label for="name" class="form-label">Food Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $food->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $food->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (₦)</label>
                <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $food->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Current Image</label><br>
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" width="100" height="100" style="object-fit:cover;"><br><br>
                @endif
                <label for="image" class="form-label">Change Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Update Food</button>
            <a href="{{ route('foods.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
