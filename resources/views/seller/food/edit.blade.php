<x-seller>
    <div class="grid w-full gap-6">
        {{--Create--}}
        <div class="bg-gray-200 shadow-xl w-full p-6 rounded-lg">
            <h2 class="text-xl font-semibold text-center">Edit Food</h2>
            {{--Form--}}
            <form method="post" class="w-3/5 mx-auto" action="{{route('seller.food.update' , $food->id)}}">
                @method('put')
                @csrf
                <div class="mt-6">
                    <x-input-label for="name" :value="__('Food Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$food->name}}" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="raw_materials" :value="__('Raw Materials')" />
                    <x-text-input id="raw_materials" class="block mt-1 w-full" type="text" name="raw_materials" value="{{$food->raw_materials}}" autofocus />
                    <x-input-error :messages="$errors->get('raw_materials')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-2/5" type="text" name="price" value="{{$food->price}}" autofocus />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="discount_id" :value="__('Discount (optional)')" />
                    <select class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" name="discount_id" id="discount_id">
                        <option value="{{null}}">Please select a discount</option>
                        @foreach($discounts as $discount)
                            <option value="{{$discount->id}}" <?= ($food->discount && $food->discount->id == $discount->id) ? 'selected' : '' ?>>
                                {{$discount->title}} : {{$discount->discount_percent}} %
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('discount_id')" class="mt-2" />
                </div>

                <label id="toggle" class="mt-4 relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_party" value="1" <?= $food->is_party ? 'checked' : '' ?> class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Food Party</span>
                </label>

                <div class="mt-6">
                    <x-input-label for="food_category_id" :value="__('Category')" />
                    <select class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" name="food_category_id" id="food_category_id">
                        <option value="" disabled selected>Please select a category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" <?= ($food->category->id == $category->id) ? 'selected' : '' ?>>{{$category->title}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('food_category_id')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="restaurant_id" :value="__('Restaurant')" />
                    <select class="border-gray-300 mt-1 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" name="restaurant_id" id="restaurant_id">
                        <option value="" disabled selected>Please select a restaurant</option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" <?= ($food->restaurant->id == $restaurant->id) ? 'selected' : '' ?>>{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('restaurant_id')" class="mt-2" />
                </div>

                <x-primary-button class="mt-6">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
</x-seller>
<script>
    $( document ).ready(function() {
        const discount = '{{$food->discount}}'
        if(discount === ''){
            $('#toggle').hide()
        }else {
            $('#toggle').show()
        }

        $('#discount_id').on('change' , function (){
            $('#toggle').show()
        })
    });
</script>
