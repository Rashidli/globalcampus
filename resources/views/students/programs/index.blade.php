@extends('layouts.master')
@section('title', 'Tələbələr')

@section('content')
    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <br>
        @foreach($programs as $key => $program)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <!-- Program Header -->
                <button
                    onclick="toggleProgram({{ $program->id }})"
                    class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition duration-300"
                >
                    <p class="text-lg font-semibold text-gray-800">{{$key+1}}. {{$program->university_list?->title}}</p>
                    <svg
                        id="program-icon-{{ $program->id }}"
                        class="w-6 h-6 text-gray-800 transform transition-transform duration-300"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Program Details -->
                <div id="program-details-{{ $program->id }}" class="p-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 gap-y-3 mb-6">
                        <div class="text-left font-medium">Ölkə:</div>
                        <div class="text-left font-bold">{{$program->country?->title}}</div>

                        <div class="text-left font-medium">Universitet:</div>
                        <div class="text-left font-bold">{{$program->university_list?->title}}</div>

                        <div class="text-left font-medium">Təhsil pilləsi:</div>
                        <div class="text-left font-bold">{{$program->education_level?->title}}</div>

                        <div class="text-left font-medium">İxtisas:</div>
                        <div class="text-left font-bold">{{$program->tariff?->profession->title}}</div>

                        <div class="text-left font-medium">Təhsil haqqı:</div>
                        <div class="text-left font-bold">{{$program->price}}</div>

                        <div class="text-left font-medium">Dönəm:</div>
                        <div class="text-left font-bold">{{$program->period?->title}}</div>

                        <div class="text-left font-medium">Cari Status:</div>
                        <div class="text-left font-bold">{{$program->program_status?->title}}</div>

                        <div class="text-left font-medium">App no:</div>
                        <div class="text-left font-bold">{{$program->app_no}}</div>

                        <div class="text-left font-medium">Başvuru tarixi:</div>
                        <div class="text-left font-bold">{{$program->application_date}}</div>

                        <div class="text-left font-medium">Nəticə tarixi:</div>
                        <div class="text-left font-bold">{{$program->result_date}}</div>

                        <div class="text-left font-medium">Qeyd:</div>
                        <div class="text-left font-bold">{{$program->note}}</div>

                        @if($program->education_level?->description)
                            <div class="text-left font-medium">Açıqlama:</div>
                            <div class="text-left font-bold">{{$program->education_level?->description}}</div>
                        @endif

                        <div class="text-left font-medium">Edit:</div>
                        <div class="text-left font-bold">
                            <a href="{{route('programs.edit', $program->id)}}" class="hover:bg-gray-100 rounded">
                                <img src="{{asset('/')}}assets/images/pen.svg" alt="Edit" class="w-5 h-5">
                            </a>
                        </div>

                        <div class="text-left font-medium">Delete:</div>
                        <div class="text-left font-bold">
                            <form action="{{ route('programs.destroy', $program->id) }}" method="post">
                                {{ method_field('DELETE') }}
                                @csrf
                                <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" class="hover:bg-gray-100 rounded">
                                    <img src="{{ asset('/') }}assets/images/trash.svg" alt="Delete" class="w-5 h-5">
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Status History Section -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status Tarixçəsi
                            </h3>
                            <button
                                onclick="toggleAddStatusForm({{ $program->id }})"
                                class="flex items-center text-sm bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Yeni Status Əlavə Et
                            </button>
                        </div>

                        <!-- Add New Status Form (Hidden by default) -->
                        <div id="add-status-form-{{ $program->id }}" class="hidden mb-8 bg-white p-6 rounded-xl shadow-md border border-gray-100">
                            <form action="{{ route('program-status.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="program_id" value="{{ $program->id }}">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                                        <select name="program_status_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                            <option value="">Seçin</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

{{--                                    <div class="space-y-2">--}}
{{--                                        <label class="block text-sm font-medium text-gray-700">Tarix <span class="text-red-500">*</span></label>--}}
{{--                                        <input type="date" name="created_at" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" value="{{ now()->format('Y-m-d') }}">--}}
{{--                                    </div>--}}

                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Fayl</label>
                                        <div class="flex items-center justify-center w-full">
                                            <label for="dropzone-file-{{ $program->id }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Faylı seçin</span> və ya buraya sürükləyin</p>
                                                    <p class="text-xs text-gray-500">pdf,doc,docx,jpg,png (Maksimum 5MB)</p>
                                                </div>
                                                <input id="dropzone-file-{{ $program->id }}" type="file" name="file" class="hidden" />
                                            </label>
                                        </div>
                                    </div>

                                    <div class="md:col-span-2 space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Qeyd</label>
                                        <textarea name="note" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Əlavə qeydlər..."></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end space-x-4">
                                    <button
                                        type="button"
                                        onclick="toggleAddStatusForm({{ $program->id }})"
                                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200"
                                    >
                                        Ləğv et
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
                                    >
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Yadda Saxla
                    </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Status History Timeline -->
                        <div class="relative">
                            <div class="absolute left-5 h-full w-0.5 bg-gray-200"></div>

                            @forelse($program->statuses as $history)
                                <div class="relative pl-8 pb-6 group">
                                    <!-- Timeline dot -->
                                    <div class="absolute left-0 top-2 flex items-center justify-center w-5 h-5 rounded-full bg-white border-4 border-blue-500 z-10 transform group-hover:scale-125 transition-transform duration-200">
                                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                    </div>

                                    <!-- Status card -->
                                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-100 transition-all duration-300">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <span class="font-semibold text-gray-800">{{ $history->title }}</span>
                                                <span class="text-xs text-gray-500 ml-2 bg-gray-100 px-2 py-1 rounded-full">
                                {{ \Carbon\Carbon::parse($history->pivot->created_at)->format('d.m.Y H:i') }}
                            </span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                @if($history->pivot->file_path)
                                                    <a
                                                        href="{{ asset('storage/' . $history->pivot->file_path) }}"
                                                        target="_blank"
                                                        class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition duration-200"
                                                        title="Fayla bax"
                                                    >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                                        </svg>
                                                    </a>
                                                @endif
                                                {{--                                                <button--}}
                                                {{--                                                    onclick="toggleEditStatusForm({{ $history->pivot->id }})"--}}
                                                {{--                                                    class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition duration-200"--}}
                                                {{--                                                    title="Düzəliş et"--}}
                                                {{--                                                >--}}
                                                {{--                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                                                {{--                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>--}}
                                                {{--                                                    </svg>--}}
                                                {{--                                                </button>--}}
                                                <form
                                                    action="{{ route('program-status.destroy', ['program' => $program->id, 'status' => $history->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bu statusu silmək istədiyinizə əminsiniz?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-full transition duration-200"
                                                        title="Sil"
                                                    >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        @if($history->pivot->note)
                                            <div class="mt-3 text-sm text-gray-600 bg-gray-50 p-3 rounded-lg border-l-4 border-blue-500">
                                                <div class="flex">
                                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p>{{ $history->pivot->note }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($history->pivot->file_path)
                                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                <a href="{{ asset('storage/' . $history->pivot->file_path) }}" target="_blank" class="text-blue-500 hover:underline">
                                                    {{ basename($history->pivot->file_path) }}
                                                </a>
                                            </div>
                                        @endif

                                        <!-- Edit Status Form (Hidden by default) -->
                                        <div id="edit-status-form-{{ $history->id }}" class="hidden mt-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                            <form action="{{ route('program-status.update', ['program' => $program->id, 'status' => $history->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="space-y-2">
                                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                                        <select name="program_status_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                                            @foreach($statuses as $status)
                                                                <option value="{{ $status->id }}" {{ $history->id == $status->id ? 'selected' : '' }}>{{ $status->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="space-y-2">
                                                        <label class="block text-sm font-medium text-gray-700">Tarix</label>
                                                        <input type="date" name="created_at" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                                               value="{{ \Carbon\Carbon::parse($history->pivot->created_at)->format('Y-m-d') }}">
                                                    </div>

                                                    <div class="md:col-span-2 space-y-2">
                                                        <label class="block text-sm font-medium text-gray-700">Yeni Fayl</label>
                                                        <input type="file" name="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                                        @if($history->pivot->file_path)
                                                            <p class="text-xs text-gray-500 mt-1">Cari fayl:
                                                                <a href="{{ asset('storage/' . $history->pivot->file_path) }}" target="_blank" class="text-blue-500 hover:underline">
                                                                    {{ basename($history->pivot->file_path) }}
                                                                </a>
                                                            </p>
                                                        @endif
                                                    </div>

                                                    <div class="md:col-span-2 space-y-2">
                                                        <label class="block text-sm font-medium text-gray-700">Qeyd</label>
                                                        <textarea name="note" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">{{ $history->pivot->note }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="mt-4 flex justify-end space-x-3">
                                                    <button
                                                        type="button"
                                                        onclick="toggleEditStatusForm({{ $history->pivot->id }})"
                                                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200"
                                                    >
                                                        Ləğv et
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
                                                    >
                                                        Yenilə
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-700 mb-1">Status tarixçəsi tapılmadı</h4>
                                    <p class="text-gray-500">Bu proqram üçün heç bir status qeydə alınmayıb</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <br>
        <a class="addUniBoxBtn" href="{{route('programs.create', $user->id)}}">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </a>
    </div>

    <!-- Delete Student Modal -->
    <div class="deleteStudentModal">
        <div class="deleteStudentBox">
            <button class="closeDeleteStudentModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <h2>Tələbəni silməyə əminsən?</h2>
            <p>Silinən məlumatı geri qaytarmaq mümkün deyil</p>
            <div class="deleteStudentBox-buttons">
                <form action="{{route('students.destroy', $user->id)}}" method="post">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="deleteStudent_yes">Bəli, sil</button>
                </form>
                <button class="deleteStudent_no" type="button">Xeyir, silmə</button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Toggle program details
        function toggleProgram(programId) {
            const details = document.getElementById(`program-details-${programId}`);
            const icon = document.getElementById(`program-icon-${programId}`);

            if (details && icon) {
                details.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }
        }

        // Toggle add status form
        function toggleAddStatusForm(programId) {
            const form = document.getElementById(`add-status-form-${programId}`);

            if (form) {
                form.classList.toggle('hidden');

                // Scroll to form if showing
                if (!form.classList.contains('hidden')) {
                    form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }
        }

        // Toggle edit status form
        function toggleEditStatusForm(statusId) {
            const form = document.getElementById(`edit-status-form-${statusId}`);

            if (form) {
                form.classList.toggle('hidden');

                // Scroll to form if showing
                if (!form.classList.contains('hidden')) {
                    form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }
        }

        // Initialize - hide all program details by default
        {{--document.addEventListener('DOMContentLoaded', function() {--}}
        {{--    @foreach($programs as $program)--}}
        {{--    const programDetails = document.getElementById(`program-details-{{ $program->id }}`);--}}
        {{--    if (programDetails) {--}}
        {{--        programDetails.classList.add('hidden');--}}
        {{--    }--}}
        {{--    @endforeach--}}
        {{--});--}}
    </script>
@endpush
