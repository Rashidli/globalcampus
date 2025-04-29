@extends('layouts.master')
@section('title', 'Tələbələr')

@section('content')

    <div class="flex justify-between my-[10px] items-center mt-[20px]">
        <a href="{{ route('students.create') }}" class="addNewStudent !mt-0 mb-0">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </a>
    </div>

    <div class="students-head !mt-[23px]">
        <form action="{{ route('students.index') }}" method="get" style="width: 100%">

            <div class="grid grid-cols-1 items-start md:grid-cols-2 lg:grid-cols-5 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">

                <div class="flex flex-col">
                    <label for="name" class="text-sm font-medium text-gray-700 dark:text-white">Ad</label>
                    <input type="text" name="name" id="name" placeholder="Ad" value="{{request('name')}}"
                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex flex-col">
                    <label for="surname" class="text-sm font-medium text-gray-700 dark:text-white">Soyad</label>
                    <input type="text" name="surname" id="surname" placeholder="Soyad" value="{{request('surname')}}"
                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex flex-col">
                    <label for="agent_id" class="text-sm font-medium text-gray-700 dark:text-white">Agent</label>
                    <select name="agent_id[]" id="agent_id" multiple
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            @if(auth()->user()->type === \App\Enums\UserType::AGENT->value) disabled @endif>
                        <option value="">Agent seçin</option>
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}" {{ collect(request('agent_id'))->contains($agent->id) ? 'selected' : '' }}>
                                {{$agent->agent_info?->company_name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="period_id" class="text-sm font-medium text-gray-700 dark:text-white">Dönəm</label>
                    <select name="period_id[]" id="period_id" multiple
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Dönəm seçin</option>
                        @foreach($periods as $period)
                            <option value="{{$period->id}}" {{ collect(request('period_id'))->contains($period->id) ? 'selected' : '' }}>
                                {{$period->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="university_list_id" class="text-sm font-medium text-gray-700 dark:text-white">Universitet</label>
                    <select name="university_list_id[]" id="university_list_id" multiple
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Universitet seçin</option>
                        @foreach($university_lists as $university_list)
                            <option value="{{$university_list->id}}" {{ collect(request('university_list_id'))->contains($university_list->id) ? 'selected' : '' }}>
                                {{$university_list->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="education_level_id" class="text-sm font-medium text-gray-700 dark:text-white">Təhsil pilləsi</label>
                    <select name="education_level_id" id="education_level_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Təhsil pilləsi seçin</option>
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}" {{$education_level->id == request('education_level_id') ? 'selected' : ''}}>
                                {{$education_level->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="profession_id" class="text-sm font-medium text-gray-700 dark:text-white">İxtisas</label>
                    <select name="profession_id[]" id="profession_id" multiple
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">İxtisas seçin</option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-3 flex gap-4">
                    <a href="{{route('students.index')}}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
                   font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Sıfırla
                    </a>
                    <button type="submit"
                            class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
                        font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Filtrlə
                    </button>
                    <p class="resultCount"><span>{{$count}}</span> Nəticə</p>
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
                <th scope="col" class="px-6 py-4">Agent</th>
                <th scope="col" class="px-6 py-4">Dönəm</th>
                <th scope="col" class="px-6 py-4">Basvuru İxtisası</th>
                <th scope="col" class="px-6 py-4">Universitet</th>
                <th scope="col" class="px-6 py-4">Proqram</th>

                <th scope="col" class="px-6 py-4 text-center">Digər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                    <td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        @if($user->image)
                            <img class="w-10 h-10 rounded-full" src="{{ asset('files/' . $user->image) }}">
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $user->name }} {{ $user->surname }}</td>
                    <td class="text-blue-700 font-bold px-6 py-4">{{ $user->agent?->agent_info?->company_name }}</td>
                    <td class="px-6 py-4">
                        @foreach($user->programs as $program)
                            <div>{{ $program->period?->title }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach($user->programs as $program)
                            <div>{{ $program->tariff?->profession?->title }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach($user->programs as $program)
                            <div>{{ $program->university_list?->title }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach($user->programs as $program)
                            <div>{{ $program->education_level?->title }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        <div class="agent_icons flex justify-center gap-4 items-center text-center">
                            <a href="{{ route('students.show', $user->id) }}">
                                <img src="{{ asset('/') }}assets/images/eye.svg" alt="">
                            </a>
                            <a href="{{ route('students.edit', $user->id) }}">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </a>
                            <form action="{{ route('students.destroy', $user->id) }}" method="post">
                                @method('DELETE')
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

@push('scripts')
    <script>
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
