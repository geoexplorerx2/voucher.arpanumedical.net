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
                    <div class="col-lg-7"><input id="fullname" type="text" class="form-control" style="transform: translateX(-10px)"></div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="city" class="form-control" id="city">
            </div>
        </div>
        {{-- <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Per Night</label>
                <input type="number" class="form-control" id="PerNight">
            </div>
        </div> --}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Receipt No</label>
                <input type="number" class="form-control" id="ReceiptNo">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">surcharge for payment by credit card</label>
                <div class="row">
                    <div class="col-lg-8"><input id="surchargepayment" type="number" class="form-control" style="transform: translateX(-10px)"></div>
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
                    <div class="col-lg-8"><input id="DHI" type="number" class="form-control" style="transform: translateX(-10px)"></div>
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
        </div>
        <div class="btnContainer">
            <div class="btnBox">
                <button id="save-btn" onclick="saveInformation(null)" class="btn btn-primary btn-lg">Save</button>
            </div>
        </div>
    </div>
</div>
