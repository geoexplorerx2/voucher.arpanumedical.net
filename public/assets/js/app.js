var serviceProviderId;
var hospitalId;
var patientId;
var agentId;
var treatment_plan_id;
var patient_global_id;
var arr = [];
var counte = [];
var colors = [];
var doctor_id =[];
var HIDDEN_URL = {
    HOME: '/home'
}

function getPatientId(){
    try {
        $('#dataTableBuilder tbody').on('click', 'td .create-registered-customer-reservation', function(){
            var selectedPatientId = this.id;
            var patientName = $(this).attr("data-name");
            $(".close").trigger("click");
            $(this).text("Selected");
            $(this).addClass("btn-danger");
            $("#next-step").trigger("click");
            $(".patientName").html('<i class="fa fa-user text-primary mr-2"></i>' + patientName);
            patient_global_id = selectedPatientId;
        });
    }
    catch(error){
        console.log(error);
    }
}
function getCustomerId(){
    try {
        $('#dataTableBuilder tbody').on('click', 'td .registered-customer-reservation', function(){
            var selectedPatientId = this.id;
            var patientName = $(this).attr("data-name");
            $(".close").trigger("click");
            $("#passengerName").html(patientName);
            customer_global_id = selectedPatientId;
        });
    }
    catch(error){
        console.log(error);
    }
}

function patientStep(){
    try {
        $('#savePatient').on('click', function(){
            var leadSourceId = $("#createPatient").find('#leadSourceId').children("option:selected").val();
            var name = $("#createPatient").find('#name').val();
            var phone = $("#createPatient").find('#phone').val();
            var age = $("#createPatient").find('#age').val();
            var note = $("#createPatient").find('#note').val();

            if (name == "" || leadSourceId == "" || phone == "" || age == ""){
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#next-step").trigger("click");
                $(".close").trigger("click");
                $(".patientName").text(name);
            }
        });
    }
    catch (error) {
        console.log(error);
    }
}

function treatmentPlanStep(){
    try {
        var frmInfo = $('#frmInfo');
        var frmInfoValidator = frmInfo.validate();

        var frmLogin = $('#frmLogin');
        var frmLoginValidator = frmLogin.validate();

        var frmMobile = $('#frmMobile');
        var frmMobileValidator = frmMobile.validate();

        $('#demo').steps({
            onChange: function (currentIndex, newIndex, stepDirection) {
                console.log('onChange', currentIndex, newIndex, stepDirection);
                // tab1
                if (currentIndex === 3) {
                    if (stepDirection === 'forward') {
                        var valid = frmLogin.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmLoginValidator.resetForm();
                    }
                }

                // tab2
                if (currentIndex === 1) {
                    if (stepDirection === 'forward') {
                        var valid = frmInfo.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmInfoValidator.resetForm();
                    }
                }

                // tab3
                if (currentIndex === 4) {
                    if (stepDirection === 'forward') {
                        var valid = frmMobile.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmMobileValidator.resetForm();
                    }
                }

                return true;
            },
            onFinish: function () {
                alert('Wizard Completed');
            }
        });

    }
    catch (error) {
        console.log(error);
    }
}

function dashboard() {
    try {
        setTimeout(() => {
            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                    labels: arr,
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: colors,
                        data: counte
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: ''
                    }
                }
            });
        }, 1000);

    }
    catch (error) {
        console.log(error);
    }
}

function treatmentPlanPdf() {
    try {
        var elem = document.getElementById('root');
        let date_ob = new Date();
        let date = ("0" + date_ob.getDate()).slice(-2);
        let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        let year = date_ob.getFullYear();
        var now_date = (date + "." + month + "." + year);
        var patient_name = $("#patient-name-pdf").text();

        let roomType = $("#roomType").children("option:selected").val();
        if (roomType == "") {
            swal({
                icon: 'error',
                title: 'Please fill in the blanks',
                text: ''
            });
        }
        else {
            html2pdf().from(elem).set({
                margin: 0,
                filename: patient_name+' Treatment Plan.pdf',
                html2canvas: {
                    scale: 2,
                    y: -2
                },
                jsPDF: {
                    orientation: 'portrait',
                    unit: 'in',
                    format: 'A4',
                    compressPDF: true
                }
            }).save();
        }
    } catch (error) {
        console.info(error);
    } finally {}
}

var dataTable;
var select2Init = function() {

    $("#filterTreatment").select2({ placeholder: "Select a Treatment", dropdownAutoWidth: true, allowClear: true });

    //bariatrics
    $("#treatmentId").select2({ placeholder: 'Select a Treatment', dropdownAutoWidth: true, allowClear: true });
    $("#salesPersonId").select2({ placeholder: "Select a Sales Person", dropdownAutoWidth: true, allowClear: true });
    $("#doctorId").select2({ placeholder: "Select a Doctor", dropdownAutoWidth: true, allowClear: true });
    $("#doctorID").select2({ placeholder: "Select a Doctor", dropdownAutoWidth: true, allowClear: true, multiple:true});
    $("#durationOfStay").select2({ placeholder: 'Select a Duration of Stay', dropdownAutoWidth: true, allowClear: true });
    $("#hospitalization").select2({ placeholder: 'Select a Hospitalization', dropdownAutoWidth: true, allowClear: true });
    $("#accommodation").select2({ placeholder: 'Select an Accomodation', dropdownAutoWidth: true, allowClear: true });
    $("#priceCurrency").select2({ placeholder: 'Select Price Currency', dropdownAutoWidth: true, allowClear: true });
    $("#weightUnit").select2({ placeholder: 'Select a Weight Unit', dropdownAutoWidth: true, allowClear: true });
    $("#heightUnit").select2({ placeholder: 'Select a Height Unit', dropdownAutoWidth: true, allowClear: true });
    //bariatrics

    $("#treatmentPlanStatus").select2({ placeholder: 'Select an option', dropdownAutoWidth: true, allowClear: true });
    $("#treatmentPlanStatusId").select2({ placeholder: 'Select a Treatment Plan Status', dropdownAutoWidth: true, allowClear: true });
    $("#medicalDepartmentId").select2({ placeholder: 'Select a Medical Department', dropdownAutoWidth: true, allowClear: true });
    $("#treatmentId").select2({ placeholder: 'Select a Treatment', dropdownAutoWidth: true, allowClear: true });
    $("#doctorId").select2({ placeholder: 'Select a Doctor', dropdownAutoWidth: true, allowClear: true });
    $("#recommendedTreatmentId").select2({ placeholder: 'Önerilen Tedaviyi Seçiniz', dropdownAutoWidth: true, allowClear: true });
    $("#leadSourceId").select2({ placeholder: 'Select a Lead Source', dropdownAutoWidth: true, allowClear: true });
    $("#countryData").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
    $("#countryId").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
    $("#patientCountry").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
    $("#country").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
};

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

var dtSearchInit = function() {

    $('#filterLeadSource').on("change", function(){
        dtSearchAction($(this), 7)
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
function bmiCalculate() {

    try {
        $("#weightUnit").on("change", function(){
            var weightValue = $(this).children("option:selected").val();
            if(weightValue == "Kg"){
                $("#heightUnit > option").each(function(){
                    if (this.value == "Cm") {
                        $(this).attr("selected", true);
                        $(this).trigger("change");
                    }
                });
            }
            if(weightValue == "lbs"){
                $("#heightUnit > option").each(function(){
                    if (this.value == "Inch") {
                        $(this).attr("selected", true);
                        $(this).trigger("change");
                    }
                });
            }
        });

        $("#calculateBmi").on("click", function(){
            var bmi;
            var weightUnit = $("#weightUnit").children("option:selected").val(),
            heightUnit = $("#heightUnit").children("option:selected").val(),
            weight = $("#weight").val(),
            height = $("#height").val();

            if(weightUnit == "Kg" && heightUnit == "Cm"){
                height = height / 100;
                bmi = weight / (height * height);
                bmi = Math.round(bmi * 100) / 100;
                $("#bmiValue").val(bmi);
            }
            else if(weightUnit == "lbs" && heightUnit == "Inch"){
                bmi = 703 * (weight / (height * height));
                bmi = Math.round(bmi * 100) / 100;
                $("#bmiValue").val(bmi);
            }
            else {
                swal({ icon: 'error', text: 'error' })
            }
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }

}

var app = (function() {

    if ([HIDDEN_URL.HOME].includes(window.location.pathname)) {
        dashboard();
    }

    $(document).ready(function() {
        select2Init();
        dataTableInit();
        dtSearchInit();
        selectedValues();
        clockPickers();
        $.ajax({
            url: '/definitions/reportApi',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $.each(response, function (key, value) {
                        arr.push(value.name);
                        counte.push(value.aCount);
                        colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
                    });
                }
            },

            error: function () { },
        });

        $('[data-toggle="popover"]').ggpopover();

        $('.navbar-nav li a').on('click', function () {
            $(this).parent().toggleClass('active');
        });

        $('.img-gal').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        $("#preloader-active").hide(1000);
        $("#mainnav .child-nav > a").on('click', function () {
            $(this).toggleClass("active");
            $(".submenu").toggleClass("in");
            return false;
        });

        $(".cancel-warning").on("click", function(){
            swal({ icon: 'warning', title: 'Warning!', text: 'Please Contact Sales Manager to Cancel!' });
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

    //edit page
    $("#uploadFile").on("click", function () {
        setTimeout(() => {
            // location.reload();
            swal({ icon: 'success', title: 'Success!', text: 'Patient Photos Added Successfully!', timer: 1000 });
        }, 1000);
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

    editTreatmentPlan();
    postTreatmentPlanOperation();
    changeTreatmentPlanDateOperation();
    treatmentPlanStep();
    treatmentPlanRequestStep();
    patientStep();
    getPatientId();
    completeTreatmentPlan();
    bmiCalculate();
    // getUetdsCities();
    // getUetdsZones();
    getCustomerId();
    saveVoucher();
    updateVoucher();
    // datePickers();

    //api's
});

var Layout = (function() {

    function pinSidenav() {
        $('.sidenav-toggler').addClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-unpin');
        $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
        $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $('#sidenav-main').data('target') + ' />');
        Cookies.set('sidenav-state', 'pinned');
    }

    function unpinSidenav() {
        $('.sidenav-toggler').removeClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-pin');
        $('body').removeClass('g-sidenav-pinned').addClass('g-sidenav-hidden');
        $('body').find('.backdrop').remove();
        Cookies.set('sidenav-state', 'unpinned');
    }

    var $sidenavState = Cookies.get('sidenav-state') ? Cookies.get('sidenav-state') : 'pinned';

    if ($(window).width() > 1200) {
        if ($sidenavState == 'pinned') {
            pinSidenav()
        }

        if (Cookies.get('sidenav-state') == 'unpinned') {
            unpinSidenav()
        }

        $(window).resize(function() {
            if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    $(document).ready(function(){
        $("#tableCompleted").dataTable({ paging: true, pageLength: 25 });
        $("#tableData").dataTable({ paging: true, pageLength: 25 });
        $("#tablePatients").dataTable({ paging: true, pageLength: 15 });
        $("#tableReconsult").dataTable({ paging: true, pageLength: 25 });
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

function deleteTableRow(id) {
    try {
        $('table#treatmentsTable tr#' + id).remove();
        $('#treatmentsTable').trigger('rowAddOrRemove');
    }
    catch(error){
        console.log(error);
    }
    finally { }
}

function editTreatmentPlan(){

    $("#item1").val($('[data-attr="item-1"]').text());
    $("#item1").on("input", function(){
        $('[data-attr="item-1"]').text($(this).val());
    });

    $("#item2").val($('[data-attr="item-2"]').text());
    $("#item2").on("input", function(){
        $('[data-attr="item-2"]').text($(this).val());
    });

    $("#item3").val($('[data-attr="item-3"]').text());
    $("#item3").on("input", function(){
        $('[data-attr="item-3"]').text($(this).val());
    });

    $("#item4").val($('[data-attr="item-4"]').text());
    $("#item4").on("input", function(){
        $('[data-attr="item-4"]').text($(this).val());
    });

    $("#item5").val($('[data-attr="item-5"]').text());
    $("#item5").on("input", function(){
        $('[data-attr="item-5"]').text($(this).val());
    });

    $("#item6").val($('[data-attr="item-6"]').text());
    $("#item6").on("input", function(){
        $('[data-attr="item-6"]').text($(this).val());
    });

    $("#item7").val($('[data-attr="item-7"]').text());
    $("#item7").on("input", function(){
        $('[data-attr="item-7"]').text($(this).val());
    });

    $("#item8").val($('[data-attr="item-8"]').text());
    $("#item8").on("input", function(){
        $('[data-attr="item-8"]').text($(this).val());
    });

    $("#item9").val($('[data-attr="item-9"]').text());
    $("#item9").on("input", function(){
        $('[data-attr="item-9"]').text($(this).val());
    });

    $("#item10").val($('[data-attr="item-10"]').text());
    $("#item10").on("input", function(){
        $('[data-attr="item-10"]').text($(this).val());
    });
}

function changeTreatmentPlanDates(treatmentPlanId, arrivalDate, departureDate, operationDate){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/changeTreatmentPlanDates/' + treatmentPlanId + '',
            type: 'POST',
            data: {
                'arrival_date': arrivalDate,
                'departure_date': departureDate,
                'operation_date': operationDate
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if(response){
                    swal({ icon: 'success', title: 'Ticket Updated Successfully!', text: '', timer: 2000 });
                    // location.reload();
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    } finally { }
}
//patient operation end

//treatment plans
function treatmentPlanRequestStep(){
    try {
        $('#saveTreatmentPlanBtn').on('click', function () {
            var mainStep = $("#tab2");
            var treatmentName       = mainStep.find('#treatmentId').children("option:selected").val(),
                treatmentNames      = mainStep.find('#treatmentId').children("option:selected").text(),
                salesPerson         = mainStep.find('#salesPersonId').children("option:selected").val(),
                salesPersonName     = mainStep.find('#salesPersonId').children("option:selected").text(),
                doctorID            = mainStep.find('#doctorID').children("option:selected").val(),
                doctorName          = mainStep.find('#doctorID').children("option:selected").text(),
                salesPersonName     = mainStep.find('#salesPersonId').children("option:selected").text(),
                duration_of_stay    = mainStep.find('#durationOfStay').children("option:selected").val(),
                hospitalization     = mainStep.find('#hospitalization').children("option:selected").val(),
                accommodation     = mainStep.find('#accommodation').children("option:selected").val(),
                weight = mainStep.find("#weight").val(),
                weightUnit = mainStep.find("#weightUnit").val(),
                height = mainStep.find("#height").val(),
                heightUnit = mainStep.find("#heightUnit").val();
                bmiValue = mainStep.find("#bmiValue").val();

            if (treatmentName == "" || salesPerson == "" || duration_of_stay == "" || hospitalization == ""|| accommodation == "" || doctorID == ""|| weight == "" || height == "" || bmiValue == "" ) {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#next-step").trigger("click");
                $(".treatment-plan-treatment").text(treatmentNames);
                $(".sales-person").text(salesPersonName);
                $(".doctor-name").text(doctorName +' ');
                $(".treatment-plan-duration-of-stay").text(duration_of_stay);
                $(".treatment-plan-hospitalization").text(hospitalization);
                $(".treatment-plan-accommodation").text(accommodation);
                $(".treatment-plan-weight").text(weight + ' ' + weightUnit);
                $(".treatment-plan-height").text(height + ' ' + heightUnit);
                $(".treatment-plan-bmi").text(bmiValue);

            }
        });

        $("#saveOtherTreatmentPlanBtn").on("click", function () {
            var mainStep = $("#tab3");
            var note = mainStep.find('#note').val();

                if(note == ''){
                    swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
                }

                else {
                    $("#next-step").trigger("click");
                    $(".treatment-plan-note").text(note);

                    var leadSourceId = $("#createPatient").find('#leadSourceId').children("option:selected").val(),
                    name = $("#createPatient").find('#name').val(),
                    phone = $("#createPatient").find('#phone').val(),
                    email = $("#createPatient").find('#email').val(),
                    countryId = $("#createPatient").find('#countryId').children("option:selected").val(),
                    age = $("#createPatient").find('#age').val(),
                    gender = $("#createPatient").find('[name="gender"]:checked').val(),
                    note = $("#createPatient").find('#note').val();
                    setTimeout(() => {
                        addPatient(leadSourceId, name, phone, email, countryId, age, gender, note);
                    }, 500);
                }
        });
    } catch (error) {
        console.log(error);
    }
}

function changeTreatmentPlanDateOperation(){
    try {
        $(".received-btn").on("click", function(){
            var tpId = this.id;
            $("#ticketReceived").find("#treatmentPlanId").val(tpId);
        });

        $("#updateTicket").on("click", function () {
            var treatmentPlanId = $("#ticketReceived").find("#treatmentPlanId").val(),
            arrivalDate = $("#ticketReceived").find("#arrivalDate").val();
            departureDate = $("#ticketReceived").find("#departureDate").val();
            operationDate = $("#ticketReceived").find("#operationDate").val();
            if(arrivalDate == ""){
                swal({ icon: 'error', title: 'Please fill in arrival date!', text: '' });
            }
            changeTreatmentPlanDates(treatmentPlanId, arrivalDate, departureDate, operationDate);
        });
    } catch (error) {
        console.log(error);
    }
}

function postTreatmentPlanOperation(){
    try {

        $("#treatmentPlanStatusId").on("change", function(){
            var selectedId = $(this).children("option:selected").val();
            if(selectedId == 3){
                $(".suitableSection").hide(300);
                $(".recommendedTreatmentSection").hide(300);
            }
            else {
                $(".suitableSection").show(300);
                $(".recommendedTreatmentSection").show(300);
            }
        });

        $("#postTreatmentPlanBtn").on("click", function(){
            var treatmentPlanId = $("#postModal").find(".treatment_plan_id").val();
            var treatmentPlanStatusId = $("#postModal").find("#treatmentPlanStatusId").children("option:selected").val();
            var doctorExplanation = $("#postModal").find("#doctorExplanation").val();
            var recommendedTreatmentId = $("#postModal").find("#recommendedTreatmentId").children("option:selected").val();
            var isSuitable = $("#postModal").find('input[name="is_suitable"]:checked').val();
            setTimeout(() => {
                postTreatmentPlan(treatmentPlanId, treatmentPlanStatusId, doctorExplanation, recommendedTreatmentId, isSuitable);
            }, 100);
        });
    }
    catch (error) { }
}

function postTreatmentPlan(treatmentPlanId, treatmentPlanStatusId, doctorExplanation, recommendedTreatmentId, isSuitable){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/treatmentplans/post/' + treatmentPlanId +'',
            type: 'POST',
            data: {
                'tratment_plan_status_id': treatmentPlanStatusId,
                'doctor_explanation': doctorExplanation,
                'recommended_treatment_id': recommendedTreatmentId,
                'is_suitable': isSuitable
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Başarılı!', text: 'Tedavi Planı Başarıyla Cevaplandı!' });
                    setTimeout(() => {
                        window.location.href = "/home";
                    }, 1000);
                }
            },

            error: function () { },
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

//patient operation
function addPatient(leadSourceId, name, phone, email, countryId, age, gender, note){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/patients/store',
            type: 'POST',
            data: {
                'leadSourceId': leadSourceId,
                'name': name,
                'phone': phone,
                'email': email,
                'countryId': countryId,
                'age': age,
                'gender': gender,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    patient_global_id = response;
                }
            },

            error: function () { },
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

function completeTreatmentPlan(){
    try {
        $("#completeTreatmentPlan").on("click", function(){
            if (patient_global_id != undefined){
                setTimeout(() => {
                    //treatment plan
                    var mainStep = $("#tab2");
                    var stepMedicalHistory = $("#tab3");
                    var treatment_id = mainStep.find('#treatmentId').children("option:selected").val();
                    $('#doctorID :selected').each(function(i, selected) {
                        doctor_id[i] = $(selected).val();
                    });
                    var sales_person_id = mainStep.find('#salesPersonId').children("option:selected").val(),
                        duration_of_stay = mainStep.find('#durationOfStay').children("option:selected").val(),
                        hospitalization = mainStep.find('#hospitalization').children("option:selected").val(),
                        accommodation = mainStep.find('#accommodation').children("option:selected").val(),
                        total_price = mainStep.find('#total_price').val(),
                        price_currency = mainStep.find('#priceCurrency').children("option:selected").val(),
                        weight = mainStep.find('#weight').val(),
                        weight_unit = mainStep.find('#weightUnit').val(),
                        height = mainStep.find('#height').val(),
                        height_unit = mainStep.find('#heightUnit').val(),
                        bmiValue = mainStep.find('#bmiValue').val(),

                        note = stepMedicalHistory.find('#note').val();

                        addTreatmentPlan(bmiValue, weight, weight_unit, height, height_unit, patient_global_id, treatment_id, doctor_id, sales_person_id, duration_of_stay, hospitalization, accommodation, total_price, price_currency, note);

                        $("#dropzone").find("#tpId").val(treatment_plan_id);
                        setTimeout(() => {
                            $("#uploadFile").trigger("click");
                        }, 100);
                }, 500);
            }
        });
    }
    catch(error){ }
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
                        clinic_balance      = $('#ClinicBalance').val(),
                        prepayment_received = $('#PrePaymentReceived').val(),
                        currency            = $('#ClinicBalanceCurrency').val(),
                        total_package       = $('#TotalPackageRateVal').text();

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
                        clinic_balance      = $('#ClinicBalance').val(),
                        prepayment_received = $('#PrePaymentReceived').val(),
                        currency            = $('#ClinicBalanceCurrency').val(),
                        total_package       = $('#TotalPackageRateVal').text();

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

$("#tab2").find("#treatmentId").on("change", function(){
    var treatmentId = $(this).children("option:selected").val();
    $.ajax({
        url: '/getDoctorTreatments/' + treatmentId,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response) {
                $("#tab2").find("#doctorID").empty();
                $.each(response, function (key, value) {
                    $("#tab2").find("#doctorID").append('<option value="' + key + '">' + value + '</option>');
                });
            }
        },

        error: function () {
            console.log(DEFINITIONS.LOG_SUCCESS);
        },
    });
});

$("#myTabContent").find("#treatmentId").on("change", function(){
    var treatmentId = $(this).children("option:selected").val();
    $.ajax({
        url: '/getDoctorTreatments/' + treatmentId,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response) {
                $("#myTabContent").find("#doctor_id").empty();
                $.each(response, function (key, value) {
                    $("#myTabContent").find("#doctor_id").append('<option value="' + key + '">' + value + '</option>');
                });
            }
        },

        error: function () {
            console.log(DEFINITIONS.LOG_SUCCESS);
        },
    });
});

$("#roomType").select2({placeholder: "Select Room Type", dropdownAutoWidth: true, allowClear: true});
$("#clinic").select2({placeholder: "Select Clinic", dropdownAutoWidth: true, allowClear: true});
$("#hotel_voucher").select2({placeholder: "Select Hotel", dropdownAutoWidth: true, allowClear: true});
$("#TotalPackageRateCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#PrePaymentReceivedCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#ClinicBalanceCurrency").select2({placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true});
$("#hotel_category").select2({placeholder: "Select Category", dropdownAutoWidth: true, allowClear: true});
$("#contactPerson").select2({placeholder: "Select Contact Person", dropdownAutoWidth: true, allowClear: true});
$("#airportCode").select2({placeholder: "Select Airport Code", dropdownAutoWidth: true, allowClear: true});
$("#uetdsCities").select2({ placeholder: 'Select a City', dropdownAutoWidth: true,dropdownParent: $('#exampleModal'), allowClear: true });
$("#uetdsZones").select2({ placeholder: 'Select a Zone', dropdownAutoWidth: true,dropdownParent: $('#exampleModal'), allowClear: true });

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
        //---------Arrival---------//
        //travel type
        $("#gelis").find("#travelType").on("change", function () {
            let travelType = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='travelType']").val(travelType);
        });

        //agencies
        $("#gelis").find("#agencies").on("change", function () {
            let agencyId = $('#agencies').find(":selected").val();
            $("#arrival_reservations_section").find("input[name='agencyId']").val(agencyId);
        });

        $(".airline-travel").find("input[name=hotelReservationStatus]").on("change", function () {
            $("#arrival_reservations_section").find("input[name=hReservationStatus]").val($(this).val());
        });

        //contact person
        $("#gelis").find("#contact").on("change", function () {
            let personId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='personId']").val(personId);
        });

        //market leader
        $("#gelis").find("#marketLeader").on("change", function () {
            let marketleaderId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='marketleaderId']").val(marketleaderId);
        });

        //sales agent
        $("#gelis").find("#sales").on("change", function () {
            let salesId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='salesId']").val(salesId);
        });

        //treatment
        $("#gelis").find("#treatments").on("change", function () {
            let treatmentId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='treatmentId']").val(treatmentId);
        });

        //patient status
        $("#gelis").find("#patientStatus").on("change", function () {
            let statusId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='statusId']").val(statusId);
        });

        //route
        $("#gelis").find("#routes").on("change", function () {
            let routeId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='routeId']").val(routeId);
        });

        //hospitals
        $("#gelis").find("#hospitals").on("change", function () {
            let hospitalArrivalId = $(this).children("option:selected").val();
            $("#arrival_reservations_section").find("input[name='hospitalId']").val(hospitalArrivalId);
        });

        //---------Departure---------//
        //travel type departure
        $("#gidis").find("#travelType").on("change", function () {
            let travelTypeDeparture = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='travelType']").val(travelTypeDeparture);
        });

        //patient status
        $("#gidis").find("#patientStatus").on("change", function () {
            let statusDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='statusId']").val(statusDepartureId);
        });

        //contact person departure
        $("#gidis").find("#contacts").on("change", function () {
            let personDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='personId']").val(personDepartureId);
        });

        //contact person departure
        $("#gidis").find("#marketLeader_departure").on("change", function () {
            let marketleaderDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='marketleaderId']").val(marketleaderDepartureId);
        });

        //sales agent
        $("#gidis").find("#sales_departure").on("change", function () {
            let salesDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='salesId']").val(salesDepartureId);
        });

        //agencies departure
        $("#gidis").find("#agencies").on("change", function () {
            let agencyDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='agencyId']").val(agencyDepartureId);
        });

        //treatment departure
        $("#gidis").find("#treatments").on("change", function () {
            let treatmentDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='treatmentId']").val(treatmentDepartureId);
        });

        //route departure
        $("#gidis").find("#routes").on("change", function () {
            let routeDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='routeId']").val(routeDepartureId);
        });

        //hospitals departure
        $("#gidis").find("#hospitals").on("change", function () {
            let hospitalDepartureId = $(this).children("option:selected").val();
            $("#departure_reservations_section").find("input[name='hospitalId']").val(hospitalDepartureId);
        });

        //Inner City
        //patient status innercity

        $("#aratransfer").find("#patientStatus").on("change", function () {
            let statusDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='statusId']").val(statusDepartureId);
        });

        //contact person innercity
        $("#aratransfer").find("#contactInner").on("change", function () {
            let personDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='personId']").val(personDepartureId);
        });

        //starting point innercity
        $("#aratransfer").find("#routes").on("change", function () {
            let startingPoint = $(this).children("option:selected").text();
            console.log(startingPoint);
        });

        //agencies innercity
        $("#aratransfer").find("#agencies").on("change", function () {
            let agencyDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='agencyId']").val(agencyDepartureId);
        });

        //treatment innercity
        $("#aratransfer").find("#treatments").on("change", function () {
            let treatmentDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='treatmentId']").val(treatmentDepartureId);
        });

        //route innercity
        $("#aratransfer").find("#routes").on("change", function () {
            let routeDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='routeId']").val(routeDepartureId);
        });

        //hospitals innercity
        $("#aratransfer").find("#hospitals").on("change", function () {
            let hospitalDepartureId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='hospitalId']").val(hospitalDepartureId);
        });

        //sales agent innercity
        $("#aratransfer").find("#salesInner").on("change", function () {
            let salesInnerId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='salesId']").val(salesInnerId);
        });

        //market leader innercity
        $("#aratransfer").find("#marketLeaderInner").on("change", function () {
            let marketLeaderId = $(this).children("option:selected").val();
            $("#innercity_reservations_section").find("input[name='marketleaderId']").val(marketLeaderId);
        });

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
        $("#TotalPackageRateCurrency").on("change", function () {
            let TotalPackageRateCurrency = $(this).children("option:selected").val();
            $("#TotalPackageRateCurrencyText").html(' ' + TotalPackageRateCurrency);
        });

        $("#ClinicBalanceCurrency").on("change", function () {
            let PrePaymentReceivedCurrency = $(this).children("option:selected").val();
            $("#PrePaymentReceivedCurrencyText").html(' ' + PrePaymentReceivedCurrency);
        });

        $("#ClinicBalanceCurrency").on("change", function () {
            let ClinicBalanceCurrency = $(this).children("option:selected").val();
            $("#ClinicBalanceCurrencyText").html(' ' + ClinicBalanceCurrency);
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
        $("#ClinicBalance").on("input", function () {
            $("#ClinicBalanceVal").html( $(this).val());

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
            var ClinicBalance       = $("#ClinicBalance").val();
            var currency            = $('#ClinicBalanceCurrency').val();
            var total               =  (parseInt(PrePaymentReceived) + parseInt(ClinicBalance));
            $("#TotalPackageRateVal").html(total +' '+ currency);
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
        $("#self-booking-hotel").on("change", function(){
            if ($(this).is(':checked')) {
                $(".hotel-voucher-note").find(".important-note").hide();
                $(".hotel-voucher-note").find(".important-desc-1").hide();
                $(".hotel-voucher-note").find(".important-desc-2").hide();
                $("#type-note").text("Self Booking");
                $(".hotel-reservation-data").hide(300);
                $(".hotel-reservation-data-fix").show(300);
                $("#hotelText").find(".data-desc").hide(300);
            }
            else {
                $(".hotel-voucher-note").find(".important-note").show();
                $(".hotel-voucher-note").find(".important-desc-1").show();
                $(".hotel-voucher-note").find(".important-desc-2").show();
                $("#type-note").text("Self Booking");
                $(".hotel-reservation-data").show(300);
                $(".hotel-reservation-data-fix").hide(300);
                $("#hotelText").find(".data-desc").show(300);
             }
        });
        $("#self-transfer").on("change", function(){
            if ($(this).is(':checked')) {
                $(".transfer-voucher").find("#importantNotesText").hide();
                $(".transfer-voucher").find("span").hide();
                $("#transportImage").find("img").hide();
            }
            else {
                $(".transfer-voucher").find("#importantNotesText").show();
                $(".transfer-voucher").find("span").show();
                $("#transportImage").find("img").show();
             }
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
// function getUetdsCities() {
//     try {
//         $.ajax({
//             url: '/getUetdsCities',
//             type: 'get',
//             dataType: 'json',
//             success: function (response) {
//                 if (response) {
//                     $.each(response, function (key, value) {
//                         $("#uetdsCities").append('<option id="' + key + '" value="' + key + '-' + value + '">' + value + '</option>');
//                     });
//                 }
//             },

//             error: function () {
//                 console.log(DEFINITIONS.LOG_SUCCESS);
//             },
//         });
//     } catch (error) {
//         console.info(error);
//     } finally { }
// }

// function getUetdsZones(e) {
//     try {
//         var selectedCity = $(e).children(":selected").attr("id");
//         $.ajax({
//             url: '/getUetdsZones/' + selectedCity,
//             type: 'get',
//             dataType: 'json',
//             success: function (response) {
//                 if (response) {
//                     $("#uetdsZones").empty();
//                     $.each(response, function (key, value) {
//                         $("#uetdsZones").append('<option id="' + key + '" value="' + key + '-' + value + '">' + value + '</option>');
//                     });
//                 }
//             },

//             error: function () {
//                 console.log(DEFINITIONS.LOG_SUCCESS);
//             },
//         });
//     } catch (error) {
//         console.info(error);
//     } finally { }
// }
// function getInnerCityReservation(elem){
//     try {
//         console.log(elem.id);
//         var passengerName = $(elem).attr("data-name");
//         $("#passengerName").text(passengerName);

//     } catch (error) {
//         console.info(error);
//     } finally { }
// }
