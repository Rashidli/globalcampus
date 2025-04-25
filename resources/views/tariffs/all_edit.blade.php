@extends('layouts.master')
@section('title', 'Universitet qiymətlərini dəyiş.')

@section('content')

    <a href="{{ route('tariffs.index') }}" class="goBack">
        <img src="{{asset('/')}}assets/images/back.svg" alt="">
        Geri
    </a>

    <div class="addNewPermission-container">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">{{ $university->title }} məlumatlarını yenilə</h2>

        <form action="{{ route('tariff.all.update', $university->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach($tariffs as $index => $tariff)
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6 border border-gray-100 rounded-lg p-4 shadow-sm">
                    <!-- İxtisas -->

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">İxtisas</label>
                        <input type="hidden" name="profession_id[]" value="{{ $tariff->profession?->id }}">
                        <input
                            type="text"
                            readonly
                            value="{{ $tariff->profession?->title }}"
                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700"
                        >
                        @if ($errors->first('profession_id.' . $index))
                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('profession_id.' . $index) }}</p>
                        @endif
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Təhisl pilləsi</label>
                        <input
                            type="text"
                            readonly
                            value="{{ $tariff->education_level?->title }}"
                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700"
                        >
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Təhisl dili</label>
                        <input
                            type="text"
                            readonly
                            value="{{ $tariff->education_language?->title }}"
                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700"
                        >
                    </div>

                    <!-- Təhsil haqqı -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Təhsil haqqı</label>
                        <input
                            type="text"
                            name="price[]"
                            placeholder="Təhsil haqqı"
                            value="{{ old('price.' . $index, $tariff->price) }}"
                            class="w-full rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        @if ($errors->first('price.' . $index))
                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('price.' . $index) }}</p>
                        @endif
                    </div>

                    <!-- Endirimli təhsil haqqı -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Endirimli təhsil haqqı</label>
                        <input
                            type="text"
                            name="discounted_price[]"
                            placeholder="Endirimli təhsil haqqı"
                            value="{{ old('discounted_price.' . $index, $tariff->discounted_price) }}"
                            class="w-full rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        @if ($errors->first('discounted_price.' . $index))
                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('discounted_price.' . $index) }}</p>
                        @endif
                    </div>

                    <!-- Valyuta -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Valyuta</label>
                        <select
                            name="currency_id[]"
                            class="w-full rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Seçin</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" {{ $tariff->currency_id == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->first('currency_id.' . $index))
                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('currency_id.' . $index) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all">
                Yadda saxla
            </button>
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
