<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gunung Luhur Camp</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="/adminLTE/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminLTE/dist/css/adminlte.min.css">
    <!-- DatePicker Jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/adminLTE/plugins/toastr/toastr.min.css">

    <style>
        @media print {

            .dataTables_length,
            .dataTables_filter,
            .dataTables_info,
            .dataTables_paginate,
            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layoutAdmin.includes._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layoutAdmin.includes._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer no-print">
            <strong>Copyright &copy; 2021 <a href="">Gunung Luhur Camp</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery --> 
    <script src="/adminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="/adminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/adminLTE/dist/js/demo.js"></script>
    <!-- Toastr -->
    <script src="/adminLTE/plugins/toastr/toastr.min.js"></script>
    @if(Session::has('success'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "60000"
        }
        toastr.success("{{ session('success') }}");
    </script>
    @endif
    @if(Session::has('warning'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "60000"
        }
        toastr.error("{{ session('warning') }}");
    </script>
    @endif

    <!-- Script Lightbox-->
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            // $('.filter-container').filterizr({
            //     gutterPixels: 3
            // });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>

    <!-- Script active menu sidebar -->
    <script>
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>

    <!-- DataTables -->
    <script src="/adminLTE/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
        $(function() {
            $('#datatable').DataTable();
        })
    </script>

    <!-- Script DatePicker Jquery -->
    @yield('scripts')

</body>

</html>