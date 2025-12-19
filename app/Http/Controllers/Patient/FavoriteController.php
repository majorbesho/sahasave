<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * عرض قائمة المفضلة للمريض
     */
    public function index(Request $request)
    {
        $patient = Auth::user();

        $favorites = Favorite::forPatient($patient->id)
            ->with([
                'doctor' => function ($q) {
                    $q->select('id', 'name', 'email', 'phone', 'photo', 'address');
                },
                'doctor.doctorProfile.specialty'
            ])
            ->orderByRecent()
            ->paginate(15);

        return view('patient.favorites.index', compact('favorites'));
    }

    /**
     * إضافة/إزالة من المفضلة (Toggle)
     */
    public function toggle(Request $request, $doctorId)
    {
        $patient = Auth::user();

        // التحقق من أن الطبيب موجود ودوره doctor
        $doctor = \App\Models\User::doctors()
            ->where('id', $doctorId)
            ->firstOrFail();

        $result = Favorite::toggle($patient->id, $doctorId);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'action' => $result['action'],
                'message' => $result['action'] === 'added'
                    ? 'تمت الإضافة للمفضلة'
                    : 'تمت الإزالة من المفضلة',
                'is_favorite' => $result['action'] === 'added',
            ]);
        }

        $message = $result['action'] === 'added'
            ? 'تمت إضافة الطبيب للمفضلة بنجاح'
            : 'تمت إزالة الطبيب من المفضلة';

        return redirect()->back()->with('success', $message);
    }

    /**
     * حذف من المفضلة
     */
    public function destroy($favoriteId)
    {
        $patient = Auth::user();

        $favorite = Favorite::forPatient($patient->id)
            ->findOrFail($favoriteId);

        $doctorName = $favorite->doctor->name;
        $favorite->delete();

        return redirect()->back()->with('success', "تم حذف {$doctorName} من المفضلة");
    }

    /**
     * تحديث ملاحظة المفضلة
     */
    public function updateNote(Request $request, $favoriteId)
    {
        $request->validate([
            'note' => 'nullable|string|max:500'
        ]);

        $patient = Auth::user();

        $favorite = Favorite::forPatient($patient->id)
            ->findOrFail($favoriteId);

        $favorite->update([
            'note' => $request->note
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الملاحظة بنجاح'
        ]);
    }

    /**
     * تفعيل/تعطيل الإشعارات
     */
    public function toggleNotifications($favoriteId)
    {
        $patient = Auth::user();

        $favorite = Favorite::forPatient($patient->id)
            ->findOrFail($favoriteId);

        $favorite->update([
            'notify_availability' => !$favorite->notify_availability
        ]);

        return response()->json([
            'success' => true,
            'notify_availability' => $favorite->notify_availability,
            'message' => $favorite->notify_availability
                ? 'تم تفعيل الإشعارات'
                : 'تم تعطيل الإشعارات'
        ]);
    }

    /**
     * تسجيل مشاهدة
     */
    public function recordView($favoriteId)
    {
        $patient = Auth::user();

        $favorite = Favorite::forPatient($patient->id)
            ->findOrFail($favoriteId);

        $favorite->recordView();

        return response()->json(['success' => true]);
    }

    /**
     * الحصول على توصيات
     */
    public function recommendations()
    {
        $patient = Auth::user();

        $recommendations = Favorite::getRecommendations($patient->id, 10);

        return view('patient.favorites.recommendations', compact('recommendations'));
    }

    /**
     * الأطباء الأكثر إضافة للمفضلة
     */
    public function popular()
    {
        $popularDoctors = Favorite::mostFavorited(20);

        return view('patient.favorites.popular', compact('popularDoctors'));
    }

    /**
     * التحقق من وجود في المفضلة
     */
    public function check($doctorId)
    {
        $patient = Auth::user();

        $isFavorite = Favorite::exists($patient->id, $doctorId);

        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}
