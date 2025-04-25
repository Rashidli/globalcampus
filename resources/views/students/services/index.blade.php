@extends('layouts.master')
@section('title', 'Xidmətlər')

@section('content')

    @include('students.includes.top')
    <div class="student-detailView-container">
        @include('students.includes.menu')
        <div class="student-detailView-tabContents">
            <div class="student-services-tabContent student-tabContent">
                <form action="{{route('student.addService', $user->id)}}" class="student-detail-serviceBox"
                      method="post">
                    @csrf
                    <h2 class="smallTitle">Tələbənin xidmətləri</h2>
                    <div class="service-list-titles">
                        <p class="service-type-title">Xidmət növü</p>
                        <p class="service-price-title">Məbləğ</p>
                    </div>
                    <div class="student-service-list">
                        @if($user->services->count() > 0)
                            <div id="studentServiceList" class="student-service-list">
                                @foreach($user->services ?? [] as $user_service)
                                    <div class="student-service-item">
                                        <select name="service_id[]" id="">
                                            <option value="">Seç</option>
                                            @foreach($services as $service)
                                                <option
                                                    value="{{$service->id}}" {{$service->id == $user_service->pivot->service_id ? 'selected' : ''}}>{{$service->title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="servicePrice">
                                            <input type="text" name="price[]"
                                                   value="{{$user_service->pivot->price}}" placeholder="0">
                                            <span>AZN</span>
                                        </div>
                                        <button class="deleteStudentService" type="button">
                                            <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div id="studentServiceList" class="student-service-list">
                                <div class="student-service-item">
                                    <select name="service_id[]" id="">
                                        <option value="">Seç</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="servicePrice">
                                        <input type="text" name="price[]" placeholder="0">
                                        <span>AZN</span>
                                    </div>
                                    <button class="deleteStudentService" type="button">
                                        <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                                    </button>
                                </div>
                            </div>
                        @endif
                        <button id="addStudentService" class="addStudentService" type="button">
                            <img src="{{asset('/')}}assets/images/plus.svg" alt="">
                            Əlavə et
                        </button>
                        <button class="saveStudentService">
                            Yadda saxla
                        </button>

                    </div>
                </form>
            </div>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const services = @json($services);
</script>
