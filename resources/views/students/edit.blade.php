@extends('layouts.master')
@section('title', 'Tələbələr')

@section('content')
    <a href="{{route('students.index')}}" class="goBack">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10.0303 6.46967C10.3232 6.76256 10.3232 7.23744 10.0303 7.53033L6.31066 11.25L14.5 11.25C15.4534 11.25 16.8667 11.5298 18.0632 12.3913C19.298 13.2804 20.25 14.7556 20.25 17C20.25 17.4142 19.9142 17.75 19.5 17.75C19.0858 17.75 18.75 17.4142 18.75 17C18.75 15.2444 18.0353 14.2196 17.1868 13.6087C16.3 12.9702 15.2133 12.75 14.5 12.75L6.31066 12.75L10.0303 16.4697C10.3232 16.7626 10.3232 17.2374 10.0303 17.5303C9.73744 17.8232 9.26256 17.8232 8.96967 17.5303L3.96967 12.5303C3.67678 12.2374 3.67678 11.7626 3.96967 11.4697L8.96967 6.46967C9.26256 6.17678 9.73744 6.17678 10.0303 6.46967Z"
                  fill="black"/>
        </svg>
        Geri
    </a>
    <div class="addNewStudent-container">
        @if(session('message'))
            <div class="success-message" style="max-width: 250px;">
                <p>{{session('message')}}</p>
            </div>
        @endif
            <h2 class="text-xl font-semibold mb-4">Məlumatları düzəliş et</h2>
            <a href="{{ route('students.show', $user->id) }}" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition duration-300">
                <span class="font-medium">{{ $user->name }}</span>
                <img src="{{ asset('/') }}assets/images/eye.svg" alt="Görüntülə" class="w-5 h-5">
            </a>
            <form action="{{route('students.update', $user->id)}}" class="addNewStudentForm" method="post"
              enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="addUserImg-container">
                <!-- burada ise yuklediyi sekil img icinde olur, js -ile yene deyismek olur -->
                <div class="addUserImg">

{{--                    <img src="{{asset('/')}}assets/images/defaultUserAdd.png" alt="">--}}
                    <img src="{{ $user->image ? asset('files/' . $user->image) : asset('/assets/images/defaultUserAdd.png') }}" alt="">

                    <input type="file" name="image">
                    <div class="icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.66669 4.6665H4.00002C3.6464 4.6665 3.30726 4.80698 3.05721 5.05703C2.80716 5.30708 2.66669 5.64622 2.66669 5.99984V11.9998C2.66669 12.3535 2.80716 12.6926 3.05721 12.9426C3.30726 13.1927 3.6464 13.3332 4.00002 13.3332H10C10.3536 13.3332 10.6928 13.1927 10.9428 12.9426C11.1929 12.6926 11.3334 12.3535 11.3334 11.9998V11.3332" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.59 4.39007C13.8526 4.12751 14.0001 3.77139 14.0001 3.40007C14.0001 3.02875 13.8526 2.67264 13.59 2.41007C13.3274 2.14751 12.9713 2 12.6 2C12.2287 2 11.8726 2.14751 11.61 2.41007L6 8.00007V10.0001H8L13.59 4.39007Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.6667 3.3335L12.6667 5.3335" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="personalInfoForm">
                <div class="formTitle">
                    <span>01</span>
                    <h3>Şəxsi məlumatlar</h3>
                </div>
                <div class="form-items">
                    <div class="form-item">
                        <label for="">Ad</label>
                        <input type="text" name="name" value="{{$user->name}}" placeholder="Ad">
                        @if($errors->first('name'))
                            <small class="form-text text-danger">{{$errors->first('name')}}</small>
                        @endif

                    </div>
                    <div class="form-item">
                        <label for="">Soyad</label>
                        <input type="text" name="surname" value="{{$user->surname}}" placeholder="Soyad">
                        @if($errors->first('surname'))
                            <small class="form-text text-danger">{{$errors->first('surname')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Ata adı</label>
                        <input type="text" name="father_name" value="{{$user->student_info?->father_name}}"
                               placeholder="Ata adı">
                        @if($errors->first('father_name'))
                            <small class="form-text text-danger">{{$errors->first('father_name')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Ana adı</label>
                        <input type="text" name="mother_name" value="{{$user->student_info?->mother_name}}"
                               placeholder="Ana adı">
                    </div>
                    <div class="form-item">
                        <label for="">Doğum tarixi</label>
                        <input type="date" name="birthday" value="{{$user->student_info?->birthday}}" class="datepicker"
                               placeholder="Gün/Ay/İl">
                        @if($errors->first('birthday'))
                            <small class="form-text text-danger">{{$errors->first('birthday')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Email</label>
                        <input type="email" name="contact_email" value="{{$user->student_info?->contact_email}}"
                               placeholder="Email">
                        @if($errors->first('contact_email'))
                            <small class="form-text text-danger">{{$errors->first('contact_email')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Mobil nömrə</label>
                        <input type="text" name="phone" value="{{$user->phone}}" placeholder="+994 50 000 00 00">
                        @if($errors->first('phone'))
                            <small class="form-text text-danger">{{$errors->first('phone')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Qeydiyyatda olduğu ünvan</label>
                        <input type="text" placeholder="Ünvan" name="address" value="{{$user->student_info?->address}}">
                        @if($errors->first('address'))
                            <small class="form-text text-danger">{{$errors->first('address')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Pasport no</label>
                        <input type="text" name="passport_number" value="{{$user->student_info?->passport_number}}" placeholder="Passport no">
                        @if($errors->first('passport_number'))
                            <small class="form-text text-danger">{{$errors->first('passport_number')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Kimlik no</label>
                        <input type="text" name="identity_number" value="{{$user->student_info?->identity_number}}" placeholder="Kimlik no">
                        @if($errors->first('identity_number'))
                            <small class="form-text text-danger">{{$errors->first('identity_number')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Mobil no</label>
                        <input type="text" name="phone" value="{{$user->phone}}" placeholder="Mobil no">
                        @if($errors->first('phone'))
                            <small class="form-text text-danger">{{$errors->first('phone')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Vətəndaşlıq</label>
                        <select name="citizenship" class="select2">
                            <option value="">Seçin</option>
                            @foreach($citizenships as $citizenship)
                                <option value="{{$citizenship->title}}" {{$user->student_info?->citizenship === $citizenship->title ? 'selected' : ''}}>{{$citizenship->title}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('citizenship_id'))
                            <small class="form-text text-danger">{{$errors->first('citizenship_id')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label>Ailə vəziyyəti</label>
                        <div class="form-checks">
                            <div class="form-check-item">
                                <div class="custom-checkbox">
                                    <input type="radio" id="student_single" value="Subay"
                                           {{$user->student_info?->marital_status == 'Subay' ? 'checked' : ''}} name="marital_status"/>
                                    <label for="student_single"></label>
                                </div>
                                <label for="student_single">Subay</label>
                            </div>
                            <div class="form-check-item">
                                <div class="custom-checkbox">
                                    <input type="radio" id="student_married" value="Evli"
                                           {{$user->student_info?->marital_status == 'Evli' ? 'checked' : ''}} name="marital_status"/>
                                    <label for="student_married"></label>
                                </div>
                                <label for="student_married">Evli</label>
                            </div>
                        </div>
                        @if($errors->first('marital_status'))
                            <small class="form-text text-danger">{{$errors->first('marital_status')}}</small>
                        @endif
                    </div>

                    <div class="form-item">
                        <label>Cins</label>
                        <div class="form-checks">
                            <div class="form-check-item">
                                <div class="custom-checkbox">
                                    <input type="radio" id="qadin" value="Qadın" name="gender"
                                        {{$user->student_info?->gender == 'Qadın' ? 'checked' : ''}} />
                                    <label for="qadin"></label>
                                </div>
                                <label for="qadin">Qadın</label>
                            </div>
                            <div class="form-check-item">
                                <div class="custom-checkbox">
                                    <input type="radio" id="kisi" value="Kişi" name="gender"
                                        {{$user->student_info?->gender == 'Kişi' ? 'checked' : ''}} />
                                    <label for="kisi"></label>
                                </div>
                                <label for="kisi">Kişi</label>
                            </div>
                        </div>
                        @if($errors->first('gender'))
                            <small class="form-text text-danger">{{$errors->first('gender')}}</small>
                        @endif
                    </div>
                    <div class="form-item">
                        <label for="">Agent seç</label>
                        <select name="agent_id" id="" class="select2">
                            <option value="">Seçin</option>
                            @foreach($agents as $agent)
                                <option
                                    value="{{$agent->id}}" {{$agent->id == $user->agent_id ? 'selected' : '' }}>{{$agent->agent_info?->company_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('agent_id'))
                            <small class="form-text text-danger">{{$errors->first('agent_id')}}</small>
                        @endif
                    </div>
                </div>
                <div class="entryInfoForm">
                    <div class="formTitle">
                        <span>02</span>
                        <h3>Giriş məlumatları</h3>
                    </div>
                    <div class="entryLine">
                        <div class="form-items">
                            <div class="form-item">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{$user->email}}" placeholder="Email">
                                @if($errors->first('email'))
                                    <small class="form-text text-danger">{{$errors->first('email')}}</small>
                                @endif
                            </div>

                            <div class="form-item">
                                <label for="">Şifrə</label>
                                <div class="password">
                                    <input type="password" name="password" placeholder="Şifrə">
                                    <button class="show_password_btn" type="button">
                                        <svg class="show-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.72843 12.7464C2.02015 11.8262 1.66602 11.3661 1.66602 9.99999C1.66602 8.63385 2.02015 8.17377 2.72843 7.2536C4.14265 5.41629 6.51444 3.33333 9.99935 3.33333C13.4843 3.33333 15.856 5.41629 17.2703 7.2536C17.9785 8.17377 18.3327 8.63385 18.3327 9.99999C18.3327 11.3661 17.9785 11.8262 17.2703 12.7464C15.856 14.5837 13.4843 16.6667 9.99935 16.6667C6.51444 16.6667 4.14265 14.5837 2.72843 12.7464Z" stroke="#000" stroke-width="1.5"></path>
                                            <path d="M12.5 10C12.5 11.3807 11.3807 12.5 10 12.5C8.61929 12.5 7.5 11.3807 7.5 10C7.5 8.61929 8.61929 7.5 10 7.5C11.3807 7.5 12.5 8.61929 12.5 10Z" stroke="#000" stroke-width="1.5"></path>
                                        </svg>
                                        <svg class="hidden-eye" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2954 6.31065C22.6761 6.47382 22.8524 6.91473 22.6893 7.29545L21.9999 7.00001C22.6893 7.29545 22.6894 7.29527 22.6893 7.29545L22.6886 7.29713L22.6875 7.29961L22.6843 7.30697L22.6736 7.33105C22.6646 7.35118 22.6518 7.3794 22.6352 7.41508C22.6019 7.48643 22.5533 7.58776 22.4888 7.71416C22.3599 7.96681 22.1675 8.32069 21.9084 8.73647C21.4828 9.41951 20.8724 10.2777 20.0619 11.1302L21.0303 12.0985C21.3231 12.3914 21.3231 12.8663 21.0303 13.1592C20.7374 13.4521 20.2625 13.4521 19.9696 13.1592L18.969 12.1586C18.3093 12.7113 17.5528 13.23 16.695 13.6562L17.6286 15.091C17.8545 15.4382 17.7562 15.9027 17.409 16.1286C17.0618 16.3546 16.5972 16.2562 16.3713 15.909L15.2821 14.2352C14.5028 14.4897 13.659 14.6626 12.7499 14.7246V16.5C12.7499 16.9142 12.4141 17.25 11.9999 17.25C11.5857 17.25 11.2499 16.9142 11.2499 16.5V14.7246C10.3689 14.6645 9.54909 14.5002 8.78982 14.2584L7.71575 15.9091C7.48984 16.2563 7.02526 16.3546 6.67807 16.1287C6.33089 15.9028 6.23257 15.4382 6.45847 15.091L7.37089 13.6888C6.5065 13.2667 5.74381 12.7502 5.07842 12.1983L4.11744 13.1592C3.82455 13.4521 3.34968 13.4521 3.05678 13.1592C2.76389 12.8664 2.76389 12.3915 3.05678 12.0986L3.98055 11.1748C3.15599 10.3151 2.53525 9.44656 2.10277 8.75468C1.83984 8.33404 1.6446 7.97566 1.51388 7.7197C1.44848 7.59164 1.3991 7.48895 1.36537 7.41665C1.3485 7.38048 1.33553 7.35189 1.32641 7.33149L1.31562 7.3071L1.31238 7.29966L1.31129 7.29714L1.31088 7.29619C1.31081 7.29602 1.31056 7.29545 1.99992 7.00001L1.31088 7.29619C1.14772 6.91547 1.32376 6.47382 1.70448 6.31065C2.08489 6.14762 2.52539 6.32356 2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363L2.68983 6.70582L2.69591 6.71953C2.7018 6.73273 2.7114 6.75392 2.72472 6.78249C2.75139 6.83965 2.79296 6.92626 2.84976 7.03748C2.96345 7.2601 3.13762 7.58028 3.37472 7.95961C3.85033 8.72048 4.57157 9.7071 5.55561 10.6216C6.42151 11.4263 7.48259 12.1676 8.75165 12.6558C9.70614 13.023 10.7854 13.25 11.9999 13.25C13.2416 13.25 14.342 13.0128 15.3124 12.6308C16.5738 12.1343 17.6277 11.3883 18.4866 10.582C19.4562 9.67198 20.1668 8.69517 20.6354 7.94321C20.869 7.56832 21.0405 7.25228 21.1525 7.03268C21.2085 6.92296 21.2494 6.83758 21.2757 6.78125C21.2888 6.7531 21.2983 6.73224 21.3041 6.71925L21.31 6.70577L21.3106 6.70457C21.3105 6.70467 21.3106 6.70447 21.3106 6.70457M22.2954 6.31065C21.9147 6.14753 21.4738 6.32405 21.3106 6.70457L22.2954 6.31065ZM2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363V6.70363Z" fill="#000"></path>
                                        </svg>
                                    </button>
                                </div>
                                @if($errors->first('password'))
                                    <small class="form-text text-danger">{{$errors->first('password')}}</small>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="educationalInfoForm">--}}
{{--                <div class="formTitle">--}}
{{--                    <span>02</span>--}}
{{--                    <h3>Təhsil</h3>--}}
{{--                </div>--}}
{{--                <div class="educationFormLine" id="educationFormsContainer">--}}
{{--                    @foreach($user->educations ?? [] as $education)--}}
{{--                        <div class="form-items">--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Təhsil dərəcəsi</label>--}}
{{--                                <input type="hidden" name="education_id[]" value="{{$education->id}}">--}}
{{--                                <select name="degree[]">--}}
{{--                                    <option value="">Seç</option>--}}
{{--                                    <option value="Bakalavr" {{$education->degree == 'Bakalavr' ? 'selected' : ''}}>--}}
{{--                                        Bakalavr--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="Magistratura" {{$education->degree == 'Magistratura' ? 'selected' : ''}}>--}}
{{--                                        Magistratura--}}
{{--                                    </option>--}}
{{--                                    <option value="Phd" {{$education->degree == 'Phd' ? 'selected' : ''}}>Phd</option>--}}
{{--                                    <option--}}
{{--                                        value="Rezidentura" {{$education->degree == 'Rezidentura' ? 'selected' : ''}}>--}}
{{--                                        Rezidentura--}}
{{--                                    </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Universitetin adı</label>--}}
{{--                                <input type="text" name="university[]" value="{{$education->university}}"--}}
{{--                                       placeholder="Universitetin adı">--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Fakültə adı</label>--}}
{{--                                <input type="text" name="faculty[]" value="{{$education->faculty}}"--}}
{{--                                       placeholder="Fakültənin adı">--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">İxtisas adı</label>--}}
{{--                                <input type="text" name="profession[]" value="{{$education->profession}}"--}}
{{--                                       placeholder="İxtisasın adı">--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">GNO</label>--}}
{{--                                <input type="text" name="gno[]" value="{{$education->gno}}" placeholder="GNO">--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Başlama tarixi</label>--}}
{{--                                <input type="date" value="{{$education->university_start_date}}" name="start_date[]"--}}
{{--                                       placeholder="Ay/İl">--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Bitmə tarixi</label>--}}
{{--                                <input type="date" value="{{$education->university_end_date}}" name="end_date[]"--}}
{{--                                       placeholder="Ay/İl">--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <button type="button" class="deleteInfoForm deleteEducation">--}}
{{--                            <img src="{{ asset('/') }}assets/images/trash.svg" alt="">--}}
{{--                            Sil--}}
{{--                        </button>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <button type="button" class="addInfoForm" id="addEducation">--}}
{{--                    <img src="{{ asset('/') }}assets/images/plus.svg" alt="">--}}
{{--                    Əlavə et--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="workExperienceInfoForm">--}}
{{--                <div class="formTitle">--}}
{{--                    <span>03</span>--}}
{{--                    <h3>İş təcrübəsi</h3>--}}
{{--                </div>--}}
{{--                <div class="workExperienceLine">--}}
{{--                    @foreach($user->experiences ?? [] as $experience)--}}
{{--                        <div class="form-items">--}}
{{--                            <input type="hidden" name="experience_id[]" value="{{$experience->id}}">--}}
{{--                            <div class="form-item-left">--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">İş yeri</label>--}}
{{--                                    <input type="text" name="experience_company[]"--}}
{{--                                           value="{{$experience->experience_company}}" placeholder="Müəssisənin adı">--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Vəzifə</label>--}}
{{--                                    <input type="text" name="position[]" value="{{$experience->position}}"--}}
{{--                                           placeholder="Vəzifənin  adı">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-item-right">--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Başlama tarixi</label>--}}
{{--                                    <input type="date" name="experience_start_date[]"--}}
{{--                                           value="{{$experience->experience_start_date}}" placeholder="Ay/İl">--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Bitmə tarixi</label>--}}
{{--                                    <input type="date" name="experience_end_date[]"--}}
{{--                                           value="{{$experience->experience_end_date}}" placeholder="Ay/İl">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <button type="button" class="deleteInfoForm">--}}
{{--                            <img src="{{ asset('/') }}assets/images/trash.svg" alt="">--}}
{{--                            Sil--}}
{{--                        </button>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <button type="button" class="addInfoForm">--}}
{{--                    <img src="{{ asset('/') }}assets/images/plus.svg" alt="">--}}
{{--                    Əlavə et--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="languageSkillsInfoForm">--}}
{{--                <div class="formTitle">--}}
{{--                    <span>04</span>--}}
{{--                    <h3>Dil bilikləri</h3>--}}
{{--                </div>--}}
{{--                <div class="languageSkillsLine">--}}
{{--                    @foreach($user->languages ?? [] as $language)--}}
{{--                        <div class="form-items">--}}
{{--                            <div class="form-item">--}}
{{--                                <input type="hidden" value="{{$language->id}}" name="language_id[]">--}}
{{--                                <label for="">Dil</label>--}}
{{--                                <select name="language[]" id="">--}}
{{--                                    <option value="">Seçin</option>--}}
{{--                                    <option value="English" {{$language->language == 'English' ? 'selected' : ''}}>--}}
{{--                                        English--}}
{{--                                    </option>--}}
{{--                                    <option value="Russian" {{$language->language == 'Russian' ? 'selected' : ''}}>--}}
{{--                                        Russian--}}
{{--                                    </option>--}}
{{--                                    <option value="Spanish" {{$language->language == 'Spanish' ? 'selected' : ''}}>--}}
{{--                                        Spanish--}}
{{--                                    </option>--}}
{{--                                    <option value="Turkish" {{$language->language == 'Turkish' ? 'selected' : ''}}>--}}
{{--                                        Turkish--}}
{{--                                    </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-item">--}}
{{--                                <label for="">Bilik səviyyəniz</label>--}}
{{--                                <select name="level[]" id="">--}}
{{--                                    <option value="">Seçin</option>--}}
{{--                                    <option value="Advanced" {{$language->level == 'Advanced' ? 'selected' : ''}}>--}}
{{--                                        Advanced--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="Intermediate" {{$language->level == 'Intermediate' ? 'selected' : ''}}>--}}
{{--                                        Intermediate--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="Pre-Intermediate" {{$language->level == 'Pre-Intermediate' ? 'selected' : ''}}>--}}
{{--                                        Pre-Intermediate--}}
{{--                                    </option>--}}
{{--                                    <option value="Beginner" {{$language->level == 'Beginner' ? 'selected' : ''}}>--}}
{{--                                        Beginner--}}
{{--                                    </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <button type="button" class="deleteInfoForm">--}}
{{--                            <img src="{{ asset('/') }}assets/images/trash.svg" alt="">--}}
{{--                            Sil--}}
{{--                        </button>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <button type="button" class="addInfoForm">--}}
{{--                    <img src="{{ asset('/') }}assets/images/plus.svg" alt="">--}}
{{--                    Əlavə et--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="programsInfoForm">--}}
{{--                <div class="formTitle">--}}
{{--                    <span>05</span>--}}
{{--                    <h3>Proqram məlumatları</h3>--}}
{{--                </div>--}}
{{--                <div class="programsLine">--}}
{{--                    @foreach($user->programs ?? [] as $program)--}}
{{--                        <div class="form-items">--}}
{{--                            <div class="form-item">--}}
{{--                                <input type="hidden" name="program_id[]" value="{{$program->id}}">--}}
{{--                                <label for="">Proqramı seç</label>--}}
{{--                                <select name="program_education[]">--}}
{{--                                    <option value="">Seçin</option>--}}
{{--                                    <option--}}
{{--                                        value="Bakalavr" {{$program->program_education == 'Bakalavr' ? 'selected' : ''}}>--}}
{{--                                        Bakalavr--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="Magistr" {{$program->program_education == 'Magistr' ? 'selected' : ''}}>--}}
{{--                                        Magistr--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="Doktorantura" {{$program->program_education == 'Doktorantura' ? 'selected' : ''}}>--}}
{{--                                        Doktorantura--}}
{{--                                    </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-items-right">--}}
{{--                                <div class="form-item">--}}
{{--                                    <div class="form-item">--}}
{{--                                        <label for="">Ölkə</label>--}}
{{--                                        <input type="text" name="country[]" value="{{$program->country}}"--}}
{{--                                               placeholder="Ölkə">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <div class="form-item">--}}
{{--                                        <label for="">Universitet</label>--}}
{{--                                        <input type="text" name="program_university[]"--}}
{{--                                               value="{{$program->program_university}}" placeholder="Universitet">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <div class="form-item">--}}
{{--                                        <label for="">İxtisas</label>--}}
{{--                                        <input type="text" name="program_profession[]"--}}
{{--                                               value="{{$program->program_profession}}" placeholder="İxtisas">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Müqavilənin başlayacağı tarix</label>--}}
{{--                                    <input type="date" name="program_date[]" placeholder="Gün/Ay/İl"--}}
{{--                                           value="{{$program->program_date}}" class="datepicker">--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Dönəm</label>--}}
{{--                                    <select name="donem[]" id="">--}}
{{--                                        <option value="">Seçin</option>--}}
{{--                                        <option value="guz" {{$program->donem == 'guz' ? 'selected' : ''}}>Güz</option>--}}
{{--                                        <option value="bahar" {{$program->donem == 'bahar' ? 'selected' : ''}}>Bahar</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-item">--}}
{{--                                    <label for="">Dönəm tarixi</label>--}}
{{--                                    <div class="form-item-selects">--}}
{{--                                        <select name="donem_start[]" id="">--}}
{{--                                            <option value="">Başlama ili</option>--}}
{{--                                            @for($year = 2019; $year <= 2026; $year++)--}}
{{--                                                <option value="{{ $year }}" {{ isset($program->donem_start) && $program->donem_start == $year ? 'selected' : '' }}>--}}
{{--                                                    {{ $year }}--}}
{{--                                                </option>--}}
{{--                                            @endfor--}}
{{--                                        </select>--}}

{{--                                        <select name="donem_end[]" id="">--}}
{{--                                            <option value="">Bitmə ili</option>--}}
{{--                                            @for($year = 2019; $year <= 2026; $year++)--}}
{{--                                                <option value="{{ $year }}" {{ isset($program->donem_end) && $program->donem_end == $year ? 'selected' : '' }}>--}}
{{--                                                    {{ $year }}--}}
{{--                                                </option>--}}
{{--                                            @endfor--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <button type="button" class="deleteInfoForm">--}}
{{--                            <img src="{{ asset('/') }}assets/images/trash.svg" alt="">--}}
{{--                            Sil--}}
{{--                        </button>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <button type="button" class="addInfoForm">--}}
{{--                    <img src="{{ asset('/') }}assets/images/plus.svg" alt="">--}}
{{--                    Əlavə et--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="agentInfoForm">--}}
{{--                <div class="formTitle">--}}
{{--                    <span>06</span>--}}
{{--                    <h3>Agent</h3>--}}
{{--                </div>--}}
{{--                <div class="agentLine">--}}
{{--                    <div class="form-items">--}}
{{--                        <div class="form-item">--}}
{{--                            <label for="">Agent seç</label>--}}
{{--                            <select name="agent_id" id="">--}}
{{--                                <option value="">Seçin</option>--}}
{{--                                @foreach($agents as $agent)--}}
{{--                                    <option--}}
{{--                                        value="{{$agent->id}}" {{$agent->id == $user->agent_id ? 'selected' : '' }}>{{$agent->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->first('agent_id'))--}}
{{--                                <small class="form-text text-danger">{{$errors->first('agent_id')}}</small>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <button class="addStudentBtn" type="submit">Düzəliş et</button>
        </form>
    </div>

@endsection
<script>
    const assetBasePath = "{{ asset('/') }}";
    // document.addEventListener('DOMContentLoaded', function () {
    //
    //     // Add new Education
    //     document.getElementById('addEducation').addEventListener('click', function () {
    //         var container = document.getElementById('educationFormsContainer');
    //         var newForm = container.querySelector('.form-items').cloneNode(true);
    //         container.appendChild(newForm);
    //     });
    //
    //     // Add new Work Experience
    //     document.querySelector('.addInfoForm').addEventListener('click', function () {
    //         var container = document.querySelector('.workExperienceLine');
    //         var newForm = container.querySelector('.form-items').cloneNode(true);
    //         container.appendChild(newForm);
    //     });
    //
    //     // Add new Language Skills
    //     document.querySelector('.addInfoForm').addEventListener('click', function () {
    //         var container = document.querySelector('.languageSkillsLine');
    //         var newForm = container.querySelector('.form-items').cloneNode(true);
    //         container.appendChild(newForm);
    //     });
    //
    //     // Add new Program Info
    //     document.querySelector('.addInfoForm').addEventListener('click', function () {
    //         var container = document.querySelector('.programsLine');
    //         var newForm = container.querySelector('.form-items').cloneNode(true);
    //         container.appendChild(newForm);
    //     });
    //
    //     // Delete Dynamic Fields (Education, Work Experience, Language Skills, Programs)
    //     document.addEventListener('click', function (e) {
    //         if (e.target.classList.contains('deleteInfoForm')) {
    //             e.target.closest('.form-items').remove();
    //         }
    //     });
    //
    // });

</script>

