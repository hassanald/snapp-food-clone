<x-seller>
    <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
        <h2 class="text-xl mb-6 font-semibold">Restaurant lists</h2>
        @if(count($foods) === 0)
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
                            Raw Materials
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Discount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Food Party
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Restaurant
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($foods as $key => $food)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $food->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $food->raw_materials }}
                            </td>
                            <td class="px-6 py-4 flex">
                                <p class="<?= $food->discount ? 'text-red-500' : '' ?>">{{$food->price }}$</p>@if($food->discount)|{{$food->price - $food->price * ($food->discount->discount_percent /100)}}$ @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $food->is_party ? 'Active' : 'Not active'}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $food->discount->title ?? '-' }} | {{$food->discount->discount_percent ?? '-'}}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $food->category->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $food->restaurant->name }}
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                <a href="{{route('seller.food.edit' , $food->id)}}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg">Edit</a>
                                <form method="post" action="{{route('seller.food.destroy' , $food->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$foods->links()}}</div>
            </div>
        @endif
    </div>
</x-seller>

