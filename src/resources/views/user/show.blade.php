<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font overflow-hidden">
                        <div class="container px-5 py-12 mx-auto">
                            <div class="lg:w-4/5 mx-auto flex flex-wrap item-center">
                                <div class="md:w-1/2 flex">
                                    <!-- Slider main container -->
                                    <div class="swiper">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                        <!-- Slides -->
                                            <div class="swiper-slide">
                                                @if ($product->firstImage->filename !== null)
                                                    <img src="{{asset('storage/products/' . $product->firstImage->filename)}}">
                                                @else
                                                    <img src="">
                                                @endif
                                            </div>
                                            <div class="swiper-slide">
                                                @if ($product->secondImage->filename !== null)
                                                    <img src="{{asset('storage/products/' . $product->secondImage->filename)}}">
                                                @else
                                                    <img src="">
                                                @endif
                                            </div>
                                            <div class="swiper-slide">
                                                @if ($product->thirdImage->filename !== null)
                                                    <img src="{{asset('storage/products/' . $product->thirdImage->filename)}}">
                                                @else
                                                    <img src="">
                                                @endif
                                            </div>
                                            <div class="swiper-slide">
                                                @if ($product->fourthImage->filename !== null)
                                                    <img src="{{asset('storage/products/' . $product->fourthImage->filename)}}">
                                                @else
                                                    <img src="">
                                                @endif
                                            </div>
                                        </div>
                                        <!-- If we need pagination -->
                                        <div class="swiper-pagination"></div>
                                    
                                        <!-- If we need navigation buttons -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    
                                        <!-- If we need scrollbar -->
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </div>
                                <div class="lg:w-1/2 w-full lg:pl-10 mt-6 lg:mt-0">
                                    <h2 class="text-sm title-font text-gray-500 tracking-widest mb-2">{{$product->secondary->name}}</h2>
                                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{$product->name}}</h1>
                                    <p class="leading-relaxed">{{$product->information}}</p>
                                    <form method="post" action="{{route('user.cart.add')}}">
                                        @csrf
                                        <div class="w-full flex justify-between mt-6">
                                            <span class="title-font font-medium text-2xl text-gray-900">¥{{number_format($product->price)}}</span>
                                            <div class="w-2/3 flex items-center justify-end">
                                                <label for="quantity" class="leading-7 text-sm text-gray-600 mr-1 whitespace-nowrap">個数</label>
                                                <select name="quantity" id="quantity" class="mr-3 w-1/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @for($i=1; $i<=$quantity; $i++)
                                                        <option value="{{$i}}">
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <button class="flex whitespace-nowrap text-white bg-indigo-500 border-0 py-2 lg:px-1 px-3 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                                <div class="mt-3 w-full text-center">
                                    <div class="border-t  border-gray-400 my-8"></div>
                                    <p class="text-sm">販売元</p>
                                    <h3 class="text-lg">{{$product->shop->name}}</h3>
                                    <div class="text-center w-full my-6">
                                        @if($product->shop->filename !== null)
                                            <img class="w-40 h-40 rounded-full mx-auto object-cover" src="{{asset('storage/shops/' . $product->shop->filename)}}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <button data-micromodal-trigger="modal-1" href='javascript:;' type="buttom" class="whitespace-nowrap text-white bg-gray-400 border-0 py-2 px-3 focus:outline-none hover:bg-gray-300 rounded">店舗詳細</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title text-gray-700" id="modal-1-title">
                {{$product->shop->name}}
              </h2>
              <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
              <p>
                {{$product->shop->information}}
              </p>
            </main>
            <footer class="modal__footer">
              <button type="button" class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
            </footer>
          </div>
        </div>
    </div>
</x-app-layout>


