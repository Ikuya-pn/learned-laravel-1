<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            カート
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-5">
                    <x-flash-message status="info" />
                </div>
                @if(count($products) > 0)
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap justify-around">
                        @foreach($products as $product)
                        <div class="w-2/5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-1 my-7">
                            <a href="{{route('user.items.show', ['item' => $product->id])}}">
                                <x-thumbnail filename="{{$product->firstImage->filename ?? ''}}" type="products" class="rounded-t-lg" />
                            </a>
                            <div class="px-5 pb-5 mt-3">
                                <a href="{{route('user.items.show', ['item' => $product->id])}}">
                                    <p class="text-gray-500 text-sm mb-1">{{$product->secondary->name}}</p>
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
                                </a>
                                <div class="sm:flex items-center justify-between mt-4">
                                    <div class="mb-2 flex justify-between items-end w-full">
                                        <div>
                                            <p class="text-gray-500 text-sm mb-1">{{$product->pivot->quantity}}個</p>
                                            <span class="text-2xl font-bold text-gray-900 dark:text-white">¥{{number_format($product->price * $product->pivot->quantity)}}</span>
                                        </div>
                                        <form id="delete_{{$product->pivot->id}}" method="post" action="{{route('user.cart.destroy', ['item' => $product->pivot->id])}}">
                                            @method('delete')
                                            @csrf
                                            <a href="#" data-id="{{$product->pivot->id}}" onclick="deletePost(this)" class="border-b text-sm border-gray-500 hover:text-gray-300 hover:border-gray-300">削除する</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pr-14 pb-8 text-right"> 
                        <h1 class="text-3xl mb-6">小計: ¥{{number_format($totalPrice)}}</h1>    
                        <button onclick="location.href='{{route('user.cart.checkout')}}'" type="button" class="whitespace-nowrap text-white bg-indigo-500 border-0 py-2 lg:px-1 px-3 focus:outline-none hover:bg-indigo-600 rounded">購入する</button>
                    </div>
                @else
                    <h1 class="p-4">カートに商品が入っていません。</h1>
                @endif

            </div>
        </div>
    </div>
    <script>
        function deletePost(e){
          'use strict';
          if(confirm('本当に削除しますか？')){
            document.getElementById('delete_' + e.dataset.id).submit();
          }
        }
    </script>
</x-app-layout>
