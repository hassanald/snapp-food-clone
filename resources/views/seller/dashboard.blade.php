<x-seller>
    <div class="p-4">
        <h1 class="text-xl font-semibold mb-4">Dashboard</h1>
        <div class="grid grid-cols-6 gap-x-4 gap-y-4">
            <div class="col-span-1 grid grid-cols-1 bg-gray-100 p-3 rounded-lg shadow-lg">
                <p class="text-xl font-semibold">Orders</p>
                <p class="font-semibold justify-self-end">{{$ordersCount}}</p>
            </div>
            <div class="col-span-1 grid grid-cols-1 bg-gray-100 p-3 rounded-lg shadow-lg">
                <p class="text-xl font-semibold">Income</p>
                <p class="font-semibold justify-self-end">{{$income}} $</p>
            </div>
            <div class="col-start-4 col-end-7 grid grid-cols-1 p-3">
                <form method="get">
                    <div class="mb-4 flex gap-0.5">
                        <select name="restaurant" class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                            <option value="" disabled selected>Please select a restaurant</option>
                            @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->name}}" <?= (request('restaurant') == $restaurant->name) ? 'selected' : '' ?>>
                                    {{ucfirst($restaurant->name)}}
                                </option>
                            @endforeach
                        </select>
                        <select name="status" class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                            <option value="" disabled selected>Please select a Status</option>
                            <option value="reject" <?= (request('status') == 'reject') ? 'selected' : '' ?>>Reject</option>
                            <option value="pending" <?= (request('status') == 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="preparing" <?= (request('status') == 'preparing') ? 'selected' : '' ?>>Preparing</option>
                            <option value="delivering" <?= (request('status') == 'delivering') ? 'selected' : '' ?>>Delivering</option>
                            <option value="delivered" <?= (request('status') == 'delivered') ? 'selected' : '' ?>>Delivered</option>
                        </select>
                        <button type="submit" class="px-3 py-2 text-white bg-blue-600 rounded-lg">Filter</button>
                    </div>
                </form>
            </div>
            <div class="col-span-6 bg-gray-100 p-3 rounded-lg shadow-lg">
                <h2 class="text-base text-gray-500 font-semibold p-3">Orders</h2>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mx-4">{{$orders->links()}}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-seller>
