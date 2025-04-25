<div class="flex flex-col">
    <label for="appointment_date" class="mb-2 text-gray-700 dark:text-white">Randevu Tarixi</label>
    <input type="date" name="appointment_date" value="{{ $education->appointment_date ?? old('appointment_date') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="tracking_number" class="mb-2 text-gray-700 dark:text-white">Təqip Nömrəsi</label>
    <input type="text" name="tracking_number" value="{{ $education->tracking_number ?? old('tracking_number') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="mobile" class="mb-2 text-gray-700 dark:text-white">Mobil Nömrə</label>
    <input type="text" name="mobile" value="{{ $education->mobile ?? old('mobile') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
<div class="flex flex-col">
    <label for="email" class="mb-2 text-gray-700 dark:text-white">Email</label>
    <input type="email" name="email" value="{{ $education->email ?? old('email') }}" class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
</div>
