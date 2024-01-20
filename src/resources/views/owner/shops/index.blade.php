<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            店舗情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($shops as $shop)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{route('owner.shops.edit', ['shop' => $shop->id])}}">
                             <x-thumbnail :filename="$shop->filename" type="shops" />
                        </a>
                        <div class="p-5">
                            <a href="{{route('owner.shops.edit', ['shop' => $shop->id])}}">
                                <div class="mb-2">
                                    @if($shop->is_selling)
                                        <span class="border px-2 py-1 rounded-md bg-blue-400 text-white text-sm">販売中</span>
                                    @else
                                        <span class="border px-2 py-1 rounded-md bg-red-400 text-white text-sm">停止中</span>
                                    @endif
                                </div>
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$shop->name}}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$shop->information}}</p>
                            <div class="text-right">
                                <a href="{{route('owner.shops.edit', ['shop' => $shop->id])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    編集する
                                     <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
