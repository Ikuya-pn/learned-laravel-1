<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            オーナー編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-7 mx-auto">
                          <x-flash-message status="session('status')" />
                          <div class="flex flex-col text-center w-full mb-8">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">オーナー編集</h1>
                          </div>
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <form method="POST" action="{{route('admin.owners.update', ['owner' => $owner->id])}}">
                                @method('PUT')
                                @csrf
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
                                    <input type="text" id="name" name="name" value="{{old('name', $owner->name)}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                    <input type="email" id="email" name="email" value="{{old('email', $owner->email)}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label class="leading-7 text-sm text-gray-600">店名</label>
                                    <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-100 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-400 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      {{$owner->shop->name}}
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                    <input type="password" id="password" name="password" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="password_confirmation" class="leading-7 text-sm text-gray-600">パスワード確認</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <x-input-error :messages="$errors->get('password-confirmation')" class="mt-2" />
                                  </div>
                                </div>
                                <div class="mt-4 p-2 w-full flex justify-between items-center">
                                  <a href="{{route('admin.owners.index')}}" class="border-b border-gray-500 text-gray-600 hover:text-gray-400">戻る</a>
                                  <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                                </div>
                              </div>
                            </form>
                            <form id="delete_{{$owner->id}}" action="{{route('admin.owners.destroy', ['owner' => $owner->id])}}" method="post">
                              @method('delete')
                              @csrf
                              <div class="mt-8 text-right">
                                <a href="#" data-id="{{$owner->id}}" onclick="deletePost(this)" class="text-white bg-red-500 hover:bg-red-400 py-3 px-8 rounded">削除する</a>
                              </div>
                            </form>
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