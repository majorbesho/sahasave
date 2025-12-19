<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $filter = $request->get('filter', 'last_7_days');

        $appointments = Appointment::with(['patient', 'medicalCenter'])
            ->forDoctor(Auth::id())
            ->pending()
            ->when($filter === 'today', function ($query) {
                return $query->whereDate('scheduled_for', today());
            })
            ->when($filter === 'this_month', function ($query) {
                return $query->whereMonth('scheduled_for', now()->month);
            })
            ->when($filter === 'last_7_days', function ($query) {
                return $query->lastDays(7);
            })
            ->orderBy('scheduled_for', 'asc')
            ->get();

        return view('doctor.requests.index', compact('appointments', 'filter'));
    }

    public function accept(Request $request, $id)
    {
        // تحقق من أن الطلب AJAX
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $appointment = Appointment::forDoctor(Auth::id())
                ->pending()
                ->findOrFail($id);

            // تسجيل تفاصيل الموعد للتحقق
            \Log::info('Attempting to accept appointment', [
                'appointment_id' => $appointment->id,
                'status' => $appointment->status,
                'scheduled_for' => $appointment->scheduled_for,
                'doctor_id' => $appointment->doctor_id,
                'current_doctor' => Auth::id(),
                'now' => now(),
                'is_future' => $appointment->scheduled_for > now()
            ]);

            // تحقق مفصل من إمكانية القبول
            if ($appointment->status !== 'pending') {
                throw new \Exception("Appointment status is {$appointment->status}, not pending");
            }

            if ($appointment->scheduled_for <= now()) {
                throw new \Exception("Appointment date is in the past or present");
            }

            if ($appointment->doctor_id != Auth::id()) {
                throw new \Exception("You are not authorized to accept this appointment");
            }

            // إذا وصلنا هنا، يمكن القبول
            $appointment->accept();

            DB::commit();

            \Log::info('Appointment accepted successfully', [
                'appointment_id' => $appointment->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment accepted successfully',
                'data' => [
                    'appointment' => $appointment,
                    'scheduled_date' => $appointment->scheduled_for->format('d M Y')
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Accept appointment error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    public function reject(Request $request, $id)
    {
        // تحقق من أن الطلب AJAX
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ], 400);
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:500',
            'refund_option' => 'nullable|in:reschedule,refund'
        ]);

        DB::beginTransaction();

        try {
            $appointment = Appointment::forDoctor(Auth::id())
                ->pending()
                ->findOrFail($id);

            // تسجيل البيانات قبل الإلغاء
            \Log::info('Rejecting appointment', [
                'appointment_id' => $appointment->id,
                'doctor_id' => Auth::id(),
                'cancellation_reason' => $request->cancellation_reason,
                'refund_option' => $request->refund_option
            ]);

            // استخدام الدالة المناسبة بناءً على ما هو متوفر
            if (method_exists($appointment, 'rejectByDoctor')) {
                $appointment->rejectByDoctor(
                    $request->cancellation_reason,
                    $request->refund_option
                );
            } else {
                // استخدام الدالة العامة مع المعلمات الصحيحة
                $appointment->cancel(
                    $request->cancellation_reason,
                    Auth::id(),
                    $request->refund_option
                );
            }

            DB::commit();

            \Log::info('Appointment rejected successfully', [
                'appointment_id' => $appointment->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment rejected successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            \Log::error('Appointment not found for rejection: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            \Log::error('Validation error in reject: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Reject appointment error: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile());
            \Log::error('Line: ' . $e->getLine());
            \Log::error('Trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to reject appointment: ' . $e->getMessage()
            ], 500);
        }
    }
    public function loadMore(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = 5;

        $appointments = Appointment::with(['patient', 'medicalCenter'])
            ->forDoctor(Auth::id())
            ->pending()
            ->orderBy('scheduled_for', 'asc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $html = '';
        foreach ($appointments as $appointment) {
            $html .= view('doctor.requests.partials.appointment-item', compact('appointment'))->render();
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'has_more' => $appointments->count() === $limit
        ]);
    }

    public function stats()
    {
        $doctorId = Auth::id();

        $stats = [
            'pending' => Appointment::forDoctor($doctorId)->pending()->count(),
            'today' => Appointment::forDoctor($doctorId)->today()->pending()->count(),
            'this_week' => Appointment::forDoctor($doctorId)->lastDays(7)->pending()->count(),
        ];

        return response()->json($stats);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
