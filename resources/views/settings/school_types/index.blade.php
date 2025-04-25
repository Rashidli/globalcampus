@extends('layouts.master')
@section('title', 'Məktəb növü')

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

        <button class="addNewUniversityBtn" type="button" onclick="openCreateModal()">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </button>

        <div class="table-universityList-container">
            <table>
                <thead>
                <tr>
                    <th class="universityListNumber">№</th>
                    <th class="universityListName">Məktəb növü</th>
                    <th class="universityListName">Təhsil pilləsi</th>
                    <th class="universityListOthers">Digər</th>
                </tr>
                </thead>
                <tbody>
                @foreach($school_types as $key => $school_type)
                    <tr>
                        <td class="universityListNumber">{{$key + 1}}</td>
                        <td class="universityListName">{{$school_type->title}}</td>
                        <td class="universityListName">{{$school_type->education_level?->title}}</td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit"
                                    onclick="openEditModal({{ json_encode($school_type) }})">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </button>

                            <form action="{{ route('school_types.destroy', $school_type->id) }}" method="POST"
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
    <x-pagination :paginator="$school_types"/>
    <div class="addUniversity-Modal" id="createModal" style="display: none;">
        <div class="addUniversity-Modal-box">
            <div class="addUniversity-Modal-box-head">
                <h2>Məktəb növü əlavə et</h2>
                <button class="closeAddUniversity-Modal" type="button" onclick="closeCreateModal()">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('school_types.store') }}" class="form_addUniversity-Modal" method="POST">
                @csrf
                <div class="form-item">
                    <label for="">Məktəb növü adı</label>
                    <input type="text" name="title" placeholder="Məktəb növü">
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

    <div class="editUniversity-Modal" style="display: none;">
        <div class="editUniversity-Modal-box">
            <div class="editUniversity-Modal-box-head">
                <h2>Düzəliş et</h2>
                <button class="closeEditUniversity-Modal" type="button" onclick="closeEditModal()">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form id="editForm" method="POST" class="form_editUniversity-Modal">
                @csrf
                @method('PUT')
                <div class="form-item">
                    <label for="">Məktəb növü adı<sup>*</sup></label>
                    <input type="text" id="editTitle" name="title" placeholder="Məktəb növü">
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

        function openEditModal(schoolType) {
            document.getElementById('editTitle').value = schoolType.title;
            document.getElementById('editForm').action = `/school_types/${schoolType.id}`;

            let educationLevelSelect = document.getElementById("editEducationLevel");
            educationLevelSelect.value = schoolType.education_level_id;

            if (typeof $.fn.niceSelect !== "undefined") {
                $(educationLevelSelect).niceSelect('update');
            }

            document.querySelector(".editUniversity-Modal").style.display = "block";
        }

        function closeEditModal() {
            document.querySelector(".editUniversity-Modal").style.display = "none";
        }
    </script>
@endsection
