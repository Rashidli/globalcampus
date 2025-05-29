@extends('layouts.master')
@section('title', 'Tələbələr')

@section('content')
    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <br>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <!-- Program Header -->
            <button
                onclick="toggleProgram({{ $program->id }})"
                class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition duration-300"
            >
                <p class="text-lg font-semibold text-gray-800">{{$program->university_list?->title}}</p>
                <svg
                    id="program-icon-{{ $program->id }}"
                    class="w-6 h-6 text-gray-800 transform transition-transform duration-300"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </button>

            <!-- Program Details -->
            <div id="program-details-{{ $program->id }}" class="p-6 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-y-3 mb-6">
                    <div class="text-left font-medium">Ölkə:</div>
                    <div class="text-left font-bold">{{$program->country?->title}}</div>

                    <div class="text-left font-medium">Universitet:</div>
                    <div class="text-left font-bold">{{$program->university_list?->title}}</div>

                    <div class="text-left font-medium">Təhsil pilləsi:</div>
                    <div class="text-left font-bold">{{$program->education_level?->title}}</div>

                    <div class="text-left font-medium">İxtisas:</div>
                    <div class="text-left font-bold">{{$program->tariff?->profession->title}}</div>

                    <div class="text-left font-medium">Təhsil haqqı:</div>
                    <div class="text-left font-bold">{{$program->price}}</div>

                    <div class="text-left font-medium">Dönəm:</div>
                    <div class="text-left font-bold">{{$program->period?->title}}</div>

                    <div class="text-left font-medium">Cari Status:</div>
                    <div class="text-left font-bold">{{$program->program_status?->title}}</div>

                    <div class="text-left font-medium">App no:</div>
                    <div class="text-left font-bold">{{$program->app_no}}</div>

                    <div class="text-left font-medium">Başvuru tarixi:</div>
                    <div class="text-left font-bold">{{$program->application_date}}</div>

                    <div class="text-left font-medium">Nəticə tarixi:</div>
                    <div class="text-left font-bold">{{$program->result_date}}</div>

                    <div class="text-left font-medium">Qeyd:</div>
                    <div class="text-left font-bold">{{$program->note}}</div>

                    @if($program->education_level?->description)
                        <div class="text-left font-medium">Açıqlama:</div>
                        <div class="text-left font-bold">{{$program->education_level?->description}}</div>
                    @endif
                    @if(!$program->is_accept)
                        <div class="text-left font-medium">Təsdiqlə:</div>
                        <div class="text-left font-bold">
                            <form action="{{route('programs.accept', $program->id)}}" class="hover:bg-gray-100 rounded" method="post">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md shadow-md transition">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="2.5"
                                         stroke="currentColor"
                                         class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <span class="text-base font-semibold">Təsdiqlə</span>
                                </button>

                            </form>
                        </div>
                    @else
                        <div class="text-left font-medium">Təsdiqlənib</div>
                    @endif


                </div>
            </div>
        </div>

    </div>
@endsection
