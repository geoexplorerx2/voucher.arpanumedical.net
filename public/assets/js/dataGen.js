$('#dateValue').datepicker({
    format: 'dd-mm-yyyy'
})
$('#dateValue').on('change', function () {
    $('.dataValue').text($('#dateValue').val())
})
$('#PerNight').on('keyup', function () {
    $('.PerNightValue').text($('#PerNight').val())
})

// $('#ReceiptNo').on('keyup', function () {
//      $('.ReceiptNo').text($('#ReceiptNo').val())
// })

$('#surchargepayment').on('keyup', function () {
    $('.ReceiptNo').text($('#ReceiptNo').val())
})

$('#surchargepayment').on('keyup', function () {
    let total = parseFloat($('#surchargepayment').val()) + (parseFloat($('#surchargepayment').val()) * 0.05)
    let check = isNaN(total);
    $('.surchargepayment').text($('#surchargepayment').val())
    $('.amount').text(check ? 0 : total)
    $('.amount2').text(check ? 0 : total)
})

$('#surchargepaymentValue').on('change', function () {
    $('.surchargepaymentValue').text($('#surchargepaymentValue').val())
    $('.amountValue').text($('#surchargepaymentValue').val())
    $('.amountValue2').text($('#surchargepaymentValue').val())
})

$('#DHI').on('keyup', function () {
    $('.DHI').text($('#DHI').val())
})

$('#DHIValue').on('change', function () {
    $('.DHIValue').text($('#DHIValue').val())
})

$('#surchargepayment2').on('keyup', function () {
    $('.surchargepayment2').text($('#surchargepayment2').val())
})

$('#surchargepaymentValue2').on('change', function () {
    $('.surchargepaymentValue2').text($('#surchargepaymentValue2').val())
})

$('#gender').on('change', function () {
    $('.gender').text($('#gender').val())
})

$('#fullname').on('keyup', function () {
    $('.fullname').text($('#fullname').val())
})

$('#countries').on('change', function () {
    console.log($('#countries').val())
    $('.country').text($('#countries').val())
})

const Services = [{
        "name": "Operation",
        "status": false
    },
    {
        "name": "AirportTransfers",
        "status": false
    },
    {
        "name": "Hotel",
        "status": false
    },
    {
        "name": "Flights",
        "status": false
    },
    {
        "name": "Post-Op",
        "status": false
    }
]
const getValue = (data) => {

    const pathname = window.location.pathname.split('/').length
    let DocumentObjectMode = ''
    if (pathname == 2) {
        if ($(`#${data.id}>span>input`).is(':checked')) {
            Services.map((item) => {
                if (item.name == data.id) {
                    item.status = true
                }
            })
        } else {
            Services.map((item) => {
                if (item.name == data.id) {
                    item.status = false
                }
            })
        }
        Services.map((item) => {
            if (item.status) {
                DocumentObjectMode = DocumentObjectMode + `<div style="width:100%;padding:1px 0px;">${item.name=='AirportTransfers'?'Airport Transfers':item.name}</div>`
            }
        })
        $('#ServiceDisplayer').html(DocumentObjectMode)
    } else {
        $.ajax({
            url: '/api/proforma/servicelog/' + window.location.pathname.split('/')[3],
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                response.map((item, index) => {
                    if (item == (Services[index].name == 'AirportTransfers' ? 'Airport Transfers' : Services[index].name)) {
                        Services[index].status = true
                    }
                })
                if ($(`#${'Operation'}>span>input`).is(':checked')) {
                    Services[0].status = true
                } else {
                    Services[0].status = false
                }
                if ($(`#${'AirportTransfers'}>span>input`).is(':checked')) {
                    Services[1].status = true
                } else {
                    Services[1].status = false
                }
                if ($(`#${'Hotel'}>span>input`).is(':checked')) {
                    Services[2].status = true
                } else {
                    Services[2].status = false
                }
                if ($(`#${'Flights'}>span>input`).is(':checked')) {
                    Services[3].status = true
                } else {
                    Services[3].status = false
                }
                if ($(`#${'Post-Op'}>span>input`).is(':checked')) {
                    Services[4].status = true
                } else {
                    Services[4].status = false
                }
                Services.map((item) => {
                    if (item.status) {
                        DocumentObjectMode = DocumentObjectMode + `<div style="width:100%;padding:1px 0px;">${item.name=='AirportTransfers'?'Airport Transfers':item.name}</div>`
                    }
                })
                $('#ServiceDisplayer').html(DocumentObjectMode)
            },
        });
    }
    
}

$('#DHIactivator').on('click', function () {
    if ($('#DHIactivator').is(":checked")) {
        $('.DHIDisplay').css('display', 'block')
    } else {
        $('.DHIDisplay').css('display', 'none')
    }
})
$('.DHIactivator').on('click', function () {
    if ($('.DHIactivator').is(":checked")) {
        $('.DHIDisplay').css('display', 'block')
    } else {
        $('.DHIDisplay').css('display', 'none')
    }
})
