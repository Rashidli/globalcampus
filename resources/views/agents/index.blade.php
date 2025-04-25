@extends('layouts.master')
@section('title', 'Agentlər')

@section('content')
   <div class="flex justify-between my-[10px] items-center mt-[20px]">
       <a href="{{route('agents.create')}}" class="addNewAgent !mt-0 mb-0">
           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M12 5V19" stroke="#1661C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M5 12H19" stroke="#1661C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
           </svg>
           Əlavə et
       </a>
   </div>
    <div class="agents-head  !mt-[23px]">
        <form action="{{ route('agents.index') }}" method="get">

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">

                <input type="text" name="name" placeholder="Ad soyad" value="{{request('name')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                <input type="text" name="email" placeholder="Email" value="{{request('email')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                <input type="text" name="phone" placeholder="Telefon" value="{{request('phone')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <input type="text" name="company_name" placeholder="Şirkət adı" value="{{request('company_name')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <div class="flex gap-4">
                    <a href="{{route('agents.index')}}"
                       class=" flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
               font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Sıfırla
                    </a>
                </div>
                <button type="submit"
                        class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
                    font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                    Filtrlə
                </button>
                <p class="resultCount"><span>{{$users->total()}}</span> Nəticə</p>
            </div>
        </form>
    </div>
    <br>
    <div class="relative overflow-x-auto shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-4">Şirkətin adı</th>
                <th scope="col" class="px-6 py-4">Ad Soyad</th>
                <th scope="col" class="px-6 py-4">Email</th>
                <th scope="col" class="px-6 py-4">Mobil nömrə</th>
                <th scope="col" class="px-6 py-4">Pin</th>
                <th scope="col" class="px-6 py-4">Tələbə sayı</th>
                <th scope="col" class="px-6 py-4 text-center">Digər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        @if($user->image)
                            <img class="w-10 h-10 rounded-full" src="{{asset('files/' . $user->image)}}"
                                 alt="{{ $user->agent_info?->company_name }}">
                        @endif
                        <div class="ps-3">
                            <div class="text-base font-semibold break-words whitespace-normal">
                                {{ $user->agent_info?->company_name }}
                            </div>
                        </div>

                    </th>
                    <td class="px-6 py-4">{{$user->name}} {{$user->surname}}</td>
                    <td class="px-6 py-4">{{$user->email}}</td>
                    <td class="px-6 py-4">{{$user->phone}}</td>
                    <td class="px-6 py-4 text-center">
                        <form method="POST" action="{{ route('agents.pin', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-lg">
                                {{ $user->pinned_at ? '📌' : '📍' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center">{{$user->students_count}}</td>
                    <td class=" px-6 py-4 ">
                        <div class="agent_icons flex justify-center gap-4 items-center text-center">
                            <a href="{{ route('students.index', ['agent_id' => $user->id]) }}">
                                <img src="{{ asset('/') }}assets/images/eye.svg" alt="">
                            </a>
                            <a href="{{route('agents.edit', $user->id)}}">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </a>
                            <form action="{{route('agents.destroy', $user->id)}}" method="post">
                                {{ method_field('DELETE') }}
                                @csrf
                                <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')">
                                    <img src="{{ asset('/') }}assets/images/trash.svg" alt="">
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <x-pagination :paginator="$users"/>

@endsection

