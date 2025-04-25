
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('/')}}assets/swiper/swiper.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/jquery-nice-select-1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/style/style.css">
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{asset('/')}}assets/images/logo.svg" alt="">
        </div>
        <h1 class="login-title">Xoş gəldin! CRM-ə daxil ol.</h1>
        <form action="{{route('login_submit')}}" class="login-form" method="post">
            @csrf
            <div class="form-item">
                <label for="">Email</label>
                <div class="input-box">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 12.3335C2 8.56226 2 6.67664 3.17157 5.50507C4.34315 4.3335 6.22876 4.3335 10 4.3335H14C17.7712 4.3335 19.6569 4.3335 20.8284 5.50507C22 6.67664 22 8.56226 22 12.3335C22 16.1047 22 17.9904 20.8284 19.1619C19.6569 20.3335 17.7712 20.3335 14 20.3335H10C6.22876 20.3335 4.34315 20.3335 3.17157 19.1619C2 17.9904 2 16.1047 2 12.3335Z" stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                        <path d="M6 8.3335L8.1589 10.1326C9.99553 11.6631 10.9139 12.4284 12 12.4284C13.0861 12.4284 14.0045 11.6631 15.8411 10.1326L18 8.3335" stroke="black" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <input type="email" name="email" placeholder="Email">
                </div>
                @if($errors->first('email')) <small class="form-text text-danger">{{$errors->first('email')}}</small>@endif
            </div>
            <div class="form-item">
                <label for="">Şifrə</label>
                <div class="input-box">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 16.3335C2 13.5051 2 12.0909 2.87868 11.2122C3.75736 10.3335 5.17157 10.3335 8 10.3335H16C18.8284 10.3335 20.2426 10.3335 21.1213 11.2122C22 12.0909 22 13.5051 22 16.3335C22 19.1619 22 20.5761 21.1213 21.4548C20.2426 22.3335 18.8284 22.3335 16 22.3335H8C5.17157 22.3335 3.75736 22.3335 2.87868 21.4548C2 20.5761 2 19.1619 2 16.3335Z" stroke="black" stroke-opacity="0.8" stroke-width="1.5"/>
                        <path d="M6 10.3335V8.3335C6 5.01979 8.68629 2.3335 12 2.3335C15.3137 2.3335 18 5.01979 18 8.3335V10.3335" stroke="black" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.3335C9 16.8858 8.55228 17.3335 8 17.3335C7.44772 17.3335 7 16.8858 7 16.3335C7 15.7812 7.44772 15.3335 8 15.3335C8.55228 15.3335 9 15.7812 9 16.3335Z" fill="black" fill-opacity="0.8"/>
                        <path d="M13 16.3335C13 16.8858 12.5523 17.3335 12 17.3335C11.4477 17.3335 11 16.8858 11 16.3335C11 15.7812 11.4477 15.3335 12 15.3335C12.5523 15.3335 13 15.7812 13 16.3335Z" fill="black" fill-opacity="0.8"/>
                        <path d="M17 16.3335C17 16.8858 16.5523 17.3335 16 17.3335C15.4477 17.3335 15 16.8858 15 16.3335C15 15.7812 15.4477 15.3335 16 15.3335C16.5523 15.3335 17 15.7812 17 16.3335Z" fill="black" fill-opacity="0.8"/>
                    </svg>
                    <div class="password">
                        <input type="password" name="password" placeholder="Şifrə">
                        <button class="show_password_btn" type="button">
                            <svg class="show-eye" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.72843 12.7464C2.02015 11.8262 1.66602 11.3661 1.66602 9.99999C1.66602 8.63385 2.02015 8.17377 2.72843 7.2536C4.14265 5.41629 6.51444 3.33333 9.99935 3.33333C13.4843 3.33333 15.856 5.41629 17.2703 7.2536C17.9785 8.17377 18.3327 8.63385 18.3327 9.99999C18.3327 11.3661 17.9785 11.8262 17.2703 12.7464C15.856 14.5837 13.4843 16.6667 9.99935 16.6667C6.51444 16.6667 4.14265 14.5837 2.72843 12.7464Z" stroke="#000" stroke-width="1.5"></path>
                                <path d="M12.5 10C12.5 11.3807 11.3807 12.5 10 12.5C8.61929 12.5 7.5 11.3807 7.5 10C7.5 8.61929 8.61929 7.5 10 7.5C11.3807 7.5 12.5 8.61929 12.5 10Z" stroke="#000" stroke-width="1.5"></path>
                            </svg>
                            <svg class="hidden-eye" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2954 6.31065C22.6761 6.47382 22.8524 6.91473 22.6893 7.29545L21.9999 7.00001C22.6893 7.29545 22.6894 7.29527 22.6893 7.29545L22.6886 7.29713L22.6875 7.29961L22.6843 7.30697L22.6736 7.33105C22.6646 7.35118 22.6518 7.3794 22.6352 7.41508C22.6019 7.48643 22.5533 7.58776 22.4888 7.71416C22.3599 7.96681 22.1675 8.32069 21.9084 8.73647C21.4828 9.41951 20.8724 10.2777 20.0619 11.1302L21.0303 12.0985C21.3231 12.3914 21.3231 12.8663 21.0303 13.1592C20.7374 13.4521 20.2625 13.4521 19.9696 13.1592L18.969 12.1586C18.3093 12.7113 17.5528 13.23 16.695 13.6562L17.6286 15.091C17.8545 15.4382 17.7562 15.9027 17.409 16.1286C17.0618 16.3546 16.5972 16.2562 16.3713 15.909L15.2821 14.2352C14.5028 14.4897 13.659 14.6626 12.7499 14.7246V16.5C12.7499 16.9142 12.4141 17.25 11.9999 17.25C11.5857 17.25 11.2499 16.9142 11.2499 16.5V14.7246C10.3689 14.6645 9.54909 14.5002 8.78982 14.2584L7.71575 15.9091C7.48984 16.2563 7.02526 16.3546 6.67807 16.1287C6.33089 15.9028 6.23257 15.4382 6.45847 15.091L7.37089 13.6888C6.5065 13.2667 5.74381 12.7502 5.07842 12.1983L4.11744 13.1592C3.82455 13.4521 3.34968 13.4521 3.05678 13.1592C2.76389 12.8664 2.76389 12.3915 3.05678 12.0986L3.98055 11.1748C3.15599 10.3151 2.53525 9.44656 2.10277 8.75468C1.83984 8.33404 1.6446 7.97566 1.51388 7.7197C1.44848 7.59164 1.3991 7.48895 1.36537 7.41665C1.3485 7.38048 1.33553 7.35189 1.32641 7.33149L1.31562 7.3071L1.31238 7.29966L1.31129 7.29714L1.31088 7.29619C1.31081 7.29602 1.31056 7.29545 1.99992 7.00001L1.31088 7.29619C1.14772 6.91547 1.32376 6.47382 1.70448 6.31065C2.08489 6.14762 2.52539 6.32356 2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363L2.68983 6.70582L2.69591 6.71953C2.7018 6.73273 2.7114 6.75392 2.72472 6.78249C2.75139 6.83965 2.79296 6.92626 2.84976 7.03748C2.96345 7.2601 3.13762 7.58028 3.37472 7.95961C3.85033 8.72048 4.57157 9.7071 5.55561 10.6216C6.42151 11.4263 7.48259 12.1676 8.75165 12.6558C9.70614 13.023 10.7854 13.25 11.9999 13.25C13.2416 13.25 14.342 13.0128 15.3124 12.6308C16.5738 12.1343 17.6277 11.3883 18.4866 10.582C19.4562 9.67198 20.1668 8.69517 20.6354 7.94321C20.869 7.56832 21.0405 7.25228 21.1525 7.03268C21.2085 6.92296 21.2494 6.83758 21.2757 6.78125C21.2888 6.7531 21.2983 6.73224 21.3041 6.71925L21.31 6.70577L21.3106 6.70457C21.3105 6.70467 21.3106 6.70447 21.3106 6.70457M22.2954 6.31065C21.9147 6.14753 21.4738 6.32405 21.3106 6.70457L22.2954 6.31065ZM2.68888 6.70363C2.68882 6.7035 2.68894 6.70376 2.68888 6.70363V6.70363Z" fill="#000"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @if($errors->first('password')) <small class="form-text text-danger">{{$errors->first('password')}}</small>@endif
            </div>
            <a href="" class="forgetPassWordLink">Şifrəmi unutdum</a>
            <button class="login-btn" type="submit">Daxil ol</button>
        </form>
    </div>
</div>

<script src="{{asset('/')}}assets/jquery-nice-select-1.1.0/js/jquery.js"></script>
<script src="{{asset('/')}}assets/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
<script>
    $(document).ready(function () {
        $('select').niceSelect()
    })
</script>
<script src="{{asset('/')}}assets/swiper/swiper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Datepicker ayarları
        $('.datepicker').datetimepicker({
            format: 'd/m/Y', // Tarih formatı
            timepicker: false, // Sadece tarih seçimi
            lang: 'az' // Dil ayarı
        });

        // Takvim ikonuna veya input alanına tıklandığında datepicker'ı aç
        $('.datepicker').on('click', function () {
            $(this).datetimepicker('show');
        });
    });
</script>
<script src="{{asset('/')}}assets/js/index.js"></script>
</body>
</html>
