@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vouchers</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Vouchers List</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create sales person')
                            <a href="{{route('voucher')}}"><button type="button" class="btn btn-primary float-right"> <i class="fa fa-plus" aria-hidden="true"></i> New Voucher</button></a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Clinic Name</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Arrival Date</th>
                                <th scope="col">Created User</th>
                                <th scope="col">Created Time</th>
                            </tr>
                        </thead>
                        @foreach ($vouchers as $voucher)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit sales person')
                                        @if ($voucher->language == "es")
                                            <li><a href="{{route('voucher_es.edit', ['id'=> $voucher->id])}}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        @elseif ($voucher->language == "es")
                                            <li><a href="{{route('voucher_it.edit', ['id'=> $voucher->id])}}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        @else
                                            <li><a href="{{route('voucher.edit', ['id'=> $voucher->id])}}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        @endif
                                        @endcan
                                        @can('delete sales person')
                                        <li><a href="{{route('voucher.destroy', ['id'=> $voucher->id])}}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $voucher->hospital->hospital_name }}</td>
                            <td>{{ $voucher->patient_name }}</td>
                            <td>{{ $voucher->arrival_date }}</td>
                            <td>{{ $voucher->user->name }}</td>
                            <td>{{ date('d-m-Y / H:i', strtotime($voucher->created_at))}}</td>
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
            <h5 class="modal-title" id="exampleModalLabel">New Sales Person</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('salesperson.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Sales Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Sales Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Sales Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Sales Phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Sales Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Sales Email">
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
