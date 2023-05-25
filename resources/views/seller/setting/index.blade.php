<x-seller>
    <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
        <h2 class="text-xl mb-6 font-semibold">Restaurant lists</h2>
        @if(count($restaurants) === 0)
            <p class="bg-white px-3 py-2 text-center rounded-lg font-semibold">There is no Restaurant!</p>
        @else
            <div class="relative overflow-x-auto rounded-lg shadow-lg w-full mx-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Account Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($restaurants as $key => $restaurant)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $restaurant->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $restaurant->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $restaurant->address }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $restaurant->acc_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $restaurant->category->title }}
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                <a href="{{route('seller.setting.edit' , $restaurant->id)}}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg">Edit</a>
                                <form method="post" action="#">
                                    @method('put')
                                    @csrf
                                    <button class="bg-gray-500 text-white px-3 py-2 rounded-lg">Close</button>
                                </form>
                                <form method="post" action="#">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$restaurants->links()}}</div>
            </div>
        @endif
    </div>
</x-seller>
