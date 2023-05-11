<x-seller>
    <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-xl mb-6 font-semibold">Orders lists</h2>
            <div class="">
                <form method="get">
                    <div class="mb-4">
                        <select  name="status" class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                            <option value="" disabled selected>Please select a discount</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->title}}" <?= (request('status') == $status->title) ? 'selected' : '' ?>>
                                    {{ucfirst($status->title)}}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-3 py-2 text-white bg-blue-600 rounded-lg">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        @if(count($orders) === 0)
            <p class="bg-white px-3 py-2 text-center rounded-lg font-semibold">There is no order!</p>
        @else
            <div class="relative overflow-x-auto rounded-lg shadow-lg w-full mx-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Restaurant
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Items
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $order->restaurant->name }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach($order->orderItems as $orderItem)
                                    |{{ ucfirst($orderItem->food->name) }}|
                                @endforeach
                            </td>
                            <td class="px-6 py-4 flex">
                                {{ $order->price }}$
                            </td>
                            <td class="px-6 py-4">
                                {{ ucfirst($order->status->title)}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->user->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->address->address }}
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                <form method="post" action="">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$orders->links()}}</div>
            </div>
        @endif
    </div>
</x-seller>
