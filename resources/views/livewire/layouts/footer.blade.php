<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    Alumnifo made by
                    Albet Novendo, Sendy Wahyudi, Irwanda Andika
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://github.com/albetnov/alumnifo" class="nav-link text-muted"
                            target="_blank">Alumnifo Git</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</main>

<!--   Core JS Files   -->
<script src="{{ asset('assets/admin') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/plugins/chartjs.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/admin') }}/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
<script src="{{ asset('assets/toastr/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
@livewireScripts
@stack('scripts')
<script>
    Livewire.on('showAlert', (type, message, redirect = null) => {
        toastr[type](message);
        if (redirect != null) {
            setTimeout(() => {
                location.href = redirect;
            }, 700);
        }
    });

    Livewire.on('openModal', (modalId, emit = null) => {
        $("#" + modalId).modal('show');
        if (emit != null) {
            Livewire.emit(emit);
        }
        // let myModal = new bootstrap.Modal(document.getElementById('imgPreview'), {
        // keyboard: false
        // });
        // myModal.show();
    });
</script>
</body>

</html>
