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

        <button class="addNewUniversityBtn" type="button" id="openAddModal">
            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
            Əlavə et
        </button>
            <br>
{{--        <form action="{{ route('setting_documents.index') }}" method="get">--}}

{{--            <div--}}
{{--                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">--}}

{{--                <select name="education_level_id"--}}
{{--                        class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">--}}
{{--                    <option value="">Təhsil pilləsi seçin</option>--}}
{{--                    @foreach($education_levels as $education_level)--}}
{{--                        <option--}}
{{--                            value="{{$education_level->id}}" {{$education_level->id == request('education_level_id') ? 'selected' : ''}}>--}}
{{--                            {{$education_level->title}}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                <div class="col-span-1 md:col-span-2 flex gap-4">--}}
{{--                    <a href="{{route('setting_documents.index')}}"--}}
{{--                       class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300--}}
{{--               font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">--}}
{{--                        Sıfırla--}}
{{--                    </a>--}}
{{--                    <button type="submit"--}}
{{--                            class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300--}}
{{--                    font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">--}}
{{--                        Filtrlə--}}
{{--                    </button>--}}
{{--                    <p class="resultCount"><span>{{$count}}</span> Nəticə</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
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
                        <td class="universityListName">
                            {{ $setting_document->educationLevels->pluck('title')->join(', ') }}
                        </td>
                        <td class="universityListOthersButtons">
                            <button class="universityListEdit" onclick="openEditModal({{ $setting_document->id }}, '{{ $setting_document->title }}', [{{ $setting_document->educationLevels->pluck('id')->join(',') }}])" >
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
    <!-- Add Document Modal -->
    <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Yeni sənəd əlavə et</h3>
                        <button id="closeAddModal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('setting_documents.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-all duration-200">Sənəd adı</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="w-full px-4 py-2.5 text-gray-700 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Məsələn: Təhsil haqqı arayışı"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Sənədin tam adını daxil edin</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Təhsil pillələri</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($education_levels as $education_level)
                                    <label class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                        <input type="checkbox" name="education_level_ids[]" value="{{ $education_level->id }}"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-600">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $education_level->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" id="cancelAddModal" class="mr-3 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-200 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                Ləğv et
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                                Əlavə et
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Document Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Sənədi redaktə et</h3>
                        <button id="closeEditModal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="editForm" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-all duration-200">Sənəd adı</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="title"
                                    id="editTitle"
                                    class="w-full px-4 py-2.5 text-gray-700 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Məsələn: Təhsil haqqı arayışı"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Sənədin tam adını daxil edin</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Təhsil pillələri</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="educationLevelsContainer">
                                @foreach($education_levels as $education_level)
                                    <label class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                        <input type="checkbox" name="education_level_ids[]" value="{{ $education_level->id }}"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-600">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $education_level->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" id="cancelEditModal" class="mr-3 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-200 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                Ləğv et
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                                Yadda saxla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Modal handling
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');

        document.getElementById('openAddModal').addEventListener('click', () => {
            addModal.classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', () => {
            addModal.classList.add('hidden');
        });

        document.getElementById('cancelAddModal').addEventListener('click', () => {
            addModal.classList.add('hidden');
        });

        document.getElementById('closeEditModal').addEventListener('click', () => {
            editModal.classList.add('hidden');
        });

        document.getElementById('cancelEditModal').addEventListener('click', () => {
            editModal.classList.add('hidden');
        });

        // Open edit modal with document data
        function openEditModal(id, title, educationLevelIds) {
            document.getElementById('editTitle').value = title;
            document.getElementById('editForm').action = `/setting_documents/${id}`;

            // Reset all checkboxes
            const checkboxes = document.querySelectorAll('#educationLevelsContainer input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Check the ones that should be checked
            educationLevelIds.forEach(levelId => {
                const checkbox = document.querySelector(`#educationLevelsContainer input[value="${levelId}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });

            editModal.classList.remove('hidden');
        }

        // Close modals when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === addModal) {
                addModal.classList.add('hidden');
            }
            if (event.target === editModal) {
                editModal.classList.add('hidden');
            }
        });
    </script>
@endsection
