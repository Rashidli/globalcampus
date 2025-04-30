@extends('layouts.master')
@section('title', 'Universitetlər')

@section('content')
    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <p>{{session('message')}}</p>
        </div>
    @endif

    <div class="universities-container">
        @include('partials.university-tabs')

        <div class="university-tab-content universities-main">
            <div class="level_bachelor_content">
                <div class="level_bachelor_tabs">
                    @foreach($university_school_types as $keys => $university_school_type)
                        <button class="level_bachelor_tab @if(!$keys) active @endif" type="button"
                                id="bachelor_{{$university_school_type->id}}">{{$university_school_type->title}}</button>
                    @endforeach
                </div>
                <div class="universities-area">
                    <div class="university_titles">
                        <p class="universityNumber">№</p>
                        <p class="universitName">Universitet adı</p>
                    </div>
                    <div class="universities_lists_area">
                        @foreach($university_school_types as $keyss => $university_school_type)
                            <div class="bachelor_universities_lists @if(!$keyss) active @endif"
                                 data-id="bachelor_{{$university_school_type->id}}">
                                @foreach($university_school_type->universities ?? [] as $keysss => $university)
                                    <div class="universities_lists_item">
                                        <p class="universityNumber">{{$keysss + 1}}</p>
                                        <p class="universitName">{{$university->title}}</p>
                                        <div class="item-buttons">
                                            @can('edit-universities')
                                            <a href="javascript:void(0)" class="editUniversityBtn"
                                               data-id="{{ $university->id }}"
                                               data-title="{{ $university->title }}"
                                               data-education_level="{{ $university->university_education_level_id }}"
                                               data-school_type="{{ $university->university_school_type_id }}">
                                                <img src="{{asset('/')}}assets/images/pen.svg" alt="Edit">
                                            </a>
                                            @endcan

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
                                    <button
                                        class="addNewUniversity bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
                                        type="button">
                                        <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                                        Əlavə et
                                    </button>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add University Modal -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="addUniversityModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h2 class="text-xl font-semibold">Yeni PDF əlavə et</h2>
                <button type="button" class="close-universities-modal text-gray-400 hover:text-gray-500">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('universities.store') }}" method="post" enctype="multipart/form-data" class="mt-4">
                @csrf
                <input type="hidden" name="tab_type" value="2">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Təhsil pilləsi</label>
                        <select name="university_education_level_id" id="university_education_level_select"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                            <option value="">Seçin</option>
                            @foreach($university_education_levels as $university_education_level)
                                <option value="{{ $university_education_level->id }}">
                                    {{ $university_education_level->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Məktəb növü</label>
                        <select name="university_school_type_id" id="university_school_type_select"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                            <option value="">Seçin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Universitet</label>
                        <input type="text" name="title" placeholder="Universitet adı"
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border p-2">
                    </div>

                    <div class="border p-3 rounded-md">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">PDF</label>
                            <button type="button" class="resetDocumentBox text-gray-400 hover:text-gray-500">
                                <img src="{{ asset('/') }}assets/images/x.svg" alt="">
                            </button>
                        </div>
                        <div
                            class="document-input-item border-2 border-dashed rounded-md p-4 text-center cursor-pointer hover:border-blue-500">
                            <input type="file" name="file" class="hidden">
                            <p class="flex items-center justify-center gap-2 text-gray-600">
                                <img src="{{ asset('/') }}assets/images/Paperclip.svg" alt="">
                                Fayl seç
                            </p>
                            <span class="fileName block mt-1 text-sm text-gray-500"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Əlavə et
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit University Modal -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="editUniversityModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h2 class="text-xl font-semibold">Universiteti redaktə et</h2>
                <button type="button" class="close-edit-universities-modal text-gray-400 hover:text-gray-500">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form id="editUniversityForm" method="post" enctype="multipart/form-data" class="mt-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="tab_type" value="2">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Təhsil pilləsi</label>
                        <select name="university_education_level_id"
                                class="edit_education_level_select mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                            <option value="">Seçin</option>
                            @foreach($university_education_levels as $level)
                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Məktəb növü</label>
                        <select name="university_school_type_id"
                                class="edit_school_type_select mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                            <option value="">Seçin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Universitet</label>
                        <input type="text" name="title"
                               class="edit_university_title mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border p-2"
                               placeholder="Universitet adı">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Yeni PDF seçin (əgər dəyişmək
                            istəyirsinizsə)</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600">
                                    <label
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                        <span>Fayl yüklə</span>
                                        <input type="file" name="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PDF formatında</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Yadda saxla
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle education level change for add modal
        $("#university_education_level_select").on("change", function () {
            let educationLevelId = $(this).val();
            let schoolTypeSelect = $("#university_school_type_select");

            schoolTypeSelect.html('<option value="">Seçin</option>');

            if (educationLevelId) {
                $.ajax({
                    url: `/university-get-school-types/${educationLevelId}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (index, schoolType) {
                                schoolTypeSelect.append(
                                    `<option value="${schoolType.id}">${schoolType.title}</option>`
                                );
                            });
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

        // File input handling for add modal
        $('.document-input-item input[type="file"]').change(function () {
            const fileName = $(this).val().split('\\').pop();
            $(this).siblings('.fileName').text(fileName || 'Fayl seçilməyib');
        });

        $('.resetDocumentBox').click(function () {
            const fileInput = $(this).closest('.document-input-box').find('input[type="file"]');
            fileInput.val('');
            fileInput.siblings('.fileName').text('');
        });

        // Modal toggle functions
        $('.addNewUniversity').click(function () {
            $('#addUniversityModal').removeClass('hidden');
        });

        $('.close-universities-modal').click(function () {
            $('#addUniversityModal').addClass('hidden');
        });

        $('.close-edit-universities-modal').click(function () {
            $('#editUniversityModal').addClass('hidden');
        });

        // Edit university modal handling
        $(document).on('click', '.editUniversityBtn', function () {
            const universityId = $(this).data('id');
            const title = $(this).data('title');
            const educationLevelId = $(this).data('education_level');
            const schoolTypeId = $(this).data('school_type');

            $('#editUniversityForm').attr('action', `/universities/${universityId}`);
            $('.edit_university_title').val(title);
            $('.edit_education_level_select').val(educationLevelId).trigger('change');

            // Fetch school types for the selected education level
            fetchSchoolTypesForEdit(educationLevelId, schoolTypeId);

            $('#editUniversityModal').removeClass('hidden');
        });

        function fetchSchoolTypesForEdit(educationLevelId, selectedSchoolTypeId = null) {
            let schoolTypeSelect = $('.edit_school_type_select');
            schoolTypeSelect.html('<option value="">Seçin</option>');

            if (educationLevelId) {
                $.ajax({
                    url: `/university-get-school-types/${educationLevelId}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (index, schoolType) {
                                let selected = (schoolType.id == selectedSchoolTypeId) ? 'selected' : '';
                                schoolTypeSelect.append(
                                    `<option value="${schoolType.id}" ${selected}>${schoolType.title}</option>`
                                );
                            });
                        }
                    },
                    error: function () {
                        alert("Məktəb növləri yüklənmədi.");
                    }
                });
            }
        }

        // Close modals when clicking outside
        $(window).click(function (event) {
            if ($(event.target).is('#addUniversityModal')) {
                $('#addUniversityModal').addClass('hidden');
            }
            if ($(event.target).is('#editUniversityModal')) {
                $('#editUniversityModal').addClass('hidden');
            }
        });
    });
</script>

