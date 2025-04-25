
@extends('layouts.master')
@section('title', 'Universitet əlavə et')

@section('content')

    <a href="{{route('universities.index')}}" class="goBack">
        <img src="{{asset('/')}}assets/images/back.svg" alt="">
        Geri
    </a>

    <div class="addNewPermission-container">
        <h2>Yeni universitet əlavə et</h2>
        <form action="{{route('universities.store')}}" class="addNewPermissionForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-items">
                <div class="form-item">
                    <label for="">Universitet</label>
                    <input type="text" placeholder="Ad" name="title">
                    @if($errors->first('title'))
                        <small class="form-text text-danger">{{$errors->first('title')}}</small>
                    @endif
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsi seçin</label>
                    <select name="education_level_id" id="education_level_select">
                        <option value="">Seçin</option>
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}">{{$education_level->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Məktən növü seçin</label>
                    <select name="school_type_id" id="school_type_select">
                        <option value="">Seçin</option>

                    </select>
                </div>
                <div class="form-item">
                    <label for="">İxtisas seçin</label>
                    <select name="profession_id" id="">
                        <option value="">Seçin</option>
                        @foreach($professions as $profession)
                            <option value="{{$profession->id}}">{{$profession->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Təhsil dilin seçin</label>
                    <select name="education_language_id" id="">
                        <option value="">Seçin</option>
                        @foreach($education_languages as $education_language)
                            <option value="{{$education_language->id}}">{{$education_language->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Şəhər seçin</label>
                    <select name="town_id" id="">
                        <option value="">Seçin</option>
                        @foreach($towns as $town)
                            <option value="{{$town->id}}">{{$town->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-item">
                    <label for="">Təhsil haqqı</label>
                    <input type="text" placeholder="Təhsil haqqı" name="price">
                    @if($errors->first('price'))
                        <small class="form-text text-danger">{{$errors->first('price')}}</small>
                    @endif
                </div>

                <div class="form-item">
                    <label for="">File</label>
                    <input type="file" placeholder="File" name="file">
                </div>
            </div>
            <button class="addPermissionBtn" type="submit">Əlavə et</button>
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
