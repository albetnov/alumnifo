<!--Header-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SisinfoAlumni</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @livewireStyles
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('mix_guest/guest.css') }}">
    {{-- <link href="{{ asset('assets/guest/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/guest/css/style.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">


    <!-- =======================================================
  * Template Name: TheEvent - v4.7.0
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<!--End Header-->



<body>
    {{ $slot }}
    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container">
            <div class="copyright">
                &copy; {{ date('Y') }} Copyright <strong>SisInfoAlumni</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
    <!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @livewireScripts

    <!-- Vendor JS Files -->
    <script src="{{ asset('mix_guest/guest.js') }}"></script>
    {{-- <script src="{{ asset('assets/guest/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/guest/js/main.js') }}"></script>
    <script src="{{ asset('assets/toastr/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script> --}}
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        Livewire.on('showAlert', (type, message) => {
            toastr[type](message);
        });
    </script>
</body>

</html>
