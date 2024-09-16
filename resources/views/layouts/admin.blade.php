<!DOCTYPE html>
<html lang="en" class="default">

<head>

    <title>@stack('title') | {{ config('app.name') }}</title>

    <!-- all the meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- End meta -->

    <link rel="shortcut icon" href="{{ asset('assets/upload/favicon/favicon-1716465915.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icons/uicons-solid-rounded/css/uicons-solid-rounded.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icons/uicons-bold-rounded/css/uicons-bold-rounded.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icons/uicons-bold-straight/css/uicons-bold-straight.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icons/uicons-regular-rounded/css/uicons-regular-rounded.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icons/uicons-thin-rounded/css/uicons-thin-rounded.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icon-picker/fontawesome-iconpicker.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/global/icon-picker/icons/fontawesome-all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/summernote/summernote-lite.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/tagify-master/dist/tagify.css') }}"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/select2/select2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/daterangepicker/daterangepicker.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.contextMenu.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/variables/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/variables/dark.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
</head>

<body>



    @include('sidebar')

    <div class="ol-sidebar-content">
        <!-- Header -->
        @include('header')
        <div class="ol-body-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>



    @include('modal')

    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/global/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/global/icon-picker/fontawesome-iconpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/jquery-ui-1.13.2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/global/tagify-master/dist/tagify.min.js') }}"></script>
    <script src="{{ asset('assets/global/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.contextMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <div class="toast-container position-fixed top-0 end-0 p-3"></div>

    @include('script')
    <script>
        function processServerResponse(response) {
            if (response.success) {
                success(response.success)
            }

            if (response.error) {
                error(response.error)
            }

            if (response.loadScript) {
                alert(response.loadScript)
            }

            if (response.validationError) {
                error('validation error')
            }

            const selector = response.loadTable ?? 'table.table';
            $(selector).load(location.href + ' ' + selector)
        }

        // When the "Select All" checkbox is changed
        $(document).on('change', '#select-all', function() {
            $('.checkbox-item').prop('checked', this.checked);
            toggleDeleteButton();
        });

        // When any checkbox item is changed
        $(document).on('change', '.checkbox-item', function() {
            if ($('.checkbox-item:checked').length === $('.checkbox-item').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
            toggleDeleteButton();
        });

        // Function to toggle delete button visibility
        function toggleDeleteButton() {
            if ($('.checkbox-item:checked').length > 0) {
                $('#delete-selected').removeClass('d-none');
            } else {
                $('#delete-selected').addClass('d-none');
            }
        }
    </script>





    @stack('js')
</body>

</html>
