<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            画像情報編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-7 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <form method="post" action="{{route('owner.images.update', ['image' => $image->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-wrap -m-2"> 
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="title" class="leading-7 text-sm text-gray-600">画像タイトル</label>
                                            <input type="text" id="title" name="title" value="{{old('title', $image->title)}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>                
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
                                                <input type="file" accept="image/png,image/jpeg,image/jpg" id="image" name="image" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                            </div>          
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative w-1/2 mt-3">
                                                <x-thumbnail type="products" :filename="$image->filename" />
                                            </div>          
                                        </div>
                                        <div class="mt-4 p-2 w-full flex justify-between items-center">
                                            <a href="{{route('owner.images.index')}}" class="border-b border-gray-500 text-gray-600 hover:text-gray-400">戻る</a>
                                            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mt-10 text-right">
                                    <form id="delete_{{$image->id}}" method="post" action="{{route('owner.images.destroy', ['image' => $image->id])}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" data-id="{{$image->id}}" onclick="deletePost(this)" class="border-b border-gray-500 hover:text-gray-300 hover:border-gray-300">削除する</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </section>

                </div>
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