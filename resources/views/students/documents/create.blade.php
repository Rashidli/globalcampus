@extends('layouts.master')
@section('title', 'Sənədlər')

@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <form action="{{route('file-upload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h1>{{$education_level->title}}</h1>
                <input type="hidden" name="file_title" value="{{$education_level->title}}">
                <div class="space-y-4 p-4">
                    <div class="grid grid-cols-3 gap-4">

                        @foreach($education_level->settingDocuments ?? [] as $document)
                            <div class="flex flex-col">
                                <label for="price" class="mb-2">{{$document->title}}</label>
                                <input type="file" name="file[]" class="w-full border border-gray-300 rounded-lg p-2">
                                <input type="hidden" name="title[]" value="{{$document->title}}" class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        @endforeach
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition">Yadda saxla</button>
                        <a href="{{route('documents.index', $user->id)}}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition">Geri</a>
                    </div>
                </div>
            </form>


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



@endsection

