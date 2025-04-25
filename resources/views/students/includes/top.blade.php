<div class="student-detailView-head">
    <a href="{{route('students.index')}}" class="goBack">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10.0303 6.46967C10.3232 6.76256 10.3232 7.23744 10.0303 7.53033L6.31066 11.25L14.5 11.25C15.4534 11.25 16.8667 11.5298 18.0632 12.3913C19.298 13.2804 20.25 14.7556 20.25 17C20.25 17.4142 19.9142 17.75 19.5 17.75C19.0858 17.75 18.75 17.4142 18.75 17C18.75 15.2444 18.0353 14.2196 17.1868 13.6087C16.3 12.9702 15.2133 12.75 14.5 12.75L6.31066 12.75L10.0303 16.4697C10.3232 16.7626 10.3232 17.2374 10.0303 17.5303C9.73744 17.8232 9.26256 17.8232 8.96967 17.5303L3.96967 12.5303C3.67678 12.2374 3.67678 11.7626 3.96967 11.4697L8.96967 6.46967C9.26256 6.17678 9.73744 6.17678 10.0303 6.46967Z"
                  fill="black"/>
        </svg>
        Geri
    </a>
    <div class="detailView-head-bottons">
        <a href="{{route('students.edit', $user->id)}}" class="edit_student">Düzəliş et</a>
        <button class="deleteStudent" type="button">Tələbəni sil</button>
        <button class="disableStudent @if(!$user->student_info?->is_active) disabled @endif" type="button"
                data-user-id="{{ $user->id }}">
            @if($user->student_info?->is_active)
                <p class="deactiveTxt">Deaktiv et</p>
            @else
                <p class="activeTxt">Aktiv et</p>
            @endif
        </button>
    </div>
</div>
<div class="student-detailView-head-main">

    <div class="flex flex-col md:flex-row items-center gap-3 p-3 bg-transparent rounded-xl shadow-none">
        <!-- Student Image -->
        <div class="w-16 h-16 rounded-full overflow-hidden border border-gray-300">
            @if($user->image)
                <img src="{{ asset('files/' . $user->image) }}" alt="" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-500 text-xs">
                    No Image
                </div>
            @endif
        </div>

        <!-- Student Info -->
        <div class="flex-1 space-y-1 text-center md:text-left">
            <!-- Full Name and ID -->
            <div>
                <h2 class="text-sm font-semibold text-gray-800">
                    {{ $user->name }} {{ $user->surname }}
                </h2>
                <p class="text-gray-500 text-xs">
                    ID: <span class="font-medium">{{ $user->id }}</span>
                </p>
            </div>

            <!-- Agent and Education Level -->
            <div>
                <h3 class="text-sm font-medium text-gray-700">
                    {{ $user->agent?->agent_info?->company_name ?? 'Agent yoxdur' }}
                    –
                    @if ($user->programs->isNotEmpty() && $user->programs->first()->education_level)
                        {{ $user->programs->first()->education_level->title }}
                    @else
                        <span class="text-gray-500 italic text-xs">Təhsil pilləsi yoxdur</span>
                    @endif
                </h3>
            </div>
        </div>
    </div>

    <!-- Added Time -->
    <p class="addedTime text-gray-500 text-xs mt-2">{{ $user->created_at->format('d.m.Y') }}</p>
</div>
