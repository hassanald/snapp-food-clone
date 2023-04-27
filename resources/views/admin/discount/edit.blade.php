<x-app-layout>
    <div class="w-3/5 mx-auto bg-gray-200 p-6">
        <div class="w-3/5">
            <form method="post" action="{{route('discount.update' , $discount->id)}}">
                @method('put')
                @csrf
                {{--Title--}}
                <div class="mt-6">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$discount->title}}" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                {{--Code--}}
                <div class="mt-6">
                    <x-input-label for="code" :value="__('Discount Code')" />
                    <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{$discount->code}}" autofocus />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>
                {{--Discount Percent--}}
                <div class="mt-6">
                    <x-input-label for="discount_percent" :value="__('Disocunt Percent')" />
                    <x-text-input id="discount_percent" class="block mt-1 w-full" type="text" name="discount_percent" value="{{$discount->discount_percent}}" autofocus />
                    <x-input-error :messages="$errors->get('discount_percent')" class="mt-2" />
                </div>
                {{--Expired Date--}}
                <div class="mt-6">
                    <x-input-label for="expired_at" :value="__('Expired Date')" />
                    <x-text-input id="expired_at" class="block mt-1 w-full" type="datetime-local" name="expired_at" value="{{$discount->expired_at}}" autofocus />
                    <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
                </div>

                <x-primary-button class="mt-6">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
