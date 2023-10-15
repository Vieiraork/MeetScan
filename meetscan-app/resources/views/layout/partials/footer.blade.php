

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Alpine 3.9.5 -->
<script src="{{ asset('plugins/alpine/alpine3-9-5.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- select2 -->
<script src=" {{ asset('plugins/select2/js/select2.js')}} "></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<!-- <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<!-- jQuery Validation -->
<script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery-validation/localization/messages_pt_BR.min.js') }}"></script>
<!-- jQuery Mask Plugin -->
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<!-- jQuery Iconpicker Plugin -->
<script src="{{ asset('plugins/bootstrap-iconpicker-1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<!-- jQuery Datatables Plugin -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}} "></script>
<script src=" {{ asset('plugins/select2/js/select2.full.js')}} "></script>
<script src="{{ asset('plugins/datatables/datetime-moment.js')}}"></script>
<script src=" {{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}} "></script>
<script src=" {{ asset('plugins/fullcalendar/main.js')}} "></script>
<script src=" {{ asset('plugins/fullcalendar/main.list.js')}} "></script>
<script src=" {{ asset('plugins/fullcalendar/main.daygrid.js')}} "></script>
<script src=" {{ asset('plugins/fullcalendar/main.interaction.js')}} "></script>
<script src=" {{ asset('plugins/html2canvas/html2canvas.min.js')}} "></script>
<script src=" {{ asset('plugins/pdfmake/pdfmake.min.js')}} "></script>
<script src=" {{ asset('plugins/jsPDF-1.3.2/dist/jspdf.debug.js')}} "></script>

<!-- funcoes -->
<script src="{{ asset('js/funcoes.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>

<script src="{{ asset('js/methods-validate.js') }}"></script>
@yield('script')
@include('sweetalert::alert')