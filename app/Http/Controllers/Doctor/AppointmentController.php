<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $doctor = Auth::user();
        //dd($doctor);

        $baseQuery = $doctor->doctorAppointments()->with('patient');

        // تطبيق الفلاتر
        if ($request->filled('search')) {
            $baseQuery->whereHas('patient', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }
        // يمكنك إضافة فلاتر أخرى هنا (date range, type, etc.)

        // جلب المواعيد لكل تبويب مع ترقيم الصفحات
        $upcomingAppointments = (clone $baseQuery)->whereIn('status', ['pending', 'confirmed'])->orderBy('appointment_time', 'asc')->paginate(10, ['*'], 'upcoming_page');
        $completedAppointments = (clone $baseQuery)->where('status', 'completed')->orderBy('appointment_time', 'desc')->paginate(10, ['*'], 'completed_page');
        $cancelledAppointments = (clone $baseQuery)->where('status', 'cancelled')->orderBy('appointment_time', 'desc')->paginate(10, ['*'], 'cancelled_page');

        // جلب عدد المواعيد لكل تبويب (بدون ترقيم صفحات)
        $upcomingCount = (clone $baseQuery)->whereIn('status', ['pending', 'confirmed'])->count();
        $completedCount = (clone $baseQuery)->where('status', 'completed')->count();
        $cancelledCount = (clone $baseQuery)->where('status', 'cancelled')->count();

        return view('doctor.appointments.index', compact(
            'upcomingAppointments',
            'completedAppointments',
            'cancelledAppointments',
            'upcomingCount',
            'completedCount',
            'cancelledCount'





        ));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
