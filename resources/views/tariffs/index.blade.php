@extends('layouts.master')
@section('title', 'Universitetlər')
<style>
    .nice-select {
        width: 100% !important;
    }
</style>
@section('content')

    @if(session('message'))
        <div class="success-message">
            <p>{{session('message')}}</p>
        </div>
    @endif

    <div class="universities-container">
       <div class="flex justify-between items-center">
           <div class="university-tabs">
               <a href="{{route('tariffs.index')}}"
                  class="university-tab-btn active"
               >Universitet
               </a>
               <a href="{{route('universities.index')}}" class="university-tab-btn"
                  id="university_info">Məlumat
               </a>
           </div>
           @can('create-universities')
               <a href="{{route('tariffs.create')}}" class="addNewPermission !mt-0">
                   <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                   Əlavə et
               </a>
           @endcan

       </div>

        <br>
        <form action="{{ route('tariffs.index') }}" method="get">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">

                <div class="form-group">
                    <label for="university_list_id" class="block text-sm font-medium text-gray-700 dark:text-white">Universitet seçin</label>
                    <select name="university_list_id[]" multiple id="university_list_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Universitet seçin</option>
                        @foreach($university_lists as $university_list)
                            <option value="{{$university_list->id}}" {{ collect(request('university_list_id'))->contains($university_list->id) ? 'selected' : '' }}>
                                {{$university_list->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="education_level_id" class="block text-sm font-medium text-gray-700 dark:text-white">Təhsil pilləsi seçin</label>
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

                <div class="form-group">
                    <label for="school-types" class="block text-sm font-medium text-gray-700 dark:text-white">Məktəb növü seçin</label>
                    <select name="school_type_id[]" multiple id="school-types"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Məktəb növü seçin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="profession" class="block text-sm font-medium text-gray-700 dark:text-white">İxtisas seçin</label>
                    <select name="profession_id[]" multiple id="profession"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">İxtisas seçin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="education_language_id" class="block text-sm font-medium text-gray-700 dark:text-white">Təhsil dilin seçin</label>
                    <select name="education_language_id[]" multiple id="education_language_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Təhsil dilin seçin</option>
                        @foreach($education_languages as $education_language)
                            <option value="{{$education_language->id}}" {{ collect(request('education_language_id'))->contains($education_language->id) ? 'selected' : '' }}>
                                {{$education_language->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-white">Ölkə seçin</label>
                    <select name="country_id[]" multiple id="country_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Ölkə seçin</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{ collect(request('country_id'))->contains($country->id) ? 'selected' : '' }}>
                                {{$country->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="town_id" class="block text-sm font-medium text-gray-700 dark:text-white">Şəhər seçin</label>
                    <select name="town_id[]" multiple id="town_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Şəhər seçin</option>
                        @foreach($towns as $town)
                            <option value="{{$town->id}}" {{ collect(request('town_id'))->contains($town->id) ? 'selected' : '' }}>
                                {{$town->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-white">Tehsil haqqı min</label>
                    <input type="number" name="min_price" id="min_price" placeholder="Tehsil haqqı min" value="{{request('min_price')}}"
                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="form-group">
                    <label for="max_price" class="block text-sm font-medium text-gray-700 dark:text-white">Tehsil haqqı max</label>
                    <input type="number" name="max_price" id="max_price" placeholder="Tehsil haqqı max" value="{{request('max_price')}}"
                           class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="form-group">
                    <label for="currency_id" class="block text-sm font-medium text-gray-700 dark:text-white">Valyuta seçin</label>
                    <select name="currency_id[]" multiple id="currency_id"
                            class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Valyuta seçin</option>
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}" {{ collect(request('currency_id'))->contains($currency->id) ? 'selected' : '' }}>
                                {{$currency->title}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 md:col-span-3 flex gap-4">
                    <a href="{{route('tariffs.index')}}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
           font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Sıfırla
                    </a>
                    <button type="submit"
                            class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
            font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Filtrlə
                    </button>
                    <a href="{{route('tariff_export_excel',request()->all())}}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
            font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Excel
                    </a>
                    <a href="{{route('tariff_export_pdf',request()->all())}}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
            font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        PDF
                    </a>
                    <p class="resultCount"><span>{{$count}}</span> Nəticə</p>
                </div>
            </div>
        </form>

        <div class="university-tab-content university_filter_content ">
            <div class="relative overflow-x-auto shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
                    <thead class="text-xs text-gray-800 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        {{--                        <th scope="col" class="px-6 py-4">№</th>--}}
                        <th scope="col" class="px-6 py-4">Universitet adı</th>
                        <th scope="col" class="px-6 py-4">Təhsil pilləsi</th>
                        <th scope="col" class="px-6 py-4">Məktəb növü</th>
                        <th scope="col" class="px-6 py-4">İxtisas</th>
                        <th scope="col" class="px-6 py-4">Təhsil dili</th>
                        <th scope="col" class="px-6 py-4">Təhsil haqqı</th>
                        <th scope="col" class="px-6 py-4">Endirimli təhsil haqqı</th>
                        @if(auth()->user()->can('edit-tariffs') || auth()->user()->can('delete-tariffs'))
                            <th scope="col" class="px-6 py-4 text-center">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tariffs as $key => $tariff)
                        <tr class="bg-white border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                @if($tariff->university_list?->image)
                                    <img class="w-10 h-10 rounded-full" src="{{asset('logos/' . $tariff->university_list?->image)}}" alt="{{ $tariff->university_list?->title }}">
                                @endif
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $tariff->university_list?->title }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $tariff->education_level?->title }}</td>
                            <td class="px-6 py-4">{{ $tariff->school_type?->title }}</td>
                            <td class="px-6 py-4">{{ $tariff->profession?->title }}</td>
                            <td class="px-6 py-4">{{ $tariff->education_language?->title }}</td>
                            <td class="px-6 py-4 font-semibold text-green-600 dark:text-green-400">
                                @if($tariff->price)
                                    {{ $tariff->price }} {{$tariff->currency?->title}}
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-green-600 dark:text-green-400">
                                @if($tariff->discounted_price)
                                    {{ $tariff->discounted_price }} {{$tariff->currency?->title}}
                                @endif
                            </td>
                            @if(auth()->user()->can('edit-tariffs') || auth()->user()->can('delete-tariffs'))
                                <td class="flex justify-center px-6 py-4 gap-4">

                                    @can('edit-tariffs')
                                        <a href="{{ route('tariff.all.edit', $tariff->university_list_id) }}">
                                            <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                                        </a>
                                    @endcan
                                    @can('edit-tariffs')
                                        <a href="{{ route('tariffs.edit',['tariff' => $tariff->id]  + request()->query()) }}">
                                            <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                                        </a>
                                    @endcan
                                    @can('delete-tariffs')
                                        <form action="{{ route('tariffs.destroy', ['tariff' => $tariff->id]  + request()->query()) }}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')">
                                                <img src="{{ asset('/') }}assets/images/trash.svg" alt="">
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <x-pagination :paginator="$tariffs"/>

        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {


        function loadDropdowns(educationLevelIds, selectedSchoolTypes, selectedProfessions) {
            if (!educationLevelIds || educationLevelIds.length === 0) {
                $('#school-types').empty().append('<option value="">Məktəb növü seçin</option>');
                $('#profession').empty().append('<option value="">İxtisas seçin</option>');
                return;
            }

            // Əgər education_level_id arraydirsə, ilk elementini götürürük (və ya API-nizi array qəbul edəcək şəkildə dəyişin)
            let educationLevelId = educationLevelIds[0];

            $.ajax({
                url: '/get-school-types/' + educationLevelId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let schoolTypeSelect = $('#school-types');
                    let professionSelect = $('#profession');

                    schoolTypeSelect.empty().append('<option value="">Məktəb növü seçin</option>');
                    professionSelect.empty().append('<option value="">İxtisas seçin</option>');

                    // Məktəb növləri
                    $.each(data.schoolTypes, function (key, schoolType) {
                        let selected = (selectedSchoolTypes && selectedSchoolTypes.includes(schoolType.id.toString())) ? 'selected' : '';
                        schoolTypeSelect.append('<option value="' + schoolType.id + '" ' + selected + '>' + schoolType.title + '</option>');
                    });

                    // İxtisaslar
                    $.each(data.professions, function (key, profession) {
                        let selected = (selectedProfessions && selectedProfessions.includes(profession.id.toString())) ? 'selected' : '';
                        professionSelect.append('<option value="' + profession.id + '" ' + selected + '>' + profession.title + '</option>');
                    });

                    // Select2 yenilə
                    schoolTypeSelect.trigger('change');
                    professionSelect.trigger('change');
                }
            });
        }

        // Seçilmiş dəyərləri almaq
        let selectedEducationLevels = {!! json_encode((array)request('education_level_id', [])) !!};
        let selectedSchoolTypes = {!! json_encode((array)request('school_type_id', [])) !!};
        let selectedProfessions = {!! json_encode((array)request('profession_id', [])) !!};

        if (selectedEducationLevels.length > 0) {
            loadDropdowns(selectedEducationLevels, selectedSchoolTypes, selectedProfessions);
        }

        $('#education_level_id').change(function () {
            let educationLevelIds = $(this).val();
            loadDropdowns(educationLevelIds, [], []);
        });
    });
</script>





