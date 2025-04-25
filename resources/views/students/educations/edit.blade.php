@extends('layouts.master')
@section('title', 'Təhsil Redaktə Et')
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <form action="{{ route('educations.update', $education->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $education->user_id }}">

                <div class="grid grid-cols-3 gap-4 p-4">
                    <!-- Təhsil pilləsi -->
                    <div class="flex flex-col">
                        <label for="degree" class="mb-2 text-gray-700 dark:text-white">Təhsil pilləsi</label>
                        <select name="degree" id="degree" class="select2 border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                            <option value="">Seçin</option>
                            <option value="Məktəb" {{ $education->degree == 'Məktəb' ? 'selected' : '' }}>Məktəb</option>
                            <option value="Kollec" {{ $education->degree == 'Kollec' ? 'selected' : '' }}>Kollec</option>
                            <option value="Bakalavr" {{ $education->degree == 'Bakalavr' ? 'selected' : '' }}>Bakalavr</option>
                            <option value="Magistr" {{ $education->degree == 'Magistr' ? 'selected' : '' }}>Magistr</option>
                            <option value="Denklik" {{ $education->degree == 'Denklik' ? 'selected' : '' }}>Denklik</option>
                        </select>
                    </div>

                    <!-- Dynamic fields will be loaded here -->
                    <div id="dynamicFields" class="col-span-3 grid grid-cols-3 gap-4">
                        <!-- Fields will be loaded based on degree selection -->
                        @if($education->degree == 'Məktəb')
                            @include('students.educations.partials.school_fields', ['education' => $education])
                        @elseif($education->degree == 'Kollec')
                            @include('students.educations.partials.college_fields', ['education' => $education])
                        @elseif($education->degree == 'Bakalavr' || $education->degree == 'Magistr')
                            @include('students.educations.partials.university_fields', ['education' => $education, 'universities' => $universities])
                        @elseif($education->degree == 'Denklik')
                            @include('students.educations.partials.equivalence_fields', ['education' => $education])
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4 p-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">Yenilə</button>
                    <a href="{{ route('educations.index', $education->user_id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">Geri</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript for dynamically loading fields on edit page
        document.addEventListener('DOMContentLoaded', function() {
            const degreeSelect = document.getElementById('degree');
            const dynamicFields = document.getElementById('dynamicFields');

            degreeSelect.addEventListener('change', function() {
                const degree = this.value;
                let url = "{{ route('educations.get_fields', ':degree') }}".replace(':degree', degree);

                fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        dynamicFields.innerHTML = data.html;
                    });
            });
        });
    </script>
@endsection
