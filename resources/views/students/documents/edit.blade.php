@extends('layouts.master')
@section('title', 'Sənədlər')

@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">

            <form action="{{ route('file.upload.update', $document->id) }}"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="grid grid-cols-3 gap-4">

                    <!-- Təhsil səviyyəsi -->
                    <div class="form-item flex flex-col">
                        <label for="educationLevel" class="mb-1 font-medium text-sm text-gray-700">Təhsil səviyyəsi</label>
                        <select name="file_title" id="educationLevel"
                                class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">Seçin</option>
                            @foreach($education_levels as $education_level)
                                <option value="{{ $education_level->title }}" {{ $document->file_title == $education_level->title ? 'selected' : '' }}>
                                    {{ $education_level->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sənədin adı -->
                    <div class="form-item flex flex-col">
                        <label for="documentTitle" class="mb-1 font-medium text-sm text-gray-700">Sənədin adı</label>
                        <select name="title" id="documentTitle"
                                class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">Seç</option>
                            @foreach($setting_documents as $setting_document)
                                <option value="{{ $setting_document->title }}" {{ $document->title == $setting_document->title ? 'selected' : '' }}>
                                    {{ $setting_document->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-item flex flex-col">
                        <label class="mb-1 font-medium text-sm text-gray-700">Fayl</label>

                        <input type="file" name="file" class="w-full border border-gray-300 rounded-lg p-2">
                    </div>


                </div>

                <!-- Buttonlar -->
                <div class="flex justify-end gap-2 mt-6">
                    <button class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition">
                        Yadda saxla
                    </button>
                    <a href="{{ route('documents.index', $user->id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">
                        Geri
                    </a>
                </div>
                @if($document->file)
                    <div class="max-w-xl my-4 rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="bg-white p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
      <span class="text-sm font-medium text-blue-600">
        Mövcud fayl:
        <a href="{{ asset('files/' . $document->file) }}" target="_blank" class="ml-2 underline hover:text-blue-800 transition-colors">
          Faylı aç
        </a>
      </span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-50">
                            <iframe
                                src="{{ asset('files/' . $document->file) }}"
                                class="w-full h-[400px]"
                                style="border-radius: 0 0 0.5rem 0.5rem;"
                                frameborder="0">
                            </iframe>
                        </div>
                    </div>
                @endif
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

<script>

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


    });
</script>
