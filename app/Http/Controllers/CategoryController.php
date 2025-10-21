<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $categories = Category::featured()
            ->active()
            ->orderBy('sort_order')
            ->get();

        return view('frontend.home', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['doctors.doctorProfile', 'medicalCenters'])
            ->firstOrFail();

        $doctors = $category->doctors()->paginate(12);
        $medicalCenters = $category->medicalCenters()->paginate(12);

        return view('frontend.categories.show', compact('category', 'doctors', 'medicalCenters'));
    }

    public function doctors($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $doctors = $category->doctors()
            ->with('doctorProfile')
            ->paginate(12);

        return view('frontend.categories.doctors', compact('category', 'doctors'));
    }

    public function medicalCenters($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $medicalCenters = $category->medicalCenters()->paginate(12);

        return view('frontend.categories.medical-centers', compact('category', 'medicalCenters'));
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
