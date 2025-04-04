<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de Primeros Auxilios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .chat-container {
            width: 80%;
            margin: 0 auto;
            max-width: 600px;
        }
        .chat-box {
            border: 1px solid #ccc;
            padding: 20px;
            height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 15px;
        }
        .user-message {
            color: blue;
        }
        .bot-message {
            color: green;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="chat-container">
        <h2>Asistente Virtual de Primeros Auxilios</h2>
        <div class="chat-box" id="chat-box"></div>
        <input type="text" id="user-message" placeholder="Escribe tu pregunta sobre primeros auxilios..." />
    </div>

    <script>
        document.getElementById('user-message').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                let userMessage = this.value.trim();
                if (userMessage === "") return;

                let chatBox = document.getElementById('chat-box');
                chatBox.innerHTML += `<div class="message user-message">${userMessage}</div>`;
                this.value = "";

                // Obtener el token CSRF desde la meta etiqueta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Enviar mensaje al servidor
                fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        message: userMessage
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json();
                })
                .then(data => {
                    chatBox.innerHTML += `<div class="message bot-message">${data.reply}</div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    chatBox.innerHTML += `<div class="message bot-message">Error: ${error.message}</div>`;
                });
            }
        });
    </script>
</body>
</html>
99
