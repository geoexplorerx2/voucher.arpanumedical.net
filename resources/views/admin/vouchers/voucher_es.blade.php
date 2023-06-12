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
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
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
                                <h3 class="m-0 text-dark text-center"> Reservation Voucher</h3>
                            </div>
                            <div class="col-sm-4">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Language</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route("voucher") }}">English</a></li>
                                        <li><a href="{{ route("es.voucher") }}">Spanish</a></li>
                                        <li><a href="{{ route("it.voucher") }}">Italian</a></li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary float-right" onclick="voucherPdf();">Download PDF <i class="fa fa-download"></i></button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                        <div class="col-lg-6 clinic-reservation-section">
                                        <h4>Clinic Appointment Details</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="clinic">Clinic</label>
                                                    <select class="form-control" id="clinic">
                                                        <option></option>
                                                        @foreach ($hospitals as $hospital)
                                                            <option value="{{$hospital->id}}">{{$hospital->hospital_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="dateOfProcedure">Foreseen Date</label>
                                                    <input type="text" class="form-control" id="dateOfProcedure" autocomplete="off" placeholder="Foreseen Date of Procedure" maxlength="10">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="typeofProcedure">Type of Medical Procedure</label>
                                                    <input type="text" class="form-control" id="typeofProcedure" placeholder="Type of Medical Procedure">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description_area">Description</label>
                                                    <textarea class="form-control" id="description_area">*Su asistente de atención clínica organizará un horario preciso de consulta, operación y control postoperatorio, además de la programación de recogida en su hotel, según sean los horarios de llegada y operación.</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 hotel-reservation-section">
                                            <div class="d-flex self-section">
                                                <h4>Hotel Reservation</h4>
                                                <label for="self-booking-hotel">Self Booking</label> <input type="checkbox" id="self-booking-hotel">
                                            </div>
                                            <hr style=" margin-top: 2px!important; ">
                                            <div class="row hotel-reservation-data">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="patientName">Patient Name:</label>
                                                        <input type="text" class="form-control" id="patientName" placeholder="Patient Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="hotel_voucher">Hotel</label>
                                                        <select class="form-control" id="hotel_voucher">
                                                            <option></option>
                                                            @foreach ($hotels as $hotel)
                                                                <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="roomType">Room Type</label>
                                                        <select class="form-control" name="roomType[]" id="roomType" multiple>
                                                            <option></option>
                                                            <option value="Single">Single</option>
                                                            <option value="Double">Double</option>
                                                            <option value="Triple">Triple</option>
                                                            <option value="Family">Family</option>
                                                            <option value="Twin">Twin</option>
                                                            <option value="Deluxe Sea View Single">Deluxe Sea View Single</option>
                                                            <option value="Deluxe Sea View Double">Deluxe Sea View Double</option>
                                                            <option value="Deluxe Sea View Triple">Deluxe Sea View Triple</option>
                                                            <option value="Deluxe City View Single">Deluxe City View Single</option>
                                                            <option value="Deluxe City View Double">Deluxe City View Double</option>
                                                            <option value="Deluxe City View Triple">Deluxe City View Triple</option>
                                                            <option value="Deluxe Sea View Twin">Deluxe Sea View Twin</option>
                                                            <option value="Deluxe City View Twin">Deluxe City View Twin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="hotel_category">Category:</label>
                                                        <select class="form-control" id="hotel_category">
                                                            <option></option>
                                                            <option value="BB (Bed & Breakfast)">BB (Bed & Breakfast)</option>
                                                            <option value="HF (Half Board)">HF (Half Board)</option>
                                                            <option value="FB (Full Board)">FB (Full Board)</option>
                                                            <option value="All inclusive">All inclusive</option>
                                                            <option value="Ultra all inclusive">Ultra all inclusive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="check-in">Check-in:</label>
                                                        <input type="text" class="form-control" id="check-in" autocomplete="off" placeholder="Check-in" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="check-out">Check-out:</label>
                                                        <input type="text" class="form-control" id="check-out" autocomplete="off" placeholder="Check-out" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="confirmation-number">Confirmation Number:</label>
                                                        <input type="text" class="form-control" id="confirmation-number" autocomplete="off" placeholder="Confirmation Number" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="calculateDate">Calculate Nights:</label>
                                                    <button class="btn btn-success float-right" id="calculateDate">Calculate</button>
                                                </div>
                                            </div>
                                            <div class="row hotel-reservation-data-fix" style="display: none">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="hotelname">Hotel Name:</label>
                                                        <input type="text" class="form-control" id="hotelname" autocomplete="off" placeholder="Hotel Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 transfer-reservation-section">
                                            <div class="d-flex self-section">
                                                <h4>Transportation Details</h4>
                                                <label for="self-transfer">Self Transfer</label> <input type="checkbox" id="self-transfer">
                                            </div>
                                            <hr >
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalDate">Arrival Date</label>
                                                        <input type="text" class="form-control" id="arrivalDate" placeholder="Arrival Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="departureDate">Departure Date</label>
                                                        <input type="text" class="form-control" id="departureDate" autocomplete="off" placeholder="Departure Date" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalTime">Arrival Time</label>
                                                        <input type="text" class="form-control" onkeypress="timeFormat(this);" id="arrivalTime" autocomplete="off" placeholder="Arrival Time" maxlength="5">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="departureTime">Departure Time</label>
                                                        <input type="text" class="form-control" onkeypress="timeFormat(this);" id="departureTime" autocomplete="off" placeholder="Departure Time" maxlength="5">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="flightNumber">Flight Number</label>
                                                        <input type="text" class="form-control" id="flightNumber" autocomplete="off" placeholder="Flight Number" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pickupTime">**Pick Up Time</label>
                                                        <input type="text" class="form-control"  id="pickupTime" autocomplete="off" placeholder="Pick Up Time">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalAirport">Arrival Airport</label>
                                                        <input type="text" class="form-control" id="arrivalAirportVoucher" autocomplete="off" placeholder="Arrival Airport" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="airport">Departure Airport</label>
                                                        <input type="text" class="form-control" id="departureAirportVoucher" autocomplete="off" placeholder="Departure Airport" maxlength="10">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="contactPerson">Contact Person</label>
                                                        <select class="form-control" name="contactPerson[]" id="contactPerson" multiple>
                                                            @foreach ($sales as $sale)
                                                                <option value="{{$sale->phone_number}}">{{$sale->name_surname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="airportCode">Airport Code</label>
                                                        <select class="form-control" id="airportCode">
                                                            <option></option>
                                                            <option value="IST">IST</option>
                                                            <option value="SAW">SAW</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 transfer-reservation-section">
                                            <h4>Payment Details</h4>
                                            <hr style="margin-top: 18px!important;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="paymentDetail_one">Payment Detail</label>
                                                        <textarea class="form-control" id="paymentDetail_one">El paquete incluye la intervención [FUE],el alojamiento [3 noches],y todos los traslados entre hotel-clínica y aeropuerto.</textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="importantNotes">Notas importantes</label>
                                                        <textarea class="form-control" id="importantNotes">*After having passed through passport checkpoint and baggage claim, you will proceed to the Exit door, where people wait while holding up signs with names written on them. At [Istanbul Airport]: you will be greeted by our driver just outside, at [door 14], holding a board with [D10].</textarea>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="TotalPackageVal">Total Package Rate:</label>
                                                        <input type="text" class="form-control" id="TotalPackageVal">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="PrePaymentReceived">Pre-payment Received:</label>
                                                        <input type="text" class="form-control" id="PrePaymentReceived">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="ClinicBalanceCurrency">Currency:</label>
                                                        <select class="form-control" id="ClinicBalanceCurrency">
                                                            <option></option>
                                                            <option value="€">Euro</option>
                                                            <option value="$">Dollar</option>
                                                            <option value="£">Pound</option>
                                                            <option value="₺">TL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="dhi-supplement">DHI supplement:</label>
                                                        <input type="checkbox" class="form-checkbox form-check" id="dhi-supplement">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="calculateDate">Calculate Balance In The Clinic:</label>
                                                    <button class="btn btn-success float-right" id="calculateTotalPackageRate">Calculate</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style=" margin-top: 50px;">
                                                    <button class="btn btn-primary float-right" id="saveVoucher">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="root">
                                        <div class="card" style="background-image:url(/images/background-voucher.png);background-repeat: round; background-size: cover;">
                                            <div class="card-body">
                                                <div class="container" >
                                                    <div class="main voucher-section">
                                                        <div class="row">
                                                            <div class="col-lg-6" id="voucher-logo"></div>
                                                            <div class="col-lg-6">
                                                                <img src="/images/hotelistan-logo.svg" class="voucher-logo" style="float:right;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="data-name" style="border-bottom: 1px solid black;">Dirección: Merkez Mah. Abide-i Hürriye Cad. No: 171/8 Aykaç Apt. Kat:2 Şişli/İSTANBUL - TURKEY</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETALLES DE LA CITA MÉDICA</h5></div>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top: 2px; padding-bottom: 2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px" class="data-name">Nombre de la clínica, Dirección: </p>
                                                                </div>
                                                                <div class="col-lg-7" style="margin-bottom:0px" id="clinicText"></div>
                                                                <div class="col-lg-2" style="margin-bottom:0px" id="clinicImage"></div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px" class="data-name">Tipo de intervención médica: </p>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <p  class="data-desc" style=" margin-bottom: 0; " id="treatmentDetail"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-4">
                                                                    <p style="margin-bottom:0px" class="data-name">*Fecha prevista de la intervención: </p>
                                                                </div>
                                                                <div class="col-lg-7" id="dateOfProcedureText" style="margin-bottom:0px">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p style="font-size: 9px; font-family: inherit" id="description_text">*Su asistente de atención clínica organizará un horario preciso de consulta, operación y control postoperatorio, además de la programación de recogida en su hotel, según sean los horarios de llegada y operación.</p>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">RESERVA DE HOTEL <span id="type-note"></span></h5></div>
                                                            </div>
                                                        </div>

                                                        <div class="test">
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Hotel: </p>
                                                                </div>
                                                                <div class="col-lg-7" id="hotelText">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px"></p>
                                                                    <p id="hotelnametext" style="margin-bottom:0px"></p>
                                                                </div>
                                                                <div class="col-lg-2" id="hotelImage"></div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p  style="margin-bottom:0px" class="data-name">Nombre: </p>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="passengerName"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">*Check-in: </p>
                                                                </div>
                                                                <div class="col-lg-3" id="checkinDate"></div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Tipo de habitación:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="roomTypeText"></div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">**Check-out: </p>
                                                                </div>
                                                                <div class="col-lg-3" id="checkoutDate"></div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Noches:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="nightResult" style="margin-bottom:0px"></div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Número de confirmación: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="confirmationNumberText"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Categoría:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="hotelCategoryText" style="margin-bottom:0px"></div>
                                                            </div>
                                                        </div>

                                                        <div class="row hotel-voucher-note">
                                                            <div class="col-lg-12">
                                                                <span class="important-note"><b style="color: #81b9d8; font-size: 10px;">Notas importantes</b></span>
                                                                <p style="font-size: 9px; font-family: inherit" class="important-desc-1">*En caso de efectuar el check-in antes de las 14:00, dependiendo de la disponibilidad de las habitaciones libres, puede que tenga que esperar hasta que la habitación quede disponible.</span><br><span>**La hora de check-out son las 12 del mediodía.</span></p>
                                                                <p style="font-size: 9px; font-family: inherit" class="important-desc-2"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETALLE DE VUELOS Y TRASLADOS <span id="self-transfer"></span></h5></div>
                                                            </div>
                                                        </div>
                                                        <div class="row transfer-voucher" style="margin-top:2px;">
                                                            <div class="col-lg-3">
                                                                <p class="data-name" style="background: #b3916e; width: fit-content; padding: 10px; border-radius: 6px; color: #fff;margin-bottom: 0px; margin-top: 4px;">LLEGADA </p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px"></p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-name" style="background: #b3916e; width: fit-content; padding: 10px; border-radius: 6px; color: #fff;margin-bottom: 0px; margin-top: 4px;">SALIDA</p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px"></p>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Fecha de llegada: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalDateText"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Fecha de salida: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureDateText"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Hora de llegada: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalTimeText"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Horario de salida: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureTimeText"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Número de vuelo: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="flightNumberText"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">** Horario de recogida en hotel: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="pickUpTimeText"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">*Aeropuerto: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalAirportText"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Aeropuerto: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureAirportText"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row transfer-voucher">
                                                            <div class="col-lg-10">
                                                                <span><b style="color: #81b9d8; font-size: 10px;">Notas importantes</b></span>
                                                                <p style="font-size: 9px; font-family: inherit" id="importantNotesText"></p>
                                                                <p style="font-size: 9px; font-family: inherit"><span>** Acorde con su horario en la clínica, se le informará sobre el momento exacto para la recogida en el hotel.</span><br><span>*** Para cumplir con la legislación del gobierno sobre los traslados de pacientes en suelo turco, debe proporcionar la información de identificación personal de aquellas personas que utilizarán los servicios de transporte junto con usted, antes de su llegada a Estambul.</span></p>
                                                            </div>
                                                            <div class="col-lg-2" id="airportImage">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETALLES DEL PAGO</h5></div>
                                                            </div>
                                                        </div>

                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Tarifa Total del Paquete: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-desc" id="TotalPackageRateVal"></span>
                                                                    <span class="data-desc" id="TotalPackageRateCurrencyText"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Pago por adelantado recibido: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-desc" id="PrePaymentReceivedVal"></span>
                                                                    <span class="data-desc" id="PrePaymentReceivedCurrencyText"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Importe a pagar en clínica: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-name" id="ClinicBalanceVal"></span>
                                                                    <span class="data-name" id="ClinicBalanceCurrencyText"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="data-desc" style=" margin-bottom: 0;" style="margin-top: 12px;" id="paymentDetail_oneText">El paquete incluye la intervención [FUE],el alojamiento [3 noches],y todos los traslados entre hotel-clínica y aeropuerto.</p>
                                                            </div>
                                                            <div class="col-lg-12 dhi-supplement-section" style="display: none">
                                                                <p class="data-desc" style="margin-bottom: 0;" style="margin-top: 12px;" id="paymentDetail_oneText">En el caso de utilizar la técnica DHI se aplicará un suplemento de 600€.</p>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <p class="data-desc" style=" margin-bottom: 0;"><span>*El importe especificado es válido para pagos en efectivo. Tenga en cuenta que para los pagos realizados con tarjeta de crédito o débito, se cobrará un cargo por servicio del 5% para tarjetas Visa y Master Card, y del 8% para American Express. </span><br><span>*Tenga en cuenta que American Express solo acepta pagos realizados en liras turcas (TRY)</b></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETALLES DE CONTACTO</h5></div>
                                                            </div>
                                                        </div>

                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="padding-bottom:2px;border-bottom #00000040 solid 1px;">
                                                                <div class="col-lg-6" >
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid" id="contactPersonName"> </p>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="data-name" style="margin-bottom:0px" id="contactPersonPhone"> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p style="text-align:center; color:red; font-size:10px; font-weight:bold;margin-bottom:0px;">En caso de cancelación, debe informarnos mediante una nota escrita mínimo 48 horas antes de su hora de llegada a Estambul.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>



    @include("layouts.active_users_modal")

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


</body>
</html>
