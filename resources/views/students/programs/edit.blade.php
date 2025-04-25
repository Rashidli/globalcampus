@extends('layouts.master')
@section('title', 'Proqramlar')
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <form action="{{ route('programs.update', $program->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Update əməliyyatı üçün -->
                <div class="space-y-4 p-4">
                    <div class="grid grid-cols-3 gap-4">

                        <!-- Ölkə seçimi -->
                        <div class="flex flex-col">
                            <label for="country_id" class="mb-2">Ölkə seçin</label>
                            <select name="country_id" id="country_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $program->country_id == $country->id ? 'selected' : '' }}>{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dönəm seçimi -->
                        <div class="flex flex-col">
                            <label for="period_id" class="mb-2">Dönəm seçin</label>
                            <select name="period_id" id="period_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}" {{ $program->period_id == $period->id ? 'selected' : '' }}>{{ $period->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Təhsil səviyyəsi seçimi -->
                        <div class="flex flex-col">
                            <label for="education_level_id" class="mb-2">Təhsil səviyyəsi seçin</label>
                            <select name="education_level_id" id="education_level_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($education_levels as $education_level)
                                    <option data-note="{{$education_level->description}}" value="{{ $education_level->id }}" {{ $program->education_level_id == $education_level->id ? 'selected' : '' }}>{{ $education_level->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Universitet seçimi -->
                        <div class="flex flex-col">
                            <label for="university_list" class="mb-2">Universitet seçin</label>
                            <select name="university_list_id" id="university_list" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($university_lists as $universities_list)
                                    <option value="{{ $universities_list->id }}" {{ $program->university_list_id == $universities_list->id ? 'selected' : '' }}>{{ $universities_list->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- İxtisas seçimi -->
                        <div class="flex flex-col">
                            <label for="profession_list" class="mb-2">İxtisas seçin</label>
                            <select name="tariff_id" id="profession_list" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($program->university_list?->tariffs ?? [] as $tariff)
                                    <option value="{{ $tariff->id }}" {{ $program->tariff_id == $tariff->id ? 'selected' : '' }}>{{$tariff->profession?->title }}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <input type="hidden" name="profession_id" value="{{$tariff->profession?->id}}">--}}
                        <!-- Qiymət inputu -->
                        <div class="flex flex-col">
                            <label for="price" class="mb-2">Qiymət</label>
                            <input type="text" name="price" id="price" class="w-full border border-gray-300 rounded-lg p-2" value="{{ $program->price }}" readonly>
                        </div>

                        <!-- Baş vuru tarixi -->
                        <div class="flex flex-col">
                            <label for="application_date" class="mb-2">Baş vuru tarixi</label>
                            <input type="date" name="application_date" value="{{ $program->application_date }}" class="w-full border border-gray-300 rounded-lg p-2">
                        </div>

                        <!-- Nəticə tarixi -->
                        <div class="flex flex-col">
                            <label for="result_date" class="mb-2">Nəticə tarixi</label>
                            <input type="date" name="result_date" value="{{ $program->result_date }}" class="w-full border border-gray-300 rounded-lg p-2">
                        </div>

                        <!-- App no inputu -->
                        <div class="flex flex-col">
                            <label for="app_no" class="mb-2">App no</label>
                            <input type="text" name="app_no" value="{{$program->app_no}}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="App no">
                        </div>

                        <!-- Status seçimi -->
                        <div class="flex flex-col">
                            <label for="status" class="mb-2">Status seçin</label>
                            <select name="program_status_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seçin</option>
                                @foreach($program_statuses as $program_status)
                                    <option value="{{ $program_status->id }}" {{ $program->program_status_id == $program_status->id ? 'selected' : '' }}>{{ $program_status->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Qeyd -->
                        <div class="flex flex-col">
                            <label for="university_end_date" class="mb-2 text-gray-700 dark:text-white">Qeyd</label>
                            <textarea name="note"  cols="10" rows="2" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{$program->note}}</textarea>
                        </div>

                    </div>

                    <!-- Save & Cancel Buttons -->
                    <div class="flex justify-end gap-2 mt-4">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition">Yadda saxla</button>
                        <a href="{{ route('programs.index', $program->user_id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">Geri</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="deleteStudentModal">
        <div class="deleteStudentBox">
            <button class="closeDeleteStudentModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        const $educationSelect = $('#education_level_id');

        // Yeni qeyd göstərmək üçün div əlavə et
        const $noteBox = $('<div id="education-note" class="mt-2 text-sm text-gray-700 dark:text-gray-300 italic"></div>');
        $educationSelect.parent().append($noteBox);

        // select2 dəyişiklik zamanı
        $educationSelect.on('change', function () {
            const note = $(this).find('option:selected').data('note');
            if (note) {
                $noteBox.text('Qeyd: ' + note);
            } else {
                $noteBox.text('');
            }
        });

        // Əgər səhifə açılan kimi bir dəyər seçilmişdirsə, onu da göstər
        $educationSelect.trigger('change');
    });

    $(document).ready(function () {

        $(".select2").select2(); // Select2 aktivləşdir

        let educationLevelSelect = $("#education_level_id");
        let universitySelect = $("#university_list");
        let professionSelect = $("#profession_list");
        let priceInput = $("input[name='price']");

        // Təhsil pilləsi seçiləndə universitetləri və ixtisasları sıfırla
        educationLevelSelect.on("change", function () {
            let educationLevelId = $(this).val();
            professionSelect.html('<option value="">İxtisas seçin</option>').trigger("change");
            universitySelect.val("").trigger("change");
            priceInput.val("").attr("placeholder", "Qiymət");

            if (educationLevelId) {
                $.ajax({
                    url: `/get-professions/${educationLevelId}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (index, profession) {
                                professionSelect.append(`<option value="${profession.id}">${profession.title}</option>`);
                            });
                        } else {
                            console.warn("Bu təhsil səviyyəsinə uyğun ixtisas tapılmadı.");
                        }
                        professionSelect.trigger("change");
                    },
                    error: function (xhr, status, error) {
                        console.error("İxtisasları gətirərkən xəta:", error);
                    }
                });
            }
        });

        // Universitet və ixtisas seçiləndə qiyməti gətir
        function loadPrice() {
            let universityId = universitySelect.val();
            let professionId = professionSelect.val();

            if (universityId && professionId) {
                $.ajax({
                    url: `/get-price/${universityId}/${professionId}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if ($.isEmptyObject(data)) {
                            priceInput.val("").attr("placeholder", "Qiymət tapılmadı");
                        } else {
                            priceInput.val(data.price);
                            priceInput.attr("placeholder", data.currency ? data.currency.title : '');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Qiyməti gətirərkən xəta:", error);
                    }
                });
            } else {
                priceInput.val("").attr("placeholder", "Qiymət");
            }
        }

        // Universitet və ixtisas seçiləndə qiyməti yoxla
        universitySelect.on("change", loadPrice);
        professionSelect.on("change", loadPrice);
    });
</script>


