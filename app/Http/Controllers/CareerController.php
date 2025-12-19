<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareerController extends Controller
{
    // عرض جميع الوظائف (للواجهة العامة)
    public function index()
    {
        $careers = Career::where('is_active', true)
            ->where('application_deadline', '>=', now())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $departments = Career::where('is_active', true)->distinct()->pluck('department');
        $locations = Career::where('is_active', true)->distinct()->pluck('location');

        return view('frontend.careers.index', compact('careers', 'departments', 'locations'));
    }

    // عرض وظيفة محددة
    public function show($id)
    {
        $career = Career::where('is_active', true)
            ->where('application_deadline', '>=', now())
            ->findOrFail($id);

        $relatedJobs = Career::where('is_active', true)
            ->where('department', $career->department)
            ->where('id', '!=', $id)
            ->where('application_deadline', '>=', now())
            ->take(3)
            ->get();

        return view('frontend.careers.show', compact('career', 'relatedJobs'));
    }

    // ========== لوحة الإدارة ==========

    // عرض جميع الوظائف (للمسؤولين)
    public function adminIndex()
    {
        $careers = Career::with('postedBy')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.careers.index', compact('careers'));
    }

    // عرض نموذج إنشاء وظيفة جديدة
    public function create()
    {
        return view('admin.careers.create');
    }

    // حفظ وظيفة جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|in:full-time,part-time,remote,contract,internship',
            'department' => 'required|string',
            'salary_range' => 'nullable|string',
            'experience_level' => 'required|string',
            'education_level' => 'nullable|string',
            'skills' => 'nullable|array',
            'benefits' => 'nullable|array',
            'application_deadline' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $validated['posted_by'] = Auth::id();
        $validated['skills'] = json_encode($request->skills ?? []);
        $validated['benefits'] = json_encode($request->benefits ?? []);

        Career::create($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'تم إضافة الوظيفة بنجاح.');
    }

    // عرض نموذج تعديل وظيفة
    public function edit($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.careers.edit', compact('career'));
    }

    // تحديث الوظيفة
    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|in:full-time,part-time,remote,contract,internship',
            'department' => 'required|string',
            'salary_range' => 'nullable|string',
            'experience_level' => 'required|string',
            'education_level' => 'nullable|string',
            'skills' => 'nullable|array',
            'benefits' => 'nullable|array',
            'application_deadline' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $validated['skills'] = json_encode($request->skills ?? []);
        $validated['benefits'] = json_encode($request->benefits ?? []);

        $career->update($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'تم تحديث الوظيفة بنجاح.');
    }

    // حذف الوظيفة
    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('admin.careers.index')
            ->with('success', 'تم حذف الوظيفة بنجاح.');
    }

    // تغيير حالة الوظيفة (تفعيل/تعطيل)
    public function toggleStatus($id)
    {
        $career = Career::findOrFail($id);
        $career->is_active = !$career->is_active;
        $career->save();

        $status = $career->is_active ? 'مفعلة' : 'معطلة';
        return redirect()->back()->with('success', "تم $status الوظيفة.");
    }
}
