$('#dateValue').datepicker({ format: 'dd-mm-yyyy' })
$('#dateValue').on('change', function () {
    $('.dataValue').text($('#dateValue').val())
})
$('#PerNight').on('keyup', function () {
    $('.PerNightValue').text($('#PerNight').val())
})

$('#ReceiptNo').on('keyup', function () {
    $('.ReceiptNo').text($('#ReceiptNo').val())
})

$('#surchargepayment').on('keyup', function () {
    $('.ReceiptNo').text($('#ReceiptNo').val())
})

$('#surchargepayment').on('keyup', function () {
    $('.surchargepayment').text($('#surchargepayment').val())
    $('.amount').text($('#surchargepayment').val())
    $('.amount2').text($('#surchargepayment').val())
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

$('#city').on('keyup', function () {
    $('.city').text($('#city').val())
})