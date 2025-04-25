@extends('layouts.master')
@section('title', 'Sənədlər')
@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tələbənin sənədləri</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">№</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tarix</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sənədin növü</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sənədin adı</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Sənəd</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($documents ?? [] as $key => $document)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-3 text-sm text-gray-700">{{$key+1}}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{$document->created_at->format('d/m/Y')}}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{$document->file_title}}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{$document->title}}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{$document->file}}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('student.document_edit', $document->id) }}" class="p-1 hover:bg-gray-100 rounded">
                                            <img src="{{asset('/')}}assets/images/pen.svg" alt="">
                                        </a>
                                        <a href="{{ asset('files/' . $document->file) }}" target="_blank" class="p-1 hover:bg-gray-100 rounded">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_72_1979)">
                                                    <path d="M2.7294 12.7464C2.02113 11.8262 1.66699 11.3661 1.66699 9.99998C1.66699 8.63383 2.02113 8.17375 2.7294 7.25359C4.14363 5.41628 6.51542 3.33331 10.0003 3.33331C13.4852 3.33331 15.857 5.41628 17.2712 7.25359C17.9795 8.17375 18.3337 8.63383 18.3337 9.99998C18.3337 11.3661 17.9795 11.8262 17.2712 12.7464C15.857 14.5837 13.4852 16.6666 10.0003 16.6666C6.51542 16.6666 4.14363 14.5837 2.7294 12.7464Z" stroke="black" stroke-opacity="0.9" stroke-width="1.5"/>
                                                    <path d="M12.5 10C12.5 11.3807 11.3807 12.5 10 12.5C8.61929 12.5 7.5 11.3807 7.5 10C7.5 8.61929 8.61929 7.5 10 7.5C11.3807 7.5 12.5 8.61929 12.5 10Z" stroke="black" stroke-opacity="0.9" stroke-width="1.5"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_72_1979">
                                                        <rect width="20" height="20" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="{{ asset('files/' . $document->file) }}" download class="p-1 hover:bg-gray-100 rounded">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 12.5C2.5 14.857 2.5 16.0355 3.23223 16.7678C3.96447 17.5 5.14298 17.5 7.5 17.5H12.5C14.857 17.5 16.0355 17.5 16.7678 16.7678C17.5 16.0355 17.5 14.857 17.5 12.5" stroke="black" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10.0003 2.49998V13.3333M10.0003 13.3333L13.3337 9.68748M10.0003 13.3333L6.66699 9.68748" stroke="black" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('deleteFile', $document->id)}}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <input type="hidden" value="5" name="tab_type">
                                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" class="p-1 hover:bg-gray-100 rounded">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.23188 3.54163C8.48958 2.81254 9.18494 2.29169 10.0004 2.29169C10.8158 2.29169 11.5111 2.81254 11.7688 3.54163C11.8839 3.86708 12.2409 4.03766 12.5664 3.92263C12.8918 3.8076 13.0624 3.45052 12.9474 3.12507C12.5187 1.91218 11.362 1.04169 10.0004 1.04169C8.63873 1.04169 7.48203 1.91218 7.05333 3.12507C6.9383 3.45052 7.10888 3.8076 7.43433 3.92263C7.75977 4.03766 8.11685 3.86708 8.23188 3.54163Z" fill="#FF1346"/>
                                                    <path d="M2.29199 5.00002C2.29199 4.65484 2.57181 4.37502 2.91699 4.37502H17.0837C17.4289 4.37502 17.7087 4.65484 17.7087 5.00002C17.7087 5.3452 17.4289 5.62502 17.0837 5.62502H2.91699C2.57181 5.62502 2.29199 5.3452 2.29199 5.00002Z" fill="#FF1346"/>
                                                    <path d="M4.26437 6.45974C4.60879 6.43678 4.9066 6.69736 4.92956 7.04178L5.31285 12.791C5.38773 13.9142 5.44108 14.6958 5.55822 15.2838C5.67185 15.8542 5.83046 16.1561 6.0583 16.3692C6.28615 16.5824 6.59795 16.7206 7.17461 16.796C7.76912 16.8738 8.55245 16.875 9.67816 16.875H10.3226C11.4483 16.875 12.2317 16.8738 12.8262 16.796C13.4028 16.7206 13.7146 16.5824 13.9425 16.3692C14.1703 16.1561 14.3289 15.8542 14.4426 15.2838C14.5597 14.6958 14.6131 13.9142 14.6879 12.791L15.0712 7.04178C15.0942 6.69736 15.392 6.43678 15.7364 6.45974C16.0808 6.4827 16.3414 6.78051 16.3185 7.12493L15.9322 12.9181C15.861 13.987 15.8034 14.8504 15.6685 15.528C15.5281 16.2324 15.2895 16.8208 14.7965 17.282C14.3035 17.7433 13.7005 17.9423 12.9883 18.0354C12.3033 18.125 11.4379 18.125 10.3666 18.125H9.63421C8.56289 18.125 7.69752 18.125 7.01249 18.0354C6.30028 17.9423 5.69732 17.7433 5.20432 17.282C4.71133 16.8208 4.47264 16.2324 4.33231 15.528C4.19734 14.8504 4.13979 13.987 4.06854 12.918L3.68233 7.12493C3.65937 6.78051 3.91996 6.4827 4.26437 6.45974Z" fill="#FF1346"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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


    <div class="uploadStudentDocumentModal">
        <div class="uploadStudentDocument-box">
            <div class="uploadStudent-box-head">
                <h2>Təhsil dərəcəsini seçin</h2>
                <button class="closeUploadStudentDocument" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="{{route('student.document_create')}}" class="form_uploadStudentDocument" method="get"
                  enctype="multipart/form-data">
                <input type="hidden" value="{{$user->id}}" name="user_id">
                <div class="form-item">
{{--                    <label for="">Təhsil dərəcəsi</label>--}}
                    <select class=" border w-full border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" name="education_level_id" id="educationLevel">
                        <option value="">Seç</option>
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}">{{$education_level->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="uploadDocumentBtn" type="submit">Seçin</button>
            </form>

        </div>
    </div>

@endsection
{{--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>--}}

{{--<script>--}}

{{--    $(document).ready(function () {--}}

{{--        $('select').niceSelect();--}}


{{--        $(document).ready(function () {--}}
{{--            $('#educationLevel').on('change', function () {--}}
{{--                const selectedLevel = $(this).val();--}}
{{--                const documentTitleSelect = $('#documentTitle');--}}

{{--                documentTitleSelect.empty();--}}
{{--                documentTitleSelect.append('<option value="">Seç</option>');--}}

{{--                if (selectedLevel) {--}}
{{--                    $.ajax({--}}
{{--                        url: '/get-documents/' + selectedLevel,--}}
{{--                        type: 'GET',--}}
{{--                        success: function (response) {--}}
{{--                            if (response.documents.length > 0) {--}}
{{--                                response.documents.forEach(function (title) {--}}
{{--                                    documentTitleSelect.append('<option value="' + title + '">' + title + '</option>');--}}
{{--                                });--}}
{{--                            }--}}
{{--                            documentTitleSelect.niceSelect('update');--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    documentTitleSelect.niceSelect('update');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}


{{--    });--}}
{{--</script>--}}
