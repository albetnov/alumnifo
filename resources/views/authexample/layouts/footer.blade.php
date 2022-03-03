 <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
 <footer class="footer py-5">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 mb-4 mx-auto text-center">

             </div>
             <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                 <a href="#" class="text-secondary me-xl-4 me-4">
                     <span class="text-lg fab fa-dribbble"></span>
                 </a>
                 <a href="#" class="text-secondary me-xl-4 me-4">
                     <span class="text-lg fab fa-twitter"></span>
                 </a>
                 <a href="#" class="text-secondary me-xl-4 me-4">
                     <span class="text-lg fab fa-instagram"></span>
                 </a>
                 <a href="#" class="text-secondary me-xl-4 me-4">
                     <span class="text-lg fab fa-pinterest"></span>
                 </a>
                 <a href="#" class="text-secondary me-xl-4 me-4">
                     <span class="text-lg fab fa-github"></span>
                 </a>
             </div>
         </div>
         <div class="row">
             <div class="col-8 mx-auto text-center mt-1">
                 <p class="mb-0 text-secondary">
                     Copyright ©
                     <script>
                         document.write(new Date().getFullYear())
                     </script> Soft by Creative Tim.
                 </p>
             </div>
         </div>
     </div>
 </footer>
 <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
 <!--   Core JS Files   -->
 <script src="{{ asset('assets/admin') }}/js/core/popper.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/core/bootstrap.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/plugins/smooth-scrollbar.min.js"></script>
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
 @stack('scripts')
 </body>

 </html>
