@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container-fluid create-new-patient">
   <div class="row">
      <div class="col-md-12">
         <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
         <div class="card p-4 mt-3">
            <div class="card-title">
               <h2>Create New Patient</h2>
            </div>
            <form method="POST" action="{{ route('patient.createpatient') }}">
               @csrf
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="leadSourceId">Lead Source</label>
                        <select class="form-control" id="leadSourceId" name="leadSourceId" required>
                           <option></option>
                           @foreach ($lead_sources as $lead_source)
                           <option value="{{ $lead_source->id }}">{{ $lead_source->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="name_surname">Patient Name Surname</label>
                        <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Enter Patient Name" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="phone">Patient Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Patient Phone" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="age">Patient Age</label>
                        <input type="number" class="form-control" id="age" maxlength="2" name="age" placeholder="Enter Patient Age">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="country">Patient Country</label>
                        <select class="form-control" name="countryId" id="country">
                            <option></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="email">Patient Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Patient Email">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6 mb-3">
                     <label>Gender</label>
                     <div class="form-check ml-3">
                        <input class="form-check-input" type="radio" value="Male" name="gender" id="male" required>
                        <label class="form-check-label" for="male">Male</label>
                     </div>
                     <div class="form-check ml-3">
                        <input class="form-check-input" type="radio" value="Female" name="gender" id="female" required>
                        <label class="form-check-label" for="female">Female</label>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note">
                     </div>
                  </div>
               </div>
               <button type="submit" class="btn btn-primary float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
