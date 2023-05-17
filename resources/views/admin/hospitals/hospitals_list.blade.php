@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hospitals</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Hospitals List</h2>
                        </div>
                        <div class="col-md-6">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Hospital</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Hospital Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Zone</th>
                                <th scope="col">Phone Number</th>
                            </tr>
                        </thead>
                        @foreach ($hospitals as $hospital)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('hospital.edit', ['id' => $hospital->hospital_id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ route('hospital.destroy', ['id' => $hospital->hospital_id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $hospital->hospital_name }}</td>
                            <td>{{ $hospital->hospital_city }}</td>
                            <td>{{ $hospital->hospital_zone }}</td>
                            <td>{{ $hospital->hospital_phone }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Hospital</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('hospital.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Hospital Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Hospital Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hospitalAddress">Hospital Address</label>
                                <input type="text" class="form-control" id="hospitalAddress" name="hospitalAddress" placeholder="Enter Hospital Address" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Hospital Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Hospital Phone" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Hospital Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Hospital Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hotelCity">City</label>
                                <select id="uetdsCities" class="form-control" name="hospitalCity" onchange="getUetdsZones(this);" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hotelZone">Zone</label>
                                <select id="uetdsZones" class="form-control" name="hospitalZone" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="phone">Short Description (ENGLISH)</label>
                                <textarea class="form-control" name="short_desc" id="short_desc" placeholder="Enter a Short Descreption..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
