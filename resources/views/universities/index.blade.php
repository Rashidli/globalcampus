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
        <div class="university-tabs">
            <a href="{{ route('tariffs.index') }}"
               class="university-tab-btn {{ request()->routeIs('tariffs.index') ? 'active' : '' }}">
                Axtar
            </a>

            @foreach($university_education_levels as $university_education_level)
                <a href="{{ route('universities.index', ['education_id' => $university_education_level->id]) }}"
                   class="university-tab-btn {{ request('education_id') == $university_education_level->id ? 'active' : '' }}">
                    {{ $university_education_level->title }}
                </a>
            @endforeach
        </div>

        <div
            class="university-tab-content universities-main">

            <div class="universities-level-tabs">
                @foreach($university_education_levels as $key => $university_education_level)
                    <button class="level-tab @if(!$key) active @endif" type="button"
                            id="level_{{$university_education_level->id}}">
                        <img src="{{asset('/')}}assets/images/cap.svg" alt="">
                        {{$university_education_level->title}}
                    </button>
                @endforeach

            </div>
            @foreach($university_education_levels as $key => $university_education_level)
                <div class="level-tabContent level_bachelor_content @if(!$key) activeLevelContent @endif"
                     data-id="level_{{$university_education_level->id}}">
                    <div class="level_bachelor_tabs">
                        @foreach($university_education_level->university_school_types ?? [] as $keys => $university_school_type)
                            <button class="level_bachelor_tab @if(!$keys) active @endif"
                                    id="bachelor_{{$university_school_type->id}}">{{$university_school_type->title}}</button>
                        @endforeach
                    </div>
                    <div class="universities-area">
                        <div class="university_titles">
                            <p class="universityNumber">№</p>
                            <p class="universitName">Universitet adı</p>
                        </div>
                        <div class="universities_lists_area">
                            @foreach($university_education_level->university_school_types ?? [] as $keyss => $university_school_type)
                                <div class="bachelor_universities_lists @if(!$keyss) active @endif"
                                     data-id="bachelor_{{$university_school_type->id}}">
                                    @foreach($university_school_type->universities ?? [] as $keysss => $university)
                                        <div class="universities_lists_item">
                                            <p class="universityNumber">{{$keysss + 1}}</p>
                                            <p class="universitName">{{$university->title}}</p>
                                            <div class="item-buttons">
                                                <a href="{{ asset('files/' . $university->file) }}">
                                                    <img src="{{asset('/')}}assets/images/eye.svg" alt="">
                                                </a>
                                                <a download href="{{ asset('files/' . $university->file) }}"
                                                   class="download_pdf" type="button">
                                                    <img src="{{asset('/')}}assets/images/download.svg" alt="">
                                                </a>
                                                @can('delete-universities')
                                                    <form action="{{route('universities.destroy', $university->id)}}"
                                                          method="post">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button class="delete_pdf" type="submit">
                                                            <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    @endforeach
                                    @can('create-universities')
                                        <button class="addNewUniversity" type="button">
                                            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                                            Əlavə et
                                        </button>
                                    @endcan
                                </div>
                            @endforeach
                        </div>

                </div>
            @endforeach
        </div>
    </div>

    <div class="universities-modal-container">
        <div class="universities-modal">
            <div class="universities-modal-head">
                <h2>Yeni PDF əlavə et</h2>
                <button class="close-universities-modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('universities.store') }}" method="post" enctype="multipart/form-data"
                  class="form-add-universities-modal">
                @csrf
                <input type="hidden" name="tab_type" value="2">

                <div class="form-items" style="display: flex; flex-direction: column">
                    <div class="form-item">
                        <label for="">Təhsil pilləsi</label>
                        <select name="university_education_level_id" id="university_education_level_select" style="width: 100% !important;">
                            <option value="">Seçin</option>
                            @foreach($university_education_levels as $university_education_level)
                                <option value="{{ $university_education_level->id }}">{{ $university_education_level->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-item">
                        <label for="">Məktəb növü</label>
                        <select name="university_school_type_id" id="university_school_type_select" style="width: 100% !important;">
                            <option value="">Seçin</option>
                        </select>
                    </div>


                    <div class="form-item">
                        <label for="">Universitet</label>
                        <input type="text" name="title" placeholder="Universitet adı">
                    </div>
                    <div class="document-input-box">
                        <div class="document-input-box-top">
                            <label for="">PDF</label>
                            <button class="resetDocumentBox" type="button">
                                <img src="{{ asset('/') }}assets/images/x.svg" alt="">
                            </button>
                        </div>
                        <div class="document-input-item">
                            <input type="file" name="file">
                            <p>
                                <img src="{{ asset('/') }}assets/images/Paperclip.svg" alt="">
                                Fayl seç
                            </p>
                            <span class="fileName"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="add-universities-modalBtn">Əlavə et</button>
            </form>

        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#university_education_level_select").on("change", function () {
            let educationLevelId = $(this).val();
            let schoolTypeSelect = $("#university_school_type_select");

            // Clear previous options
            schoolTypeSelect.html('<option value="">Seçin</option>');

            if (educationLevelId) {
                $.ajax({
                    url: `/get-school-types/${educationLevelId}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log("Received data:", data); // Debugging

                        if (data.length > 0) {
                            $.each(data, function (index, schoolType) {
                                schoolTypeSelect.append(
                                    `<option value="${schoolType.id}">${schoolType.title}</option>`
                                );
                            });

                            // Destroy and reinitialize Nice Select
                            schoolTypeSelect.niceSelect('destroy'); // Destroy previous instance
                            schoolTypeSelect.niceSelect(); // Reinitialize
                        } else {
                            console.warn("No school types found for this education level.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching school types:", error);
                    }
                });
            }
        });

        // Initialize Nice Select on page load
        $("select").niceSelect();
    });

    function fetchSchoolTypes(educationLevelId) {
        $.ajax({
            url: `/get-school-types/${educationLevelId}`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                let schoolTypesDiv = $("#school-types");
                schoolTypesDiv.empty();

                if (response.length === 0) {
                    schoolTypesDiv.append('<p>Bu təhsil pilləsi üçün məktəb növü yoxdur.</p>');
                } else {
                    response.forEach(function (type) {
                        schoolTypesDiv.append(`
                            <div class="check-item">
                                <input type="radio" id="university_school_type_${type.id}" name="university_school_type_id" value="${type.id}">
                                <label for="university_school_type_${type.id}">${type.title}</label>
                            </div>
                        `);
                    });
                }
            },
            error: function () {
                alert("Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.");
            }
        });
    }

</script>

