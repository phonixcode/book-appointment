@extends('layouts.admin')

@section('title', 'Settings')

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
                        <h1>Settings</h1>
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
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Appointment Settings</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.settings.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="appointment_interval">Appointment Interval</label>
                                <select class="form-control" id="appointment_interval" name="appointment_interval" id="appointment_interval" required>
                                    <option value="{{ App\Models\Setting::get_option('appointment_interval') }}">{{ App\Models\Setting::get_option('appointment_interval') }} minutes</option>
                                    <option value="10">10 minutes</option>
                                    <option value="15">15 minutes</option>
                                    <option value="20">20 minutes</option>
                                    <option value="25">25 minutes</option>
                                    <option value="30">30 minutes</option>
                                    <option value="35">35 minutes</option>
                                    <option value="40">40 minutes</option>
                                    <option value="45">45 minutes</option>
                                    <option value="50">50 minutes</option>
                                    <option value="55">55 minutes</option>
                                    <option value="60">60 minutes</option>
                                </select>
                                <small class="form-text text-warning mt-2">Modifying the interval will distort the dates of the appointments</small>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Monday">Monday From</label>
                                    <input type="time" class="form-control" id="Monday" name="monday_from" value="{{ App\Models\Setting::get_option('monday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Monday">Monday To</label>
                                    <input type="time" class="form-control" id="Monday" name="monday_to" value="{{ App\Models\Setting::get_option('monday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Tuesday">Tuesday From</label>
                                    <input type="time" class="form-control" id="Tuesday" name="tuesday_from" value="{{ App\Models\Setting::get_option('tuesday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Tuesday">Tuesday To</label>
                                    <input type="time" class="form-control" id="Tuesday" name="tuesday_to" value="{{ App\Models\Setting::get_option('tuesday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Wednesday">Wednesday From</label>
                                    <input type="time" class="form-control" id="Wednseday" name="wednesday_from" value="{{ App\Models\Setting::get_option('wednesday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Wednesday">Wednesday To</label>
                                    <input type="time" class="form-control" id="Wednseday" name="wednesday_to" value="{{ App\Models\Setting::get_option('wednesday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Thursday">Thursday From</label>
                                    <input type="time" class="form-control" id="Thursday" name="thursday_from" value="{{ App\Models\Setting::get_option('thursday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Thursday">Thursday To</label>
                                    <input type="time" class="form-control" id="Thursday" name="thursday_to" value="{{ App\Models\Setting::get_option('thursday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Friday">Friday From</label>
                                    <input type="time" class="form-control" id="Friday" name="friday_from" value="{{ App\Models\Setting::get_option('friday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Friday">Friday To</label>
                                    <input type="time" class="form-control" id="Friday" name="friday_to" value="{{ App\Models\Setting::get_option('friday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Saturday">Saturday From</label>
                                    <input type="time" class="form-control" id="Saturday" name="saturday_from" value="{{ App\Models\Setting::get_option('saturday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Saturday">Saturday To</label>
                                    <input type="time" class="form-control" id="Saturday" name="saturday_to" value="{{ App\Models\Setting::get_option('saturday_to') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Sunday">Sunday From</label>
                                    <input type="time" class="form-control" id="Sunday" name="sunday_from" value="{{ App\Models\Setting::get_option('sunday_from') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Sunday">Sunday To</label>
                                    <input type="time" class="form-control" id="Sunday" name="sunday_to" value="{{ App\Models\Setting::get_option('sunday_to') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>

@endsection
