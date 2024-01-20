<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            画像登録
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
                            <form method="post" action="{{route('owner.images.store')}}" enctype="multipart/form-data">
                              @csrf
                              <div class="flex flex-wrap -m-2">              
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
                                        <input type="file" accept="image/png,image/jpeg,image/jpg" id="image" name="files[][image]" multiple class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>          
                                </div>
                                <div class="mt-4 p-2 w-full flex justify-around items-center">
                                  <a href="{{route('owner.images.index')}}" class="border-b border-gray-500 text-gray-600 hover:text-gray-400">戻る</a>
                                  <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>