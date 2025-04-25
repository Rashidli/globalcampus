@extends('layouts.master')
@section('title', 'Xidmətlər')

@section('content')

    <button class="addNewService" type="button">
        <img src="{{asset('/')}}assets/images/plus.svg" alt="">
        Əlavə et
    </button>
    <div class="table-service-container">
        <table>
            <thead>
            <tr>
                <th class="serviceNumber">№</th>
                <th class="serviceName">Xidmətin adı</th>
                <th class="serviceOthers">Digər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $key => $service)
                <tr>
                    <td class="serviceNumber">{{$loop->index + 1}}</td>
                    <td class="serviceName">{{$service->title}}</td>
                    <td class="serviceOthersButtons">
                        <button class="serviceCategoryEdit" data-id="{{$service->id}}" data-title="{{$service->title}}">
                            <img src="{{asset('/')}}assets/images/pen.svg" alt="">
                        </button>
                        <form action="{{route('services.destroy', $service->id)}}" method="post">
                            {{ method_field('DELETE') }}
                            @csrf
                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" class="serviceCategoryDelete">
                                <img src="{{asset('/')}}assets/images/trash.svg" alt="">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$services"/>

    <div class="editServiceModal">
        <div class="editServiceModal-box">
            <div class="editServiceModal-box-head">
                <h2>Xidmət məlumatı</h2>
                <button class="closeEditServiceModal" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form id="editForm" class="form_editServiceModal" method="post">
                @csrf
                @method('PUT')
                <div class="form-item">
                    <label for="">Xidmət<sup>*</sup></label>
                    <input id="title" name="title" type="text" placeholder="Xidmətin adı">
                    <input type="hidden" id="serviceId">
                </div>
                <button class="editServiceModalBtn" type="button" id="updateService">Yadda saxla</button>
            </form>

        </div>
    </div>

    <div class="addServiceModal">
        <div class="addServiceModal-box">
            <div class="addServiceModal-box-head">
                <h2>Xidmət əlavə et</h2>
                <button class="closeAddServiceModal" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="black" stroke-opacity="0.6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <form action="{{route('services.store')}}" class="form_addServiceModal" method="post">
                @csrf
                <div class="form-item">
                    <label for="">Xidmət<sup>*</sup></label>
                    <input type="text" name="title" placeholder="Xidmətin adı">
                </div>
                <button class="addServiceModalBtn" type="submit">Əlavə et</button>
            </form>

        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.serviceCategoryEdit').on('click', function () {
            const serviceId = $(this).data('id');
            const title = $(this).data('title');

            $('#serviceId').val(serviceId);
            $('#title').val(title);

            $('.editServiceModal').show();
        });

        $('.closeEditServiceModal').on('click', function () {
            $('.editServiceModal').hide();
        });

        $('#updateService').on('click', function () {
            const serviceId = $('#serviceId').val();
            const title = $('#title').val();
            const token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `/services/${serviceId}`,
                method: 'PUT',
                data: {
                    _token: token,
                    title: title,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    alert(Object.values(errors).join('\n'));
                }
            });
        });
    });

</script>
