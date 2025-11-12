<x-app-layout> 
    <x-slot name="header"> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> 
            {{ __('All Foods') }} 
        </h2> 
    </x-slot>

    <!-- Bootstrap Container -->
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Foods</h4>
                <a href="{{ route('foods.create') }}" class="btn btn-light btn-sm">+ Add New Food</a>
            </div>

            <div class="card-body bg-light">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price (₦)</th>
                                <th>Category</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($foods as $food)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($food->image)
                                            <img src="{{ asset('storage/' . $food->image) }}" width="70" height="70" class="rounded shadow-sm" style="object-fit:cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $food->description }}</td>
                                    <td><strong>₦{{ number_format($food->price, 2) }}</strong></td>
                                    <td>
                                        {{ $food->category ? $food->category->name : '—' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('foods.destroy', $food->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this food?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No food items added yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
