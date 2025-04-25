@extends('layouts.master')
@section('title', 'Dil Redaktəsi')
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <form action="{{ route('lang.update', $education->id) }}" class="form_addUni" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="grid grid-cols-3 gap-4 p-4">
                    <!-- İmtahan dili -->
                    <div class="flex flex-col">
                        <label for="language" class="mb-2 text-gray-700 dark:text-white">İmtahan dili</label>
                        <select name="language" id="language" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">Seç</option>
                            @foreach($exam_languages as $exam_language)
                                <option data-id="{{$exam_language->id}}" value="{{$exam_language->title}}"
                                        @if($education->language == $exam_language->title) selected @endif>
                                    {{$exam_language->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- İmtahan -->
                    <div class="flex flex-col" id="exam-wrapper">
                        @if($exams->count() > 0)
                            <div class="flex flex-col" >
                                <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                                <select name="exam" id="exam" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    <option value="">Seç</option>
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->title}}"
                                                @if($education->exam == $exam->title) selected @endif>
                                            {{$exam->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="flex flex-col">
                                <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                                <input type="text" name="exam" id="exam" value="{{ $education->exam }}"
                                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                       placeholder="İmtahan">
                            </div>
                        @endif
                    </div>

                    <!-- Səviyyə -->
                    <div class="flex flex-col">
                        <label for="level" class="mb-2 text-gray-700 dark:text-white">Səviyyə</label>
                        <input type="text" name="level" id="level" value="{{ $education->level }}"
                               class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                               placeholder="Səviyyə">
                    </div>

                    <!-- Ortalama bal -->
                    <div class="flex flex-col">
                        <label for="point" class="mb-2 text-gray-700 dark:text-white">Ortalama bal</label>
                        <input type="text" name="point" id="point" value="{{ $education->point }}"
                               class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                               placeholder="Ortalama bal">
                    </div>

                    <!-- İmtahan tarixi -->
                    <div class="flex flex-col">
                        <label for="date" class="mb-2 text-gray-700 dark:text-white">İmtahan tarixi</label>
                        <input type="date" name="date" value="{{ $education->date ? \Carbon\Carbon::parse($education->date)->format('Y-m-d') : '' }}"
                               class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- Submit button -->
                <div class="flex justify-end gap-2 mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition" type="submit">Yadda Saxla</button>
                    <a href="{{ route('lang.index', $user->id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">Geri</a>
                </div>
            </form>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        // $('.select2').select2();

        $('#language').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const languageId = selectedOption.data('id');
            const examWrapper = $('#exam-wrapper');

            if (!languageId) {
                examWrapper.html(`
                    <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                    <select name="exam" id="exam" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seç</option>
                    </select>
                `);
                $('#exam').select2(); // Reinitialize Select2
                return;
            }

            $.ajax({
                url: `/api/exams/by-education/${languageId}`,
                method: 'GET',
                success: function(response) {
                    let newElement;

                    if (response.exams && response.exams.length > 0) {
                        console.log(response.exams)
                        let options = '<option value="">Seç</option>';
                        response.exams.forEach(function(exam) {
                            options += `<option value="${exam.title}">${exam.title}</option>`;
                        });

                        newElement = `
                            <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                            <select name="exam" id="exam" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                ${options}
                            </select>
                        `;
                    } else {
                        // No exams, create input
                        newElement = `
                            <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                            <input type="text" name="exam" id="exam" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="İmtahanı əlavə edin">
                        `;
                    }

                    // Replace the content
                    examWrapper.html(newElement);

                    // Reinitialize Select2 if select was created
                    if (newElement.includes('select')) {
                        $('#exam').select2();
                    }
                },
                error: function() {
                    alert('Xəta baş verdi. Zəhmət olmasa yenidən yoxlayın.');
                    examWrapper.html(`
                        <label for="exam" class="mb-2 text-gray-700 dark:text-white">İmtahan</label>
                        <select name="exam" id="exam" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">Seç</option>
                        </select>
                    `);
                    $('#exam').select2();
                }
            });
        });
    });
</script>
