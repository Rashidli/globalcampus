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

</style>
@section('content')

    <div class="student-detailView-head">
        <a href="{{route('students.index')}}" class="goBack">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M10.0303 6.46967C10.3232 6.76256 10.3232 7.23744 10.0303 7.53033L6.31066 11.25L14.5 11.25C15.4534 11.25 16.8667 11.5298 18.0632 12.3913C19.298 13.2804 20.25 14.7556 20.25 17C20.25 17.4142 19.9142 17.75 19.5 17.75C19.0858 17.75 18.75 17.4142 18.75 17C18.75 15.2444 18.0353 14.2196 17.1868 13.6087C16.3 12.9702 15.2133 12.75 14.5 12.75L6.31066 12.75L10.0303 16.4697C10.3232 16.7626 10.3232 17.2374 10.0303 17.5303C9.73744 17.8232 9.26256 17.8232 8.96967 17.5303L3.96967 12.5303C3.67678 12.2374 3.67678 11.7626 3.96967 11.4697L8.96967 6.46967C9.26256 6.17678 9.73744 6.17678 10.0303 6.46967Z"
                      fill="black"/>
            </svg>
            Geri
        </a>
    </div>
    <div class="student-detailView-head-main">
        <div class="detailView-left-top">
            <div class="studentImg">
                <img src="{{asset('/')}}assets/images/userImg.svg" alt="">
            </div>
            <div class="top-fullName">
                <h2 class="studentFullName">{{$user->name}} {{$user->surname}}</h2>
                <p>ID: <span>{{$user->id}}</span></p>
            </div>
            <!-- Statuslar: active, deactive, finished, reject, accept olabiler. uygun adli classlari
            add ele. numune ucun active add etmisem -->
            {{--<p class="studentStatus active">{{ \App\Enums\StudentStatus::getStatus($user->student_info?->status) }}</p>--}}
        </div>
        <p class="addedTime">{{$user->created_at->format('d.m.Y')}}</p>
    </div>
    <div class="student-detailView-container">
        <div class="student-detail-tabs">
            <button class="student-detail-tab active" type="button" id="studentGeneralDetail">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.08301 5.91665C2.08301 4.3453 2.08301 3.55962 2.57116 3.07147C3.05932 2.58331 3.84499 2.58331 5.41634 2.58331C6.98769 2.58331 7.77336 2.58331 8.26152 3.07147C8.74967 3.55962 8.74967 4.3453 8.74967 5.91665V15.0833C8.74967 16.6547 8.74967 17.4403 8.26152 17.9285C7.77336 18.4166 6.98769 18.4166 5.41634 18.4166C3.84499 18.4166 3.05932 18.4166 2.57116 17.9285C2.08301 17.4403 2.08301 16.6547 2.08301 15.0833V5.91665Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path
                        d="M11.25 13.4166C11.25 11.8453 11.25 11.0596 11.7382 10.5715C12.2263 10.0833 13.012 10.0833 14.5833 10.0833C16.1547 10.0833 16.9404 10.0833 17.4285 10.5715C17.9167 11.0596 17.9167 11.8453 17.9167 13.4166V15.0833C17.9167 16.6547 17.9167 17.4403 17.4285 17.9285C16.9404 18.4166 16.1547 18.4166 14.5833 18.4166C13.012 18.4166 12.2263 18.4166 11.7382 17.9285C11.25 17.4403 11.25 16.6547 11.25 15.0833V13.4166Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path
                        d="M11.25 5.08331C11.25 4.30674 11.25 3.91846 11.3769 3.61217C11.546 3.20379 11.8705 2.87934 12.2789 2.71018C12.5851 2.58331 12.9734 2.58331 13.75 2.58331H15.4167C16.1932 2.58331 16.5815 2.58331 16.8878 2.71018C17.2962 2.87934 17.6206 3.20379 17.7898 3.61217C17.9167 3.91846 17.9167 4.30674 17.9167 5.08331C17.9167 5.85988 17.9167 6.24817 17.7898 6.55445C17.6206 6.96283 17.2962 7.28729 16.8878 7.45645C16.5815 7.58331 16.1932 7.58331 15.4167 7.58331H13.75C12.9734 7.58331 12.5851 7.58331 12.2789 7.45645C11.8705 7.28729 11.546 6.96283 11.3769 6.55445C11.25 6.24817 11.25 5.85988 11.25 5.08331Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                </svg>
                Ümumi
            </button>
            <button class="student-detail-tab" type="button" id="studentjobEducationDetail">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="13.8333" r="2.5" stroke="black" stroke-opacity="0.8"
                            stroke-width="1.5"/>
                    <path
                        d="M10 16.5499L8.11427 18.3578C7.84421 18.6167 7.70918 18.7461 7.59483 18.7909C7.33426 18.893 7.04521 18.8056 6.90814 18.5834C6.84799 18.4858 6.82924 18.3099 6.79175 17.9581C6.77058 17.7594 6.76 17.6601 6.72788 17.5769C6.65596 17.3906 6.50483 17.2457 6.31055 17.1768C6.22377 17.146 6.12016 17.1358 5.91295 17.1155C5.54593 17.0796 5.36243 17.0616 5.26069 17.004C5.02886 16.8725 4.93774 16.5954 5.04421 16.3456C5.09094 16.236 5.22597 16.1065 5.49603 15.8476L6.72788 14.6666L7.59483 13.7997"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path
                        d="M10 16.5499L11.8857 18.3578C12.1558 18.6167 12.2908 18.7461 12.4052 18.7909C12.6657 18.893 12.9548 18.8057 13.0919 18.5834C13.152 18.4859 13.1708 18.3099 13.2082 17.9581C13.2294 17.7594 13.24 17.6601 13.2721 17.5769C13.344 17.3906 13.4952 17.2457 13.6894 17.1768C13.7762 17.146 13.8798 17.1358 14.0871 17.1156C14.4541 17.0796 14.6376 17.0616 14.7393 17.004C14.9711 16.8726 15.0623 16.5954 14.9558 16.3456C14.9091 16.236 14.774 16.1065 14.504 15.8476L13.2721 14.6667L12.5 13.8945"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path
                        d="M14.4334 15.4965C16.0771 15.479 16.9932 15.376 17.6014 14.7678C18.3337 14.0356 18.3337 12.857 18.3337 10.5V7.16669C18.3337 4.80966 18.3337 3.63115 17.6014 2.89892C16.8692 2.16669 15.6907 2.16669 13.3337 2.16669L6.66699 2.16669C4.30997 2.16669 3.13146 2.16669 2.39922 2.89892C1.66699 3.63115 1.66699 4.80966 1.66699 7.16669L1.66699 10.5C1.66699 12.857 1.66699 14.0356 2.39923 14.7678C3.03955 15.4081 4.02114 15.4885 5.83366 15.4986"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path d="M7.5 5.5L12.5 5.5" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M5.83301 8.41669H14.1663" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                </svg>
                Təhsil
            </button>
            <button class="student-detail-tab" type="button" id="studentProgramDetail">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.96716 3.20801C10.2698 2.59733 11.7295 2.59733 13.0321 3.20801L19.1657 6.08358C20.4999 6.70908 20.4999 8.8743 19.1657 9.49979L13.0322 12.3753C11.7296 12.986 10.2698 12.986 8.96725 12.3753L2.83364 9.49975C1.49946 8.87426 1.49947 6.70904 2.83364 6.08354L8.96716 3.20801Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path d="M1.83301 7.79169V12.8334" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path
                        d="M17.4163 10.5417V15.24C17.4163 16.164 16.9548 17.0291 16.1465 17.4768C14.8004 18.2222 12.646 19.25 10.9997 19.25C9.35334 19.25 7.1989 18.2222 5.8529 17.4768C5.04455 17.0291 4.58301 16.164 4.58301 15.24V10.5417"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                Proqram
            </button>
            <button class="student-detail-tab" type="button" id="studentServicesDetail">
                <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.6667 4.16827C16.6604 4.17937 17.7402 4.26779 18.4445 4.97214C19.25 5.77759 19.25 7.07396 19.25 9.66668V15.1667C19.25 17.7594 19.25 19.0558 18.4445 19.8612C17.6391 20.6667 16.3427 20.6667 13.75 20.6667H8.25C5.65728 20.6667 4.36091 20.6667 3.55546 19.8612C2.75 19.0558 2.75 17.7594 2.75 15.1667V9.66668C2.75 7.07396 2.75 5.77759 3.55546 4.97214C4.25981 4.26779 5.33956 4.17937 7.33333 4.16827"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path d="M9.625 13.3333L15.5833 13.3333" stroke="black" stroke-opacity="0.8"
                          stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M6.41699 13.3333H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M6.41699 10.125H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M6.41699 16.5417H6.87533" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M9.625 10.125H15.5833" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M9.625 16.5417H15.5833" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path
                        d="M7.33301 3.70831C7.33301 2.94892 7.94862 2.33331 8.70801 2.33331H13.2913C14.0507 2.33331 14.6663 2.94892 14.6663 3.70831V4.62498C14.6663 5.38437 14.0507 5.99998 13.2913 5.99998H8.70801C7.94862 5.99998 7.33301 5.38437 7.33301 4.62498V3.70831Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                </svg>
                Xidmət
            </button>
            <button class="student-detail-tab" type="button" id="studentDocumentsDetail">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.5 8.83335C2.5 5.69066 2.5 4.11931 3.47631 3.143C4.45262 2.16669 6.02397 2.16669 9.16667 2.16669H10.8333C13.976 2.16669 15.5474 2.16669 16.5237 3.143C17.5 4.11931 17.5 5.69066 17.5 8.83335V12.1667C17.5 15.3094 17.5 16.8807 16.5237 17.857C15.5474 18.8334 13.976 18.8334 10.8333 18.8334H9.16667C6.02397 18.8334 4.45262 18.8334 3.47631 17.857C2.5 16.8807 2.5 15.3094 2.5 12.1667V8.83335Z"
                        stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                    <path d="M6.66699 10.5H13.3337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M6.66699 7.16669H13.3337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path d="M6.66699 13.8333H10.8337" stroke="black" stroke-opacity="0.8" stroke-width="1.5"
                          stroke-linecap="round"/>
                </svg>
                Sənədlər
            </button>

        </div>
        <div class="student-detailView-tabContents">
            <div class="student-General-tabContent student-tabContent" data-id="studentGeneralDetail">
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
                                    <p>{{$user->agent?->name}}</p>
                                    <button class="copyBtn" type="button">
                                        <img src="{{asset('/')}}assets/images/copy.svg" alt="">

                                    </button>
                                </div>
                            </div>
                            <div class="info-list-item">
                                <p>Sifarişçi:</p>
                                <div class="itemDetail">
                                    <p>{{$user->student_info?->client}}</p>
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
                </div>

                <div class="student_general_tabContent magistrContent" data-id="magistr_tab">
                </div>
                <div class="student_general_tabContent allSteps_tab" data-id="allSteps_tab">
                    <h2 class="smallTitle">Hərəkətlər</h2>
                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-check">
                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-item-body">
                                <p>01.02.2025</p>
                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                            </div>
                            <div class="step-item-buttons">
                                <button class="editStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                              fill="black" fill-opacity="0.9"/>
                                    </svg>
                                </button>
                                <button class="deleteStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                            fill="#FF1346"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-check">
                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-item-body">
                                <p>01.02.2025</p>
                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                            </div>
                            <div class="step-item-buttons">
                                <button class="editStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                              fill="black" fill-opacity="0.9"/>
                                    </svg>
                                </button>
                                <button class="deleteStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                            fill="#FF1346"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-check">
                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-item-body">
                                <p>01.02.2025</p>
                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                            </div>
                            <div class="step-item-buttons">
                                <button class="editStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                              fill="black" fill-opacity="0.9"/>
                                    </svg>
                                </button>
                                <button class="deleteStepBtn" type="button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                            fill="#FF1346"/>
                                        <path
                                            d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                            fill="#FF1346"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-jobEducation-tabContent student-tabContent" data-id="studentjobEducationDetail">
                <div class="education-box-list">
                    <h2>Təhsil</h2>
                    @foreach($user->educations ?? [] as $education)
                        <div class="education-box">
                            <h2>{{$education->degree}}</h2>
                            <div class="infoList">

                                <div class="info-list-item">
                                    <p>2.Universitet:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->university}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>3.Ixtisas:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->profession}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>4.Fakultə:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->faculty}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>5.Ortalama bal:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->gno}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>6.Başlama tarixi:</p>
                                    <div class="itemDetail">
                                        <p>{{$education->university_start_date}}</p>
                                        <button class="copyBtn" type="button">
                                            <img src="{{asset('/')}}assets/images/copy.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>7.Bitmə tarixi:</p>
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

            </div>

            <div class="student-program-tabContent student-tabContent" data-id="studentProgramDetail">
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
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Başvuru tarixi:</p>
                                    <div class="itemDetail">
                                        <p>12/02/2024</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>App no:</p>
                                    <div class="itemDetail">
                                        <p>123456</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Ölkə:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Universitet adı:</p>
                                    <div class="itemDetail">
                                        <p>Bakı Dövlət Universiteti</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dövlət:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>İxtisas:</p>
                                    <div class="itemDetail">
                                        <p>Azərbaycan dili və ədəbiyyat müəllimi</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dönəm:</p>
                                    <div class="itemDetail">
                                        <p>Bahar</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Təhsil haqqı:</p>
                                    <div class="itemDetail">
                                        <p>1500 AZN</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Login:</p>
                                    <div class="itemDetail">
                                        <p>ilaha@gmail.com</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Şifrə:</p>
                                    <div class="itemDetail">
                                        <p>1234567</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-box">
                                <h2 class="smallTitle">Mərhələlər</h2>
                                <div class="steps-list">
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="program-item">
                        <button class="program-item-btn" type="button">
                            <p>2. Hacettepe Universiteti</p>
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
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Başvuru tarixi:</p>
                                    <div class="itemDetail">
                                        <p>12/02/2024</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>App no:</p>
                                    <div class="itemDetail">
                                        <p>123456</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Ölkə:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Universitet adı:</p>
                                    <div class="itemDetail">
                                        <p>Bakı Dövlət Universiteti</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dövlət:</p>
                                    <div class="itemDetail">
                                        <p>Türkiyə</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>İxtisas:</p>
                                    <div class="itemDetail">
                                        <p>Azərbaycan dili və ədəbiyyat müəllimi</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Dönəm:</p>
                                    <div class="itemDetail">
                                        <p>Bahar</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Təhsil haqqı:</p>
                                    <div class="itemDetail">
                                        <p>1500 AZN</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Login:</p>
                                    <div class="itemDetail">
                                        <p>ilaha@gmail.com</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <p>Şifrə:</p>
                                    <div class="itemDetail">
                                        <p>1234567</p>
                                        <button class="copyBtn" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.6665 6.44469C4.6665 5.97313 4.85383 5.52089 5.18727 5.18745C5.52071 4.85401 5.97295 4.66669 6.4445 4.66669H12.2218C12.4553 4.66669 12.6865 4.71268 12.9022 4.80203C13.118 4.89138 13.314 5.02235 13.4791 5.18745C13.6442 5.35255 13.7751 5.54856 13.8645 5.76428C13.9538 5.97999 13.9998 6.2112 13.9998 6.44469V12.222C13.9998 12.4555 13.9538 12.6867 13.8645 12.9024C13.7751 13.1181 13.6442 13.3142 13.4791 13.4793C13.314 13.6444 13.118 13.7753 12.9022 13.8647C12.6865 13.954 12.4553 14 12.2218 14H6.4445C6.21101 14 5.97981 13.954 5.76409 13.8647C5.54838 13.7753 5.35237 13.6444 5.18727 13.4793C5.02217 13.3142 4.8912 13.1181 4.80185 12.9024C4.71249 12.6867 4.6665 12.4555 4.6665 12.222V6.44469Z"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path
                                                    d="M2.67467 11.158C2.47023 11.0415 2.30018 10.873 2.18172 10.6697C2.06325 10.4663 2.00057 10.2353 2 10V3.33333C2 2.6 2.6 2 3.33333 2H10C10.5 2 10.772 2.25667 11 2.66667"
                                                    stroke="black" stroke-opacity="0.4" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-box">
                                <h2 class="smallTitle">Mərhələlər</h2>
                                <div class="steps-list">
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-check">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.833008 5.75L3.45206 8.75L9.99967 1.25" stroke="black"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="step-item-body">
                                            <div class="item-title">
                                                <h3 class="step-title">Şəxsi kabinet yaradıldı</h3>
                                                <p>01.02.2025</p>
                                            </div>
                                            <div class="item-document">
                                                <a href="" class="document-title">PDF sənədi</a>
                                                <p>01.02.2025</p>
                                            </div>
                                        </div>
                                        <div class="step-item-buttons">
                                            <button class="editStepBtn-item" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M11.7493 1.99266C13.0172 0.724778 15.0728 0.724778 16.3407 1.99266C17.6086 3.26054 17.6086 5.31618 16.3407 6.58406L10.0123 12.9124C9.65568 13.2691 9.43787 13.4869 9.1951 13.6763C8.90908 13.8994 8.5996 14.0907 8.27214 14.2467C7.99421 14.3792 7.70195 14.4766 7.2234 14.6361L4.99619 15.3785L4.46147 15.5567C3.98285 15.7163 3.45516 15.5917 3.09841 15.2349C2.74167 14.8782 2.6171 14.3505 2.77664 13.8719L3.69728 11.11C3.85677 10.6314 3.95417 10.3391 4.08663 10.0612C4.24269 9.73376 4.43395 9.42427 4.65705 9.13825C4.8464 8.89548 5.06425 8.67766 5.42096 8.32099L11.7493 1.99266ZM4.96736 14.0705L4.26288 13.366L4.8699 11.5449C5.04664 11.0147 5.11964 10.7992 5.21503 10.599C5.33203 10.3535 5.47543 10.1215 5.64269 9.90703C5.77906 9.73218 5.93924 9.57048 6.33443 9.17529L11.2436 4.26614C11.4462 4.77447 11.7891 5.38799 12.3672 5.96614C12.9454 6.54429 13.5589 6.88714 14.0672 7.08978L9.15806 11.9989C8.76287 12.3941 8.60117 12.5543 8.42633 12.6907C8.21189 12.8579 7.97987 13.0013 7.73437 13.1183C7.5342 13.2137 7.31862 13.2867 6.78841 13.4634L4.96736 14.0705ZM15.0632 6.09375C14.96 6.0711 14.831 6.03701 14.6843 5.98612C14.281 5.84618 13.7504 5.58157 13.2511 5.08226C12.7518 4.58295 12.4872 4.05238 12.3472 3.64903C12.2963 3.50233 12.2623 3.37331 12.2396 3.27012L12.6332 2.87654C13.4129 2.09682 14.6771 2.09682 15.4568 2.87654C16.2365 3.65627 16.2365 4.92045 15.4568 5.70018L15.0632 6.09375ZM2.70827 18.3334C2.70827 17.9882 2.98809 17.7084 3.33327 17.7084H16.6666V18.9584H3.33327C2.98809 18.9584 2.70827 18.6786 2.70827 18.3334Z"
                                                          fill="black" fill-opacity="0.9"/>
                                                </svg>
                                            </button>
                                            <button class="deleteStepBtn" type="button">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.23139 3.54169C8.48909 2.81261 9.18445 2.29175 9.99986 2.29175C10.8153 2.29175 11.5106 2.81261 11.7683 3.54169C11.8834 3.86714 12.2404 4.03772 12.5659 3.92269C12.8913 3.80766 13.0619 3.45058 12.9469 3.12514C12.5182 1.91224 11.3615 1.04175 9.99986 1.04175C8.63824 1.04175 7.48154 1.91224 7.05284 3.12514C6.93781 3.45058 7.10839 3.80766 7.43384 3.92269C7.75929 4.03772 8.11636 3.86714 8.23139 3.54169Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M2.2915 5.00008C2.2915 4.6549 2.57133 4.37508 2.9165 4.37508H17.0832C17.4284 4.37508 17.7082 4.6549 17.7082 5.00008C17.7082 5.34526 17.4284 5.62508 17.0832 5.62508H2.9165C2.57133 5.62508 2.2915 5.34526 2.2915 5.00008Z"
                                                        fill="#FF1346"/>
                                                    <path
                                                        d="M4.26388 6.4598C4.6083 6.43684 4.90611 6.69743 4.92907 7.04184L5.31236 12.7911C5.38724 13.9143 5.4406 14.6958 5.55774 15.2838C5.67136 15.8542 5.82997 16.1561 6.05782 16.3693C6.28566 16.5825 6.59746 16.7206 7.17413 16.7961C7.76863 16.8738 8.55197 16.8751 9.67767 16.8751H10.3221C11.4478 16.8751 12.2312 16.8738 12.8257 16.7961C13.4023 16.7206 13.7141 16.5825 13.942 16.3693C14.1698 16.1561 14.3284 15.8542 14.4421 15.2838C14.5592 14.6958 14.6126 13.9143 14.6874 12.7911L15.0707 7.04184C15.0937 6.69743 15.3915 6.43684 15.7359 6.4598C16.0803 6.48276 16.3409 6.78057 16.318 7.12499L15.9318 12.9181C15.8605 13.9871 15.803 14.8505 15.668 15.5281C15.5276 16.2325 15.289 16.8209 14.796 17.2821C14.303 17.7433 13.7 17.9423 12.9878 18.0355C12.3028 18.1251 11.4374 18.1251 10.3661 18.1251H9.63372C8.5624 18.1251 7.69703 18.1251 7.012 18.0355C6.29979 17.9423 5.69683 17.7433 5.20384 17.2821C4.71084 16.8209 4.47216 16.2325 4.33182 15.5281C4.19685 14.8505 4.1393 13.9871 4.06805 12.9181L3.68184 7.12499C3.65888 6.78057 3.91947 6.48276 4.26388 6.4598Z"
                                                        fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="student-services-tabContent student-tabContent" data-id="studentServicesDetail">
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


                    </div>
                </form>
            </div>
            <div class="student-documents-tabContent student-tabContent" data-id="studentDocumentsDetail">
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
                                        <a href="{{ asset('files/' . $document->file) }}" class="documentBtn-view">
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
{{--                                        <form action="{{route('deleteFile', $document->id)}}" method="post">--}}
{{--                                            {{ method_field('DELETE') }}--}}
{{--                                            @csrf--}}
{{--                                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin') "--}}
{{--                                                    class="documentBtn-delete">--}}
{{--                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"--}}
{{--                                                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                    <path--}}
{{--                                                        d="M8.23188 3.54163C8.48958 2.81254 9.18494 2.29169 10.0004 2.29169C10.8158 2.29169 11.5111 2.81254 11.7688 3.54163C11.8839 3.86708 12.2409 4.03766 12.5664 3.92263C12.8918 3.8076 13.0624 3.45052 12.9474 3.12507C12.5187 1.91218 11.362 1.04169 10.0004 1.04169C8.63873 1.04169 7.48203 1.91218 7.05333 3.12507C6.9383 3.45052 7.10888 3.8076 7.43433 3.92263C7.75977 4.03766 8.11685 3.86708 8.23188 3.54163Z"--}}
{{--                                                        fill="#FF1346"/>--}}
{{--                                                    <path--}}
{{--                                                        d="M2.29199 5.00002C2.29199 4.65484 2.57181 4.37502 2.91699 4.37502H17.0837C17.4289 4.37502 17.7087 4.65484 17.7087 5.00002C17.7087 5.3452 17.4289 5.62502 17.0837 5.62502H2.91699C2.57181 5.62502 2.29199 5.3452 2.29199 5.00002Z"--}}
{{--                                                        fill="#FF1346"/>--}}
{{--                                                    <path--}}
{{--                                                        d="M4.26437 6.45974C4.60879 6.43678 4.9066 6.69736 4.92956 7.04178L5.31285 12.791C5.38773 13.9142 5.44108 14.6958 5.55822 15.2838C5.67185 15.8542 5.83046 16.1561 6.0583 16.3692C6.28615 16.5824 6.59795 16.7206 7.17461 16.796C7.76912 16.8738 8.55245 16.875 9.67816 16.875H10.3226C11.4483 16.875 12.2317 16.8738 12.8262 16.796C13.4028 16.7206 13.7146 16.5824 13.9425 16.3692C14.1703 16.1561 14.3289 15.8542 14.4426 15.2838C14.5597 14.6958 14.6131 13.9142 14.6879 12.791L15.0712 7.04178C15.0942 6.69736 15.392 6.43678 15.7364 6.45974C16.0808 6.4827 16.3414 6.78051 16.3185 7.12493L15.9322 12.9181C15.861 13.987 15.8034 14.8504 15.6685 15.528C15.5281 16.2324 15.2895 16.8208 14.7965 17.282C14.3035 17.7433 13.7005 17.9423 12.9883 18.0354C12.3033 18.125 11.4379 18.125 10.3666 18.125H9.63421C8.56289 18.125 7.69752 18.125 7.01249 18.0354C6.30028 17.9423 5.69732 17.7433 5.20432 17.282C4.71133 16.8208 4.47264 16.2324 4.33231 15.528C4.19734 14.8504 4.13979 13.987 4.06854 12.918L3.68233 7.12493C3.65937 6.78051 3.91996 6.4827 4.26437 6.45974Z"--}}
{{--                                                        fill="#FF1346"/>--}}
{{--                                                </svg>--}}

{{--                                            </button>--}}
{{--                                        </form>--}}

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

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
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const services = @json($services);
</script>
<script>
    $(document).ready(function () {

        $('select').niceSelect();

        const documentRequirements = {
            Bakalavr: [
                "Attestat",
                "Attestatin Türkçe Tesdiqi",
                "Transkript",
                "Transkript Türkçe Tesdiqi",
                "Pasport",
                "Pasport Türkçe Tesdiqi",
                "Foto",
                "Denklik Belgesi",
                "Ölkeden çıxış üçün İcaze (18 Yaş olmayanlar üçün)",
                "Türkiyede Yaşam üçün İcaze (18 Yaş olmayanlar üçün)",
                "Dogum Haqqında Sehadetname (18 Yaş olmayanlar üçün)",
                "Türk Dili Sertifikatı",
                "İngilis Dili Sertifikatı",
                "Etibarname",
            ],
            Magistr: [
                "Bakalavr Diplomu",
                "Bakalavr Diplomu Türkçe Tesdiqi",
                "Transkript",
                "Transkript Türkçe Tesdiqi",
                "Pasport",
                "Pasport Türkçe Tesdiqi",
                "Foto",
                "Tanıma Belgesi",
                "Türk Dili Sertifikatı",
                "İngilis Dili Sertfikatı",
                "Etibarname",
            ],
            Doktorantura: [
                "Bakalavr Diplomu",
                "Bakalavr Diplomu Türkçe Tesdiqi",
                "Bakalavr Transkripti",
                "Bakalavr Transkripti Türkçe Tesdiqi",
                "Magistr Diplomu",
                "Magistr Diplomu Türkçe Tesdiqi",
                "Magistr Transkripti",
                "Magistr Transkripti Türkçe Tesdiqi",
                "Pasport",
                "Pasport Türkçe Tesdiqi",
                "Foto",
                "Tanıma Belgesi Bakalavr",
                "Tanıma Belgesi Magistr",
                "Türk Dili Sertifikatı",
                "İngilis Dili Sertfikatı",
                "Etibarname",
            ]
        };

        $('#educationLevel').on('change', function () {
            const selectedLevel = $(this).val();
            const documentTitleSelect = $('#documentTitle');
            documentTitleSelect.empty(); // Clear the previous document title options
            documentTitleSelect.append('<option value="">Seç</option>'); // Add the default option

            // Check if the selected level has corresponding document titles
            if (documentRequirements[selectedLevel]) {
                documentRequirements[selectedLevel].forEach(function (title) {
                    documentTitleSelect.append('<option value="' + title + '">' + title + '</option>');
                });
            }

            // Reinitialize niceSelect for the document title select
            documentTitleSelect.niceSelect('update');
        });

        $(document).on("click", ".editPersonalInfoBtn", function () {
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

        $(".form_addUni").on("submit", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "/education/store",
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

    });
</script>
