<x-seller>
    <div class="grid w-full gap-6">
        {{--Create--}}
        <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl font-semibold text-center">Restaurant Setting</h2>
            {{--Form--}}
            <form method="post" class="w-4/5 mx-auto grid grid-cols-2 gap-x-28" action="{{route('seller.setting.update' , $restaurant->id)}}">
                @method('put')
                @csrf
                <div class="w-4/5">
                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Restaurant Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$restaurant->name}}" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="phone" :value="__('Restaurant Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{$restaurant->phone}}" autofocus />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="address" :value="__('Restaurant Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{$restaurant->address}}" autofocus />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="acc_number" :value="__('Restaurant Account Number')" />
                        <x-text-input id="acc_number" class="block mt-1 w-full" type="text" name="acc_number" value="{{$restaurant->acc_number}}" autofocus />
                        <x-input-error :messages="$errors->get('acc_number')" class="mt-2" />
                    </div>

                    <label id="toggle" class="mt-6 relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_open" value="1" class="sr-only peer" {{$restaurant->is_open ? 'checked' : ''}}>
                        <div class="w-11 h-6 bg-gray-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Open</span>
                    </label>

                    <div class="mt-6">
                        <x-input-label for="restaurant_category_id" :value="__('Category')" />
                        <select class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" name="restaurant_category_id" id="restaurant_category_id">
                            <option value="" disabled selected>Please select a category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" <?= ($restaurant->category->id == $category->id) ? 'selected' : '' ?>>{{$category->title}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('restaurant_category_id')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 w-4/5">
                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="saturday">Saturday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="saturday[from]">From:</label>
                            <input id="saturday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['saturday']['from'] ?? null}}" type="number" name="saturday[from]">
                            <label for="saturday[to]">To:</label>
                            <input id="saturday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['saturday']['to'] ?? null}}" type="number" name="saturday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="sunday">Sunday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="sunday[from]">From:</label>
                            <input id="sunday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['sunday']['from'] ?? null}}" type="number" name="sunday[from]">
                            <label for="sunday[to]">To:</label>
                            <input id="sunday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['sunday']['to'] ?? null}}" type="number" name="sunday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="monday">Monday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="monday[from]">From:</label>
                            <input id="monday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['monday']['from'] ?? null}}" type="number" name="monday[from]">
                            <label for="monday[to]">To:</label>
                            <input id="monday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['monday']['to'] ?? null}}" type="number" name="monday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="tuesday">Tuesday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="tuesday[from]">From:</label>
                            <input id="tuesday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['tuesday']['from'] ?? null}}" type="number" name="tuesday[from]">
                            <label for="tuesday[to]">To:</label>
                            <input id="tuesday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['tuesday']['to'] ?? null}}" type="number" name="tuesday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="wednesday">Wednesday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="wednesday[from]">From:</label>
                            <input id="wednesday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['wednesday']['from'] ?? null}}" type="number" name="wednesday[from]">
                            <label for="wednesday[to]">To:</label>
                            <input id="wednesday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['wednesday']['to'] ?? null}}" type="number" name="wednesday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="thursday">Thursday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="thursday[from]">From:</label>
                            <input id="thursday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['thursday']['from'] ?? null}}" type="number" name="thursday[from]">
                            <label for="thursday[to]">To:</label>
                            <input id="thursday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['thursday']['to'] ?? null}}" type="number" name="thursday[to]">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-6 items-center justify-between">
                        <label for="friday">Friday:</label>
                        <div class="flex gap-2 items-center">
                            <label for="friday[from]">From:</label>
                            <input id="friday[from]" class="rounded-lg w-16 h-8" value="{{$schedule['friday']['from'] ?? null}}" type="number" name="friday[from]">
                            <label for="friday[to]">To:</label>
                            <input id="friday[to]" class="rounded-lg w-16 h-8" value="{{$schedule['friday']['to'] ?? null}}" type="number" name="friday[to]">
                        </div>
                    </div>
                </div>

                <x-primary-button class="mt-6 col-span-2">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
</x-seller>


