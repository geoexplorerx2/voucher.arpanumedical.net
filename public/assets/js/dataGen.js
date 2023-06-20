

$('#dateValue').datepicker({ format: 'dd-mm-yyyy' })
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

$('#city').on('keyup', function () {
    $('.city').text($('#city').val())
})

// $('#ReceiptNo').click(function(){
//     let ReceiptNo = Math.floor(100000 + Math.random() * 900000);
//     $('#ReceiptNo').val(ReceiptNo);
//     $('.ReceiptNo').text(ReceiptNo);
// })