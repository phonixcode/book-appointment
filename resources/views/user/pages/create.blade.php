@extends('layouts.app')

@section('title', 'Appointment')

@section('content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin row -->
        <div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-lg-flex flex-nowrap align-items-center">
                    <div class="page-title mr-4 pr-4 border-right">
                        <h1>Book an Appointment</h1>
                    </div>
                    <div class="breadcrumb-bar align-items-center">
                        <nav>

                        </nav>
                    </div>

                </div>
                <!-- end page title -->
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="appointment_name">Name</label>
                                    <input type="text" class="form-control" id="appointment_name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="appointment_reason">Reason for appointment</label>
                                    <textarea class="form-control" id="appointment_reason"
                                        rows="1" placeholder="Reason for appointment" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rdvdate">Date</label>
                                    <div class="input-group date display-years" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control target" readonly="readonly" id="rdvdate">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <small class="form-text text-info mt-2">Select date to view time slots
                                        available</small>
                                </div>

                            </div>
                            <div class="col-md-8 col-sm-12">
                                <label for="date">Available Time Slots</label>
                                <hr>
                                <div class="row mb-2 myorders"></div>
                                <div class="alert alert-warning text-center" role="alert" id="help-block">
                                    <img src="{{ asset('assets/img/calendar.png') }}"><br>
                                    <b>No Date Selected</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure of the date</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <th>Name</th>
                                <td><span id="appointment_name"></span></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><span class="badge badge-primary-inverse" id="rdv_date"></span></td>
                            </tr>
                            <tr>
                                <th>Time Slot</th>
                                <td><span class="badge badge-primary-inverse" id="rdv_time"></span></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td><p id="appointment_reason"></p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary text-white" onclick="event.preventDefault();
               document.getElementById('rdv-form').submit();">Save</a>
                        <form id="rdv-form" action="{{ route('user.appointment.store') }}" method="POST" class="d-none">
                            <input type="hidden" name="name" id="name_input">
                            <input type="hidden" name="reason" id="detail_input">
                            <input type="hidden" name="date" id="rdv_date_input">
                            <input type="hidden" name="time_start" id="rdv_time_start_input">
                            <input type="hidden" name="time_end" id="rdv_time_end_input">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end container-fluid -->
</div>


@endsection
