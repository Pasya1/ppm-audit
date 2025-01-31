{{-- <footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row bg-warning">
            <nav class="footer-nav">
                <ul>
                    <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                    <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                    <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
                </ul>
            </nav>
            <div class="credits ml-auto">
            </div>
        </div>
    </div>
</footer> --}}
</div>
</div>

<!--   Core JS Files   -->
<script src="{{ asset('AdminStyle') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('AdminStyle') }}/js/core/popper.min.js"></script>
<script src="{{ asset('AdminStyle') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('AdminStyle') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="{{ asset('AdminStyle') }}/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('AdminStyle') }}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('AdminStyle') }}/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('AdminStyleStyle') }}/demo/demo.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{-- TinyMce5 --}}
<script src="{{ asset('tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce5/tinymce.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
</script>
<script>
    $(document).ready(function() {
        // Menghindari error saat DataTables gagal diinisialisasi
        $.fn.dataTable.ext.errMode = 'none';

        // Inisialisasi DataTables
        $('.table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" // Bahasa Indonesia
            }
        });
    });
</script>
</body>

</html>
