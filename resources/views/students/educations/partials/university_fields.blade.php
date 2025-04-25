<div class="flex flex-col">
    <label for="institution_name" class="mb-2 text-gray-700 dark:text-white">Universitet Adı</label>
    <select name="institution_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
        <option value="">Seçin</option>
        @foreach($universities as $university)
            <option value="{{ $university->title }}"
                {{ ($education->institution_name ?? old('institution_name')) == $university->title ? 'selected' : '' }}>
                {{ $university->title }}
            </option>
        @endforeach
        <option value="other" {{ old('institution_name') == 'other' ? 'selected' : '' }}>Digər (Əl ilə daxil et)</option>
    </select>
    <input type="text" name="custom_university" id="customUniversity"
           value="{{ old('custom_university') }}"
           class="border border-gray-300 rounded-lg p-2 w-full mt-2 {{ ($education->institution_name ?? old('institution_name')) == 'other' ? '' : 'hidden' }} dark:border-gray-600 dark:bg-gray-700 dark:text-white"
           placeholder="Universitet adını daxil edin"
        {{ ($education->institution_name ?? old('institution_name')) == 'other' ? 'required' : '' }}>
</div>
<div class="flex flex-col">
    <label for="faculty" class="mb-2 text-gray-700 dark:text-white">Fakültə Adı</label>
    <input type="text" name="faculty" value="{{ $education->faculty ?? old('faculty') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="specialty" class="mb-2 text-gray-700 dark:text-white">İxtisas Adı</label>
    <input type="text" name="specialty" value="{{ $education->specialty ?? old('specialty') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="average_score" class="mb-2 text-gray-700 dark:text-white">Ortalama Bal</label>
    <input type="number" step="0.01" name="average_score" value="{{ $education->average_score ?? old('average_score') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
</div>
<div class="flex flex-col">
    <label for="start_date" class="mb-2 text-gray-700 dark:text-white">Başlama Tarixi</label>
    <input type="date" name="start_date" value="{{ $education->start_date ?? old('start_date') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="end_date" class="mb-2 text-gray-700 dark:text-white">Bitmə Tarixi</label>
    <input type="date" name="end_date" value="{{ $education->end_date ?? old('end_date') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="exam_name" class="mb-2 text-gray-700 dark:text-white">İmtahan Adı</label>
    <select name="exam_name" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
        <option value="">Seçin</option>
        @foreach($exams as $exam)
            <option value="{{ $exam->title }}" {{ ($education->exam_name ?? old('exam_name')) == $exam->title ? 'selected' : '' }}>{{ $exam->title }}</option>
        @endforeach
    </select>
</div>
<div class="flex flex-col">
    <label for="exam_result" class="mb-2 text-gray-700 dark:text-white">İmtahan Nəticəsi</label>
    <input type="text" name="exam_result" value="{{ $education->exam_result ?? old('exam_result') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
