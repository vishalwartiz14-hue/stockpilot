@extends('layouts.app')

@section('content')

<div class="chat-wrapper">

    <div class="chat-card">

        <div class="chat-header">
            🤖 Laravel AI Assistant
        </div>

        <div id="chat-box" class="chat-box"></div>

        <div class="chat-input-area">

            <input
                type="text"
                id="message"
                placeholder="Ask something..."
                class="chat-input"
            >

            <button onclick="sendMessage()" class="send-btn">
                ➤
            </button>

        </div>

    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>

/* Background */
.chat-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: Arial, sans-serif;
}

/* Card */
.chat-card {
    width: 420px;
    height: 600px;
    background: #fff;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

/* Header */
.chat-header {
    background: #4f46e5;
    color: white;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}

/* Chat box */
.chat-box {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    background: #f9fafb;
}

/* Messages */
.msg {
    padding: 10px 14px;
    margin: 8px 0;
    border-radius: 12px;
    max-width: 80%;
    word-wrap: break-word;
}

.user {
    background: #4f46e5;
    color: white;
    margin-left: auto;
    text-align: right;
}

.bot {
    background: #e5e7eb;
    color: #111;
    margin-right: auto;
}

/* Input area */
.chat-input-area {
    display: flex;
    padding: 10px;
    border-top: 1px solid #ddd;
    background: white;
}

.chat-input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
}

.send-btn {
    margin-left: 8px;
    background: #4f46e5;
    color: white;
    border: none;
    padding: 10px 14px;
    border-radius: 10px;
    cursor: pointer;
}

.send-btn:hover {
    background: #4338ca;
}

</style>

<script>

async function sendMessage() {

    let input = document.getElementById('message');
    let message = input.value;

    if (!message.trim()) return;

    let chatBox = document.getElementById('chat-box');

    // User message
    chatBox.innerHTML += `
        <div class="msg user">${message}</div>
    `;

    input.value = '';

    chatBox.scrollTop = chatBox.scrollHeight;

    try {

        let response = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message })
        });

        let data = await response.json();

        // Bot message
        chatBox.innerHTML += `
            <div class="msg bot">${data.reply}</div>
        `;

        chatBox.scrollTop = chatBox.scrollHeight;

    } catch (error) {

        chatBox.innerHTML += `
            <div class="msg bot" style="color:red;">
                Error connecting to AI server
            </div>
        `;
    }
}

</script>

@endsection