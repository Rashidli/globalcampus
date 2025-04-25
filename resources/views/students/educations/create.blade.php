@extends('layouts.master')
@section('title', 'Təhsil Əlavə Et')
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <form action="{{ route('educations.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="grid grid-cols-3 gap-4 p-4">
                    <!-- Təhsil pilləsi -->
                    <div class="flex flex-col">
                        <label for="degree" class="mb-2 text-gray-700 dark:text-white">Təhsil pilləsi</label>
                        <select name="degree" id="degree"
                                class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="">Seçin</option>
                            <option value="Məktəb">Məktəb</option>
                            <option value="Kollec">Kollec</option>
                            <option value="Bakalavr">Bakalavr</option>
                            <option value="Magistr">Magistr</option>
                            <option value="Denklik">Denklik</option>
                        </select>
                    </div>

                    <!-- Dynamic fields will be loaded here -->
                    <div id="dynamicFields" class="col-span-3 grid grid-cols-3 gap-4">
                        <!-- Fields will be loaded based on degree selection -->
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4 p-4">
                    <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition">
                        Əlavə et
                    </button>
                    <a href="{{ route('educations.index', $user->id) }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">Geri</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const degreeSelect = document.getElementById('degree');
            const dynamicFields = document.getElementById('dynamicFields');

            degreeSelect.addEventListener('change', function () {
                const degree = this.value;
                let fieldsHtml = '';

                if (degree === 'Məktəb') {
                    fieldsHtml = `
                <div class="flex flex-col">
                    <label for="institution_name" class="mb-2 text-gray-700 dark:text-white">Məktəb Adı</label>
                    <input type="text" name="institution_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="city" class="mb-2 text-gray-700 dark:text-white">Yerləşdiyi Şəhər</label>
                    <input type="text" name="city" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="average_score" class="mb-2 text-gray-700 dark:text-white">Ortalama Bal</label>
                    <input type="number" step="0.01" name="average_score" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
                <div class="flex flex-col">
                    <label for="attestat_score" class="mb-2 text-gray-700 dark:text-white">Attestat Ortalaması</label>
                    <input type="number" step="0.01" name="attestat_score" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
                <div class="flex flex-col">
                    <label for="start_date" class="mb-2 text-gray-700 dark:text-white">Başlama Tarixi</label>
                    <input type="date" name="start_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="mb-2 text-gray-700 dark:text-white">Bitmə Tarixi</label>
                    <input type="date" name="end_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="exam_name" class="mb-2 text-gray-700 dark:text-white">İmtahan Adı</label>
                    <select name="exam_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($exams as $exam)
                    <option value="{{ $exam->title }}">{{ $exam->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="exam_result" class="mb-2 text-gray-700 dark:text-white">İmtahan Nəticəsi</label>
                    <input type="text" name="exam_result" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
            `;
                } else if (degree === 'Kollec') {
                    fieldsHtml = `
                <div class="flex flex-col">
                    <label for="institution_name" class="mb-2 text-gray-700 dark:text-white">Kollec Adı</label>
                    <input type="text" name="institution_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="city" class="mb-2 text-gray-700 dark:text-white">Yerləşdiyi Şəhər</label>
                    <input type="text" name="city" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="average_score" class="mb-2 text-gray-700 dark:text-white">Ortalama Bal</label>
                    <input type="number" step="0.01" name="average_score" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
                <div class="flex flex-col">
                    <label for="start_date" class="mb-2 text-gray-700 dark:text-white">Başlama Tarixi</label>
                    <input type="date" name="start_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="mb-2 text-gray-700 dark:text-white">Bitmə Tarixi</label>
                    <input type="date" name="end_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="exam_name" class="mb-2 text-gray-700 dark:text-white">İmtahan Adı</label>
                    <select name="exam_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seçin</option>
                        @foreach($exams as $exam)
                    <option value="{{ $exam->title }}">{{ $exam->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="exam_result" class="mb-2 text-gray-700 dark:text-white">İmtahan Nəticəsi</label>
                    <input type="text" name="exam_result" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
            `;
                } else if (degree === 'Bakalavr' || degree === 'Magistr') {
                    fieldsHtml = `
                <div class="flex flex-col">
                    <label for="institution_name" class="mb-2 text-gray-700 dark:text-white">Universitet Adı</label>
                    <select name="institution_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        <option value="">Seçin</option>
                        @foreach($universities as $university)
                    <option value="{{ $university->title }}">{{ $university->title }}</option>
                        @endforeach
                    <option value="other">Digər (Əl ilə daxil et)</option>
                </select>
                <input type="text" name="custom_university" id="customUniversity" class="border border-gray-300 rounded-lg p-2 w-full mt-2 hidden dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Universitet adını daxil edin">
            </div>
            <div class="flex flex-col">
                <label for="faculty" class="mb-2 text-gray-700 dark:text-white">Fakültə Adı</label>
                <input type="text" name="faculty" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>
            <div class="flex flex-col">
                <label for="specialty" class="mb-2 text-gray-700 dark:text-white">İxtisas Adı</label>
                <input type="text" name="specialty" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>
            <div class="flex flex-col">
                <label for="average_score" class="mb-2 text-gray-700 dark:text-white">Ortalama Bal</label>
                <input type="number" step="0.01" name="average_score" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="flex flex-col">
                <label for="start_date" class="mb-2 text-gray-700 dark:text-white">Başlama Tarixi</label>
                <input type="date" name="start_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>
            <div class="flex flex-col">
                <label for="end_date" class="mb-2 text-gray-700 dark:text-white">Bitmə Tarixi</label>
                <input type="date" name="end_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>
            <div class="flex flex-col">
                <label for="exam_name" class="mb-2 text-gray-700 dark:text-white">İmtahan Adı</label>
                <select name="exam_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Seçin</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->title }}">{{ $exam->title }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="exam_result" class="mb-2 text-gray-700 dark:text-white">İmtahan Nəticəsi</label>
                    <input type="text" name="exam_result" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
            `;
                } else if (degree === 'Denklik') {
                    fieldsHtml = `
                <div class="flex flex-col">
                    <label for="appointment_date" class="mb-2 text-gray-700 dark:text-white">Randevu Tarixi</label>
                    <input type="date" name="appointment_date" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="tracking_number" class="mb-2 text-gray-700 dark:text-white">Təqip Nömrəsi</label>
                    <input type="text" name="tracking_number" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="mobile" class="mb-2 text-gray-700 dark:text-white">Mobil Nömrə</label>
                    <input type="text" name="mobile" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex flex-col">
                    <label for="email" class="mb-2 text-gray-700 dark:text-white">Email</label>
                    <input type="email" name="email" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                </div>
            `;
                }

                dynamicFields.innerHTML = fieldsHtml;

                // Əgər universitet seçimi "Digər"dirsə, inputu göstər
                if (degree === 'Bakalavr' || degree === 'Magistr') {
                    const universitySelect = document.querySelector('select[name="institution_name"]');
                    const customUniversityInput = document.getElementById('customUniversity');

                    universitySelect.addEventListener('change', function() {
                        if (this.value === 'other') {
                            customUniversityInput.classList.remove('hidden');
                            customUniversityInput.setAttribute('required', 'required');
                        } else {
                            customUniversityInput.classList.add('hidden');
                            customUniversityInput.removeAttribute('required');
                        }
                    });
                }
            });
        });
    </script>
@endsection
