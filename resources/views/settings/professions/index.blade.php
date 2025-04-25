@extends('layouts.master')
@section('title', 'İxtisas')

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
            <form action="{{ route('professions.import') }}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="grid grid-cols-3 gap-4">
                    <!-- Təhsil səviyyəsi seçimi -->
                    <div class="flex flex-col space-y-1">
                        <label for="education_level_id" class="text-sm font-medium text-gray-700 dark:text-gray-300">Təhsil səviyyəsi</label>
                        <select name="education_level_id" id="education_level_id"
                                class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                            @foreach($education_levels as $level)
                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fayl yükləmə -->
                    <div class="flex flex-col space-y-1">
                        <label for="file" class="text-sm font-medium text-gray-700 dark:text-gray-300">Fayl seç (.xlsx, .csv)</label>
                        <input type="file" name="file" id="file"
                               class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                               required accept=".xlsx,.csv">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                            Yüklə
                        </button>
                    </div>
                </div>


            </form>

            <br>
        <div class="table-universityList-container">
            <table>
                <thead>
                <tr>
                    <th class="universityListNumber">№</th>
                    <th class="universityListName">İxtisas</th>
                    <th class="universityListName">Təhsil pilləsi</th>
                    <th class="universityListOthers">Digər</th>
                </tr>
                </thead>
                <tbody>
                @foreach($professions as $key => $profession)
                    <tr>
                        <td class="universityListNumber">{{$key + 1}}</td>
                        <td class="universityListName">{{$profession->title}}</td>
                        <td class="universityListName">{{$profession->education_level?->title}}</td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit" onclick="openEditModal({{ json_encode($profession) }})">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </button>

                            <form action="{{ route('professions.destroy', $profession->id) }}"
                                  method="POST" style="display:inline;">
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
    <x-pagination :paginator="$professions"/>
    <div class="addUniversity-Modal">
        <div class="addUniversity-Modal-box">
            <div class="addUniversity-Modal-box-head">
                <h2>İxtisas əlavə et</h2>
                <button class="closeAddUniversity-Modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('professions.store') }}" class="form_addUniversity-Modal" method="POST">
                @csrf
                <div class="form-item">
                    <label for="">İxtisas adı</label>
                    <input type="text" name="title" placeholder="İxtisas">
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsini seçin</label>
                    <select name="education_level_id">
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
                    <label for="">İxtisas adı<sup>*</sup></label>
                    <input type="text" id="editTitle" name="title" placeholder="İxtisas">
                </div>
                <div class="form-item">
                    <label for="">Təhsil pilləsini seçin</label>
                    <select id="editEducationLevel" name="education_level_id">
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

        function openEditModal(profession) {
            document.getElementById('editTitle').value = profession.title;
            document.getElementById('editForm').action = `/professions/${profession.id}`;

            let educationLevelSelect = document.getElementById("editEducationLevel");
            educationLevelSelect.value = profession.education_level_id;

            if (typeof $.fn.niceSelect !== "undefined") {
                $(educationLevelSelect).niceSelect('update');
            }

            document.querySelector('.editUniversity-Modal').style.display = 'block';
        }

        function closeEditModal() {
            document.querySelector('.editUniversity-Modal').style.display = 'none';
        }


    </script>
@endsection
