<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Items
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Total Price
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                        {{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                        <ul class="list-disc pl-5">
                                            @foreach($order->items as $item)
                                                <li>{{ $item['name'] }} × {{ $item['quantity'] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                        ₦{{ number_format($order->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($order->status == 'uncompleted')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Uncompleted
                                            </span>
                                        @elseif($order->status == 'in_progress')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 flex gap-2">
                                        @if($order->status == 'uncompleted')
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="submit" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                    Mark In Progress
                                                </button>
                                            </form>
                                        @elseif($order->status == 'in_progress')
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                    Mark Completed
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                        No orders yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
