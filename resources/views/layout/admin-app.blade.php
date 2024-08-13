<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('lms/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('lms/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lms/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('lms/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('lms/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('lms/vendors/css/vendor.bundle.base.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> --}}
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('lms/css/vertical-layout-light/style.css') }}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('lms/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{ asset('lms/css/select2/select2.css') }}" rel="stylesheet" />


    @livewireStyles
    <style>
        .breadcrumb {
            border-radius: 10px;
        }

        .powergrid .row {
            padding: 5px;
            margin: 0px;
        }

        .navbar-toggler:focus {
            text-decoration: none;
            outline: 0;
            box-shadow: 0 0 0 0;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @livewire('components.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            @livewire('components.settings')
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @livewire('components.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @livewire('components.footer')
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script data-navigate-once src="{{ asset('lms/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('lms/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('lms/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('lms/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('lms/js/off-canvas.js') }}"></script>
    <script src="{{ asset('lms/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('lms/js/template.js') }}"></script>
    <script src="{{ asset('lms/js/settings.js') }}"></script>

    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('lms/js/dashboard.js') }}"></script>
    <script src="{{ asset('/lms/js/Chart.roundedBarCharts.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <!-- End custom js for this page-->
    @livewireScripts
    @stack('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="{{ asset('lms/css/select2/select2.js') }}"></script>

    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    <script>
        window.addEventListener('show-delete-button', event => {
            console.log(event);
            Swal.fire({
                title: "Confirm Delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('DeleteConfirm');
                }
            });
        });
        window.addEventListener('approve-leave', event => {
            // 
        });
        window.addEventListener('reject-leave', event => {
            // 
        });
        window.addEventListener('admin-edituser', event => {
            // 
        });

        document.addEventListener('livewire:navigated', function() {
            flatpickr(".flatpickr");
        });
    </script>
</body>

</html>
