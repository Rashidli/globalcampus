@extends('layouts.master')
@section('title', 'Sənədlər')

@section('content')
    <div class="dashboard-body">
        @if(session('message'))
            <div class="success-message" style="max-width: 250px;">
                <p>{{session('message')}}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="error-message" style="max-width: 250px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <button class="addNewUniversityBtn" type="button">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </button>
            <br>
        <form action="{{ route('setting_documents.index') }}" method="get">

            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">

                <select name="education_level_id"
                        class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Təhsil pilləsi seçin</option>
                    @foreach($education_levels as $education_level)
                        <option
                            value="{{$education_level->id}}" {{$education_level->id == request('education_level_id') ? 'selected' : ''}}>
                            {{$education_level->title}}
                        </option>
                    @endforeach
                </select>

                <div class="col-span-1 md:col-span-2 flex gap-4">
                    <a href="{{route('setting_documents.index')}}"
                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
               font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Sıfırla
                    </a>
                    <button type="submit"
                            class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300
                    font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Filtrlə
                    </button>
                    <p class="resultCount"><span>{{$count}}</span> Nəticə</p>
                </div>
            </div>
        </form>
        <div class="table-universityList-container">
            <table>
                <thead>
                <tr>
                    <th class="universityListNumber">№</th>
                    <th class="universityListName">Sənədlər</th>
                    <th class="universityListName">Təhsil pilləsi</th>
                    <th class="universityListOthers">Digər</th>
                </tr>
                </thead>
                <tbody>
                @foreach($setting_documents as $key => $setting_document)
                    <tr>
                        <td class="universityListNumber">{{$key + 1}}</td>
                        <td class="universityListName">{{$setting_document->title}}</td>
                        <td class="universityListName">{{$setting_document->education_level?->title}}</td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit" onclick="openEditModal({{ $setting_document }})">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </button>
                            <form action="{{ route('setting_documents.destroy', $setting_document->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="universityListDelete"
                                        onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                    <img src="{{ asset('/') }}assets/images/trash.svg" alt="">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-pagination :paginator="$setting_documents"/>
    <div class="addUniversity-Modal">
        <div class="addUniversity-Modal-box">
            <div class="addUniversity-Modal-box-head">
                <h2>Sənədlər əlavə et</h2>
                <button class="closeAddUniversity-Modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('setting_documents.store') }}" class="form_addUniversity-Modal" method="POST">
                @csrf
                <div class="form-item">
                    <label for="">Sənədlər adı</label>
                    <input type="text" name="title" placeholder="Sənədlər">
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsini seçin</label>
                    <select name="education_level_id" id="">
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}">{{$education_level->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="addUniversity-ModalBtn" type="submit">Əlavə et</button>
            </form>

        </div>
    </div>

    <div class="editUniversity-Modal">
        <div class="editUniversity-Modal-box">
            <div class="editUniversity-Modal-box-head">
                <h2>Düzəliş et</h2>
                <button class="closeEditUniversity-Modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form id="editForm" method="POST" class="form_editUniversity-Modal">
                @csrf
                @method('PUT')
                <div class="form-item">
                    <label for="">Sənədlər adı<sup>*</sup></label>
                    <input type="text" id="editTitle" name="title" placeholder="Sənədlər">
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsini seçin</label>
                    <select name="education_level_id" id="">
                        @foreach($education_levels as $education_level)
                            <option value="{{$education_level->id}}">{{$education_level->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="editUniversity-ModalBtn" type="submit">Yadda saxla</button>
            </form>

        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').style.display = 'block';
        }

        function closeCreateModal() {
            document.getElementById('createModal').style.display = 'none';
        }

        function openEditModal(schoolType) {
            document.getElementById('editTitle').value = schoolType.title;
            document.getElementById('editForm').action = `/setting_documents/${schoolType.id}`;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
