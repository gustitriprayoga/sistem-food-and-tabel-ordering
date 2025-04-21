<script src="{{ asset('backend/dist/assets/js/vendor.min.js') }}"></script>
<!-- Import Js Files -->
<script src="{{ asset('backend/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/dist/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/dist/assets/js/theme/app.init.js') }}"></script>
<script src="{{ asset('backend/dist/assets/js/theme/theme.js') }}"></script>
<script src="{{ asset('backend/dist/assets/js/theme/app.min.js') }}"></script>
<script src="{{ asset('backend/dist/assets/js/theme/sidebarmenu.js') }}"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('backend/dist/assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/dist/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/dist/assets/js/dashboards/dashboard.js') }}"></script>


  <!-- Import Js Files -->
  <script src="{{ asset('backend/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

  <script src="{{ asset('backend/dist/assets/js/datatable/datatable-advanced.init.js') }}"></script>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- jQuery UI: draggable dll --}}
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

{{-- jQuery UI CSS --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Sidebar Toggle -->
<script>
    $(document).ready(function() {
        $('.sidebar-link.has-arrow').on('click', function(e) {
            e.preventDefault();

            let $submenu = $(this).next('ul');

            // Tutup yang lain (opsional)
            $('.sidebar-link.has-arrow').not(this).next('ul').slideUp().removeClass('show');
            $('.sidebar-link.has-arrow').not(this).attr('aria-expanded', 'false');

            // Toggle
            if ($submenu.is(':visible')) {
                $(this).attr('aria-expanded', 'false');
                $submenu.slideUp().removeClass('show');
            } else {
                $(this).attr('aria-expanded', 'true');
                $submenu.slideDown().addClass('show');
            }
        });
    });
</script>
