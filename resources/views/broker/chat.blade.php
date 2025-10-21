@foreach ($messages as $message)
    <div class="chats {{ $message->sender_type === auth()->guard()->getName() ? 'chats-right' : '' }}">
        <div class="chat-avatar">
            <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}" alt="image">
        </div>
        <div class="chat-content">
            <div class="message-content">{{ $message->message }}</div>
        </div>
    </div>
@endforeach

<form action="{{ route('broker.chat.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">

    <div class="chat-footer">
        <input type="text" name="message" placeholder="Type your message...">
        <input type="file" name="attachment">
        <button type="submit">Send</button>
    </div>
</form>
