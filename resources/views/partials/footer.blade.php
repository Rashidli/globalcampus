{{--<script src="{{asset('/')}}assets/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>--}}
{{--<script src="{{asset('/')}}assets/jquery-nice-select-1.1.0/js/jquery.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.select2').select2({
            // tags: true,
            // placeholder: function() {
            //     return $(this).attr('placeholder');
            // },
            // allowClear: true
        });

        $('.select2_agent:not([multiple])').select2({
            width: '100%',
        });
        $('.price_select').select2({
            tags: true,
            // placeholder: function() {
            //     return $(this).attr('placeholder');
            // },
            // allowClear: true
        });
    });
</script>

<script src="{{asset('/')}}assets/swiper/swiper.js"></script>
<script src="{{asset('/')}}assets/js/index.js?v={{time()}}"></script>
<script src="{{asset('/')}}assets/js/script.js?v={{time()}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>--}}

@if (session('success'))
    <script>
        $(document).ready(function() {
            toastr.success('{{ session('success') }}', 'Success');
        });
    </script>
@endif
