
@extends('layouts.master')
@section('title', 'Tariff əlavə et')

@section('content')

    <a href="{{route('tariffs.index')}}" class="goBack">
        <img src="{{asset('/')}}assets/images/back.svg" alt="">
        Geri
    </a>

    <div class="addNewPermission-container">
        <h2>Yeni universitet əlavə et</h2>
        <form action="{{route('tariffs.store')}}" class="addNewPermissionForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-items">
                <div class="form-item">
                    <label for="">Universitet</label>
                    <select name="university_list_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($university_lists as $university_list)
                            <option value="{{$university_list->id}}">{{$university_list->title}}</option>
                        @endforeach
                    </select>
                    @if($errors->first('university_list_id'))
                        <small class="form-text text-danger">{{$errors->first('university_list_id')}}</small>
                    @endif
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsi seçin</label>
                    <select name="education_level_id" id="education_level_select" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}">{{$education_level->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Məktən növü seçin</label>
                    <select name="school_type_id" id="school_type_select" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>

                    </select>
                </div>
{{--                <div class="form-item">--}}
{{--                    <label for="">İxtisas seçin</label>--}}
{{--                    <select name="profession_id" id="">--}}
{{--                        <option value="">Seçin</option>--}}
{{--                        @foreach($professions as $profession)--}}
{{--                            <option value="{{$profession->id}}">{{$profession->title}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="form-item">
                    <label for="">Təhsil dilin seçin</label>
                    <select name="education_language_id" id="" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($education_languages as $education_language)
                            <option value="{{$education_language->id}}">{{$education_language->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Ölkə seçin</label>
                    <select name="country_id" id="" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Şəhər seçin</label>
                    <select name="town_id" id="" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($towns as $town)
                            <option value="{{$town->id}}">{{$town->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Valyutanı seç</label>
                    <select name="currency_id" id="" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="profession_id">İxtisas seçin</label>
                    <select id="profession_id" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>

                    </select>
                </div>

                <div class="form-item">
                    <label for="price">Təhsil haqqı</label>

                    <select id="price" class="price_select  border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($education_costs as $education_cost)
                            <option value="{{$education_cost->title}}">{{$education_cost->title}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-item">
                    <label for="discounted_price">Endirimli təhsil haqqı</label>

                    <select id="discounted_price" class="price_select border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($education_costs as $education_cost)
                            <option value="{{$education_cost->title}}">{{$education_cost->title}}</option>
                        @endforeach

                    </select>
                </div>

                <button type="button" id="add-profession">Əlavə et</button>

                <ul id="selected-professions"></ul>

                <!-- Bu gizli inputlar form submit edildikdə məlumatların göndərilməsi üçün istifadə olunacaq -->
                <div id="hidden-fields"></div>

            </div>
            <button class="addPermissionBtn" type="submit">Əlavə et</button>
        </form>
    </div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        let selectedProfessions = {};

        $('#add-profession').on('click', function() {
            let professionId = $('#profession_id').val();
            let professionName = $('#profession_id option:selected').text();
            let price = $('#price').val().trim();
            let discounted_price = $('#discounted_price').val().trim();

            if (!professionId || !price) {
                alert('Zəhmət olmasa ixtisas və qiymət daxil edin!');
                return;
            }

            if (selectedProfessions[professionId]) {
                alert('Bu ixtisas artıq əlavə olunub!');
                return;
            }

            selectedProfessions[professionId] = price;

            // Seçilmiş ixtisasları siyahıya əlavə edirik
            $('#selected-professions').append(`
            <li id="profession-${professionId}">
                ${professionName} - ${price} - ${discounted_price}
                <button type="button" class="remove-profession" data-id="${professionId}">❌</button>
            </li>
        `);

            // Gizli inputlar (form submit edildikdə göndərmək üçün)
            $('#hidden-fields').append(`
            <input type="hidden" name="profession_id[]" value="${professionId}">
            <input type="hidden" name="price[${professionId}]" value="${price}">
            <input type="hidden" name="discounted_price[${professionId}]" value="${discounted_price}">
        `);

        });

        // Sil düyməsinə basıldıqda ixtisası silmək
        $(document).on('click', '.remove-profession', function() {
            let professionId = $(this).data('id');
            delete selectedProfessions[professionId];

            // Siyahıdan sil
            $(`#profession-${professionId}`).remove();

            // Gizli inputları sil
            $(`input[value="${professionId}"]`).remove();
            $(`input[name="price[${professionId}]"]`).remove();
            $(`input[name="discounted_price[${professionId}]"]`).remove();
        });
    });

    $(document).ready(function () {
        $('#education_level_select').on('change', function () {
            let educationLevelId = $(this).val();

            if (!educationLevelId) {
                $('#school_type_select').html('<option value="">Seçin</option>').niceSelect('update');
                $('#profession_id').html('<option value="">Seçin</option>').niceSelect('update');
                return;
            }

            $.ajax({
                url: `/get-school-types/${educationLevelId}`,
                type: 'GET',
                success: function (response) {
                    let schoolTypeOptions = '<option value="">Seçin</option>';
                    response.schoolTypes.forEach(function (schoolType) {
                        schoolTypeOptions += `<option value="${schoolType.id}">${schoolType.title}</option>`;
                    });

                    let professionOptions = '<option value="">Seçin</option>';
                    response.professions.forEach(function (profession) {
                        professionOptions += `<option value="${profession.id}">${profession.title}</option>`;
                    });

                    $('#school_type_select').html(schoolTypeOptions).niceSelect('update');
                    $('#profession_id').html(professionOptions).niceSelect('update');
                }
            });
        });
    });
</script>




