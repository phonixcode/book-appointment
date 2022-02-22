<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\AppointmentEditRequest;
use App\Http\Requests\Appointment\AppointmentSettingsRequest;
use App\Http\Requests\Appointment\AppointmentStorRequest;
use DateTime;
use App\Models\Setting;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function appointment()
    {
        $appointments = Appointment::latest()->paginate(10);
        return view('admin.pages.home', ['appointments' => $appointments]);
    }

    public function appointmentList()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('user.pages.list', ['appointments' => $appointments]);
    }

    public function appointmentCreate()
    {
        return view('user.pages.create');
    }

    public function appointmentStore(AppointmentStorRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 0;

        $check = Appointment::create($data);

        return $check
            ? redirect()->route('user.home')->with('success', 'Appointment Created Successfully!')
            : redirect()->back()->with('error', 'Something went wrong, failed to create appointment');

//        $appointment = new Appointment();
//        $appointment->user_id = auth()->user()->id;
//        $appointment->name = $request->rdv_name;
//        $appointment->reason = $request->rdv_details;
//        $appointment->date = $request->rdv_time_date;
//        $appointment->time_start = $request->rdv_time_start;
//        $appointment->time_end = $request->rdv_time_end;
//        $appointment->status = 0;
//        $appointment->save();

        //return redirect()->route('user.home')->with('success', 'Appointment Created Successfully!');
    }

    public function appointmentStoreEdit(AppointmentEditRequest $request)
    {
        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->status = $request->rdv_status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment Updated Successfully!');
    }

    public function appointmentsSettingsStore(AppointmentSettingsRequest $request)
    {
        Setting::update_option('appointment_interval', $request->appointment_interval);

        Setting::update_option('saturday_from', $request->saturday_from);
        Setting::update_option('saturday_to', $request->saturday_to);

        Setting::update_option('sunday_from', $request->sunday_from);
        Setting::update_option('sunday_to', $request->sunday_to);

        Setting::update_option('monday_from', $request->monday_from);
        Setting::update_option('monday_to', $request->monday_to);

        Setting::update_option('tuesday_from', $request->tuesday_from);
        Setting::update_option('tuesday_to', $request->tuesday_to);

        Setting::update_option('wednesday_from', $request->wednesday_from);
        Setting::update_option('wednesday_to', $request->wednesday_to);

        Setting::update_option('thursday_from', $request->thursday_from);
        Setting::update_option('thursday_to', $request->thursday_to);

        Setting::update_option('friday_from', $request->friday_from);
        Setting::update_option('friday_to', $request->friday_to);

        return redirect()->route('admin.settings')->with('success', "Settings successfully updated");
    }

    public function checkSlots($date)
    {
        return $this->getTimeSlot($date);
    }

    public function getTimeSlot($date)
    {

        $day = date("l", strtotime($date));
        $day_from =  strtolower($day . '_from');
        $day_to =  strtolower($day . '_to');

        $start = Setting::get_option($day_from);
        $end = Setting::get_option($day_to);
        $interval = Setting::get_option('appointment_interval');

        $start = new DateTime($start);
        $end = new DateTime($end);
        $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
        $end_time = $end->format('H:i');

        $i = 0;
        $time = [];
        while (strtotime($start_time) <= strtotime($end_time)) {
            $start = $start_time;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
            $start_time = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time)));
            $i++;
            if (strtotime($start_time) <= strtotime($end_time)) {
                $time[$i]['start'] = $start;
                $time[$i]['end'] = $end;
                $time[$i]['available'] = $this->availableSlot($date, $start, $end);
            }
        }

        return $time;
    }

    public function availableSlot($date, $start, $end)
    {
        $check = Appointment::where(['date' => $date, 'time_start' => $start, 'time_end' => $end])
            ->where('status', '!=', '2')->count();
        return $check == 0 ? 'available' : 'unavailable';
    }
}
