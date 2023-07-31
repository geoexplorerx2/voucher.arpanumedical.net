<div class="dataGeneratorContainer">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Tarih / Date</label>
                <input class="form-control" id="dateValue">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Select gender and full Name</label>
                <div class="row">
                    <div class="col-lg-5 transformation">
                        <select class="form-control" id="gender">
                            <option></option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="col-lg-7"><input id="fullname" type="text" class="form-control"
                            style="transform: translateX(-10px)"></div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Country</label>
                <select class="form-control select" id="countries">
                    <option>---Select Country---</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <div class="col-lg-6" countries>
            <div class="mb-3">
                <label class="form-label">Per Night</label>
                <input type="number" class="form-control" id="PerNight">
            </div>
        </div> --}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Receipt No</label>
                <input type="number" id="ReceiptNo" class="form-control" value="{{ $ReceiptNo }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">surcharge for payment by credit card</label>
                <div class="row">
                    <div class="col-lg-8"><input id="surchargepayment" type="number" class="form-control"
                            style="transform: translateX(-10px)"></div>
                    <div class="col-lg-4">
                        <select class="form-control select" id="surchargepaymentValue">
                            <option value="€" selected> € </option>
                            <option value="$"> $ </option>
                            <option value="₺"> ₺ </option>
                            <option value="£"> £ </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">İn case DHI technique will be applied</label>
                <div class="row">
                    <div class="col-lg-8"><input id="DHI" type="number" class="form-control"
                            style="transform: translateX(-10px)"></div>
                    <div class="col-lg-4">
                        <select class="form-control select" id="DHIValue">
                            <option value="€" selected> € </option>
                            <option value="$"> $ </option>
                            <option value="₺"> ₺ </option>
                            <option value="£"> £ </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Service</label>
                <div class="row">
                    <div class="mb-2">Hair Transplant Package</div>
                    <ul id="Service" style="list-style: none;">
                        <li id="Operation" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox"
                                    value="Operation" /></span><span style="padding: 0 10px;">Operation</span></li>
                        <li id="AirportTransfers" onclick="getValue(this)" style="padding: 5px 0;"><span><input
                                    type="checkbox" value="Airport Transfers" /></span><span
                                style="padding: 0 10px;">Airport Transfers</span></li>
                        <li id="Hotel" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox"
                                    value="Hotel" /></span><span style="padding: 0 10px;">Hotel</span></li>
                        <li id="Flights" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox"
                                    value="Flights" /></span><span style="padding: 0 10px;">Flights</span></li>
                        <li id="Post-Op" onclick="getValue(this)" style="padding: 5px 0;"><span><input type="checkbox"
                                    value="Post-Op" /></span><span style="padding: 0 10px;">Post-Op</span></li>
                        <ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <div>
                    <span>
                        <input id="DHIactivator" type="checkbox" value="DHI" />
                    </span>
                    <span style="padding: 0 10px;">DHI</span>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">surcharge for payment by credit card</label>
                <div class="row">
                    <div class="col-lg-8"><input id="surchargepayment2" type="number" class="form-control" style="transform: translateX(-10px)"></div>
                    <div class="col-lg-4">
                        <select class="form-control select" id="surchargepaymentValue2">
                            <option value="€" selected> € </option>
                            <option value="$"> $ </option>
                            <option value="₺"> ₺ </option>
                            <option value="£"> £ </option>
                        </select>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="btnContainer">
            <div class="btnBox">
                <button id="save-btn" onclick="saveInformation(null)" class="btn btn-primary btn-lg">Save</button>
            </div>
        </div>
    </div>
</div>
