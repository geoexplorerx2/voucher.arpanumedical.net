@foreach($data as $item)

<div class="dataGeneratorContainer">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Tarih / Date</label>
                <input class="form-control" id="dateValue" value="{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Select gender and full Name</label>
                <div class="row">
                    <div class="col-lg-5 transformation">
                        <select class="form-control" id="gender">
                            <option></option>
                            <option value="Mr" {{ $item->gender=="Mr"?'selected':'' }}>Mr</option>
                            <option value="Mrs" {{ $item->gender=="Mrs"?'selected':'' }}>Mrs</option>
                        </select>
                    </div>
                    <div class="col-lg-7"><input id="fullname" type="text" class="form-control" style="transform: translateX(-10px)" value="{{ $item->fullname }}"></div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Country</label>
                <select class="form-control select" id="countries">
                    <option>{{ $item->city }}</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="city" class="form-control" id="countries" value="{{ $item->city }}">
    </div>
</div> --}}
{{-- <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Per Night</label>
                <input type="number" class="form-control" id="PerNight" value="{{ $item->perNight }}">
</div>
</div> --}}
<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Receipt No</label>
        <input type="number" class="form-control" id="ReceiptNo" value="{{ $item->ReceiptNo }}">
    </div>
</div>
<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">surcharge for payment by credit card</label>
        <div class="row">
            <div class="col-lg-8"><input id="surchargepayment" value="{{ $item->surchargepayment }}" type="number" class="form-control" style="transform: translateX(-10px)"></div>
            <div class="col-lg-4">
                <select class="form-control select" id="surchargepaymentValue">
                    <option value="€" {{ $item->surchargePaymentUnit=="€"?'selected':'' }}> € </option>
                    <option value="$" {{ $item->surchargePaymentUnit=="$"?'selected':'' }}> $ </option>
                    <option value="₺" {{ $item->surchargePaymentUnit=="₺"?'selected':'' }}> ₺ </option>
                    <option value="£" {{ $item->surchargePaymentUnit=="£"?'selected':'' }}> £ </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">İn case DHI technique will be applied</label>
        <div class="row">
            <div class="col-lg-8"><input id="DHI" value="{{ $item->DHI }}" type="number" class="form-control" style="transform: translateX(-10px)"></div>
            <div class="col-lg-4">
                <select class="form-control select" id="DHIValue">
                    <option value="€" {{ $item->DHIUnit=="€"?'selected':'' }}> € </option>
                    <option value="$" {{ $item->DHIUnit=="$"?'selected':'' }}> $ </option>
                    <option value="₺" {{ $item->DHIUnit=="₺"?'selected':'' }}> ₺ </option>
                    <option value="£" {{ $item->DHIUnit=="£"?'selected':'' }}> £ </option>
                </select>
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">surcharge for payment by credit card</label>
                <div class="row">
                    <div class="col-lg-8"><input id="surchargepayment2" value="{{ $item->surchargepayment2 }}" type="number" class="form-control" style="transform: translateX(-10px)"></div>
<div class="col-lg-4">
    <select class="form-control select" id="surchargepaymentValue2">
        <option value="€" {{ $item->surchargePaymentUnit2=="€"?'selected':'' }}> € </option>
        <option value="$" {{ $item->surchargePaymentUnit2=="$"?'selected':'' }}> $ </option>
        <option value="₺" {{ $item->surchargePaymentUnit2=="₺"?'selected':'' }}> ₺ </option>
        <option value="£" {{ $item->surchargePaymentUnit2=="£"?'selected':'' }}> £ </option>
    </select>
</div>
</div>
</div>
</div> --}}
<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Service</label>
        <div class="row">
            <div class="mb-2">Hair Transplant Package</div>
            <ul id="Service" style="list-style: none;">
                <li id="Operation" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox" value="Operation" {!! strpos($item->services, 'Operation') !== false ? 'checked' : null !!}/></span><span style="padding: 0 10px;">Operation</span></li>
                <li id="AirportTransfers" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox" value="Airport Transfers" {!! strpos($item->services, 'Airport Transfers') !== false ? 'checked' : null !!}/></span><span style="padding: 0 10px;">Airport Transfers</span></li>
                <li id="Hotel" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox" value="Hotel" {!! strpos($item->services, 'Hotel') !== false ? 'checked' : null !!}/></span><span style="padding: 0 10px;">Hotel</span></li>
                <li id="Flights" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox" value="Flights" {!! strpos($item->services, 'Flights') !== false ? 'checked' : null !!}/></span><span style="padding: 0 10px;">Flights</span></li>
                <li id="Post-Op" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox" value="Post-Op" {!! strpos($item->services, 'Post-Op') !== false ? 'checked' : null !!}/></span><span style="padding: 0 10px;">Post-Op</span></li>
                <ul>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="mb-3">
        <div>
            <span>
                <input id="DHIactivator" type="checkbox" value="DHI" {!! $item->DHI==0?null:'checked' !!}/>
            </span>
            <span style="padding: 0 10px;">DHI</span>
        </div>
    </div>
</div>
<div class="btnContainer">
    <div class="btnBox">
        <button id="save-btn" onclick="saveInformation({{ $data }})" class="btn btn-primary btn-lg">Update</button>
    </div>
</div>
</div>
</div>

@endforeach
