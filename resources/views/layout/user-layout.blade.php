<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'ONFP')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon-onfp.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    {{-- <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/v/bs5/dt-2.0.2/datatables.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">

    {{-- Pour sweetAlert --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/home') }}" class="logo d-flex align-items-center">
                {{-- <img src="{{ asset('assets/img/onfp.png') }}" alt=""> --}}
                <span class="d-none d-lg-block">ONFP</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        {{--   <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div> --}}
        <!-- End Search Bar -->

        {{-- Mode sombre --}}
        {{-- <div class="form-check form-switch mx-4">
            <input class="form-check-input p-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked
                onclick="myFunction()" />
        </div> --}}
        @include('layout.page-navbar')
        <!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('layout.page-sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">

        @yield('space-work')

    </main><!-- End #main -->
    @include('sweetalert::alert')

    <!-- ======= Footer ======= -->
    @include('layout.page-footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script>
        setTimeout(function() {
            $('.alert-success').remove();
        }, 5000);
    </script>
    <script>
        setTimeout(function() {
            $('.alert-danger').remove();
        }, 5000);
    </script>
    <script>
        function myFunction() {
            var element = document.body;
            element.dataset.bsTheme =
                element.dataset.bsTheme == "light" ? "dark" : "light";
        }

        function stepFunction(event) {
            debugger;
            var element = document.getElementsByClassName(("html")[0].innerHTML);
            for (var i = 0; i < element.length; i++) {
                if (element[i] !== event.target.ariaControls) {
                    element[i].classList.remove("show");
                }
            }
        }
    </script>

    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

    {{-- Pour sweetAlert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Êtes-vous sûr de vouloir supprimer cet enregistrement ?`,
                    text: "Si vous supprimez ceci, il disparaîtra pour toujours.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
    <script type="text/javascript">
        $('.show_confirm_disconnect').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Êtes-vous sûr de vouloir vous déconnecter ?`,
                    text: "Vous pouvez cliquer sur ok pour confirmer ou cliquer sur cancel pour annuler.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
    <script>
        $("#checkAll").click(function() {
            $(".form-check-input").prop('checked', $(this).prop('checked'));
        });
    </script>
    <script type="text/javascript">
        $('.show_confirm_valider').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Êtes-vous sûr de vouloir valider ?`,
                    text: "Si oui, cliquer sur ok.",
                    icon: "success",
                    buttons: true,
                })
                .then((willValide) => {
                    if (willValide) {
                        form.submit();
                    }
                });
        });
    </script>
    <script type="text/javascript">
        $('.show_confirm_annuler').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Êtes-vous sûr de vouloir rejeter ?`,
                    text: "Si oui, cliquer sur ok.",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willValide) => {
                    if (willValide) {
                        form.submit();
                    }
                });
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#select-field-civilite').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-registre-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-civilite-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-departement-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-statut-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-categorie-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-registre').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-familiale').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-statut').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-professionnelle').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-niveau_etude').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>


    <script>
        $('#select-field-diplome_academique').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-projet_poste_formation').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-diplome_professionnel').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-region').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            dropdownParent: $('#AddFormationModal'),
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-types_formation').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            dropdownParent: $('#AddFormationModal'),
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-niveau_qualification').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            dropdownParent: $('#AddFormationModal'),
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-departement').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-departement-modal').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            dropdownParent: $('#AddFormationModal'),
        });
    </script>

    <script>
        $('#select-field-employe').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    {{-- type de dirction/service/cellule --}}
    <script>
        $('#select-field-type').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>


    <script>
        $('#select-field-categorie').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            dropdownParent: $('#AddFormationModal'),
        });
    </script>

    <script>
        $('#select-field-operateur').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            dropdownParent: $('#AddFormationModal'),
        });
    </script>

    <script>
        $('#select-field-fonction').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-arrondissement').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#multiple-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-module').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    <script>
        $('#select-field-civilite-update').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
        });
    </script>

    </script>
    @stack('scripts')
</body>

</html>
