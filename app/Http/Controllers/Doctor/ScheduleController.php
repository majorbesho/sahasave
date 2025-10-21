<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

use App\Models\Schedule;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $doctor = Auth::user();
        $schedules = $doctor->schedules()->get()->groupBy('day_of_week');

        // مصفوفة لمساعدتنا في عرض أسماء الأيام
        $daysOfWeek = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            0 => 'Sunday'
        ];

        return view('doctor.schedule.index', compact('schedules', 'daysOfWeek'));
    }

    // لتخزين فترة عمل جديدة
    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $doctor = Auth::user();

        // التحقق من عدم وجود تداخل في المواعيد (منطق متقدم يمكن إضافته لاحقاً)

        $doctor->schedule()->create([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Time slot added successfully.');
    }

    // لحذف فترة عمل
    public function destroy(Schedule $schedule)
    {
        // التأكد من أن الطبيب الحالي هو مالك هذا الجدول الزمني
        if ($schedule->doctor_id !== Auth::id()) {
            abort(403);
        }

        $schedule->delete();

        return back()->with('success', 'Time slot removed successfully.');
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
}
