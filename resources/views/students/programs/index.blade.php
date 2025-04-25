@extends('layouts.master')
@section('title', 'Tələbələr')
<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 15px;
        margin: 10px 0;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    .active-tab {
        background-color: #3b82f6; /* Tailwind Blue-500 */
        color: white;
        border-radius: 6px 6px 0 0;
    }

    .rotate-180 {
        transform: rotate(180deg);
        transition: transform 0.2s ease-in-out;
    }
</style>
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <br>
        @foreach($programs as $key => $program)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition duration-300">
                    <p class="text-lg font-semibold text-gray-800">{{$key+1}}. {{$program->university_list?->title}}</p>
                    <svg class="w-6 h-6 text-gray-800 transform transition-transform duration-300" class="{'rotate-180': open}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mx-auto bg-white p-8 border-gray-300 shadow-sm">
                    <div class="grid grid-cols-2 gap-y-3">
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

                        <div class="text-left font-medium">Status:</div>
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
                </div>

            </div>
        @endforeach
        <br>
        <a class="addUniBoxBtn" href="{{route('programs.create', $user->id)}}">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </a>
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

<script>
    function toggleRow(id) {
        let row = document.getElementById("row-" + id);
        let icon = document.getElementById("icon-" + id);
        let buttonText = document.querySelector(`button[data-id="${id}"] span`);

        if (row.classList.contains("hidden")) {
            row.classList.remove("hidden");
            icon.classList.add("rotate-180"); // Aşağı oxu çevir
            buttonText.innerText = "Bağla"; // Mətni dəyiş
        } else {
            row.classList.add("hidden");
            icon.classList.remove("rotate-180"); // Yuxarı oxu çevir
            buttonText.innerText = "Aç"; // Mətni dəyiş
        }
    }

    function openTab(id, tabName) {
        // Bütün tabları gizlə
        let tabs = document.querySelectorAll(`.tab-content-${id}`);
        tabs.forEach(tab => tab.classList.add("hidden"));

        // Seçilmiş tabı göstər
        document.getElementById(`tab-${id}-${tabName}`).classList.remove("hidden");

        // Bütün tab düymələrindən aktiv sinifi çıxart
        let tabButtons = document.querySelectorAll(`.tab-btn-${id}`);
        tabButtons.forEach(btn => btn.classList.remove("active-tab"));

        // Aktiv olan tab düyməsinə sinif əlavə et
        event.target.classList.add("active-tab");
    }

    $(document).ready(function () {

        $('select').niceSelect();


        $(document).ready(function () {
            $('#educationLevel').on('change', function () {
                const selectedLevel = $(this).val();
                const documentTitleSelect = $('#documentTitle');

                documentTitleSelect.empty();
                documentTitleSelect.append('<option value="">Seç</option>');

                if (selectedLevel) {
                    $.ajax({
                        url: '/get-documents/' + selectedLevel,
                        type: 'GET',
                        success: function (response) {
                            if (response.documents.length > 0) {
                                response.documents.forEach(function (title) {
                                    documentTitleSelect.append('<option value="' + title + '">' + title + '</option>');
                                });
                            }
                            documentTitleSelect.niceSelect('update');
                        }
                    });
                } else {
                    documentTitleSelect.niceSelect('update');
                }
            });
        });

        $(document).on("click", ".editPersonalInfoBtn", function () {
            let userId = $(this).data("user-id");

            $.ajax({
                url: "/get-user-info",
                type: "GET",
                data: {user_id: userId},
                dataType: "json",
                success: function (response) {
                    $("#user_id").val(response.id);
                    $("#name").val(response.name);
                    $("#surname").val(response.surname);
                    $("#father_name").val(response.student_info?.father_name);
                    $("#mother_name").val(response.student_info?.mother_name);
                    $("#birthday").val(response.student_info?.birthday);
                    $("#passport_number").val(response.student_info?.passport_number);
                    $("#identity_number").val(response.student_info?.identity_number);
                    $("#citizenship").val(response.student_info?.citizenship);
                    $("#contact_email").val(response.student_info?.contact_email);
                    $("#phone").val(response.phone);
                    $("#relative_number").val(response.student_info?.relative_number);
                    $("#whatsapp_number").val(response.student_info?.whatsapp_number);
                    $("#company_email").val(response.student_info?.company_email);
                    $("#emal_password").val(response.student_info?.emal_password);
                    $("#emal_confirmation_code").val(response.student_info?.emal_confirmation_code);
                    $("#client").val(response.student_info?.client);
                    // $("#editPersonalInfoModal").modal("show");
                },
                error: function () {
                    alert("İstifadəçi tapılmadı!");
                }
            });
        });

        $(".form_Personal").on("submit", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                url: "/update-user-info",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    $(".success-message").text("Məlumatlar uğurla yeniləndi!").fadeIn().delay(3000).fadeOut();

                    // Formdakı məlumatları yenilə
                    $("#name").val(response.user.name);
                    $("#surname").val(response.user.surname);
                    $("#phone").val(response.user.phone);
                    $("#father_name").val(response.user.student_info.father_name);
                    $("#mother_name").val(response.user.student_info.mother_name);
                    $("#birthday").val(response.user.student_info.birthday);
                    $("#passport_number").val(response.user.student_info.passport_number);
                    $("#identity_number").val(response.user.student_info.identity_number);
                    $("#citizenship").val(response.user.student_info.citizenship);
                    $("#contact_email").val(response.user.student_info.contact_email);
                    $("#relative_number").val(response.user.student_info.relative_number);
                    $("#whatsapp_number").val(response.user.student_info.whatsapp_number);
                    $("#company_email").val(response.user.student_info.company_email);
                    $("#client").val(response.user.student_info.client);
                    $("#emal_password").val(response.user.student_info.emal_password);
                    $("#emal_confirmation_code").val(response.user.student_info.emal_confirmation_code);
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        // $(".form_addUni").on("submit", function (e) {
        //     e.preventDefault();
        //
        //     let formData = $(this).serialize();
        //
        //     $.ajax({
        //         url: "/education/store",
        //         type: "POST",
        //         data: formData,
        //         dataType: "json",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        //         },
        //         success: function (response) {
        //             alert("Məlumatlar uğurla əlavə edildi!");
        //             location.reload();
        //         },
        //         error: function () {
        //             alert("Xəta baş verdi, yenidən cəhd edin!");
        //         }
        //     });
        // });

        $(".form_addLang").on("submit", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "/lang/store",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    alert("Məlumatlar uğurla əlavə edildi!");
                    location.reload();
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        $(document).on("submit", ".update_education", function (e) {
            e.preventDefault();

            let educationId = $(this).attr("data-id");
            let formData = $(this).serialize();

            // Check if educationId is present to determine if this is an update or create
            let url = educationId ? "/education/update/" + educationId : "/education/store";

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (educationId) {
                        alert("Məlumatlar uğurla yeniləndi!"); // Update success message
                    } else {
                        alert("Məlumatlar uğurla əlavə edildi!"); // Create success message
                    }
                    $(".addUniModal").hide();  // Close the modal
                    // Optionally, refresh the page or the list of education entries
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        $(document).on("click", ".editEducation", function () {

            let educationId = $(this).data("id");
            let educationBox = $(this).closest(".education-box");

            let degree = educationBox.find(".info-list-item:nth-child(1) .itemDetail p").text();
            let university = educationBox.find(".info-list-item:nth-child(2) .itemDetail p").text();
            let profession = educationBox.find(".info-list-item:nth-child(3) .itemDetail p").text();
            let faculty = educationBox.find(".info-list-item:nth-child(4) .itemDetail p").text();
            let gno = educationBox.find(".info-list-item:nth-child(5) .itemDetail p").text();
            let universityStartDate = educationBox.find(".info-list-item:nth-child(6) .itemDetail p").text();
            let universityEndDate = educationBox.find(".info-list-item:nth-child(7) .itemDetail p").text();

            $(".form_addUni input[name=degree]").val(degree);
            $(".form_addUni input[name=university]").val(university);
            $(".form_addUni input[name=profession]").val(profession);
            $(".form_addUni input[name=faculty]").val(faculty);
            $(".form_addUni input[name=gno]").val(gno);
            $(".form_addUni input[name=university_start_date]").val(universityStartDate);
            $(".form_addUni input[name=university_end_date]").val(universityEndDate);
            $(".form_addUni").attr("data-id", educationId); // Add educationId for update

            $(".addUniModal").show();
        });

        function toggleRow(id) {
            let row = document.getElementById("row-" + id);
            if (row.classList.contains("hidden")) {
                row.classList.remove("hidden");
            } else {
                row.classList.add("hidden");
            }
        }

    });
</script>
