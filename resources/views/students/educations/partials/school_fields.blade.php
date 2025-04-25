<div class="flex flex-col">
    <label for="institution_name" class="mb-2 text-gray-700 dark:text-white">Məktəb Adı</label>
    <input type="text" name="institution_name" value="{{ $education->institution_name ?? old('institution_name') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="city" class="mb-2 text-gray-700 dark:text-white">Yerləşdiyi Şəhər</label>
    <input type="text" name="city" value="{{ $education->city ?? old('city') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="average_score" class="mb-2 text-gray-700 dark:text-white">Ortalama Bal</label>
    <input type="number" step="0.01" name="average_score" value="{{ $education->average_score ?? old('average_score') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
</div>
<div class="flex flex-col">
    <label for="attestat_score" class="mb-2 text-gray-700 dark:text-white">Attestat Ortalaması</label>
    <input type="number" step="0.01" name="attestat_score" value="{{ $education->attestat_score ?? old('attestat_score') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
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
            <option value="{{ $exam->name }}" {{ ($education->exam_name ?? old('exam_name')) == $exam->title ? 'selected' : '' }}>{{ $exam->title }}</option>
        @endforeach
    </select>
</div>
<div class="flex flex-col">
    <label for="exam_result" class="mb-2 text-gray-700 dark:text-white">İmtahan Nəticəsi</label>
    <input type="text" name="exam_result" value="{{ $education->exam_result ?? old('exam_result') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
