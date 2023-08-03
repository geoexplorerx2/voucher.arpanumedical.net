@foreach($data as $item)
<div class="documentViewContainer">
    <div class="logoContainer"></div>
    <div class="arpanuLogoContainer">
        <div class="arpanuLogo"></div>
    </div>
    <div class="proFormaInvoiceContainer">
        <div class="proformaInvoice">Pro-forma Invoice</div>
        <div class="proformaInvoiceDescription">Merkez Mahallesi, Abide-i Hürriyet Cad. 171, Aykaç Apartmanı Kat: 2,
            Daire 8 Şişli/ISTANBUL - TURKEY</div>
    </div>
</div>
<div class="services">
    <div>HİZMET / SERVICE:</div>
    <div>Tarih / Date:<span class="dataValue">{{ date('d-m-Y', strtotime($item->date)) }}</span></div>
</div>
<div class="LayoutContainer">
    <div class="Layout">
        <label>Country</label>
        <div class="country subLayout">
            {{ $item->city }}
        </div>
    </div>
</div>
<div class="LayoutContainer">
    <div class="Layout">
        <label>Name</label>
        <div class="subLayout">
            <span class="gender">{{ $item->gender }} </span> <span class="fullname" style="margin:0 5px;">{{ $item->fullname }}</span>
        </div>
    </div>
</div>
<div class="LayoutContainer">
    <div class="Layout">
        <label>Receipt No</label>
        <div class="subLayout ReceiptNo">
            {{ $item->ReceiptNo }}
        </div>
    </div>
</div>
<div class="LayoutContainer mb-1">
    <div class="Layout">
        <label>Service</label>
        <div id="ServiceDisplayer" class="subLayout" style="display: block;">
            @foreach($service as $subitem)
            @if(strpos($item->services, $subitem) !== false)
             <div style="padding: 1px 0;">{{ $subitem }}</div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<div class="services">
    <div>DESCRIPTION</div>
</div>
<div class="table2">
    <div class="t2row1">
        <div>
            <div class="textCustomizing">5 % surcharge for payment by credit card:</div>
            <div class="textCustomizing mt-1"><span class="surchargepayment">{{ $item->surchargepayment }}</span><span class="surchargepaymentValue mx-1">{{ $item->surchargePaymentUnit }}</span></div>
        </div>
    </div>
    <div class="t2row2">
        <div class="DHIDisplay" {!! $item->DHI=='0'?'style="display:none;"':'style="display:block;border-top:1px solid #000;padding:8px 0px;"' !!}>
            <div class="textCustomizing">İn case DHI technique will be applied, there is supplement of <span class="DHI">{{ $item->DHI }}</span><span class="DHIValue mx-1">{{ $item->DHIUnit }}</span></div>
        </div>
    </div>
    {{-- <div class="t2row3">
        <div>
            <div class="textCustomizing">5 % surcharge for payment by credit card:</div>
            <div class="textCustomizing mt-1"><span class="surchargepayment2">{{ $item->surchargepayment2 }}</span><span class="surchargepaymentValue2 mx-1">{{ $item->surchargePaymentUnit2 }}</span>
</div>
</div>
</div> --}}
</div>
<div class="sectionAmount">
    <div class="amountContainer">
        <div>
            <div class="tutar mt-2">Tutar / Amount</div>
            <div class="value">
                <span class="amount">{{ $item->surchargepayment }}</span>
                <span class="amountValue">{{ $item->surchargePaymentUnit }}</span>
            </div>
            <hr />
            <div class="tutar">Toplam / Total</div>
            <div class="value mb-2">
                <span class="amount2">{{ $item->surchargepayment }}</span>
                <span class="amountValue2">{{ $item->surchargePaymentUnit }}</span>
            </div>
        </div>
    </div>
</div>
<div class="LayoutContainer">
    <div class="Layout">
        <label>Payment details</label>
        <div class="subLayout" style="min-height: 50px;">

        </div>
    </div>
</div>
@endforeach
