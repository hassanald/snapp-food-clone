<x-seller>
    <div class="grid w-full gap-6">
        {{--Create--}}
        <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl font-semibold text-center">Edit Restaurant</h2>
            {{--Form--}}
            <form method="post" class="w-3/5 mx-auto" action="{{route('seller.rest.update' , $restaurant->id)}}">
                @method('put')
                @csrf
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

                <x-primary-button class="mt-6">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
</x-seller>

