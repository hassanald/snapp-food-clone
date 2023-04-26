@if(session()->has('success'))
    <div class="w-full rounded-lg my-4 bg-green-600 text-white px-4 py-2">
        <p>{{ session('success') }}</p>
    </div>
@endif


@if(session()->has('danger'))
    <div class="w-full rounded-lg my-4 bg-red-600 text-white px-4 py-2">
        <p>{{ session('danger') }}</p>
    </div>
@endif
