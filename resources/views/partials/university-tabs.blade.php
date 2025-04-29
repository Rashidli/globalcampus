<div class="university-tabs">
    <a href="{{ route('tariffs.index') }}"
       class="university-tab-btn {{ request()->routeIs('tariffs.index') ? 'active' : '' }}">
        Axtar
    </a>

    @foreach($university_education_levels as $university_education_level)
        <a href="{{ route('universities.index', ['education_id' => $university_education_level->id]) }}"
           class="university-tab-btn {{ request('education_id') == $university_education_level->id ? 'active' : '' }}">
            {{ $university_education_level->title }}
        </a>
    @endforeach
</div>
