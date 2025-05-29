@extends('layouts.master')
@section('title', 'Agentlər')
<style>
    .loading-indicator {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }

    .searching .loading-indicator {
        display: block;
    }

    .searching #agentsTableBody {
        opacity: 0.5;
    }
</style>
@section('content')
    <div class="flex justify-between my-[10px] items-center mt-[20px]">
        <a href="{{route('agents.create')}}" class="addNewAgent !mt-0 mb-0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19" stroke="#1661C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 12H19" stroke="#1661C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Əlavə et
        </a>
    </div>
    <div class="agents-head  !mt-[23px]">
        <form id="searchForm" action="{{ route('agents.index') }}" method="get">

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 bg-white p-4 rounded-lg shadow-md dark:bg-gray-800">
                <input type="text" name="company_name" id="company_name" placeholder="Şirkət adı" value="{{request('company_name')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <input type="text" name="name" id="name" placeholder="Ad soyad" value="{{request('name')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                <input type="text" name="email" id="email" placeholder="Email" value="{{request('email')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                <input type="text" name="phone" id="phone" placeholder="Telefon" value="{{request('phone')}}"
                       class="border border-gray-300 rounded-lg p-2 w-full dark:border-gray-600 dark:bg-gray-700 dark:text-white">

{{--                <div class="flex gap-4">--}}
{{--                    <a href="{{route('agents.index')}}"--}}
{{--                       class=" flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300--}}
{{--               font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">--}}
{{--                        Sıfırla--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <button type="submit" id="filterButton"--}}
{{--                        class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300--}}
{{--                    font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">--}}
{{--                    Filtrlə--}}
{{--                </button>--}}
                <p class="resultCount"><span id="totalResults">{{$users->total()}}</span> Nəticə</p>
            </div>
        </form>
    </div>
    <br>
    <div class="relative overflow-x-auto shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-4">Şirkətin adı</th>
                <th scope="col" class="px-6 py-4">Ad Soyad</th>
                <th scope="col" class="px-6 py-4">Email</th>
                <th scope="col" class="px-6 py-4">Mobil nömrə</th>
                <th scope="col" class="px-6 py-4">Pin</th>
                <th scope="col" class="px-6 py-4">Tələbə sayı</th>
                <th scope="col" class="px-6 py-4">Instagram</th>
                <th scope="col" class="px-6 py-4 text-center">Digər</th>
            </tr>
            </thead>
            <tbody id="agentsTableBody">
            @include('agents.partials.table', ['users' => $users])
            </tbody>
        </table>
    </div>

    <div id="paginationContainer">
        <x-pagination :paginator="$users"/>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Debounce function to prevent too many AJAX calls
            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this, args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            }

            // Function to perform search
            function performSearch() {
                var formData = $('#searchForm').serialize();

                $.ajax({
                    url: '{{ route("agents.index") }}',
                    type: 'GET',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#agentsTableBody').html(response.html);
                        $('#totalResults').text(response.total);
                        $('#paginationContainer').html(response.pagination || '');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Debounced search function
            var debouncedSearch = debounce(performSearch, 500);

            // Trigger search on input change
            $('#name, #email, #phone, #company_name').on('input', debouncedSearch);

            // Handle form submission to prevent page reload
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                performSearch();
            });
        });
    </script>
@endpush
