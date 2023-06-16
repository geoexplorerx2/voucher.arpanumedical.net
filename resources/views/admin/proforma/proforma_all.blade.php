<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <title>Dr Serkan Aygin Voucher System</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/voucher.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/gijgo.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/grid.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/popover.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/jquery-steps.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/glightbox.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/fullcalendar.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/PDFVoucher.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body onload="app();">

    @include('layouts.menu')
    <main class="main-content">
        @include('layouts.navbar')

        <div class="wrapper">
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 mt-3">
                            <div class="col-sm-8">
                                <h3 class="m-0 text-dark text-center"> Reservation Pro-forma</h3>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary float-right" onclick="voucherPdf();">Download PDF <i class="fa fa-download"></i></button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <section id="root" class="content">
                    @if (isset($data))
                    <div id="temContainer" class="templateContainer">@include('admin/PDFRepository/dataGeneratorWithData',['data'=>$data])</div>
                    <div id="formContainerId" class="formContainer">@include('admin/PDFRepository/DocumentViewWithData',['data'=>$data])</div>
                    @else
                    <div id="temContainer" class="templateContainer">@include('admin/PDFRepository/dataGenerator',['ReceiptNo'=>$ReceiptNo])</div>
                    <div id="formContainerId" class="formContainer">@include('admin/PDFRepository/DocumentView',['ReceiptNo'=>$ReceiptNo])</div>
                    @endif
                </section>
            </div>
        </div>
    </main>
    @include('layouts.active_users_modal')

    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popover.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/glightbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/Chart.extension.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.datatable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jscolor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-steps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gijgo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rest_api.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/clockpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataGen.js') }}"></script>
</body>

</html>
