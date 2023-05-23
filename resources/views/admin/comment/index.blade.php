<x-app-layout>
    <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
        <h2 class="text-xl mb-6 font-semibold">Comment lists</h2>
        <div class="">
            <form method="get" class="flex gap-0.5">
                <div class="mb-4">
                    <select name="restaurant" class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                        <option value="" disabled selected>Please select a Restaurant</option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->name}}" <?= (request('restaurant') == $restaurant->name) ? 'selected' : '' ?>>
                                {{ucfirst($restaurant->name)}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <select name="status" class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                        <option value="" disabled selected>Please select a Status</option>
                        <option value="pending" <?= (request('status') == 'pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="approve" <?= (request('status') == 'approve') ? 'selected' : '' ?>>Approve</option>
                        <option value="delete-req" <?= (request('status') == 'delete-req') ? 'selected' : '' ?>>Delete Request</option>
                    </select>
                    <button type="submit" class="px-3 py-2 text-white bg-blue-600 rounded-lg">Filter</button>
                </div>
            </form>
        </div>
        @if(count($comments) === 0)
            <p class="bg-white px-3 py-2 text-center rounded-lg font-semibold">There is no Comments!</p>
        @else
            <div class="relative overflow-x-auto rounded-lg shadow-lg w-full mx-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Content
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Answer
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cart
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Restaurant
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $key => $comment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $comment->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $comment->content }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $comment->answer ?? 'No answer' }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach($comment->cart->cartItems as $item)
                                    @if($loop->count > 1 && $loop->iteration % 2 != 0)
                                        {{ $item->food->name }} |
                                    @else
                                        {{ $item->food->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $comment->cart->restaurant->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if($comment->status === \App\Models\Comment::PENDING)
                                    <p class="bg-yellow-500 text-center px-3 py-2 rounded-lg text-white">Pending</p>
                                @elseif($comment->status === \App\Models\Comment::APPROVE)
                                    <p class="bg-green-500 text-center px-3 py-2 rounded-lg text-white">Approved</p>
                                @else
                                    <p class="bg-pink-500 text-center px-3 py-2 rounded-lg text-white">Delete Request</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                <form method="post" action="{{route('admin.comment.delete' , $comment->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$comments->links()}}</div>
            </div>
        @endif
    </div>
</x-app-layout>
