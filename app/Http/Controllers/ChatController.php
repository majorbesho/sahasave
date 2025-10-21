<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        $userType = auth()->guard()->getName(); // broker, carrier...
        $userId = auth()->id();

        $conversations = Conversation::where(function ($q) use ($userId, $userType) {
            $q->where('sender_id', $userId)
                ->where('sender_type', $userType);
        })
            ->orWhere(function ($q) use ($userId, $userType) {
                $q->where('receiver_id', $userId)
                    ->where('receiver_type', $userType);
            })
            ->with(['messages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return view('broker.chat.index', compact('conversations'));
    }

    public function show($id)
    {
        $conversation = Conversation::with(['sender', 'receiver', 'messages' => function ($query) {
            $query->latest();
        }])->findOrFail($id);

        // تحديث حالة الرسائل كمقروءة
        Message::where('conversation_id', $id)
            ->where('sender_id', '!=', auth()->id())
            ->where('read', false)
            ->update(['read' => true]);

        $messages = $conversation->messages->sortBy('created_at');

        return view('broker.chat.index', [
            'conversations' => $this->index()->getData()['conversations'],
            'conversation' => $conversation,
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'nullable|string',
            'attachment' => 'nullable|file',
        ]);

        $userType = auth()->guard()->getName();
        $userId = auth()->id();

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => $userId,
            'sender_type' => $userType,
            'message' => $request->message,
            'attachment' => $request->hasFile('attachment') ?
                $request->file('attachment')->store('chat_attachments') : null,
        ]);

        return back();
    }

    public function startChat(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'receiver_type' => 'required|in:broker,carrier,shipper,admin',
        ]);

        $userType = auth()->guard()->getName();
        $userId = auth()->id();

        // البحث عن محادثة موجودة أو إنشاء جديدة
        $conversation = Conversation::where(function ($q) use ($userId, $userType, $request) {
            $q->where('sender_id', $userId)
                ->where('sender_type', $userType)
                ->where('receiver_id', $request->receiver_id)
                ->where('receiver_type', $request->receiver_type);
        })
            ->orWhere(function ($q) use ($userId, $userType, $request) {
                $q->where('sender_id', $request->receiver_id)
                    ->where('sender_type', $request->receiver_type)
                    ->where('receiver_id', $userId)
                    ->where('receiver_type', $userType);
            })
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $userId,
                'sender_type' => $userType,
                'receiver_id' => $request->receiver_id,
                'receiver_type' => $request->receiver_type,
            ]);
        }

        return redirect()->route('broker.chat.show', $conversation->id);
    }

    public function getUsers($type)
    {
        try {
            $model = match ($type) {
                'broker' => \App\Models\Broker::class,
                'carrier' => \App\Models\Carrier::class,
                'shipper' => \App\Models\Shipper::class,
                'admin' => \App\Models\Admin::class,
                default => null,
            };

            if (!$model) {
                return response()->json([], 404);
            }

            $users = $model::select('id', 'name')
                ->where('id', '!=', auth()->id()) // استثناء المستخدم الحالي
                ->get();

            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function markAsRead(Request $request)
    {
        Message::where('conversation_id', $request->conversation_id)
            ->where('sender_id', '!=', auth()->id())
            ->where('read', false)
            ->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}

    // // عرض قائمة المحادثات
    // public function index()
    // {
    //     $guard = auth()->getDefaultDriver();
    //     $userId = auth($guard)->id();

    //     $conversations = Conversation::where(function ($q) use ($userId, $guard) {
    //         $q->where('sender_id', $userId)
    //             ->where('sender_type', $guard);
    //     })
    //         ->orWhere(function ($q) use ($userId, $guard) {
    //             $q->where('receiver_id', $userId)
    //                 ->where('receiver_type', $guard);
    //         })
    //         ->with('messages')
    //         ->latest()
    //         ->get();

    //     return view('broker.chat.index', compact('conversations'));
    // }

    // عرض محتوى المحادثة
    // public function show(Conversation $conversation)
    // {
    //     $guard = auth()->getDefaultDriver();
    //     $userId = auth($guard)->id();

    //     // التأكد من أن المحادثة تخص هذا المستخدم
    //     if (
    //         ($conversation->sender_type === $guard && $conversation->sender_id == $userId) ||
    //         ($conversation->receiver_type === $guard && $conversation->receiver_id == $userId)
    //     ) {
    //         $messages = $conversation->messages->sortBy('created_at');

    //         return view('broker.chat.show', compact('conversation', 'messages'));
    //     }

    //     return abort(403);
    // }

    // إرسال رسالة جديدة
//     public function store(Request $request)
//     {
//         $request->validate([
//             'conversation_id' => 'required|exists:conversations,id',
//             'message' => 'nullable|string',
//         ]);

//         $guard = auth()->getDefaultDriver();
//         $userId = auth($guard)->id();

//         $message = Message::create([
//             'conversation_id' => $request->conversation_id,
//             'sender_id' => $userId,
//             'sender_type' => $guard,
//             'message' => $request->message,
//         ]);

//         broadcast(new \App\Events\MessageSent($message, $message->conversation_id))->toOthers();

//         return response(['status' => 'sent']);
//     }
// }
