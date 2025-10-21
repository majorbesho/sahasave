@extends('frontend.layouts.master')


@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .messages {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
            background: #f9f9f9;
        }

        .message.sender {
            background: #e3f2fd;
            text-align: left;
        }

        .message.receiver {
            background: #f5f5f5;
            text-align: right;
        }

        .message-input {
            display: flex;
            gap: 10px;
        }

        .message-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .message-input button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message-input button:hover {
            background: #0056b3;
        }
    </style>

    <div class="chat-container">
        <h1>Chat</h1>
        <div class="messages" id="messages">
            @foreach ($chat->messages as $message)
                <div class="message {{ $message->sender_type === 'App\Models\ShipmentOwner' ? 'sender' : 'receiver' }}">
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>
        <div class="message-input">
            <input type="text" id="message-input" placeholder=" Your Message ...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        const chatId = {{ $chat->id }};
        const senderId = 1; //
        const senderType = 'App\Models\shipment_owners'; //

        function sendMessage() {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;

            if (message.trim() === '') return;

            fetch(`/chat/${chatId}/send`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        sender_id: senderId,
                        sender_type: senderType,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const messagesDiv = document.getElementById('messages');
                    const newMessage = document.createElement('div');
                    newMessage.className =
                        `message ${senderType === 'App\Models\shipment_owners' ? 'sender' : 'receiver'}`;
                    newMessage.innerHTML = `<strong>${data.message.sender.name}:</strong> ${data.message.message}`;
                    messagesDiv.appendChild(newMessage);
                    messageInput.value = '';
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                });
        }
    </script>
@endsection
