<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $location = $request->input('location', '');
        $date = $request->input('date', '');

        // البحث الأساسي عن الأطباء
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile', 'medicalCenters'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('doctorProfile', function ($profileQuery) use ($search) {
                            $profileQuery->where('specialization', 'like', "%{$search}%")
                                ->orWhere('qualifications', 'like', "%{$search}%");
                        });
                });
            })
            ->when($location, function ($query) use ($location) {
                return $query->where(function ($q) use ($location) {
                    $q->where('address', 'like', "%{$location}%")
                        ->orWhereHas('medicalCenters', function ($centerQuery) use ($location) {
                            $centerQuery->where('name', 'like', "%{$location}%")
                                ->orWhere('address', 'like', "%{$location}%");
                        });
                });
            })
            ->orderBy('name')
            ->paginate(10);

        // تأكد من أن جميع البيانات strings
        $totalDoctors = $doctors->total();

        return view('frontend.doctors-search', compact('doctors', 'search', 'location', 'date', 'totalDoctors'));
    }


    // public function search(Request $request)
    // {
    //     $search = $request->input('search');
    //     $location = $request->input('location');
    //     $date = $request->input('date');
    //     $specialty = $request->input('specialty');
    //     $gender = $request->input('gender');
    //     $experience = $request->input('experience');

    //     $doctors = User::where('role', 'doctor')
    //         ->where('status', 'active')
    //         ->with(['doctorProfile', 'medicalCenters'])
    //         ->when($search, function ($query) use ($search) {
    //             return $query->where(function ($q) use ($search) {
    //                 $q->where('name', 'like', "%{$search}%")
    //                     ->orWhereHas('doctorProfile', function ($profileQuery) use ($search) {
    //                         $profileQuery->where('specialization', 'like', "%{$search}%")
    //                             ->orWhere('qualifications', 'like', "%{$search}%")
    //                             ->orWhere('bio', 'like', "%{$search}%");
    //                     });
    //             });
    //         })
    //         ->when($location, function ($query) use ($location) {
    //             return $query->where(function ($q) use ($location) {
    //                 $q->where('address', 'like', "%{$location}%")
    //                     ->orWhereHas('medicalCenters', function ($centerQuery) use ($location) {
    //                         $centerQuery->where('name', 'like', "%{$location}%")
    //                             ->orWhere('address', 'like', "%{$location}%")
    //                             ->orWhere('city', 'like', "%{$location}%");
    //                     });
    //             });
    //         })
    //         ->when($specialty, function ($query) use ($specialty) {
    //             return $query->whereHas('doctorProfile', function ($q) use ($specialty) {
    //                 $q->where('specialization', 'like', "%{$specialty}%");
    //             });
    //         })
    //         ->when($gender, function ($query) use ($gender) {
    //             return $query->where('gender', $gender);
    //         })
    //         ->when($experience, function ($query) use ($experience) {
    //             return $query->whereHas('doctorProfile', function ($q) use ($experience) {
    //                 $q->where('experience_years', '>=', $experience);
    //             });
    //         })
    //         ->orderBy('name')
    //         ->paginate(10)
    //         ->appends($request->all());

    //     $totalDoctors = $doctors->total();

    //     return view('frontend.doctors-search', compact(
    //         'doctors',
    //         'search',
    //         'location',
    //         'date',
    //         'totalDoctors',
    //         'specialty',
    //         'gender',
    //         'experience'
    //     ));
    // }

    public function index()
    {
        //
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
