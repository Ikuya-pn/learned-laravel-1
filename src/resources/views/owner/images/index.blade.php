<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            画像一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <x-flash-message status="info" />
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-around flex-wrap">
                    @foreach($images as $image)          
                        <div class="bg-white rounded-lg w-1/3 m-4">
                            <a href="{{route('owner.images.edit', ['image' => $image->id])}}">
                                <x-thumbnail :filename="$image->filename" type="products" class="rounded-lg" />
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="flex mt-4 lg:w-2/3 w-full mx-auto pr-8 pb-8">
                    <button onclick="location.href='{{route('owner.images.create')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">画像登録</button>
                </div>
                {{$images->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
