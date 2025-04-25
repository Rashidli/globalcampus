<div class="page-head">
    <h1>@yield('title')</h1>
    <div class="head-userProfile">
        <h2>{{ auth()->user()->name }} {{ auth()->user()->surname }}</h2>
        <div class="profile-edit-img">
            <img src="{{ auth()->user()->image ? asset('files/' . auth()->user()->image) : asset('/assets/images/userImg.svg') }}" alt="" class="edit-img">

            <form id="uploadImageForm" action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" class="upload-img-input hidden" onchange="document.getElementById('uploadImageForm').submit()">
            </form>

            <div class="icon" onclick="document.querySelector('.upload-img-input').click()">
                <img src="{{ asset('/') }}assets/images/pen_upload.svg" alt="">
            </div>
        </div>
    </div>
</div>
