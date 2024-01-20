<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            商品一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-5">
                    <x-flash-message status="info" />
                </div>
                <div class="w-5/6 mx-auto pt-5">
                    <form action="{{route('user.items.index')}}" method="get" class="flex justify-between">
                        @csrf
                        <div class="w-full">
                            <div><label for="sort" class="leading-7 text-sm text-gray-600">表示順</label></div>
                            <select name="sort" id="sort" class="lg:w-1/4 md:w-2/5 w-2/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="{{\Constant::SORT_ORDER['recommend']}}"
                                    @if(\Request::get('sort') === \Constant::SORT_ORDER['recommend'])
                                        selected
                                    @endif >
                                    おすすめ順
                                </option>
                                <option value="{{\Constant::SORT_ORDER['higher']}}"
                                    @if(\Request::get('sort') === \Constant::SORT_ORDER['higher'])
                                        selected
                                    @endif >
                                    価格が高い順
                                </option>
                                <option value="{{\Constant::SORT_ORDER['lower']}}"
                                    @if(\Request::get('sort') === \Constant::SORT_ORDER['lower'])
                                        selected
                                    @endif >
                                    価格が低い順
                                </option>
                                <option value="{{\Constant::SORT_ORDER['later']}}"
                                    @if(\Request::get('sort') === \Constant::SORT_ORDER['later'])
                                        selected
                                    @endif >
                                    新しい順
                                </option>
                                <option value="{{\Constant::SORT_ORDER['older']}}"
                                    @if(\Request::get('sort') === \Constant::SORT_ORDER['older'])
                                        selected
                                    @endif >
                                    古い順
                                </option>
                            </select>
                        </div>
                        <div>
                            <div><label for="category" class="leading-7 text-sm text-gray-600">カテゴリ</label></div>
                            <select name="category" id="category" class="mb-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="" @if(\Request::get('category') === '0') selected @endif>全て</option>
                                @foreach ($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                    @foreach($category->secondary as $secondary)
                                        <option value="{{ $secondary->id}}" @if(\Request::get('category') == $secondary->id) selected @endif >{{$secondary->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <div class="flex items-end">
                               <input name="keyword" placeholder="キーワードを入力" class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mr-2">
                               <button class="flex whitespace-nowrap text-white bg-indigo-500 border-0 py-2 lg:px-1 px-3 focus:outline-none hover:bg-indigo-600 rounded">検索</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap justify-around">
                    @foreach($products as $product)
                    <div class="w-2/5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-1 my-7">
                        <a href="{{route('user.items.show', ['item' => $product->id])}}">
                            <x-thumbnail filename="{{$product->filename ?? ''}}" type="products" class="rounded-t-lg" />
                        </a>
                        <div class="px-5 pb-5 mt-3">
                            <a href="{{route('user.items.show', ['item' => $product->id])}}">
                                <p class="text-gray-500 text-sm mb-1">{{$product->category}}</p>
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
                            </a>
                            <div class="sm:flex items-center justify-between mt-4">
                                <div class="mb-2">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">¥{{number_format($product->price)}}</span>
                                </div>
                                <a href="{{route('user.items.show', ['item' => $product->id])}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-end mr-8 mb-6">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('sort')
        select.addEventListener('change', function(){
            this.form.submit()
        })
        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change', function(){
            this.form.submit()
        })
    
    </script>
</x-app-layout>
