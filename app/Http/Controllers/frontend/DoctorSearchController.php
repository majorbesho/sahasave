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


    // public function search(Request $request)
    // {
    //     $search = $request->input('search', '');
    //     $location = $request->input('location', '');
    //     $date = $request->input('date', '');

    //     // البحث الأساسي عن الأطباء
    //     $doctors = User::where('role', 'doctor')
    //         ->where('status', 'active')
    //         ->with(['doctorProfile', 'medicalCenters'])
    //         ->when($search, function ($query) use ($search) {
    //             return $query->where(function ($q) use ($search) {
    //                 $q->where('name', 'like', "%{$search}%")
    //                     ->orWhereHas('doctorProfile', function ($profileQuery) use ($search) {
    //                         $profileQuery->where('specialization', 'like', "%{$search}%")
    //                             ->orWhere('qualifications', 'like', "%{$search}%");
    //                     });
    //             });
    //         })
    //         ->when($location, function ($query) use ($location) {
    //             return $query->where(function ($q) use ($location) {
    //                 $q->where('address', 'like', "%{$location}%")
    //                     ->orWhereHas('medicalCenters', function ($centerQuery) use ($location) {
    //                         $centerQuery->where('name', 'like', "%{$location}%")
    //                             ->orWhere('address', 'like', "%{$location}%");
    //                     });
    //             });
    //         })
    //         ->orderBy('name')
    //         ->paginate(10);

    //     // تأكد من أن جميع البيانات strings
    //     $totalDoctors = $doctors->total();

    //     return view('frontend.doctors-search', compact('doctors', 'search', 'location', 'date', 'totalDoctors'));
    // }

    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $location = $request->input('location', '');
        $date = $request->input('date', '');

        // البحث الأساسي عن الأطباء مع التأكد من وجود doctorProfile
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile') // فقط الأطباء الذين لديهم ملف طبي
            ->with(['doctorProfile', 'medicalCenters'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('doctorProfile', function ($profileQuery) use ($search) {
                            $profileQuery->where('specialization', 'like', "%{$search}%")
                                ->orWhere('medical_school', 'like', "%{$search}%")
                                ->orWhereJsonContains('qualifications', $search);
                        });
                });
            })
            ->when($location, function ($query) use ($location) {
                return $query->where(function ($q) use ($location) {
                    $q->where('address', 'like', "%{$location}%")
                        ->orWhereHas('medicalCenters', function ($centerQuery) use ($location) {
                            $centerQuery->where('name', 'like', "%{$location}%")
                                ->orWhere('address', 'like', "%{$location}%")
                                ->orWhere('city', 'like', "%{$location}%");
                        });
                });
            })
            ->orderBy('name')
            ->paginate(10);

        $totalDoctors = $doctors->total();
        $specialties = \App\Models\Specialty::active()->get();

        return view('frontend.doctors-search', compact('doctors', 'search', 'location', 'date', 'totalDoctors', 'specialties'));
    }

    /**
     * SEO-friendly search by city and specialty
     * Handles URLs like /doctors/dubai/cardiology
     */
    public function searchBySpecialty($city, $specialty)
    {
        // Convert URL-friendly names to readable format
        $cityName = ucfirst(str_replace('-', ' ', $city));
        $specialtyName = ucfirst(str_replace('-', ' ', $specialty));

        // Search for doctors matching the specialty and city
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($query) use ($specialtyName) {
                $query->where('specialization', 'like', "%{$specialtyName}%");
            })
            ->whereHas('medicalCenters', function ($query) use ($cityName) {
                $query->where('city', 'like', "%{$cityName}%")
                    ->orWhere('address', 'like', "%{$cityName}%");
            })
            ->with(['doctorProfile', 'medicalCenters'])
            ->orderBy('name')
            ->paginate(12);

        $totalDoctors = $doctors->total();
        $specialties = \App\Models\Specialty::active()->get();

        // SEO metadata
        $pageTitle = __('seo.doctors_in_city_specialty', [
            'specialty' => $specialtyName,
            'city' => $cityName
        ]);

        $search = $specialtyName;
        $location = $cityName;
        $date = '';

        return view('frontend.doctors-search', compact(
            'doctors',
            'search',
            'location',
            'date',
            'totalDoctors',
            'specialties',
            'pageTitle',
            'cityName',
            'specialtyName'
        ));
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
