<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            店舗情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-5">
                    <x-flash-message status="info" />
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap justify-around">
                    @foreach($owner->shop->product as $product)
                    <div class="w-2/5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-1 my-7">
                        <a href="{{route('owner.products.edit', ['product' => $product->id])}}">
                            <x-thumbnail filename="{{$product->firstImage->filename ?? ''}}" type="products" />
                        </a>
                        <div class="px-5 pb-5 mt-3">
                            <a href="{{route('owner.products.edit', ['product' => $product->id])}}">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
                            </a>
                            <div class="sm:flex items-center justify-between mt-4">
                                <div class="mb-2">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">¥{{$product->price}}</span>
                                </div>
                                <a href="{{route('owner.products.edit', ['product' => $product->id])}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">編集する</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex mt-4 lg:w-2/3 w-full mx-auto pr-8 pb-8">
                    <button onclick="location.href='{{route('owner.products.create')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">商品登録</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
