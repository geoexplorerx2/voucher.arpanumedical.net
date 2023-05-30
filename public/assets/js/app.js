var dataTable;
var select2Init = function() { };

var dataTableInit = function() {
    dataTable = $('#dataTable').dataTable({
        "columnDefs": [{
                "targets": 1,
                "type": 'num',
            },
            {
                "targets": 2,
                "type": 'num',
            }
        ],
    });
};

dtSearchAction = function(selector, columnId) {
    var fv = selector.val();
    if ((fv == '') || (fv == null)) {
        dataTable.api().column(columnId).search('', true, false).draw();
    } else {
        dataTable.api().column(columnId).search(fv, true, false).draw();
    }
};

var app = (function() {

    $(document).ready(function() {
        select2Init();
        dataTableInit();
        selectedValues();
        clockPickers();

        $('[data-toggle="popover"]').ggpopover();

        $('.navbar-nav li a').on('click', function () {
            $(this).parent().toggleClass('active');
        });

        $("#preloader-active").hide(1000);
        $("#mainnav .child-nav > a").on('click', function () {
            $(this).toggleClass("active");
            $(".submenu").toggleClass("in");
            return false;
        });

        $('#dhi-supplement').change(function(){
            if ($(this).is(':checked')) {
                $(".dhi-supplement-section").show(300);
            }
            else {
                $(".dhi-supplement-section").hide(300);
            }
        });

        var pageurl = window.location.href;
        $(".nav-item_sub li a").each(function(){
            if ($(this).attr("href") == pageurl || $(this).attr("href") == '')
            $(this).addClass("active");
        });

        $(".nav-item_sub li a").each(function(){
            if ($(this).attr("href") == pageurl || $(this).attr("href") == '')
            $(this).parents(':eq(2)').addClass("active");
        });

        $('.input-container input').on('change', function() {
            if ($(this).val() == 'yes') {
                var nameInput = $(this).attr("name");
                var inputElement = '<div class="font-weight-700 mt-2 form-note"><label class="form-note-label" for='+nameInput+' >Note</label><textarea class="form-control" name='+nameInput+' placeholder="Enter Note" rows="3" cols="50"></textarea></div>';
                $(this).closest('.input-container').append(inputElement).hide().slideDown(800);
                // $(this).removeAttr("name");
            }
            else {
                $(this).closest('.input-container').find('.form-note').hide('slow', function(){ $(this).remove(); });
            }
        });
    });

    $.ajax({
        url: '/getCurrencies',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response) {
                $.each(response, function(key, value) {
                    $("#currenciesSection").append("<span class='currencyText'>" + value[0] + "</span>");
                });
            }
        },
        error: function() {
            console.log();
        },
    });

    saveVoucher();
    updateVoucher();
});

var Layout = (function() {

    function pinSidenav() {
        $('.sidenav-toggler').addClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-unpin');
        $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
        $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $('#sidenav-main').data('target') + ' />');
    }

    function unpinSidenav() {
        $('.sidenav-toggler').removeClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-pin');
        $('body').removeClass('g-sidenav-pinned').addClass('g-sidenav-hidden');
        $('body').find('.backdrop').remove();
    }

    $(document).ready(function(){
        $("#tableData").dataTable({ paging: true, pageLength: 25 });
    });

    if ($(window).width() < 1200) {
        $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
        $('body').removeClass('g-sidenav-show');
        $(window).resize(function() {
            if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    $("body").on("click", "[data-action]", function(e) {

        e.preventDefault();

        var $this = $(this);
        var action = $this.data('action');
        var target = $this.data('target');

        switch (action) {
            case 'sidenav-pin':
                pinSidenav();
                break;

            case 'sidenav-unpin':
                unpinSidenav();
                break;

            case 'search-show':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-showing');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-showing').addClass('g-navbar-search-show');
                }, 150);

                setTimeout(function() {
                    $('body').addClass('g-navbar-search-shown');
                }, 300)
                break;

            case 'search-close':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-shown');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-hiding');
                }, 150);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hiding').addClass('g-navbar-search-hidden');
                }, 300);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hidden');
                }, 500);
            break;
        }
    });

    $('.sidenav').on('mouseenter', function() {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-hide').removeClass('g-sidenav-hidden').addClass('g-sidenav-show');
        }
    });

    $('.sidenav').on('mouseleave', function() {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hide');

            setTimeout(function() {
                $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
            }, 300);
        }
    });

    var userFormat = "DD.MM.YYYY";

    $('#arrivalDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(0, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('#dateOfProcedure').daterangepicker({
        "autoApply": false,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
    });

    $('#check-in').daterangepicker({
        "autoApply": false,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
    });

    $('#check-out').daterangepicker({
        "autoApply": false,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
    });

    $('#operationDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(1, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('#departureDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(0, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('[data-toggle="popover"]').ggpopover();

    $(window).on('load resize', function() {
        if ($('body').height() < 800) {
            $('body').css('min-height', '100vh');
            $('#footer-main').addClass('footer-auto-bottom')
        }
    });
})();

function previousPage() {
    history.go(-1);
}

function saveVoucher(){
    try {
        $("#saveVoucher").on("click", function(){
                setTimeout(() => {
                    // Get the img element by its id
                    var hotelimg = document.getElementById('hotel_img');
                    var hospitalimg = document.getElementById('clinic_img');
                    var codeimg = document.getElementById('code_img');

                    // Access the src attribute to get the source content
                    var hotel_img = hotelimg.outerHTML;
                    var hospital_img = hospitalimg.outerHTML;
                    var code_img = codeimg.outerHTML;
                    var clinic              = $('#clinic').children("option:selected").val(),
                        foreseen_date       = $('#dateOfProcedure').val(),
                        medical_type        = $('#typeofProcedure').val(),
                        desc                = $('#description_area').val(),
                        patient_name        = $('#patientName').val(),
                        hotel_name          = $('#hotel_voucher').children("option:selected").val(),
                        room_type           = $('#roomType').children("option:selected").val(),
                        category            = $('#hotel_category').children("option:selected").val(),
                        hotel_checkin       = $('#check-in').val(),
                        hotel_checkout      = $('#check-out').val(),
                        confirmatiom_num    = $('#confirmation-number').val(),
                        nights              = $('#nightResult').text(),
                        arrival_date        = $('#arrivalDate').val(),
                        departure_date      = $('#departureDate').val(),
                        arrival_time        = $('#arrivalTime').val(),
                        departure_time      = $('#departureTime').val(),
                        pickup_time         = $('#pickupTime').val(),
                        flight_number       = $('#flightNumber').val(),
                        arrival_airport     = $('#arrivalAirportVoucher').val(),
                        departure_airport   = $('#departureAirportVoucher').val(),
                        airport_code        = $('#airportCode').children("option:selected").val(),
                        contact_person      = $('#contactPerson').children("option:selected").val(),
                        payment_detail      = $('#paymentDetail_one').val(),
                        important_note      = $('#importantNotes').val(),
                        clinic_balance      = $('#ClinicBalanceVal').text(),
                        prepayment_received = $('#PrePaymentReceived').val(),
                        currency            = $('#ClinicBalanceCurrency').val(),
                        total_package       = $('#TotalPackageVal').val();

                        addVoucher(code_img, hotel_img, hospital_img, clinic, foreseen_date, medical_type, desc, patient_name, hotel_name, room_type, category, hotel_checkin, hotel_checkout, confirmatiom_num, nights, arrival_date, departure_date, arrival_time, departure_time, pickup_time, flight_number, arrival_airport, departure_airport, airport_code, contact_person, payment_detail, important_note, clinic_balance, prepayment_received, currency, total_package);
                }, 500);
        });
    }
    catch(error){ }
}

//send Voucher
function addVoucher(code_img, hotel_img, hospital_img, clinic, foreseen_date, medical_type, desc, patient_name, hotel_name, room_type, category, hotel_checkin, hotel_checkout, confirmatiom_num, nights, arrival_date, departure_date, arrival_time, departure_time, pickup_time, flight_number, arrival_airport, departure_airport, airport_code, contact_person, payment_detail, important_note, clinic_balance, prepayment_received, currency, total_package){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/vouchers/store',
            type: 'POST',
            data: {
                'clinic_name'           : clinic,
                'hospital_img'          : hospital_img,
                'foreseen_date'         : foreseen_date,
                'medical_type'          : medical_type,
                'desc'                  : desc,
                'patient_name'          : patient_name,
                'hotel_name'            : hotel_name,
                'hotel_img'             : hotel_img,
                'room_type'             : room_type,
                'category'              : category,
                'hotel_checkin'         : hotel_checkin,
                'hotel_checkout'        : hotel_checkout,
                'confirmatiom_num'      : confirmatiom_num,
                'nights'                : nights,
                'arrival_date'          : arrival_date,
                'departure_date'        : departure_date,
                'arrival_time'          : arrival_time,
                'departure_time'        : departure_time,
                'pickup_time'           : pickup_time,
                'flight_number'         : flight_number,
                'arrival_airport'       : arrival_airport,
                'departure_airport'     : departure_airport,
                'airport_code'          : airport_code,
                'code_img'              : code_img,
                'contact_person'        : contact_person,
                'payment_detail'        : payment_detail,
                'important_note'        : important_note,
                'clinic_balance'        : clinic_balance,
                'prepayment_received'   : prepayment_received,
                'currency'              : currency,
                'total_package'         : total_package,
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success', text: 'Voucher Added Successfully!'});
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    } finally { }
}

function updateVoucher(){
    try {
        $("#updateVoucher").on("click", function(){
                setTimeout(() => {
                    var hotelimg     = document.getElementById('hotel_img');
                    var hospitalimg  = document.getElementById('clinic_img');
                    var codeimg      = document.getElementById('code_img');
                    var hotel_img    = hotelimg.outerHTML;
                    var hospital_img = hospitalimg.outerHTML;
                    var code_img     = codeimg.outerHTML;

                    var clinic              = $('#clinic').children("option:selected").val(),
                        foreseen_date       = $('#dateOfProcedure').val(),
                        id                  = $('#voucher_id').val(),
                        medical_type        = $('#typeofProcedure').val(),
                        desc                = $('#description_area').val(),
                        patient_name        = $('#patientName').val(),
                        hotel_name          = $('#hotel_voucher').children("option:selected").val(),
                        room_type           = $('#roomType').children("option:selected").val(),
                        category            = $('#hotel_category').children("option:selected").val(),
                        hotel_checkin       = $('#check-in').val(),
                        hotel_checkout      = $('#check-out').val(),
                        confirmatiom_num    = $('#confirmation-number').val(),
                        nights              = $('#nightResult').text(),
                        arrival_date        = $('#arrivalDate').val(),
                        departure_date      = $('#departureDate').val(),
                        arrival_time        = $('#arrivalTime').val(),
                        departure_time      = $('#departureTime').val(),
                        pickup_time         = $('#pickupTime').val(),
                        flight_number       = $('#flightNumber').val(),
                        arrival_airport     = $('#arrivalAirportVoucher').val(),
                        departure_airport   = $('#departureAirportVoucher').val(),
                        airport_code        = $('#airportCode').children("option:selected").val(),
                        contact_person      = $('#contactPerson').children("option:selected").val(),
                        payment_detail      = $('#paymentDetail_one').val(),
                        important_note      = $('#importantNotes').val(),
                        clinic_balance      = $('#ClinicBalanceVal').text(),
                        prepayment_received = $('#PrePaymentReceived').val(),
                        currency            = $('#ClinicBalanceCurrency').val(),
                        total_package       = $('#TotalPackageVal').val();

                        saveUpdateVoucher(id, code_img, hotel_img, hospital_img, clinic, foreseen_date, medical_type, desc, patient_name, hotel_name, room_type, category, hotel_checkin, hotel_checkout, confirmatiom_num, nights, arrival_date, departure_date, arrival_time, departure_time, pickup_time, flight_number, arrival_airport, departure_airport, airport_code, contact_person, payment_detail, important_note, clinic_balance, prepayment_received, currency, total_package);
                }, 500);
        });
    }
    catch(error){ }
}

//Update Voucher
function saveUpdateVoucher(id, code_img, hotel_img, hospital_img, clinic, foreseen_date, medical_type, desc, patient_name, hotel_name, room_type, category, hotel_checkin, hotel_checkout, confirmatiom_num, nights, arrival_date, departure_date, arrival_time, departure_time, pickup_time, flight_number, arrival_airport, departure_airport, airport_code, contact_person, payment_detail, important_note, clinic_balance, prepayment_received, currency, total_package){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/vouchers/update/'+id,
            type: 'POST',
            data: {
                'clinic_name'           : clinic,
                'hospital_img'          : hospital_img,
                'foreseen_date'         : foreseen_date,
                'medical_type'          : medical_type,
                'desc'                  : desc,
                'patient_name'          : patient_name,
                'hotel_name'            : hotel_name,
                'hotel_img'             : hotel_img,
                'room_type'             : room_type,
                'category'              : category,
                'hotel_checkin'         : hotel_checkin,
                'hotel_checkout'        : hotel_checkout,
                'confirmatiom_num'      : confirmatiom_num,
                'nights'                : nights,
                'arrival_date'          : arrival_date,
                'departure_date'        : departure_date,
                'arrival_time'          : arrival_time,
                'departure_time'        : departure_time,
                'pickup_time'           : pickup_time,
                'flight_number'         : flight_number,
                'arrival_airport'       : arrival_airport,
                'departure_airport'     : departure_airport,
                'airport_code'          : airport_code,
                'code_img'              : code_img,
                'contact_person'        : contact_person,
                'payment_detail'        : payment_detail,
                'important_note'        : important_note,
                'clinic_balance'        : clinic_balance,
                'prepayment_received'   : prepayment_received,
                'currency'              : currency,
                'total_package'         : total_package,
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success', text: 'Voucher Updated Successfully!'});
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    } finally { }
}

$("#roomType").select2({placeholder: "Select Room Type", dropdownAutoWidth: true, allowClear: true});
$("#clinic").select2({placeholder: "Select Clinic", dropdownAutoWidth: true, allowClear: true});
$("#hotel_voucher").select2({placeholder: "Select Hotel", dropdownAutoWidth: true, allowClear: true});
$("#TotalPackageRateCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#PrePaymentReceivedCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#ClinicBalanceCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#hotel_category").select2({placeholder: "Select Category", dropdownAutoWidth: true, allowClear: true});
$("#contactPerson").select2({placeholder: "Select Contact Person", dropdownAutoWidth: true, allowClear: true});
$("#airportCode").select2({placeholder: "Select Airport Code", dropdownAutoWidth: true, allowClear: true});

function dayDifference(d0, d1) {
    try {
        var diff = new Date(+d1).setHours(12) - new Date(+d0).setHours(12);
        return Math.round(diff / 8.64e7);
    }
    catch (error) {
        console.info(error);
    }
    finally { }
}

function selectedValues() {
    try {

        $("#clinic").on("input", function () {
            let clinic = $(this).children("option:selected").text();
            let clinicVal = $(this).children("option:selected").val();
            $("#clinicText").html('<p class="data-desc" style="margin-bottom:0px;">' + clinic + '</p>');
            //Doku
            if (clinicVal == 1) {
                $("#clinicImage").html('<img src="/images/doku-logo.png" style="width: 68px; float: right;" id="clinic_img">');
            }
            //Dr Serkan
            if (clinicVal == 2) {
                $("#clinicImage").html('<img src="/images/drserkan-logo.svg" style="width: 130px; float: right;" id="clinic_img">');
                $("#treatmentDetail").text("Hair Transplantation, Dermatology Clinic");
                $("#typeofProcedure").val("Hair Transplantation, Dermatology Clinic");
            }
            //Koc Unı
            if (clinicVal == 3) {
                $("#clinicImage").html('<img src="/images/koc-universitesi-logo.png" style="width: 117px; float: right;" id="clinic_img">');
            }
            //Ceyhun Aydogan
            if (clinicVal == 24) {
                $("#clinicImage").html('<img src="/images/ceyhun-logo.png" style="width: 140px;float: right;" id="clinic_img">');
                $("#treatmentDetail").text("Bariatrics Surgery");
                $("#typeofProcedure").val("Bariatrics Surgery");
            }
        });

        $("#hotel_voucher").on("change", function () {
            let hotel = $(this).children("option:selected").text();
            let hotelVal = $(this).children("option:selected").val();
            $("#hotelText").html('<p style="font-size: 9px;margin-bottom:0px;">' + hotel + '</p>');
            //nova plaza
            if (hotelVal == 3) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            if (hotelVal == 4) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            if (hotelVal == 6) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            if (hotelVal == 7) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            if (hotelVal == 8) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            if (hotelVal == 329) $("#hotelImage").html('<img src="/images/nova-plaza-logo.png" style="width: 80px; float: right;" id="hotel_img">');
            //marriot
            if (hotelVal == 9) $("#hotelImage").html('<img src="/images/marriott-logo.png" style="width: 55px; float: right;" id="hotel_img">');
            if (hotelVal == 163) $("#hotelImage").html('<img src="/images/hilton-logo.png" style="width: 50px; float: right;" id="hotel_img">');
        });

        $("#airportCode").on("change", function () {
            let airportCode = $(this).children("option:selected").val();
            if (airportCode == "IST") $("#airportImage").html('<img src="/images/d10.png" style="width: 75px;margin-top: 25px;" id="code_img">');
            if (airportCode == "SAW") $("#airportImage").html('<img src="/images/3e.jpg" style="width: 75px;margin-top: 25px;"  id="code_img">');
        });

        $("#hotel_category").on("change", function () {
            let hotelCategoryVal = $(this).children("option:selected").val();
            $("#hotelCategoryText").html('<p class="data-desc" style="margin-bottom:0px;">' + hotelCategoryVal + '</p>');
        });

        $("#ClinicBalanceCurrency").on("change", function () {
            let TotalPackageRateCurrency = $(this).children("option:selected").val();
            $("#TotalPackageRateCurrencyText").html(' ' + TotalPackageRateCurrency);
        });

        $("#ClinicBalanceCurrency").on("change", function () {
            let PrePaymentReceivedCurrency = $(this).children("option:selected").val();
            $("#PrePaymentReceivedCurrencyText").html(' ' + PrePaymentReceivedCurrency);
        });

        $("#ClinicBalanceCurrency").on("change", function () {
            let ClinicBalanceCurrency = $(this).children("option:selected").val();
            $("#TotalPackageCurrencyText").html(' ' + ClinicBalanceCurrency);
        });

        $("#contactPerson").on("change", function () {
            let contactPersonVal = $(this).children("option:selected").text();
            let contactPersonPhone = $(this).children("option:selected").val();
            $("#contactPersonName").html( contactPersonVal);
            $("#contactPersonPhone").html( contactPersonPhone);
        });

        $("#patientName").on("input", function () {
            $("#passengerName").html( $(this).val());
        });

        $("#PrePaymentReceived").on("input", function () {
            $("#PrePaymentReceivedVal").html( $(this).val());

        });

        $("#TotalPackageVal").on("input", function () {
            $("#TotalPackageRateVal").html( $(this).val());
        });

        $("#dateOfProcedure").on("change", function(){
            $("#dateOfProcedureText").html('<p class="data-desc" style="margin-bottom:0px;">' + $(this).val() + '</p>');
        });

        $("#check-in").on("change", function(){
            $("#checkinDate").html('<p style="margin-bottom:0px;font-size: 9px; font-family: "Gotham Rounded Medium" font-weight: 100">' + $(this).val() + '</p>');
        });

        $("#check-out").on("change", function(){
            $("#checkoutDate").html('<p style="margin-bottom:0px;font-size: 9px; font-family: "Gotham Rounded Medium"; font-weight: 100;">' + $(this).val() + '</p>');
        });

        $("#calculateDate").on("click", function(){
            var checkIn = $("#check-in").val();
            var arrival = checkIn.split('.');
            var dbFormatDateArrival = (arrival[2] + "." + arrival[1] + "." + arrival[0]);
            var checkOut = $("#check-out").val();
            var departure = checkOut.split('.');
            var dbFormatDateDeparture = (departure[2] + "." + departure[1] + "." + departure[0]);
            [[new Date(dbFormatDateArrival), new Date(dbFormatDateDeparture)]].forEach(function (dates) {
                $("#nightResult").html('<p style="font-size: 9px; margin-bottom:0px;">' + dayDifference(dates[0], dates[1]) + '</p>');
            });
        });

        $("#calculateTotalPackageRate").on("click", function(){
            var PrePaymentReceived  = $("#PrePaymentReceived").val();
            var TotalPackageVal       = $("#TotalPackageVal").val();
            var currency            = $('#ClinicBalanceCurrency').val();
            var total               =  (parseInt(TotalPackageVal) - parseInt(PrePaymentReceived));
            $("#ClinicBalanceVal").html(total+' '+currency);
        });

        $("#description_area").on("input", function(){
            $("#description_text").text($(this).val());
        });

        $("#typeofProcedure").on("input", function(){
            $("#treatmentDetail").text($(this).val());
        });

        $("#paymentDetail_one").on("input", function(){
            $("#paymentDetail_oneText").text($(this).val());
        });

        $("#importantNotes").on("input", function(){
            $("#importantNotesText").text($(this).val());
        });

        $("#confirmation-number").on("input", function () {
            $("#confirmationNumberText").text($(this).val());
        });

        $("#arrivalDate").on("change", function () {
            $("#arrivalDateText").text($(this).val());
        });

        $("#arrivalTime").on("change", function () {
            $("#arrivalTimeText").text($(this).val());
        });

        $("#departureDate").on("change", function () {
            $("#departureDateText").text($(this).val());
        });

        $("#departureTime").on("change", function () {
            $("#departureTimeText").text($(this).val());
        });

        $("#pickupTime").on("change", function () {
            $("#pickUpTimeText").text($(this).val());
        });

        $("#flightNumber").on("input", function () {
            $("#flightNumberText").text($(this).val());
        });

        $("#arrivalAirportVoucher").on("input", function () {
            $("#arrivalAirportText").text($(this).val());
        });

        $("#departureAirportVoucher").on("input", function () {
            $("#departureAirportText").text($(this).val());
        });

        $("#roomType").on("change", function () {
            let roomType = $(this).children("option:selected").val();
            $("#roomTypeText").html('<p class="data-desc" style="margin-bottom:0px;">' + roomType + '</p>');
        });
    } catch (error) {
        console.info(error);
    } finally {

    }
}

function voucherPdf() {
    try {
        var elem = document.getElementById('root');
        let date_ob = new Date();
        let date = ("0" + date_ob.getDate()).slice(-2);
        let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        let year = date_ob.getFullYear();
        var now_date = (date + "." + month + "." + year);

        html2pdf().from(elem).set({
            margin: 0,
            filename: 'reservation-voucher-' + now_date + '.pdf',
            html2canvas: {
                scale: 2,
                y: 10
            },
            jsPDF: {
                orientation: 'portrait',
                unit: 'in',
                format: 'letter',
                compressPDF: true
            }
        }).save();
    } catch (error) {
        console.info(error);
    } finally {

    }
}

function clockPickers() {
    try {
        $('#arrivalTime').clockpicker({autoclose: true, donetext: 'Done', placement: 'left', align: 'top'});
        $('#departureTime').clockpicker({autoclose: true, donetext: 'Done', placement: 'left', align: 'top'});
        $('#pickupTime').clockpicker({autoclose: true, donetext: 'Done', placement: 'left', align: 'top'});
    }
    catch (error) {
        console.info(error);
    }
    finally { }
}