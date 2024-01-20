<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            オーナー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 py-7 mx-auto">
                          <x-flash-message status="info" />
                          <div class="flex flex-col text-center w-full mb-8">
                            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">オーナー一覧</h1>
                          </div>
                          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">氏名</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">登録日</th>
                                  <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($owners as $owner)
                                <tr>
                                  <td class="md:px-4 py-3">{{$owner->name}}</td>
                                  <td class="md:px-4 py-3">{{$owner->email}}</td>
                                  <td class="md:px-4 py-3">{{$owner->created_at->diffForHumans()}}</td>
                                  <td class="md:px-4 py-3">
                                    <a href="{{route('admin.owners.edit',['owner' => $owner->id])}}" class="whitespace-nowrap bg-blue-400 py-1 px-3 rounded hover:bg-blue-300 text-sm text-white">編集</a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                            <button onclick="location.href='{{route('admin.owners.create')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</button>
                          </div>
                          <div class="mt-8">
                            {{$owners->links()}}
                          </div>
                        </div>
                      </section>       

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
