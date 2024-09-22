
@extends('DriverPannel.app')

@section('title', 'Chat with Admin')
<meta name="csrf-token" content="{{ csrf_token() }}"> 

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chat with Admin</h5>
                    <div id="chat-container" class="chat-box">
                        <div id="messages" class="d-flex flex-column">
                            <!-- Messages will be populated here -->
                        </div>
                        <form id="message-form" class="input-group mt-3">
                            <input type="text" name="message" id="message-input" required placeholder="Type your message here..." class="form-control">
                            <button type="submit" class="btn btn-danger">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const receiverId = {{ $adminId }}; 
    const messagesContainer = document.getElementById('messages');

    function fetchMessages() {
        fetch(`/driver/messages/${receiverId}`)
            .then(response => response.json())
            .then(data => {
                messagesContainer.innerHTML = '';
                data.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = message.message; 
                    messagesContainer.appendChild(messageElement);
                    if (message.sender_id === receiverId) {
                        messageElement.classList.add('message', 'received'); // Add classes for received messages
                    } else {
                        messageElement.classList.add('message', 'sent'); // Add classes for sent messages
                }
                });
            });
    }

    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const messageInput = document.getElementById('message-input');
        
        fetch('/driver/messages/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                message: messageInput.value
            })
        }).then(response => {
            if (response.ok) {
                messageInput.value = ''; 
                fetchMessages(); 
            }
        });
    });

   
    setInterval(fetchMessages, 5000); 
    fetchMessages(); 
</script> 
<style>
    .chat-box {
   background-color: white;
   border-radius: 10px;
   padding: 20px; /* Add padding for a nicer look */
   max-height: 500px; /* Set a maximum height for the chat box */
   overflow-y: auto; /* Enable scrolling */
}

.message {
   padding: 10px 15px; /* Add some padding on the sides */
   border-radius: 20px;
   margin-bottom: 10px;
   position: relative;
   word-wrap: break-word;
   max-width: 70%; /* Maximum width for the message balloons */
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.sent {
   background-color: rgba(166, 133, 127, 0.589); 
   align-self: flex-end;
   margin-left: auto;
   font-weight: bold;
   color: black;
   text-align: left; /* Align text to the left */
}

.received {
   background-color: rgba(166, 133, 127, 0.189); /* White for received messages */
   align-self: flex-start;
   text-align: left;
   font-weight: bold;
   color: black; /* Align text to the left */
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

small {
   display: block;
   color: #ff0; /* Light gray for timestamps */
   font-size: 0.8em;
}

   </style>
@endsection
