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

    .education-item {
        margin-bottom: 1.5rem;
    }
</style>
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <br>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @foreach($user->educations ?? [] as $key => $education)
            <div class="education-item bg-white rounded-lg shadow-md overflow-hidden">
                <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition duration-300 education-toggle">
                    <p class="text-lg font-semibold text-gray-800">{{$key+1}}. {{$education->degree}}</p>
                    <svg class="w-6 h-6 text-gray-800 transform transition-transform duration-300 toggle-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="education-content  mx-auto bg-white p-8 border-gray-300 shadow-sm">
                    <div class="grid grid-cols-2 gap-y-3">
                        @if($education->degree == 'Məktəb')
                            <div class="text-left font-medium">Məktəb Adı:</div>
                            <div class="text-left font-bold">{{$education->institution_name}}</div>

                            <div class="text-left font-medium">Şəhər:</div>
                            <div class="text-left font-bold">{{$education->city}}</div>

                            <div class="text-left font-medium">Ortalama Bal:</div>
                            <div class="text-left font-bold">{{$education->average_score}}</div>

                            <div class="text-left font-medium">Attestat Ortalaması:</div>
                            <div class="text-left font-bold">{{$education->attestat_score}}</div>

                        @elseif($education->degree == 'Kollec')
                            <div class="text-left font-medium">Kollec Adı:</div>
                            <div class="text-left font-bold">{{$education->institution_name}}</div>

                            <div class="text-left font-medium">Şəhər:</div>
                            <div class="text-left font-bold">{{$education->city}}</div>

                            <div class="text-left font-medium">Ortalama Bal:</div>
                            <div class="text-left font-bold">{{$education->average_score}}</div>

                        @elseif($education->degree == 'Bakalavr' || $education->degree == 'Magistr')
                            <div class="text-left font-medium">Universitet:</div>
                            <div class="text-left font-bold">{{$education->institution_name}}</div>

                            <div class="text-left font-medium">Fakültə:</div>
                            <div class="text-left font-bold">{{$education->faculty}}</div>

                            <div class="text-left font-medium">İxtisas:</div>
                            <div class="text-left font-bold">{{$education->specialty}}</div>

                            <div class="text-left font-medium">Ortalama Bal:</div>
                            <div class="text-left font-bold">{{$education->average_score}}</div>

                        @elseif($education->degree == 'Denklik')
                            <div class="text-left font-medium">Randevu Tarixi:</div>
                            <div class="text-left font-bold">{{$education->appointment_date}}</div>

                            <div class="text-left font-medium">Təqip Nömrəsi:</div>
                            <div class="text-left font-bold">{{$education->tracking_number}}</div>

                            <div class="text-left font-medium">Mobil Nömrə:</div>
                            <div class="text-left font-bold">{{$education->mobile}}</div>

                            <div class="text-left font-medium">Email:</div>
                            <div class="text-left font-bold">{{$education->email}}</div>
                        @endif

                        <div class="text-left font-medium">Başlama Tarixi:</div>
                        <div class="text-left font-bold">{{$education->start_date}}</div>

                        <div class="text-left font-medium">Bitmə Tarixi:</div>
                        <div class="text-left font-bold">{{$education->end_date}}</div>

                        @if($education->exam_name)
                            <div class="text-left font-medium">İmtahan Adı:</div>
                            <div class="text-left font-bold">{{$education->exam_name}}</div>

                            <div class="text-left font-medium">İmtahan Nəticəsi:</div>
                            <div class="text-left font-bold">{{$education->exam_result}}</div>
                        @endif

                        <div class="text-left font-medium">Dəyişdir:</div>
                        <div class="text-left font-bold">
                            <a href="{{route('educations.edit', $education->id)}}" class="hover:bg-gray-100 rounded">
                                <img src="{{asset('/')}}assets/images/pen.svg" alt="Edit" class="w-5 h-5">
                            </a>
                        </div>

                        <div class="text-left font-medium">Sil:</div>
                        <div class="text-left font-bold">
                            <form action="{{ route('educations.destroy', $education->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" class="hover:bg-gray-100 rounded">
                                    <img src="{{ asset('/') }}assets/images/trash.svg" alt="Delete" class="w-5 h-5">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach

        @if(count($user->educations ?? []) === 0)
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600">Hələ heç bir təhsil məlumatı əlavə edilməyib</p>
            </div>
        @endif

        <a href="{{route('educations.create', $user->id)}}" class="addLangBoxBtn mt-4">
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
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="deleteStudent_yes">Bəli, sil</button>
                </form>
                <button class="deleteStudent_no" type="button">Xeyir, silmə</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Açılıp bağlanma funksiyası
            const educationToggles = document.querySelectorAll('.education-toggle');

            educationToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.toggle-icon');

                    content.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });

            // Əgər URL-də #error varsa, xəta mesajı göstər
            if (window.location.hash === '#error') {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                errorDiv.role = 'alert';
                errorDiv.innerHTML = `
            <strong class="font-bold">Xəta!</strong>
            <span class="block sm:inline">Təhsil məlumatları yüklənərkən xəta baş verdi.</span>
        `;

                const container = document.querySelector('.student-detailView-container');
                container.insertBefore(errorDiv, container.firstChild);
            }
        });
    </script>
@endpush
