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
</style>
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <div
                @style(['display: flex ' => request('tab_type') == 1 || !request()->has('tab_type'), 'display: none '=> request()->has('tab_type') && request('tab_type' ) != 1]) class="student-General-tabContent student-tabContent"
                data-id="studentGeneralDetail">
                <div class="student_general_tabs">
                    <button class="student_general_tab active" id="personal_tab" type="button">
                        Şəxsi məlumatlar
                    </button>
                    <button class="student_general_tab" id="magistr_tab" type="button">
                        Magistr
                    </button>
                    <button class="student_general_tab" id="allSteps_tab" type="button">
                        Keçmiş
                    </button>
                </div>

                <div class="student_general_tabContent personalContent" data-id="personal_tab">
                    <div class="studentPersonalInfoBox">
                        <h3 class="boxTitle">Şəxsi məlumatlar</h3>
                        <div class="infoList">
                            <div class="info-list-item">
                                <p>Adı, soyadı:</p>
                                <div class="itemDetail">
                                    <p>{{$user->name}} {{$user->surname}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Ata adı</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->father_name}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Ana adı</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->mother_name}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Doğum tarixi:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->birthday}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Passport no:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->passport_number}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Kimlik no:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->identity_number}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Vətəndaşlıq:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->citizenship}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="studentPersonalInfoBox">
                        <h3 class="boxTitle">Əlaqə</h3>
                        <div class="infoList">
                            <div class="info-list-item">
                                <p>Email:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->contact_email}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Mobil nömrə:</p>
                                <div class="itemDetail">
                                    <p>{{$user->phone}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Mobil nömrə (Yaxın):</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->relative_number}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Whatsapp nömrə:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->whatsapp_number}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="studentPersonalInfoBox">
                        <h3 class="boxTitle">Şirkət əlaqə məlumatları</h3>
                        <div class="infoList">
                            <div class="info-list-item">
                                <p>Email:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->company_email}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Emal şifrə:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->emal_password}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Emal onay kodu:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->emal_confirmation_code}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="studentPersonalInfoBox">
                        <h3 class="boxTitle">Digər məlumatlar</h3>
                        <div class="infoList">
                            <div class="info-list-item">
                                <p>Agent:</p>
                                <div class="itemDetail">
                                    <p>{{$user->agent?->agent_info?->company_name}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Sifarişçi:</p>
                                <div class="itemDetail">
                                    <p>{{$user->agent?->name}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="smallLogo">
                        <img src="{{asset('/')}}assets/images/logo.svg" alt="">
                    </div>
                    <button class="editPersonalInfoBtn" data-user-id="{{ $user->id }}" type="button">Düzəliş et</button>
                </div>

                <div class="student_general_tabContent magistrContent" data-id="magistr_tab">
                </div>
                <div class="student_general_tabContent allSteps_tab" data-id="allSteps_tab">
                    <h2 class="text-lg font-semibold mb-4">Hərəkətlər</h2>
                    <div class="space-y-4">
                        @foreach($user->logs as $log)
                            <div class="flex items-start justify-between gap-4 bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">{{ $log->created_at->format('d.m.Y') }}</p>
                                        <h3 class="text-base font-medium text-gray-800">{{ $log->user?->name }} tərəfindən {{ $log->description }}</h3>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="p-2 hover:bg-gray-100 rounded-md" type="button" title="Düzəliş et">
                                        <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7493 1.99266C13.0172 0.724778..." fill="currentColor"/>
                                        </svg>
                                    </button>
                                    <button class="p-2 hover:bg-gray-100 rounded-md" type="button" title="Sil">
                                        <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 20 20">
                                            <path d="M8.23139 3.54169..." fill="currentColor"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div
                @style(['display: flex '=>request('tab_type' ) == 2, 'display: none '=>request('tab_type' ) != 2]) class="student-jobEducation-tabContent student-tabContent"
                data-id="studentjobEducationDetail">
                <div class="education-box-list">
                    <h2>Təhsil</h2>
                    @foreach($user->educations ?? [] as $education)
                        <div class="education-box">
                            <h2>{{$education->degree}}</h2>
                            <div class="infoList">
                                <div class="info-list-item">
                                    <p>1.Universitet:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->university}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>2.Ixtisas:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->profession}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>3.Fakultə:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->faculty}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>4.Ortalama bal:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->gno}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>5.Başlama tarixi:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->university_start_date}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>6.Bitmə tarixi:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->university_end_date}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                {{--                                <div class="info-list-item">--}}
                                {{--                                    <p>Dəyişdir:</p>--}}
                                {{--                                    <div class="itemDetail">--}}
                                {{--                                        <button class="copyBtn editEducation" data-id="{{$education->id}}"  type="button">--}}
                                {{--                                            <img src="{{asset('/')}}assets/images/pen.svg" alt="">--}}

                                {{--                                        </button>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach

                </div>
                <button class="addUniBoxBtn" type="button">
                    <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                    Əlavə et
                </button>
                <div class="language-box-list">
                    <h2>Dil bilikləri</h2>
                    @foreach($user->languages ?? [] as $language)
                        <div class="language-box">

                            <div class="infoList">
                                <div class="info-list-item">
                                    <p>1.Dil:</p>
                                    <div class="itemDetail">
                                        <p>{{$language->language}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>2.İmtahan adı:</p>
                                    <div class="itemDetail">
                                        <p>{{$language->exam}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>3.Səviyyə:</p>
                                    <div class="itemDetail">
                                        <p>{{$language->level}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>4.Puan:</p>
                                    <div class="itemDetail">
                                        <p>{{$language->point}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="addLangBoxBtn" type="button">
                    <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                    Əlavə et
                </button>
            </div>
            <div
                @style(['display: flex '=>request('tab_type' ) == 3, 'display: none '=>request('tab_type' ) != 3]) class="student-program-tabContent student-tabContent"
                data-id="studentProgramDetail">
                {{--                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden shadow-md">--}}
                {{--                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-300">--}}
                {{--                    <tr>--}}
                {{--                        <th scope="col" class="px-4 py-3">#</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">Universitet adı</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">Təhsil pilləsi</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">Məktəb növü</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">İxtisas</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">Təhsil dili</th>--}}
                {{--                        <th scope="col" class="px-4 py-3">Təhsil haqqı</th>--}}
                {{--                    </tr>--}}
                {{--                    </thead>--}}
                {{--                    <tbody>--}}
                {{--                    @foreach(range(1, 3) as $index)--}}
                {{--                        <!-- Əsas Məlumat Sətiri -->--}}
                {{--                        <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">--}}
                {{--                            <td class="px-4 py-3">--}}
                {{--                                <button onclick="toggleRow({{ $index }})" class="toggle-btn flex items-center space-x-1 text-blue-500 hover:underline" data-id="{{ $index }}">--}}
                {{--                                    <span>Aç</span>--}}
                {{--                                    <svg class="w-4 h-4 transition-transform" id="icon-{{ $index }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
                {{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>--}}
                {{--                                    </svg>--}}
                {{--                                </button>--}}
                {{--                            </td>--}}
                {{--                            <th scope="row" class="px-4 py-3 text-gray-900 dark:text-white">Universitet {{ $index }}</th>--}}
                {{--                            <td class="px-4 py-3">Bakalavr</td>--}}
                {{--                            <td class="px-4 py-3">Dövlət</td>--}}
                {{--                            <td class="px-4 py-3">İT</td>--}}
                {{--                            <td class="px-4 py-3">İngilis</td>--}}
                {{--                            <td class="px-4 py-3 font-semibold text-green-600 dark:text-green-400">$5000</td>--}}
                {{--                        </tr>--}}

                {{--                        <!-- GİZLİ BÖLMƏ (TAB FORMASI) -->--}}
                {{--                        <tr id="row-{{ $index }}" class="hidden">--}}
                {{--                            <td colspan="7" class="p-4 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300">--}}
                {{--                                <div class="border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm">--}}
                {{--                                    <!-- Tablar -->--}}
                {{--                                    <div class="flex border-b bg-gray-100 dark:bg-gray-800 rounded-t-lg">--}}
                {{--                                        <button onclick="openTab({{ $index }}, 'info')" class="tab-btn-{{ $index }} active-tab px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Ümumi Məlumat</button>--}}
                {{--                                        <button onclick="openTab({{ $index }}, 'contact')" class="tab-btn-{{ $index }} px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Əlaqə</button>--}}
                {{--                                    </div>--}}

                {{--                                    <!-- Tab Məzmunu -->--}}
                {{--                                    <div id="tab-{{ $index }}-info" class="tab-content-{{ $index }} p-4">--}}
                {{--                                        <table class="w-full text-sm border border-gray-300 dark:border-gray-700 rounded-lg">--}}
                {{--                                            <tbody>--}}
                {{--                                            <tr class="border-b">--}}
                {{--                                                <td class="px-4 py-2 font-semibold bg-gray-100 dark:bg-gray-800">Tələbə sayı:</td>--}}
                {{--                                                <td class="px-4 py-2">5000</td>--}}
                {{--                                            </tr>--}}
                {{--                                            <tr>--}}
                {{--                                                <td class="px-4 py-2 font-semibold bg-gray-100 dark:bg-gray-800">Təhsil müddəti:</td>--}}
                {{--                                                <td class="px-4 py-2">4 il</td>--}}
                {{--                                            </tr>--}}
                {{--                                            </tbody>--}}
                {{--                                        </table>--}}
                {{--                                    </div>--}}

                {{--                                    <div id="tab-{{ $index }}-contact" class="tab-content-{{ $index }} p-4 hidden">--}}
                {{--                                        <table class="w-full text-sm border border-gray-300 dark:border-gray-700 rounded-lg">--}}
                {{--                                            <tbody>--}}
                {{--                                            <tr class="border-b">--}}
                {{--                                                <td class="px-4 py-2 font-semibold bg-gray-100 dark:bg-gray-800">Əlaqə nömrəsi:</td>--}}
                {{--                                                <td class="px-4 py-2">+994 50 123 45 67</td>--}}
                {{--                                            </tr>--}}
                {{--                                            <tr>--}}
                {{--                                                <td class="px-4 py-2 font-semibold bg-gray-100 dark:bg-gray-800">E-mail:</td>--}}
                {{--                                                <td class="px-4 py-2">info@university.az</td>--}}
                {{--                                            </tr>--}}
                {{--                                            </tbody>--}}
                {{--                                        </table>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </td>--}}
                {{--                        </tr>--}}
                {{--                    @endforeach--}}
                {{--                    </tbody>--}}
                {{--                </table>--}}


                <div class="program-item-list">
                    <div class="program-item">
                        <button class="program-item-btn" type="button">
                            <p>1. İstanbul Universiteti</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="program-item-body">
                            <div class="infoList">
                                <div class="info-list-item">
                                    <p>Status:</p>
                                    <div class="itemDetail">
                                        <p>Qəbul olundu</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Başvuru tarixi:</p>
                                    <div class="itemDetail">
                                        <p>12/02/2024</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>App no:</p>
                                    <div class="itemDetail">
                                        <p>123456</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Ölkə:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Universitet adı:</p>
                                    <div class="itemDetail">
                                        <p>Bakı Dövlət Universiteti</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dövlət:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>İxtisas:</p>
                                    <div class="itemDetail">
                                        <p>Azərbaycan dili və ədəbiyyat müəllimi</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dönəm:</p>
                                    <div class="itemDetail">
                                        <p>Bahar</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Təhsil haqqı:</p>
                                    <div class="itemDetail">
                                        <p>1500 AZN</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Login:</p>
                                    <div class="itemDetail">
                                        <p>ilaha@gmail.com</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Şifrə:</p>
                                    <div class="itemDetail">
                                        <p>1234567</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="addNewProgram" type="button">
                    <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                    Əlavə et
                </button>
            </div>
            <div
                @style(['display: flex '=>request('tab_type' ) == 4, 'display: none '=>request('tab_type' ) != 4]) class="student-services-tabContent student-tabContent"
                data-id="studentServicesDetail">
                <form action="{{route('student.addService', $user->id)}}" class="student-detail-serviceBox"
                      method="post">
                    @csrf
                    <h2 class="smallTitle">Tələbənin sənədləri</h2>
                    <div class="service-list-titles">
                        <p class="service-type-title">Xidmət növü</p>
                        <p class="service-price-title">Məbləğ</p>
                    </div>
                    <div class="student-service-list">
                        @if($user->services->count() > 0)
                            <div id="studentServiceList" class="student-service-list">
                                @foreach($user->services ?? [] as $user_service)
                                    <div class="student-service-item">
                                        <select name="service_id[]" id="">
                                            <option value="">Seç</option>
                                            @foreach($services as $service)
                                                <option
                                                    value="{{$service->id}}" {{$service->id == $user_service->pivot->service_id ? 'selected' : ''}}>{{$service->title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="servicePrice">
                                            <input type="text" name="price[]"
                                                   value="{{$user_service->pivot->price}}" placeholder="0">
                                            <span>AZN</span>
                                        </div>
                                        <button class="deleteStudentService" type="button">
                                            <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div id="studentServiceList" class="student-service-list">
                                <div class="student-service-item">
                                    <select name="service_id[]" id="">
                                        <option value="">Seç</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="servicePrice">
                                        <input type="text" name="price[]" placeholder="0">
                                        <span>AZN</span>
                                    </div>
                                    <button class="deleteStudentService" type="button">
                                        <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                                    </button>
                                </div>
                            </div>
                        @endif
                        <button id="addStudentService" class="addStudentService" type="button">
                            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                            Əlavə et
                        </button>
                        <button class="saveStudentService">
                            Yadda saxla
                        </button>

                    </div>
                </form>
            </div>
            <div
                @style(['display: flex '=>request('tab_type' ) == 5, 'display: none '=>request('tab_type' ) != 5]) class="student-documents-tabContent student-tabContent"
                data-id="studentDocumentsDetail">
                <div class="student-detail-documentBox">
                    <h2 class="smallTitle">Tələbənin sənədləri</h2>
                    <div class="document-list-titles">
                        <p class="document-date-title">№</p>
                        <p class="document-date-title">Tarix</p>
                        <p class="document-type-title">Sənədin növü</p>
                        <p class="document-type-title">Sənədin adı</p>
                        <p class="document-name-title">Sənəd</p>
                    </div>
                    <div class="student-document-list">
                        @foreach($user->documents ?? [] as $key => $document)
                            <div class="student-document-item">
                                <p class="document-date">{{$key+1}}</p>
                                <p class="document-date">{{$document->created_at->format('d/m/Y')}}</p>
                                <p class="document-type">{{$document->file_title}}</p>
                                <p class="document-type">{{$document->title}}</p>
                                <div class="document-name">
                                    <p>{{$document->file}}</p>
                                    <div class="documentBtns">
                                        <a href="{{ asset('files/' . $document->file) }}" target="_blank"
                                           class="documentBtn-view">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_72_1979)">
                                                    <path
                                                        d="M2.7294 12.7464C2.02113 11.8262 1.66699 11.3661 1.66699 9.99998C1.66699 8.63383 2.02113 8.17375 2.7294 7.25359C4.14363 5.41628 6.51542 3.33331 10.0003 3.33331C13.4852 3.33331 15.857 5.41628 17.2712 7.25359C17.9795 8.17375 18.3337 8.63383 18.3337 9.99998C18.3337 11.3661 17.9795 11.8262 17.2712 12.7464C15.857 14.5837 13.4852 16.6666 10.0003 16.6666C6.51542 16.6666 4.14363 14.5837 2.7294 12.7464Z"
                                                        stroke="black" stroke-opacity="0.9" stroke-width="1.5"/>
                                                    <path
                                                        d="M12.5 10C12.5 11.3807 11.3807 12.5 10 12.5C8.61929 12.5 7.5 11.3807 7.5 10C7.5 8.61929 8.61929 7.5 10 7.5C11.3807 7.5 12.5 8.61929 12.5 10Z"
                                                        stroke="black" stroke-opacity="0.9" stroke-width="1.5"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_72_1979">
                                                        <rect width="20" height="20" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="{{ asset('files/' . $document->file) }}" download
                                           class="documentBtn-download">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.5 12.5C2.5 14.857 2.5 16.0355 3.23223 16.7678C3.96447 17.5 5.14298 17.5 7.5 17.5H12.5C14.857 17.5 16.0355 17.5 16.7678 16.7678C17.5 16.0355 17.5 14.857 17.5 12.5"
                                                    stroke="black" stroke-opacity="0.9" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                                <path
                                                    d="M10.0003 2.49998V13.3333M10.0003 13.3333L13.3337 9.68748M10.0003 13.3333L6.66699 9.68748"
                                                    stroke="black" stroke-opacity="0.9" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('deleteFile', $document->id)}}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <input type="hidden" value="5" name="tab_type">
                                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin') "
                                                    class="documentBtn-delete">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23188 3.54163C8.48958 2.81254 9.18494 2.29169 10.0004 2.29169C10.8158 2.29169 11.5111 2.81254 11.7688 3.54163C11.8839 3.86708 12.2409 4.03766 12.5664 3.92263C12.8918 3.8076 13.0624 3.45052 12.9474 3.12507C12.5187 1.91218 11.362 1.04169 10.0004 1.04169C8.63873 1.04169 7.48203 1.91218 7.05333 3.12507C6.9383 3.45052 7.10888 3.8076 7.43433 3.92263C7.75977 4.03766 8.11685 3.86708 8.23188 3.54163Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.29199 5.00002C2.29199 4.65484 2.57181 4.37502 2.91699 4.37502H17.0837C17.4289 4.37502 17.7087 4.65484 17.7087 5.00002C17.7087 5.3452 17.4289 5.62502 17.0837 5.62502H2.91699C2.57181 5.62502 2.29199 5.3452 2.29199 5.00002Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26437 6.45974C4.60879 6.43678 4.9066 6.69736 4.92956 7.04178L5.31285 12.791C5.38773 13.9142 5.44108 14.6958 5.55822 15.2838C5.67185 15.8542 5.83046 16.1561 6.0583 16.3692C6.28615 16.5824 6.59795 16.7206 7.17461 16.796C7.76912 16.8738 8.55245 16.875 9.67816 16.875H10.3226C11.4483 16.875 12.2317 16.8738 12.8262 16.796C13.4028 16.7206 13.7146 16.5824 13.9425 16.3692C14.1703 16.1561 14.3289 15.8542 14.4426 15.2838C14.5597 14.6958 14.6131 13.9142 14.6879 12.791L15.0712 7.04178C15.0942 6.69736 15.392 6.43678 15.7364 6.45974C16.0808 6.4827 16.3414 6.78051 16.3185 7.12493L15.9322 12.9181C15.861 13.987 15.8034 14.8504 15.6685 15.528C15.5281 16.2324 15.2895 16.8208 14.7965 17.282C14.3035 17.7433 13.7005 17.9423 12.9883 18.0354C12.3033 18.125 11.4379 18.125 10.3666 18.125H9.63421C8.56289 18.125 7.69752 18.125 7.01249 18.0354C6.30028 17.9423 5.69732 17.7433 5.20432 17.282C4.71133 16.8208 4.47264 16.2324 4.33231 15.528C4.19734 14.8504 4.13979 13.987 4.06854 12.918L3.68233 7.12493C3.65937 6.78051 3.91996 6.4827 4.26437 6.45974Z"
                                                        fill="#FF1346"/>
                                                </svg>

                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <button class="addNewStudentDocument" type="button">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4.66663V16.3333" stroke="#1661C3" stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M4.16699 10.5H15.8337" stroke="#1661C3" stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        Əlavə et
                    </button>
                </div>
            </div>
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


    <!--================== Modals======================= -->
    <div class="editStepModal">
        <div class="editStep-box">
            <div class="editStep-box-head">
                <h2>Düzəliş et</h2>
                <button class="closeEditStep" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_editStep" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Başlıq</label>
                        <input type="text">
                    </div>
                    <div class="form-item">
                        <label for="">Əlavə qeyd</label>
                        <input type="text" placeholder="Qeyd">
                    </div>
                </div>
                <button class="saveEditStep" type="submit">Yadda saxla</button>
            </form>
        </div>
    </div>
    <div class="addStepModal">
        <div class="addStep-box">
            <div class="addStep-box-head">
                <h2>Yeni mərhələ əlavə et</h2>
                <button class="closeAddStep" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_addStep" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Mərhələnin adı</label>
                        <input type="text" placeholder="Mərhələ">
                    </div>
                    <div class="document-input-box">
                        <div class="document-input-box-top">
                            <label for="">PDF</label>
                            <button class="resetDocumentBox" type="button">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4L4 12" stroke="#FF1346" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M4 4L12 12" stroke="#FF1346" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="document-input-item">
                            <input type="file">
                            <p>
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.59792 15.339L13.1736 9.04458C13.9631 8.28886 13.9631 7.0636 13.1736 6.30788C12.3842 5.55217 11.1041 5.55216 10.3146 6.30788L3.78656 12.5567C2.28652 13.9925 2.28652 16.3205 3.78656 17.7564C5.2866 19.1923 7.71864 19.1923 9.21868 17.7564L15.8421 11.4164C18.0526 9.30037 18.0526 5.86964 15.8421 3.75363C13.6315 1.63762 10.0474 1.63762 7.83682 3.75363L2.5 8.86213"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                Fayl seç
                            </p>
                            <span class="fileName"></span>
                        </div>
                    </div>
                </div>
                <button class="saveAddStep" type="submit">Əlavə et</button>
            </form>
        </div>
    </div>
    <div class="editProgramStepModal">
        <div class="editProgramStep-box">
            <div class="editProgramStep-box-head">
                <h2>Düzəliş et</h2>
                <button class="closeEditProgramStep" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_editProgramStep" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Mərhələnin adı</label>
                        <input type="text" placeholder="Mərhələ">
                    </div>
                    <div class="document-input-box">
                        <div class="document-input-box-top">
                            <label for="">PDF</label>
                            <button class="resetDocumentBox" type="button">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4L4 12" stroke="#FF1346" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M4 4L12 12" stroke="#FF1346" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="document-input-item">
                            <input type="file">
                            <p>
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.59792 15.339L13.1736 9.04458C13.9631 8.28886 13.9631 7.0636 13.1736 6.30788C12.3842 5.55217 11.1041 5.55216 10.3146 6.30788L3.78656 12.5567C2.28652 13.9925 2.28652 16.3205 3.78656 17.7564C5.2866 19.1923 7.71864 19.1923 9.21868 17.7564L15.8421 11.4164C18.0526 9.30037 18.0526 5.86964 15.8421 3.75363C13.6315 1.63762 10.0474 1.63762 7.83682 3.75363L2.5 8.86213"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                Fayl seç
                            </p>
                            <span class="fileName"></span>
                        </div>
                    </div>
                </div>
                <button class="saveEditProgramStep" type="submit">Əlavə et</button>
            </form>
        </div>
    </div>
    <div class="addUniversityModal">
        <div class="addUniversity-box">
            <div class="addUniversity-box-head">
                <h2>Yeni Universitet əlavə et</h2>
                <button class="closeAddUniversity" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_addUniversity" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Universitet</label>
                        <input type="text" placeholder="Universitet adı">
                    </div>
                    <div class="form-item">
                        <label for="">Status</label>
                        <select name="" id="">
                            <option value="">Qəbul olub</option>
                            <option value="">İmtina</option>
                            <option value="">Gözləmə</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Başvuru tarixi</label>
                        <input type="date">
                    </div>
                    <div class="form-item">
                        <label for="">App no</label>
                        <input type="text" placeholder="App no">
                    </div>
                    <div class="form-item">
                        <label for="">Dönəm</label>
                        <select name="" id="">
                            <option value="">Güz</option>
                            <option value="">Bahar</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Ölkə</label>
                        <select name="" id="">
                            <option value="">Seç</option>
                            <option value="">Azerbaycan</option>
                            <option value="">Turkiye</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Dövlət</label>
                        <input type="text" placeholder="Dövlət">
                    </div>
                    <div class="form-item">
                        <label for="">İxtisas</label>
                        <input type="text" placeholder="İxtisasın adı">
                    </div>
                    <div class="form-item">
                        <label for="">Təhsil haqqı</label>
                        <input type="text" placeholder="0 AZN">
                    </div>
                </div>
                <button class="addUni_btn" type="submit">Əlavə et</button>
            </form>
        </div>
    </div>

    <div class="addUniModal">
        <div class="addUni-box">
            <div class="addUni-box-head">
                <h2>Yeni təhsil əlavə et</h2>
                <button class="closeAddUni" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="{{route('educations.store')}}" class="form_addUni" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tab_type" value="2">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Təhsil pilləsi</label>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <select name="degree" id="">
                            <option value="">Seç</option>
                            <option value="Bakalavr">Bakalavr</option>
                            <option value="Magistr">Magistr</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Universitet</label>
                        <input type="text" name="university" placeholder="Universitet adı">
                    </div>
                    <div class="form-item">
                        <label for="">İxtisas</label>
                        <input type="text" name="profession" placeholder="İxtisas adı">
                    </div>
                    <div class="form-item">
                        <label for="">Fakultə</label>
                        <input type="text" name="faculty" placeholder="Fakultə adı">
                    </div>
                    <div class="form-item">
                        <label for="">Ortalama bal</label>
                        <input type="text" name="gno" placeholder="Ortalama bal">
                    </div>
                    <div class="form-item">
                        <label for="">Başlama tarixi</label>
                        <input type="date" name="university_start_date">
                    </div>
                    <div class="form-item">
                        <label for="">Bitmə tarixi</label>
                        <input type="date" name="university_end_date">
                    </div>
                </div>
                <button class="addNewUniBtn" type="submit">Əlavə et</button>
            </form>
        </div>
    </div>
    <div class="addLangModal">
        <div class="addLang-box">
            <div class="addLang-box-head">
                <h2>Yeni dil biliyi əlavə et</h2>
                <button class="closeAddLang" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_addLang" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-item">
                        <label for="">Dil</label>
                        <input type="text" name="language" placeholder="İngilis dili">
                    </div>
                    <div class="form-item">
                        <label for="">Səviyyə</label>
                        <input type="text" name="level" placeholder="Intermediate">
                    </div>
                    <div class="form-item">
                        <label for="">İmtahan adı</label>
                        <input type="text" name="exam" placeholder="İmtahan adı">
                    </div>
                    <div class="form-item">
                        <label for="">Ortalama bal</label>
                        <input type="text" name="point" placeholder="Ortalama bal">
                    </div>
                </div>
                <button class="addNewLangBtn" type="submit">Əlavə et</button>
            </form>
        </div>
    </div>

    <div class="uploadStudentUniversityModal">
        <div class="uploadStudentUniversity-box">
            <div class="uploadStudentUniversity-box-head">
                <h2>Yeni universitet əlavə et</h2>
                <button class="closeUploadStudentUniversity" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_uploadStudentUniversity" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Universitet</label>
                        <select>
                            <option value="">Seç</option>
                            <option value="Bakalavr">UNEc</option>
                            <option value="Magistr">AzMİU</option>
                            <option value="Doktorantura">ADNSU</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">İxtisas</label>
                        <input type="text" placeholder="İxtisas">
                    </div>
                    <div class="form-item">
                        <label for="">Proqram</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Proqram1</option>
                            <option value="">Proqram2</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Dönəm</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Güz</option>
                            <option value="">bahar</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">App no</label>
                        <input type="text" placeholder="App no">
                    </div>
                    <div class="form-item">
                        <label for="">Status</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Qəbul olunub</option>
                            <option value="">Gözləmə</option>
                            <option value="">İmtina</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Bitmə tarixi</label>
                        <input type="date">
                    </div>
                </div>
                <button class="uploadUniversityBtn" type="submit">Əlavə et</button>
            </form>

        </div>
    </div>

    <div class="editStudentUniversityModal">
        <div class="editStudentUniversity-box">
            <div class="editStudentUniversity-box-head">
                <h2>Məlumat düzəlişi</h2>
                <button class="closeEditStudentUniversity" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="" class="form_editStudentUniversity" method="post" enctype="multipart/form-data">
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Universitet</label>
                        <select>
                            <option value="">Seç</option>
                            <option value="Bakalavr">UNEc</option>
                            <option value="Magistr">AzMİU</option>
                            <option value="Doktorantura">ADNSU</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">İxtisas</label>
                        <input type="text" placeholder="İxtisas">
                    </div>
                    <div class="form-item">
                        <label for="">Proqram</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Proqram1</option>
                            <option value="">Proqram2</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Dönəm</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Güz</option>
                            <option value="">bahar</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">App no</label>
                        <input type="text" placeholder="App no">
                    </div>
                    <div class="form-item">
                        <label for="">Status</label>
                        <select name="title" id="documentTitle">
                            <option value="">Seç</option>
                            <option value="">Qəbul olunub</option>
                            <option value="">Gözləmə</option>
                            <option value="">İmtina</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Bitmə tarixi</label>
                        <input type="date">
                    </div>
                </div>
                <button class="editUniversityBtnForm" type="submit">Düzəliş et</button>
            </form>

        </div>
    </div>


    <div class="editStudentModal">
        <div class="editStudentModal-box">
            <h2>Tələbə məlumatları</h2>
            <button class="closeEditStudentModal" type="button">
                <img src="{{asset('/')}}assets/images/x.svg" alt="">
            </button>
            <form action="" class="form_editStudentModal" method="post">
                <div class="form-items-top">
                    <div class="form-item">
                        <label for="">Agent</label>
                        <select name="" id="">
                            <option value="">Agent1</option>
                            <option value="">Agent2</option>
                            <option value="">Agent3</option>
                            <option value="">Agent4</option>
                            <option value="">Agent5</option>
                            <option value="">Agent6</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="">Status</label>
                        <select name="" id="">
                            <option value="">Status1</option>
                            <option value="">Status2</option>
                            <option value="">Status3</option>
                            <option value="">Status4</option>
                            <option value="">Status5</option>
                            <option value="">Status6</option>
                        </select>
                    </div>
                </div>
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Ad</label>
                        <input type="text" placeholder="Ad">
                    </div>
                    <div class="form-item">
                        <label for="">Soyad</label>
                        <input type="text" placeholder="Soyad">
                    </div>
                    <div class="form-item">
                        <label for="">Ata adı</label>
                        <input type="text" placeholder="Ata adı">
                    </div>
                    <div class="form-item">
                        <label for="">Doğum tarixi</label>
                        <input type="text" class="datepicker" placeholder="Gün/Ay/İl">
                    </div>
                    <div class="form-item">
                        <label for="">Email</label>
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="form-item">
                        <label for="">Mobil nömrə</label>
                        <input type="text" placeholder="+994 50 000 00 00">
                    </div>
                    <div class="form-item">
                        <label for="">Qeydiyyatda olduğu ünvan</label>
                        <input type="text" placeholder="Ünvan">
                    </div>
                    <div class="form-item">
                        <label>Ailə vəziyyəti</label>
                        <div class="form-checks">
                            <div class="form-check-item">
                                <!-- Custom radio için input ve label birbiriyle bağlantılı -->
                                <div class="custom-checkbox">
                                    <input type="radio" id="student_single" name="student_family_status"/>
                                    <label for="student_single"></label>
                                </div>
                                <label for="student_single">Subay</label>
                            </div>
                            <div class="form-check-item">
                                <!-- Custom radio için input ve label birbiriyle bağlantılı -->
                                <div class="custom-checkbox">
                                    <input type="radio" id="student_married" name="student_family_status"/>
                                    <label for="student_married"></label>
                                </div>
                                <label for="student_married">Evli</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label>Cins</label>
                        <div class="form-checks">
                            <div class="form-check-item">
                                <!-- Custom radio için input ve label birbiriyle bağlantılı -->
                                <div class="custom-checkbox">
                                    <input type="radio" id="qadin" name="student_gender"/>
                                    <label for="qadin"></label>
                                </div>
                                <label for="qadin">Qadın</label>
                            </div>
                            <div class="form-check-item">
                                <!-- Custom radio için input ve label birbiriyle bağlantılı -->
                                <div class="custom-checkbox">
                                    <input type="radio" id="kisi" name="student_gender"/>
                                    <label for="kisi"></label>
                                </div>
                                <label for="kisi">Kişi</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="editStudentModalBtn" type="submit">Düzəliş et</button>
            </form>

        </div>
    </div>

    <div class="editPersonalInfo-modal">
        <div class="editPersonalInfo">
            <div class="editPersonalInfo-box-head">
                <div class="success-message" style="display: none"></div>
                <h2>Tələbə məlumatları</h2>
                <button class="closePersonalInfo" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form class="form_Personal">
                <div class="infoBox">
                    <h3>Şəxsi məlumatlar</h3>
                    <div class="form-items">
                        <div class="form-item">
                            <label for="">Ad</label>
                            <input type="text" id="name" name="name" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Soyad</label>
                            <input type="text" id="surname" name="surname" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Ata adı</label>
                            <input type="text" id="father_name" name="father_name" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Ana adı</label>
                            <input type="text" id="mother_name" name="mother_name" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Doğum tarixi</label>
                            <input type="date" id="birthday" name="birthday" class="datepicker"
                                   placeholder="Gün/Ay/İl">
                        </div>
                        <div class="form-item">
                            <label for="">Pasport no</label>
                            <input type="text" id="passport_number" name="passport_number" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Kimlik no</label>
                            <input type="text" id="identity_number" name="identity_number" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Vətəndaşlıq</label>
                            <input type="text" id="citizenship" name="citizenship" value="">
                        </div>
                    </div>
                </div>
                <div class="infoBox">
                    <h3>Əlaqə məlumatları</h3>
                    <div class="form-items">
                        <div class="form-item">
                            <label for="">Email</label>
                            <input type="text" id="contact_email" name="contact_email" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Mobil nömrə</label>
                            <input type="text" id="phone" name="phone" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Mobil nömrə (yaxın)</label>
                            <input type="text" id="relative_number" name="relative_number" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Whatsapp nömrə</label>
                            <input type="text" id="whatsapp_number" name="whatsapp_number" value="">
                        </div>

                    </div>
                </div>
                <div class="infoBox">
                    <h3>Şirkət əlaqə məlumatları</h3>
                    <div class="form-items">
                        <div class="form-item">
                            <label for="">Email</label>
                            <input type="text" id="company_email" name="company_email" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Emal şifrə:</label>
                            <input type="text" id="emal_password" name="emal_password" value="">
                        </div>
                        <div class="form-item">
                            <label for="">Emal onay kodu:</label>
                            <input type="text" id="emal_confirmation_code" name="emal_confirmation_code" value="">
                        </div>

                    </div>
                </div>
                <div class="infoBox">
                    <h3>Digər məlumatlar</h3>
                    <div class="form-items">
                        <div class="form-item">
                            <label for="">Sifarişçi:</label>
                            <input type="text" id="client" name="client" value="">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="">
                <button class="editPersonalInfo-btn" type="submit">Düzəliş et</button>
            </form>

        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const services = @json($services);
</script>
<script>
    function toggleRow(id) {
        let row = document.getElementById("row-" + id);
        let icon = document.getElementById("icon-" + id);
        let buttonText = document.querySelector(`button[data-id="${id}"] span`);

        if (row.classList.contains("hidden")) {
            row.classList.remove("hidden");
            icon.classList.add("rotate-180"); // Aşağı oxu çevir
            buttonText.innerText = "Bağla"; // Mətni dəyiş
        } else {
            row.classList.add("hidden");
            icon.classList.remove("rotate-180"); // Yuxarı oxu çevir
            buttonText.innerText = "Aç"; // Mətni dəyiş
        }
    }

    function openTab(id, tabName) {
        // Bütün tabları gizlə
        let tabs = document.querySelectorAll(`.tab-content-${id}`);
        tabs.forEach(tab => tab.classList.add("hidden"));

        // Seçilmiş tabı göstər
        document.getElementById(`tab-${id}-${tabName}`).classList.remove("hidden");

        // Bütün tab düymələrindən aktiv sinifi çıxart
        let tabButtons = document.querySelectorAll(`.tab-btn-${id}`);
        tabButtons.forEach(btn => btn.classList.remove("active-tab"));

        // Aktiv olan tab düyməsinə sinif əlavə et
        event.target.classList.add("active-tab");
    }

    $(document).ready(function () {

        // $('select').niceSelect();


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
                            // documentTitleSelect.niceSelect('update');
                        }
                    });
                } else {
                    // documentTitleSelect.niceSelect('update');
                }
            });
        });

        $(document).on("click", ".editPersonalInfoBtn", function () {
            // console.log("Button clicked");
            let userId = $(this).data("user-id");

            $.ajax({
                url: "/get-user-info",
                type: "GET",
                data: {user_id: userId},
                dataType: "json",
                success: function (response) {
                    $("#user_id").val(response.id);
                    $("#name").val(response.name);
                    $("#surname").val(response.surname);
                    $("#father_name").val(response.student_info?.father_name);
                    $("#mother_name").val(response.student_info?.mother_name);
                    $("#birthday").val(response.student_info?.birthday);
                    $("#passport_number").val(response.student_info?.passport_number);
                    $("#identity_number").val(response.student_info?.identity_number);
                    $("#citizenship").val(response.student_info?.citizenship);
                    $("#contact_email").val(response.student_info?.contact_email);
                    $("#phone").val(response.phone);
                    $("#relative_number").val(response.student_info?.relative_number);
                    $("#whatsapp_number").val(response.student_info?.whatsapp_number);
                    $("#company_email").val(response.student_info?.company_email);
                    $("#emal_password").val(response.student_info?.emal_password);
                    $("#emal_confirmation_code").val(response.student_info?.emal_confirmation_code);
                    $("#client").val(response.student_info?.client);
                    // $("#editPersonalInfoModal").modal("show");
                },
                error: function () {
                    alert("İstifadəçi tapılmadı!");
                }
            });
        });

        $(".form_Personal").on("submit", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                url: "/update-user-info",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    $(".success-message").text("Məlumatlar uğurla yeniləndi!").fadeIn().delay(3000).fadeOut();

                    // Formdakı məlumatları yenilə
                    $("#name").val(response.user.name);
                    $("#surname").val(response.user.surname);
                    $("#phone").val(response.user.phone);
                    $("#father_name").val(response.user.student_info.father_name);
                    $("#mother_name").val(response.user.student_info.mother_name);
                    $("#birthday").val(response.user.student_info.birthday);
                    $("#passport_number").val(response.user.student_info.passport_number);
                    $("#identity_number").val(response.user.student_info.identity_number);
                    $("#citizenship").val(response.user.student_info.citizenship);
                    $("#contact_email").val(response.user.student_info.contact_email);
                    $("#relative_number").val(response.user.student_info.relative_number);
                    $("#whatsapp_number").val(response.user.student_info.whatsapp_number);
                    $("#company_email").val(response.user.student_info.company_email);
                    $("#client").val(response.user.student_info.client);
                    $("#emal_password").val(response.user.student_info.emal_password);
                    $("#emal_confirmation_code").val(response.user.student_info.emal_confirmation_code);
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        // $(".form_addUni").on("submit", function (e) {
        //     e.preventDefault();
        //
        //     let formData = $(this).serialize();
        //
        //     $.ajax({
        //         url: "/education/store",
        //         type: "POST",
        //         data: formData,
        //         dataType: "json",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        //         },
        //         success: function (response) {
        //             alert("Məlumatlar uğurla əlavə edildi!");
        //             location.reload();
        //         },
        //         error: function () {
        //             alert("Xəta baş verdi, yenidən cəhd edin!");
        //         }
        //     });
        // });

        $(".form_addLang").on("submit", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "/lang/store",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    alert("Məlumatlar uğurla əlavə edildi!");
                    location.reload();
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        $(document).on("submit", ".update_education", function (e) {
            e.preventDefault();

            let educationId = $(this).attr("data-id");
            let formData = $(this).serialize();

            // Check if educationId is present to determine if this is an update or create
            let url = educationId ? "/education/update/" + educationId : "/education/store";

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (educationId) {
                        alert("Məlumatlar uğurla yeniləndi!"); // Update success message
                    } else {
                        alert("Məlumatlar uğurla əlavə edildi!"); // Create success message
                    }
                    $(".addUniModal").hide();  // Close the modal
                    // Optionally, refresh the page or the list of education entries
                },
                error: function () {
                    alert("Xəta baş verdi, yenidən cəhd edin!");
                }
            });
        });

        $(document).on("click", ".editEducation", function () {

            let educationId = $(this).data("id");
            let educationBox = $(this).closest(".education-box");

            let degree = educationBox.find(".info-list-item:nth-child(1) .itemDetail p").text();
            let university = educationBox.find(".info-list-item:nth-child(2) .itemDetail p").text();
            let profession = educationBox.find(".info-list-item:nth-child(3) .itemDetail p").text();
            let faculty = educationBox.find(".info-list-item:nth-child(4) .itemDetail p").text();
            let gno = educationBox.find(".info-list-item:nth-child(5) .itemDetail p").text();
            let universityStartDate = educationBox.find(".info-list-item:nth-child(6) .itemDetail p").text();
            let universityEndDate = educationBox.find(".info-list-item:nth-child(7) .itemDetail p").text();

            $(".form_addUni input[name=degree]").val(degree);
            $(".form_addUni input[name=university]").val(university);
            $(".form_addUni input[name=profession]").val(profession);
            $(".form_addUni input[name=faculty]").val(faculty);
            $(".form_addUni input[name=gno]").val(gno);
            $(".form_addUni input[name=university_start_date]").val(universityStartDate);
            $(".form_addUni input[name=university_end_date]").val(universityEndDate);
            $(".form_addUni").attr("data-id", educationId); // Add educationId for update

            $(".addUniModal").show();
        });

        function toggleRow(id) {
            let row = document.getElementById("row-" + id);
            if (row.classList.contains("hidden")) {
                row.classList.remove("hidden");
            } else {
                row.classList.add("hidden");
            }
        }

    });
</script>
