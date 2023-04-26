<x-app-layout>
    <div class="w-3/5 mx-auto bg-gray-200 p-6">
        <div class="w-3/5">
            <form method="post" action="{{route('rest.cat.update' , $category->id)}}">
                @method('put')
                @csrf
                <div class="mt-6">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$category->title}}" autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <x-primary-button class="mt-6">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
