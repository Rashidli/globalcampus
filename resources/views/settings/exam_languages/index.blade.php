@extends('layouts.master')
@section('title', 'İmtahan dili')

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

        <div class="table-universityList-container">
            <table>
                <thead>
                <tr>
                    <th class="universityListNumber">№</th>
                    <th class="universityListName">İmtahan dili</th>
                    <th class="universityListOthers">Digər</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exam_languages as $key => $exam_language)
                    <tr>
                        <td class="universityListNumber">{{$key + 1}}</td>
                        <td class="universityListName">{{$exam_language->title}}</td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit" onclick="openEditModal({{ $exam_language }})">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </button>
                            {{--                            <a href="" class="universityView">--}}
                            {{--                                <img src="{{asset('/')}}assets/images/eye.svg" alt="">--}}
                            {{--                            </a>--}}

                            <form action="{{ route('exam_languages.destroy', $exam_language->id) }}"
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
    <x-pagination :paginator="$exam_languages"/>
    <div class="addUniversity-Modal">
        <div class="addUniversity-Modal-box">
            <div class="addUniversity-Modal-box-head">
                <h2>İmtahan dili əlavə et</h2>
                <button class="closeAddUniversity-Modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('exam_languages.store') }}" class="form_addUniversity-Modal" method="POST">
                @csrf
                <div class="form-item">
                    <label for="">İmtahan dili adı</label>
                    <input type="text" name="title" placeholder="İmtahan dili">
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
                    <label for="">İmtahan dili adı<sup>*</sup></label>
                    <input type="text" id="editTitle" name="title" placeholder="İmtahan dili">
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

        function openEditModal(examLanguage) {
            document.getElementById('editTitle').value = examLanguage.title;
            document.getElementById('editForm').action = `/exam_languages/${examLanguage.id}`;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
