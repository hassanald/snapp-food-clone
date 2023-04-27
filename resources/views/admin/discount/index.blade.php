<x-app-layout>
    <div class="grid grid-cols-6 w-full gap-6">
        {{--Create--}}
        <div class="bg-gray-200 col-span-2 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl font-semibold">Create New Discount</h2>
            {{--Form--}}
            <div class="w-4/5">
                <form method="post" action="{{route('discount.store')}}">
                    @csrf
                    {{--Title--}}
                    <div class="mt-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    {{--Code--}}
                    <div class="mt-6">
                        <x-input-label for="code" :value="__('Discount Code')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" autofocus />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    {{--Discount Percent--}}
                    <div class="mt-6">
                        <x-input-label for="discount_percent" :value="__('Disocunt Percent')" />
                        <x-text-input id="discount_percent" class="block mt-1 w-full" type="text" name="discount_percent" :value="old('discount_percent')" autofocus />
                        <x-input-error :messages="$errors->get('discount_percent')" class="mt-2" />
                    </div>
                    {{--Expired Date--}}
                    <div class="mt-6">
                        <x-input-label for="expired_at" :value="__('Expired Date')" />
                        <x-text-input id="expired_at" class="block mt-1 w-full" type="datetime-local" name="expired_at" :value="old('expired_at')" autofocus />
                        <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-6">
                        {{ __('Create') }}
                    </x-primary-button>
                </form>
            </div>
        </div>

        {{--List--}}
        <div class="bg-gray-200 col-span-4 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl mb-6 font-semibold">Restaurant Category lists</h2>
            @if(count($discounts) === 0)
                <p class="bg-white px-3 py-2 text-center rounded-lg font-semibold">There is no category!</p>
            @else
                <div class="relative overflow-x-auto rounded-lg shadow-lg w-full mx-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount Percent
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Expired Date
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $key => $discount)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $discount->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->code }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->discount_percent }}%
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->expired_at }}
                                </td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <a href="{{route('discount.edit' , $discount->id)}}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg">Edit</a>
                                    <form method="post" action="{{route('discount.destroy' , $discount->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mx-4">{{$discounts->links()}}</div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

