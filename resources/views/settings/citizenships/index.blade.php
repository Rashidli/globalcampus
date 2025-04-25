@extends('layouts.master')
@section('title', 'Vətəndaşlıq')

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
            <form action="{{ route('citizenships.import') }}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="grid grid-cols-3 gap-4">

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
                    <th class="universityListName">Vətəndaşlıq</th>
                    <th class="universityListOthers">Digər</th>
                </tr>
                </thead>
                <tbody>
                @foreach($citizenships as $key => $citizenship)
                    <tr>
                        <td class="universityListNumber">{{$key + 1}}</td>
                        <td class="universityListName">{{$citizenship->title}}</td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit" onclick="openEditModal({{ $citizenship }})">
                                <img src="{{ asset('/') }}assets/images/pen.svg" alt="">
                            </button>
                            {{--                            <a href="" class="universityView">--}}
                            {{--                                <img src="{{asset('/')}}assets/images/eye.svg" alt="">--}}
                            {{--                            </a>--}}

                            <form action="{{ route('citizenships.destroy', $citizenship->id) }}"
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
    <x-pagination :paginator="$citizenships"/>
    <div class="addUniversity-Modal">
        <div class="addUniversity-Modal-box">
            <div class="addUniversity-Modal-box-head">
                <h2>Vətəndaşlıq əlavə et</h2>
                <button class="closeAddUniversity-Modal" type="button">
                    <img src="{{asset('/')}}assets/images/x.svg" alt="">
                </button>
            </div>
            <form action="{{ route('citizenships.store') }}" class="form_addUniversity-Modal" method="POST">
                @csrf
                <div class="form-item">
                    <label for="">Vətəndaşlıq adı</label>
                    <input type="text" name="title" placeholder="Vətəndaşlıq">
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
                    <label for="">Vətəndaşlıq adı<sup>*</sup></label>
                    <input type="text" id="editTitle" name="title" placeholder="Vətəndaşlıq">
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

        function openEditModal(citizenship) {
            document.getElementById('editTitle').value = citizenship.title;
            document.getElementById('editForm').action = `/citizenships/${citizenship.id}`;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
