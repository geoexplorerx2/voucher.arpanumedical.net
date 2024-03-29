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
                            <div class="col-sm-4">
                                <button class="btn btn-primary" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="m-0 text-dark text-center">Edit Reservation Voucher</h3>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary float-right" onclick="voucherPdf();">Download PDF <i class="fa fa-download"></i></button>
                                <div class="dropdown float-right">
                                    <button class="btn btn-success dropdown-toggle action-btn" type="button" data-toggle="dropdown">Language</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('voucher.edit', ['id'=> $voucher->id])}}">English</a></li>
                                        <li><a href="{{route('voucher_es.edit', ['id'=> $voucher->id])}}">Spanish</a></li>
                                        <li><a href="{{route('voucher_it.edit', ['id'=> $voucher->id])}}">Italian</a></li>
                                    </ul>
                                </div>
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
                                        <input type="hidden" id="voucher_id" value="{{ $voucher->id }}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="clinic">Clinic</label>
                                                    <select class="form-control" id="clinic">
                                                        <option value="{{$voucher->hospital_id}}" selected>{{$voucher->hospital->hospital_name}}</option>
                                                        @foreach ($hospitals as $hospital)
                                                            <option value="{{$hospital->id}}">{{$hospital->hospital_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="dateOfProcedure">Foreseen Date</label>
                                                    <input type="text" class="form-control" id="dateOfProcedure" autocomplete="off" placeholder="Foreseen Date of Procedure" maxlength="10" value="{{ $voucher->foreseen_date}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="typeofProcedure">Type of Medical Procedure</label>
                                                    <input type="text" class="form-control" id="typeofProcedure" placeholder="Type of Medical Procedure" value="{{ $voucher->medical_type }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description_area">Description</label>
                                                    <textarea class="form-control" id="description_area" rows="7">{{$voucher->desc}}</textarea>
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
                                                        <input type="text" class="form-control" id="patientName" placeholder="Patient Name" value="{{ $voucher->patient_name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="hotel_voucher">Hotel</label>
                                                        <select class="form-control" id="hotel_voucher">
                                                            <option value="{{ $voucher->hotel_id }}" selected>{{ $voucher->hotel->hotel_name }}</option>
                                                            @foreach ($hotels as $hotel)
                                                                <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="roomType">Room Type</label>
                                                        <select class="form-control" id="roomType" name="roomType[]" multiple>
                                                            @php
                                                                $roomtypes = explode(' - ', $voucher->room_type);
                                                            @endphp
                                                            @foreach ($roomtypes as $roomtype)
                                                                <option value="{{$roomtype}}" selected>{{$roomtype}}</option>
                                                            @endforeach
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
                                                            <option value="{{$voucher->category}}">{{$voucher->category}}</option>
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
                                                        <input type="text" class="form-control" id="check-in" autocomplete="off" placeholder="Check-in" maxlength="10" value="{{ $voucher->hotel_checkin }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="check-out">Check-out:</label>
                                                        <input type="text" class="form-control" id="check-out" autocomplete="off" placeholder="Check-out" maxlength="10" value="{{ $voucher->hotel_checkout }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="confirmation-number">Confirmation Number:</label>
                                                        <input type="text" class="form-control" id="confirmation-number" autocomplete="off" placeholder="Confirmation Number" maxlength="10" value="{{ $voucher->confirmation_num }}">
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
                                                        <input type="text" class="form-control" id="arrivalDate" autocomplete="off" placeholder="Arrival Date" maxlength="10" value="{{ $voucher->arrival_date }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="departureDate">Departure Date</label>
                                                        <input type="text" class="form-control" id="departureDate" autocomplete="off" placeholder="Departure Date" maxlength="10" value="{{ $voucher->departure_date }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalTime">Arrival Time</label>
                                                        <input type="text" class="form-control" onkeypress="timeFormat(this);" id="arrivalTime" autocomplete="off" placeholder="Arrival Time" maxlength="5" value="{{ $voucher->arrival_time }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="departureTime">Departure Time</label>
                                                        <input type="text" class="form-control" onkeypress="timeFormat(this);" id="departureTime" autocomplete="off" placeholder="Departure Time" maxlength="5" value="{{ $voucher->departure_time }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="flightNumber">Flight Number</label>
                                                        <input type="text" class="form-control" id="flightNumber" autocomplete="off" placeholder="Flight Number" maxlength="10" value="{{ $voucher->flight_number }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pickupTime">**Pick Up Time</label>
                                                        <input type="text" class="form-control"  id="pickupTime" autocomplete="off" placeholder="Pick Up Time" value="{{ $voucher->pickup_time }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalAirport">Arrival Airport</label>
                                                        <input type="text" class="form-control" id="arrivalAirportVoucher" autocomplete="off" placeholder="Arrival Airport" maxlength="10" value="{{ $voucher->arrival_airport }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="airport">Departure Airport</label>
                                                        <input type="text" class="form-control" id="departureAirportVoucher" autocomplete="off" placeholder="Departure Airport" maxlength="10" value="{{ $voucher->departure_airport }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="contactPerson">Contact Person</label>
                                                        <select class="form-control" name="contactPerson[]" id="contactPerson" multiple>
                                                            @foreach ($contactPersons as $contactPerson)
                                                                <option value="{{ $contactPerson->phone_number }}" selected>{{ $contactPerson->name_surname }}</option>
                                                            @endforeach
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
                                                            <option value="{{$voucher->airport_code}}" selected>{{$voucher->airport_code}}</option>
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
                                                        <textarea class="form-control" id="paymentDetail_one" rows="4">{{$voucher->payment_detail}}</textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="importantNotes">NOTE IMPORTANTI</label>
                                                        <textarea class="form-control" id="importantNotes">{{$voucher->important_note}}</textarea>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="TotalPackageVal">Total Package Rate:</label>
                                                        <input type="text" class="form-control" id="TotalPackageVal" value="{{$voucher->total_package}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="PrePaymentReceived">Pre-payment Received:</label>
                                                        <input type="text" class="form-control" id="PrePaymentReceived" value="{{$voucher->prepayment_received}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="ClinicBalanceCurrency">Currency:</label>
                                                        <select class="form-control" id="ClinicBalanceCurrency">
                                                            <option value="{{$voucher->currency}}" selected>{{$voucher->currency}}</option>
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
                                                        <input type="checkbox" class="form-checkbox form-check" id="dhi-supplement" {{ $voucher->dhi_supplement == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="calculateDate">Calculate Balance In The Clinic:</label>
                                                    <button class="btn btn-success float-right" id="calculateTotalPackageRate">Calculate</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style=" margin-top: 50px;">
                                                    <button class="btn btn-primary float-right" id="updateVoucher">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="root">
                                        <div class="card" style="background-image:url(/images/background-voucher.png);background-repeat: round; background-size: cover;">
                                            <div class="card-body" style=" padding-bottom: 0; ">
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
                                                                <p class="data-name" style="border-bottom: 1px solid black;">Indirizzo: Merkez Mah. Abide-i Hürriye Cad. No: 171/8 Aykaç Apt. Kat:2 Şişli/İSTANBUL - TURKEY</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">CLINIC APPOINTMENT DETAILS</h5></div>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top: 2px; padding-bottom: 2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px" class="data-name">Nome della clinica, Indirizzo: </p>
                                                                </div>
                                                                <div class="col-lg-7" style="margin-bottom:0px" id="clinicText">
                                                                    <p class="data-desc" style="margin-bottom:0px;">{{$voucher->hospital->hospital_name}}</p>
                                                                </div>
                                                                <div class="col-lg-2" style="margin-bottom:0px" id="clinicImage">{!! $voucher->hospital_img !!}</div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px" class="data-name">Tipo di trattamento medico: </p>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <p class="data-desc" style=" margin-bottom: 0;" id="treatmentDetail">{{$voucher->medical_type}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px; padding-bottom: 2px;">
                                                                <div class="col-lg-4">
                                                                    <p style="margin-bottom:0px" class="data-name">*Data prevista della procedura </p>
                                                                </div>
                                                                <div class="col-lg-7" id="dateOfProcedureText" style="margin-bottom:0px">
                                                                    <p class="data-desc" style="margin-bottom:0px;">{{$voucher->foreseen_date}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p style="font-size: 9px; font-family: inherit" id="description_text">{{$voucher->desc}}</p>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text">
                                                                    <h5 style="margin-bottom:0px">DETTAGLI DELLA PRENOTAZIONE IN HOTEL <span id="type-note"></span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Hotel: </p>
                                                                </div>
                                                                <div class="col-lg-7" id="hotelText">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px">{{$voucher->hotel->hotel_name}}</p>
                                                                    <p id="hotelnametext" style="margin-bottom:0px"></p>
                                                                </div>
                                                                <div class="col-lg-2" id="hotelImage">{!! $voucher->hotel_img !!}</div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p  style="margin-bottom:0px" class="data-name">Nome/i: </p>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="passengerName">{{$voucher->patient_name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">*Check-in: </p>
                                                                </div>
                                                                <div class="col-lg-3" id="checkinDate">
                                                                    <p style="margin-bottom:0px"  class="data-desc">{{$voucher->hotel_checkin}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Tipo di Camera:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="roomTypeText">
                                                                    <p style="margin-bottom:0px"  class="data-desc">{{$voucher->room_type}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px" class="data-name">**Check-out: </p>
                                                                </div>
                                                                <div class="col-lg-3" id="checkoutDate">
                                                                    <p style="margin-bottom:0px" class="data-desc">{{$voucher->hotel_checkout}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Notti:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="nightResult" style="margin-bottom:0px"><p style="margin-bottom:0px"  class="data-desc">{{$voucher->nights}}</p></div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Numero di Conferma: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="confirmationNumberText">{{$voucher->confirmation_num}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p style="margin-bottom:0px"  class="data-name">Categoria:</p>
                                                                </div>
                                                                <div class="col-lg-3" id="hotelCategoryText" style="margin-bottom:0px">
                                                                    <p style="margin-bottom:0px"  class="data-desc">{{$voucher->category}}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row hotel-voucher-note">
                                                            <div class="col-lg-12">
                                                                <b style="color: #81b9d8; font-size: 10px;" class="important-note">NOTE IMPORTANTI</b>
                                                                <p style="font-size: 9px; font-family: inherit" class="important-desc-1">*Per effettuare il check-in prima delle 15:00, potrebbe essere necessario attendere brevemente in base alla disponibilità delle camere libere.</span><br><span>** Il check-out dev 'essere entro le ore 12 :00.</span></p>
                                                                <p style="font-size: 9px; font-family: inherit" class="important-desc-2"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETTAGLI DEI TRASPORTI <span id="self-transfer"></span></h5></div>
                                                            </div>
                                                        </div>
                                                        <div class="row transfer-voucher" style="margin-top:2px;">
                                                            <div class="col-lg-3">
                                                                <p class="data-name" style="background: #b3916e; width: fit-content; padding: 6px; border-radius: 6px; color: #fff;margin-bottom: 0px; margin-top: 4px;">ARRIVO </p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px"></p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-name" style="background: #b3916e; width: fit-content; padding: 6px; border-radius: 6px; color: #fff;margin-bottom: 0px; margin-top: 4px;">PARTENZA</p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px"></p>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Data di arrivo: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalDateText">{{$voucher->arrival_date}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Data di partenza: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureDateText">{{$voucher->departure_date}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Orario di arrivo: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalTimeText">{{$voucher->arrival_time}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Orario di partenza: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureTimeText">{{$voucher->departure_time}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Numero di volo: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="flightNumberText">{{$voucher->flight_number}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">**Orario di Pick-up: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="pickUpTimeText">{{$voucher->pickup_time}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="margin-top:2px; padding-bottom:2px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">*Aeroporto: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="arrivalAirportText">{{$voucher->arrival_airport}}</p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px">Aeroporto: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <p class="data-desc" style=" margin-bottom: 0; " style="margin-bottom:0px" id="departureAirportText">{{$voucher->departure_airport}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row transfer-voucher">
                                                            <div class="col-lg-10">
                                                                <b style="color: #81b9d8; font-size: 10px;">NOTE IMPORTANTI</b>
                                                                <p style="font-size: 9px; font-family: inherit" id="important-note-airport"><span style="font-size: 9px;font-weight:700" id="importantNotesText">{{$voucher->important_note}}</span><br><span>** In base al tuo programma presso la clinica, il tuo assistente ti fornirà gli orari precisi dei tuoi pick-up giorno per giorno.</span><br><span>*** Secondo le politiche governative turche riguardanti i traporti, ti chiediamo di fornire un documento di identità tuo e di chiunque viaggi con te, prima del tuo arrivo in Turchia.</span></p>
                                                            </div>
                                                            <div class="col-lg-2" id="airportImage">{!! $voucher->code_img !!}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="head-text"><h5 style="margin-bottom:0px">DETTAGLI DI PAGAMENTO</h5></div>
                                                            </div>
                                                        </div>

                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Prezzo Totale: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-desc" id="TotalPackageRateVal">{{$voucher->total_package}}</span>
                                                                    <span class="data-desc" id="TotalPackageRateCurrencyText">{{$voucher->currency}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher" style="border-bottom: #00000040 solid 1px;">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Deposito ricevuto: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-desc" id="PrePaymentReceivedVal">{{$voucher->prepayment_received}}</span>
                                                                    <span class="data-desc" id="PrePaymentReceivedCurrencyText">{{$voucher->currency}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row transfer-voucher">
                                                                <div class="col-lg-3">
                                                                    <p class="data-name" style="margin-bottom:0px;border-right: 1px #00000040  solid">Saldo in clinica: </p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span class="data-name" id="ClinicBalanceVal">{{$voucher->clinic_balance}}</span>
                                                                    <span class="data-name" id="ClinicBalanceCurrencyText"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="data-desc" style=" margin-bottom: 0;" style="margin-top: 12px;" id="paymentDetail_oneText">{{$voucher->payment_detail}}</p>
                                                            </div>
                                                            <div class="col-lg-12 dhi-supplement-section" {{ $voucher->dhi_supplement != 1 ? 'style=display:none' : '' }}>
                                                                <p class="data-desc" style="margin-bottom: 0;" style="margin-top: 12px;" id="paymentDetail_oneText">Nel caso in cui venga applicata la tecnica DHI, è previsto un supplemento di 600 €.</p>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <p class="data-desc" style=" margin-bottom: 0;"><span>*Il prezzo indicato è valido per i pagamenti in contanti. Si ricorda che per i pagamenti effettuati con carta di credito, sarà applicato un supplemento del 5% per Visa e Mastercard, e dell'8% per AmEx come costo di servizio.</span><br><span>* Nel caso di pagamento con AmEx, la transazione può essere effettuata solo in Lire Turche (TRY), utilizzando il tasso di cambio giornaliero stabilito dalla Banca Centrale Turca.</b></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="head-text">
                                                                    <h5 style="margin-bottom:0px">DETTAGLI DEI CONTATTI DI EMERGENZA</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="test">
                                                            <div class="row transfer-voucher" style="padding-bottom:2px;">
                                                                <div class="col-lg-12" >
                                                                    <p class="data-name" style="margin-bottom:0px;" id="contactPersonName">
                                                                        @foreach ($contactPersons as $contactPerson)
                                                                            {{ $contactPerson->name_surname }} - {{ $contactPerson->phone_number }}@if (!$loop->last) / @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p style="text-align:center; color:red; font-size:10px; font-weight:bold;margin-bottom:0px;">In caso di cancellazione, è necessario informarci per iscritto almeno 48 ore prima dell'orario previsto di arrivo.</p>
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
    <script type="text/javascript" src="{{ asset('assets/js/popover.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.datatable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-steps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gijgo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}" defer></script>
</body>
</html>
