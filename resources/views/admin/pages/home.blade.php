@extends('layouts.admin')

@section('title', 'Appointment')

@section('content')

    <!-- begin app-main -->
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-lg-flex flex-nowrap align-items-center">
                        <div class="pr-4 mr-4 page-title border-right">
                            <h1>Appointment</h1>
                        </div>
                        <div class="breadcrumb-bar align-items-center">
                            <nav>

                            </nav>
                        </div>

                    </div>
                    <!-- end page title -->
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 class="card-title">All Appointments</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Schedule Info</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($appointments as $item)
                                            <tr>
                                                <th scope="row">{{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration}}</th>
                                                <td>{{ ucfirst($item->name) }}</td>
                                                <td>
                                                    <label class="badge badge-primary-inverse">
                                                        <i class="fa fa-calendar"></i> {{ $item->date->format('d M Y') }}
                                                    </label>
                                                    <label class="badge badge-primary-inverse">
                                                        <i class="fa fa-clock-o"></i> {{ $item->time_start }} -
                                                        {{ $item->time_end }}
                                                    </label>
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <label class="badge badge-warning-inverse">
                                                            <i class="fa fa-hourglass-start"></i> Pending
                                                        </label>
                                                    @elseif($item->status == 1)
                                                        <label class="badge badge-success-inverse">
                                                            <i class="fa fa-check"></i> Approved
                                                        </label>
                                                    @else
                                                        <label class="badge badge-danger-inverse">
                                                            <i class="fa fa-user-times"></i> Cancelled
                                                        </label>
                                                    @endif
                                                </td>
                                                <td style="white-space: nowrap; width: 5%;">

                                                    @if ($item->status == 0)
                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            data-toggle="modal" data-target="#EDITRDVModal"
                                                            data-rdv_id="{{ $item->id }}"
                                                            data-rdv_name="{{ $item->name }}"
                                                            data-rdv_details="{{ $item->reason }}"
                                                            data-rdv_date="{{ $item->date->format('d M Y') }}"
                                                            data-rdv_time_start="{{ $item->time_start }}"
                                                            data-rdv_time_end="{{ $item->time_end }}"
                                                            data-rdv_status="{{ $item->status }}">
                                                            <i class="pr-2 ti ti-pencil text-primary" title="edit"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            data-toggle="modal" data-target="#SHOWRDVModal"
                                                            data-rdv_id="{{ $item->id }}"
                                                            data-rdv_name="{{ $item->name }}"
                                                            data-rdv_details="{{ $item->reason }}"
                                                            data-rdv_date="{{ $item->date->format('d M Y') }}"
                                                            data-rdv_time_start="{{ $item->time_start }}"
                                                            data-rdv_time_end="{{ $item->time_end }}"
                                                            data-rdv_status="{{ $item->status }}">
                                                            <i class="pr-2 fa fa-desktop text-primary" title="show"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2">{{ $appointments->links('pagination::default') }}</div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="SHOWRDVModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    You are about to modify an appointment
                                </h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered">
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
                                            <th>Status</th>
                                            <td><span id="rdv_status"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Details</th>
                                            <td>
                                                <p id="appointment_reason"></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    You are about to modify an appointment
                                </h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered">
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
                                            <th>Status</th>
                                            <td><span id="rdv_status"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Details</th>
                                            <td>
                                                <p id="appointment_reason"></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="text-white btn btn-primary"
                                    onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">Confirm
                                    Appointment
                                </a>
                                <form id="rdv-form-confirm" action="{{ route('admin.appointment.store.edit') }}"
                                    method="POST" class="d-none">
                                    <input type="hidden" name="rdv_id" id="rdv_id">
                                    <input type="hidden" name="rdv_status" value="1">
                                    @csrf
                                </form>
                                <a class="text-white btn btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">Cancel
                                    Appointment
                                </a>
                                <form id="rdv-form-cancel" action="{{ route('admin.appointment.store.edit') }}"
                                    method="POST" class="d-none">
                                    <input type="hidden" name="rdv_id" id="rdv_id2">
                                    <input type="hidden" name="rdv_status" value="2">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end app-main -->

@endsection
