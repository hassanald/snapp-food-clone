<x-seller>
    <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
        <h2 class="text-xl mb-6 font-semibold">Comment lists</h2>
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
                                @if(!$comment->answer)
                                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                       Reply
                                    </button>

                                    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="px-6 py-6 lg:px-8">
                                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Send your response</h3>
                                                    <form class="space-y-6" action="{{route('seller.comment.response' , $comment->id)}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div>
                                                            <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Response</label>
                                                            <input type="text" name="answer" id="answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Write something">
                                                        </div>
                                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    {{ $comment->answer }}
                                @endif
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
                            <td class="px-6 py-4 flex justify-center gap-2">
                                @if($comment->status !== \App\Models\Comment::DELETE_REQ)
                                    @if($comment->status === \App\Models\Comment::PENDING)
                                        <form method="post" action="{{route('seller.comment.approve' , $comment->id)}}">
                                            @method('put')
                                            @csrf
                                            <button class="bg-blue-500 text-white px-3 py-2 rounded-lg">Approve</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('seller.comment.pending' , $comment->id)}}">
                                            @method('put')
                                            @csrf
                                            <button class="bg-yellow-500 text-white px-3 py-2 rounded-lg">Pending</button>
                                        </form>
                                    @endif
                                    @if($comment->status !== \App\Models\Comment::DELETE_REQ)
                                        <form method="post" action="{{route('seller.comment.deleteReq' , $comment->id)}}">
                                            @method('put')
                                            @csrf
                                            <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete Request</button>
                                        </form>
                                    @endif
                                @else
                                    <p class="text-red-600">Delete Request has been sent!</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$comments->links()}}</div>
            </div>
        @endif
    </div>
</x-seller>
