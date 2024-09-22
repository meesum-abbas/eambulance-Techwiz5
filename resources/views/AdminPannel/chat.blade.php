@extends('AdminPannel.app')

@section('title', 'Chat with Driver')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chat with {{ $driver->name }}</h5>
                    <div id="chat-box" class="chat-box border p-3 mb-3" style="height: 300px; overflow-y: auto;">
                        <!-- Chat messages will be appended here -->
                    </div>
                    <div class="input-group">
                        <input type="text" id="message-input" class="form-control" placeholder="Type a message..." />
                        <button id="send-button" class="btn btn-danger">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const receiverId = {{ $driver->id }};
    
    document.getElementById('send-button').addEventListener('click', function() {
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value;

        if (message.trim() === '') return;

        fetch('{{ route('messages.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                message: message,
            }),
        }).then(response => response.json())
          .then(data => {
              const date = new Date(data.created_at);
              const formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
              document.getElementById('chat-box').innerHTML += `<div class="message sent">${data.message}</div>`;
              messageInput.value = '';
          });
    });

    function fetchMessages() {
        fetch(`{{ route('messages.fetch', '') }}/${receiverId}`)
            .then(response => response.json())
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';
                data.forEach(msg => {
                    const alignment = msg.sender_id === {{ Auth::id() }} ? 'sent' : 'received';
                    const date = new Date(msg.created_at);
                    const formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    chatBox.innerHTML += `<div class="message ${alignment}">${msg.message}<br><small id="sendtime">${formattedTime}</small></div>`;
                });
            });
    }

    setInterval(fetchMessages, 1000);
</script>
<style>
    .chat-box {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 10px;
    }

    .message {
        padding: 10px;
        border-radius: 20px;
        margin-bottom: 10px;
        position: relative;
        word-wrap: break-word;
        max-width: 30%;
        /* Maximum width for the message balloons */
    }

    .sent {
        background-color: rgba(166, 133, 127, 0.589);
        align-self: flex-end;
        margin-left: auto;
        font-weight: bold;
        color: black;
        text-align: left;
        /* Align text to the left */
    }

    .received {
        background-color: rgba(166, 133, 127, 0.189);
        /* White for received messages */
        align-self: flex-start;
        text-align: left;
        font-weight: bold;
        color: black;
        /* Align text to the left */
    }

    .input-group {
        margin-top: 10px;
    }

    .input-group .form-control {
        border-radius: 20px 0 0 20px;
    }

    .input-group .btn {
        border-radius: 0 20px 20px 0;
    }

    #sendtime {
        justify-content: left;
    }

    small {
        display: block;
        color: gray;
        /* Light gray for timestamps */
        font-size: 0.8em;
    }
</style>
@endsection