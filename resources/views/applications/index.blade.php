@extends('layouts.master')
@section('title', 'Başvurular')

@section('content')

    <div class="agents-head !mt-[23px]">
        <form action="{{ route('applications.index') }}" method="get" style="width: 100%">

            <div
                class="grid grid-cols-1 items-start md:grid-cols-2 lg:grid-cols-5 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">

                {{--                <!-- Ad Input with Label -->--}}
                {{--                <div>--}}
                {{--                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Ad</label>--}}
                {{--                    <input type="text" id="name" name="name" placeholder="Ad" value="{{ request('name') }}"--}}
                {{--                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">--}}
                {{--                </div>--}}

                {{--                <!-- Soyad Input with Label -->--}}
                {{--                <div>--}}
                {{--                    <label for="surname" class="block text-sm font-medium text-gray-700 dark:text-white">Soyad</label>--}}
                {{--                    <input type="text" id="surname" name="surname" placeholder="Soyad" value="{{ request('surname') }}"--}}
                {{--                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">--}}
                {{--                </div>--}}

                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-white">Tələbə
                        seçin</label>
                    <select name="user_id[]" multiple id="user_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        @foreach($users as $user)
                            <option
                                value="{{ $user->id }}" {{ collect(request('user_id'))->contains($user->id) ? 'selected' : '' }}>
                                {{ $user->name . ' '. $user->surname }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Ölkə Select with Label -->
                <div>
                    <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-white">Ölkə
                        seçin</label>
                    <select name="country_id[]" multiple id="country_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">Ölkə seçin</option>
                        @foreach($countries as $country)
                            <option
                                value="{{ $country->id }}" {{ collect(request('country_id'))->contains($country->id) ? 'selected' : '' }}>
                                {{ $country->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Agent Select with Label -->
                <div>
                    <label for="agent_id" class="block text-sm font-medium text-gray-700 dark:text-white">Agent
                        seçin</label>
                    <select name="agent_id[]" multiple id="agent_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1"
                            @if(auth()->user()->type === \App\Enums\UserType::AGENT->value) disabled @endif>
                        @foreach($agents as $agent)
                            <option
                                value="{{ $agent->id }}" {{ collect(request('agent_id'))->contains($agent->id) ? 'selected' : '' }}>
                                {{ $agent->agent_info?->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Dönəm Select with Label -->
                <div>
                    <label for="period_id" class="block text-sm font-medium text-gray-700 dark:text-white">Dönəm
                        seçin</label>
                    <select name="period_id[]" multiple id="period_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">Dönəm seçin</option>
                        @foreach($periods as $period)
                            <option
                                value="{{ $period->id }}" {{ collect(request('period_id'))->contains($period->id) ? 'selected' : '' }}>
                                {{ $period->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Universitet Select with Label -->
                <div>
                    <label for="university_list_id" class="block text-sm font-medium text-gray-700 dark:text-white">Universitet
                        seçin</label>
                    <select name="university_list_id[]" multiple id="university_list_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">Universitet seçin</option>
                        @foreach($university_lists as $university_list)
                            <option
                                value="{{ $university_list->id }}" {{ collect(request('university_list_id'))->contains($university_list->id) ? 'selected' : '' }}>
                                {{ $university_list->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Təhsil Pilləsi Select with Label -->
                <div>
                    <label for="education_level_id" class="block text-sm font-medium text-gray-700 dark:text-white">Təhsil
                        pilləsi seçin</label>
                    <select name="education_level_id" id="education_level_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">Təhsil pilləsi seçin</option>
                        @foreach($education_levels as $education_level)
                            <option
                                value="{{ $education_level->id }}" {{ $education_level->id == request('education_level_id') ? 'selected' : '' }}>
                                {{ $education_level->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Select with Label -->
                <div>
                    <label for="program_status_id" class="block text-sm font-medium text-gray-700 dark:text-white">Status
                        seçin</label>
                    <select name="program_status_id[]" multiple id="program_status_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">Status seçin</option>
                        @foreach($program_statuses as $program_status)
                            <option
                                value="{{ $program_status->id }}" {{ collect(request('program_status_id'))->contains($program_status->id) ? 'selected' : '' }}>
                                {{ $program_status->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- İxtisas Select with Label -->
                <div>
                    <label for="profession_id" class="block text-sm font-medium text-gray-700 dark:text-white">İxtisas
                        seçin</label>
                    <select name="profession_id[]" multiple id="profession_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white mt-1">
                        <option value="">İxtisas seçin</option>
                    </select>
                </div>

                <!-- Filter Buttons and Reset -->
                <div class="col-span-1 md:col-span-3 flex gap-4">
                    <a href="{{ route('applications.index') }}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Sıfırla
                    </a>
                    <button type="submit"
                            class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Filtrlə
                    </button>
                    <a href="{{ route('application_export_excel', request()->all()) }}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Excel
                    </a>
                    <a href="{{ route('application_export_pdf', request()->all()) }}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        PDF
                    </a>
                    <p class="resultCount"><span>{{ $applications->total() }}</span> Nəticə</p>
                </div>
            </div>
        </form>
    </div>

    <br>
    <div class="relative overflow-x-auto shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-4 text-center">№</th>
                <th scope="col" class="px-6 py-4">Foto</th>
                <th scope="col" class="px-6 py-4">Ad soyad</th>
                <th scope="col" class="px-6 py-4">Basvuru İxtisası</th>
                <th scope="col" class="px-6 py-4">Universitet</th>
                <th scope="col" class="px-6 py-4">Proqram</th>
                <th scope="col" class="px-6 py-4">Dönəm</th>
                <th scope="col" class="px-6 py-4">Agent</th>
                <th scope="col" class="px-6 py-4">Menecer</th>
                <th scope="col" class="px-6 py-4 text-center">Status</th>
                <th scope="col" class="px-6 py-4 text-center">Passport no</th>
                <th scope="col" class="px-6 py-4 text-center">App no</th>
                <th scope="col" class="px-6 py-4 text-center">Başvuru tarixi</th>
                <th scope="col" class="px-6 py-4 text-center">Digər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $key => $application)
                <tr class="bg-white border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    <td class="px-6 py-4 text-center">{{$applications->firstItem() + $key}}</td>
                    <td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        @if($application->user?->image)
                            <img class="w-10 h-10 rounded-full" src="{{asset('files/' . $application->user?->image)}}">
                        @endif
                    </td>
                    <td class="px-6 py-4">{{$application->user?->name}} {{$application->user?->surname}}</td>
                    <td class="px-6 py-4">{{$application->tariff?->profession->title}}</td>
                    <td class="px-6 py-4">{{$application->university_list?->title}}</td>
                    <td class="px-6 py-4">{{$application->education_level?->title}}</td>
                    <td class="px-6 py-4">{{$application->period?->title}}</td>
                    <td class="text-blue-700 font-bold px-6 py-4">{{$application->user?->agent?->agent_info?->company_name}}</td>
                    <td class="px-6 py-4">{{$application->user?->user?->name}}</td>
                    <td style="background-color: {{$application->program_status?->color}}" class="px-3 py-2.5 whitespace-nowrap">
                        <div class="flex items-center justify-between min-w-0">
                            <!-- Status name with truncation -->
                            <span class="font-medium text-gray-800 dark:text-gray-200 truncate max-w-[120px] md:max-w-[180px] pr-2"
                                  title="{{$application->program_status?->title}}">
            {{$application->program_status?->title}}
        </span>

                            <!-- Actions container - flex-shrink-0 prevents wrapping -->
                            <div class="flex-shrink-0 flex items-center space-x-1">
                                <!-- File attachments - only show if files exist -->
                                @if($application->statuses->filter(fn($h) => $h->pivot->file_path)->count() > 0)
                                    <a href="{{asset('storage/'.$application->statuses->first()->pivot->file_path)}}" target="_blank"
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded"
                                       title="Əlavə edilmiş fayl">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                @endif

                                <!-- Status change button -->
                                <button onclick="openStatusModal({{ $application->id }}, '{{ $application->program_status_id }}')"
                                        class="text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300 p-1 rounded hover:bg-purple-50 dark:hover:bg-gray-700"
                                        title="Statusu dəyiş">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">{{$application->user?->student_info?->passport_number}}</td>
                    <td class="px-6 py-4">{{$application->app_no}}</td>
                    <td class="px-6 py-4">{{$application->application_date}}</td>
                    <td class=" px-6 py-4 ">
                        <div class="agent_icons flex justify-center gap-4 items-center text-center">
                            @if($application->user)
                                <a href="{{ route('students.show', $application->user?->id) }}">
                                    <img src="{{ asset('/') }}assets/images/eye.svg" alt="">
                                </a>
                            @else
                                'Tələbəsi silinib.'
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <x-pagination :paginator="$applications"/>
    <!-- Modal -->
    <div id="statusModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md dark:bg-gray-800">
            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Statusu dəyiş</h2>
            <form method="POST" action="{{ route('applications.change-status') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="application_id" id="modal_application_id">

                <!-- Status Selection -->
                <div class="mb-4">
                    <label for="modal_program_status_id"
                           class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Yeni status:</label>
                    <select name="program_status_id" id="modal_program_status_id"
                            class="w-full border border-gray-300 p-2 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @foreach($program_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Notes Field -->
                <div class="mb-4">
                    <label for="status_note" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Qeyd
                        (Əlavə məlumat):</label>
                    <textarea name="note" id="status_note" rows="3"
                              class="w-full border border-gray-300 p-2 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Status dəyişikliyi ilə bağlı əlavə qeydlər..."></textarea>
                </div>

                <!-- File Upload -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300" for="status_file">Fayl
                        əlavə et (Əlavə sənəd):</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="status_file"
                               class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-700 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Faylı seçin</span>
                                    və ya sürükləyib buraxın</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOCX, JPG, PNG (MAX: 5MB)</p>
                            </div>
                            <input id="status_file" name="file" type="file" class="hidden"
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"/>
                        </label>
                    </div>
                    <div id="file-name-display" class="mt-2 text-sm text-gray-600 dark:text-gray-400 hidden"></div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeStatusModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                        Bağla
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800">
                        Yadda saxla
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')

    <script>

        function openStatusModal(applicationId, currentStatusId) {
            document.getElementById('modal_application_id').value = applicationId;
            document.getElementById('modal_program_status_id').value = currentStatusId;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        $(document).ready(function () {
            function loadDropdowns(educationLevelId, selectedSchoolType, selectedProfessions) {
                if (!educationLevelId) return;

                $.ajax({
                    url: '/get-school-types/' + educationLevelId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let schoolTypeSelect = $('select[name="school_type_id"]');
                        let professionSelect = $('select[name="profession_id[]"]');

                        schoolTypeSelect.empty().append('<option value="">Məktəb növü seçin</option>');
                        professionSelect.empty().append('<option value="">İxtisas seçin</option>');

                        // Məktəb növləri
                        $.each(data.schoolTypes, function (key, schoolType) {
                            let selected = (schoolType.id == selectedSchoolType) ? 'selected' : '';
                            schoolTypeSelect.append('<option value="' + schoolType.id + '" ' + selected + '>' + schoolType.title + '</option>');
                        });

                        // İxtisaslar
                        $.each(data.professions, function (key, profession) {
                            // Array daxilində olub-olmadığını yoxla
                            let selected = (selectedProfessions && selectedProfessions.includes(profession.id.toString())) ? 'selected' : '';
                            professionSelect.append('<option value="' + profession.id + '" ' + selected + '>' + profession.title + '</option>');
                        });

                        // Select2 yenilə
                        professionSelect.trigger('change');
                    }
                });
            }

            // Seçilmiş dəyərləri almaq
            let selectedEducationLevel = $('select[name="education_level_id"]').val();
            let selectedSchoolType = "{{ request('school_type_id') ?? '' }}";

            // PHP-dən array kimi gələn dəyərləri JavaScript array-ə çevir
            let selectedProfessions = {!! json_encode((array)request('profession_id', [])) !!};

            if (selectedEducationLevel) {
                loadDropdowns(selectedEducationLevel, selectedSchoolType, selectedProfessions);
            }

            $('select[name="education_level_id"]').change(function () {
                let educationLevelId = $(this).val();
                loadDropdowns(educationLevelId, "", []);
            });
        });

    </script>
@endpush


