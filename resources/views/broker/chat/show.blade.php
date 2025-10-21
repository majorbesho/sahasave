@extends('broker.chat.index')

@section('chat-content')
    <div id="chat-messages" style="height: 400px; overflow-y: auto;">
        @foreach ($messages as $msg)
            <div class="chats {{ $msg->sender_type === auth()->getDefaultDriver() ? 'chats-right' : '' }}">
                <div class="chat-content">
                    <p>{{ $msg->message }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <form id="chat-form" action="{{ route('broker.chat.send') }}" method="POST">
        @csrf
        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
        <input type="text" name="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>
@endsection

@section('scripts')
    <script src="https://js.pusher.com/7.2/pusher.min.js "></script>
    <script>
        const userId = "{{ auth()->id() }}";
        const guard = "{{ auth()->getDefaultDriver() }}";

        // إعداد Pusher
        const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            encrypted: true
        });

        // الانضمام إلى قناة المحادثة
        const channel = pusher.subscribe('private-chat.{{ $conversation->id }}');
        channel.bind('message.sent', function(data) {
            const msg = data.message;

            let html = `
            <div class="chats ${msg.sender_type === guard ? 'chats-right' : ''}">
                <div class="chat-content">
                    <p>${msg.message}</p>
                </div>
            </div>
        `;

            $('#chat-messages').append(html);
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        });

        // إرسال الرسالة عبر AJAX
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            $.post("{{ route('broker.chat.send') }}", $(this).serialize(), function() {
                $('#chat-form input[name=message]').val('');
            });
        });
    </script>
@endsection
