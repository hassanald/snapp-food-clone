<x-app-layout>
    <div class="grid grid-cols-6 w-full gap-6">
        {{--Create--}}
        <div class="bg-gray-200 col-span-2 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl font-semibold">Create New Food Category</h2>
            {{--Form--}}
            <div class="w-3/5">
                <form method="post" action="{{route('food.cat.store')}}">
                    @csrf
                    <div class="mt-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-6">
                        {{ __('Create') }}
                    </x-primary-button>
                </form>
            </div>
        </div>

        {{--List--}}
        <div class="bg-gray-200 col-span-4 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl mb-6 font-semibold">Food Category lists</h2>
            @if(count($categories) === 0)
                <p class="bg-white px-3 py-2 text-center rounded-lg font-semibold">There is no category!</p>
            @else
            <div class="relative overflow-x-auto rounded-lg shadow-lg w-3/4 mx-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $category->title }}
                                </td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <a href="{{route('food.cat.edit' , $category->id)}}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg">Edit</a>
                                    <form method="post" action="{{route('food.cat.destroy' , $category->id)}}">
                                        @csrf
                                        <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mx-4">{{$categories->links()}}</div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
