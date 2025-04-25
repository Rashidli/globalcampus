@extends('layouts.master')
@section('title', 'Universiteti Dəyiş')

@section('content')

    <a href="{{ route('universities.index') }}" class="goBack">
        <img src="{{asset('/')}}assets/images/back.svg" alt="">
        Geri
    </a>

    <div class="addNewPermission-container">
        <h2>{{ $university->title }}-ni dəyiş</h2>
        <form action="{{ route('universities.update', $university->id) }}" class="addNewPermissionForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-items">
                <div class="form-item">
                    <label for="title">Universitet</label>
                    <input type="text" placeholder="Ad" name="title" value="{{ old('title', $university->title) }}">
                    @if ($errors->first('title'))
                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                    @endif
                </div>

                <div class="form-item">
                    <label for="education_level_id">Təhsil pilləsi seçin</label>
                    <select name="education_level_id" id="education_level_select">
                        <option value="">Seçin</option>
                        @foreach($education_levels as $education_level)
                            <option value="{{ $education_level->id }}" {{ $university->education_level_id == $education_level->id ? 'selected' : '' }}>
                                {{ $education_level->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="school_type_id">Məktəbin növü seçin</label>
                    <select name="school_type_id" id="school_type_select">
                        <option value="">Seçin</option>
                        @foreach($university->education_level->school_types ?? [] as $school_type)
                            <option value="{{ $school_type->id }}" {{ $university->school_type_id == $school_type->id ? 'selected' : '' }}>
                                {{ $school_type->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="profession_id">İxtisas seçin</label>
                    <select name="profession_id">
                        <option value="">Seçin</option>
                        @foreach($professions as $profession)
                            <option value="{{ $profession->id }}" {{ $university->profession_id == $profession->id ? 'selected' : '' }}>
                                {{ $profession->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="education_language_id">Təhsil dilini seçin</label>
                    <select name="education_language_id">
                        <option value="">Seçin</option>
                        @foreach($education_languages as $education_language)
                            <option value="{{ $education_language->id }}" {{ $university->education_language_id == $education_language->id ? 'selected' : '' }}>
                                {{ $education_language->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="education_language_id">Şəhər seçin</label>
                    <select name="town_id">
                        <option value="">Seçin</option>
                        @foreach($towns as $town)
                            <option value="{{ $town->id }}" {{ $university->town_id == $town->id ? 'selected' : '' }}>
                                {{ $town->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="min_price">Təhsil haqqı</label>
                    <input type="text" placeholder="Təhsil haqqı" name="price" value="{{ old('price', $university->price) }}">
                    @if ($errors->first('price'))
                        <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                    @endif
                </div>

                <div class="form-item">
                    <label for="file">File</label>
                    <input type="file" placeholder="File" name="file">
                    @if($university->file)
                        <a href="{{ asset('files/' . $university->file) }}">Fayla bax <img src="{{asset('/')}}assets/images/eye.svg" alt=""></a>
                    @endif
                </div>
            </div>
            <button class="addPermissionBtn" type="submit">Yadda saxla</button>
        </form>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#education_level_select").on("change", function () {
            let educationLevelId = $(this).val();
            let schoolTypeSelect = $("#school_type_select");

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
</script>
