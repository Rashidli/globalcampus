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
        <td class="px-6 py-4 text-center">
            @if($user->agent_info?->insta_url)
                <a href="{{ $user->agent_info->insta_url }}" target="_blank" class="inline-flex items-center justify-center text-pink-600 hover:text-pink-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 mr-1" viewBox="0 0 24 24">
                        <path d="M7.75 2C5.127 2 3 4.127 3 6.75v10.5C3 19.873 5.127 22 7.75 22h8.5C18.873 22 21 19.873 21 17.25V6.75C21 4.127 18.873 2 16.25 2h-8.5zm0 1.5h8.5c1.45 0 2.75 1.3 2.75 2.75v10.5c0 1.45-1.3 2.75-2.75 2.75h-8.5c-1.45 0-2.75-1.3-2.75-2.75V6.25C5 4.8 6.3 3.5 7.75 3.5zm8.25 2.25a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5zM12 7.25a4.75 4.75 0 1 0 0 9.5 4.75 4.75 0 0 0 0-9.5zm0 1.5a3.25 3.25 0 1 1 0 6.5 3.25 3.25 0 0 1 0-6.5z"/>
                    </svg>
                    Bax
                </a>
            @else
                <span class="text-gray-400 italic">Yoxdur</span>
            @endif
        </td>
        <td class=" px-6 py-4 ">
            <div class="agent_icons flex justify-center gap-4 items-center text-center">
                <a href="{{ route('students.index', ['agent_id[]' => $user->id]) }}">
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
