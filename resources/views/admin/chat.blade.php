@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Live Chat
                    </h2>
                    <div class="text-muted mt-1">Connect with users and artists</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="newChatBtn">
                            <i class="ti ti-plus me-2"></i>
                            New Conversation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <!-- Chat list sidebar -->
                    <div class="col-12 col-lg-4 col-xl-3 border-end">
                        <div class="card-body p-0">
                            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0">Conversations</h3>
                                <div class="ms-auto">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="ti ti-filter me-1"></i>Filter
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">All</a>
                                            <a class="dropdown-item" href="#">Unread</a>
                                            <a class="dropdown-item" href="#">Artists</a>
                                            <a class="dropdown-item" href="#">Cover Creators</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-search px-3 py-2">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search conversations...">
                                </div>
                            </div>
                            <div class="chat-list-wrapper" style="height: calc(100vh - 300px); overflow-y: auto;">
                                <div class="list-group list-group-flush">
                                    @php
                                        $users = [
                                            ['id' => 1, 'name' => 'John Doe', 'role' => 'Artist', 'avatar' => 'https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff', 'online' => true, 'unread' => 3, 'last_message' => 'Hey, I just released a new song!', 'time' => '2m ago'],
                                            ['id' => 2, 'name' => 'Jane Smith', 'role' => 'Cover Creator', 'avatar' => 'https://ui-avatars.com/api/?name=Jane+Smith&background=4caf50&color=fff', 'online' => true, 'unread' => 0, 'last_message' => 'I\'d like to cover your latest track', 'time' => '15m ago'],
                                            ['id' => 3, 'name' => 'Mike Johnson', 'role' => 'Composer', 'avatar' => 'https://ui-avatars.com/api/?name=Mike+Johnson&background=2196f3&color=fff', 'online' => false, 'unread' => 0, 'last_message' => 'The arrangement looks great!', 'time' => '1h ago'],
                                            ['id' => 4, 'name' => 'Sarah Williams', 'role' => 'User', 'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Williams&background=9c27b0&color=fff', 'online' => false, 'unread' => 1, 'last_message' => 'I love your music!', 'time' => '3h ago'],
                                            ['id' => 5, 'name' => 'David Brown', 'role' => 'Artist', 'avatar' => 'https://ui-avatars.com/api/?name=David+Brown&background=ff9800&color=fff', 'online' => true, 'unread' => 0, 'last_message' => 'Let\'s collaborate on the next album', 'time' => '5h ago'],
                                        ];
                                        
                                        for ($i = 0; $i < 5; $i++) {
                                            $user = $users[$i];
                                            $activeClass = $i === 0 ? 'active bg-light' : '';
                                    @endphp
                                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center {{ $activeClass }}" data-user-id="{{ $user['id'] }}">
                                        <div class="position-relative me-3">
                                            <span class="avatar" style="background-image: url({{ $user['avatar'] }})"></span>
                                            @if($user['online'])
                                                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" style="width: 10px; height: 10px;"></span>
                                            @endif
                                        </div>
                                        <div class="flex-fill text-truncate">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="text-body d-block mb-0 fs-5">{{ $user['name'] }}</h4>
                                                <span class="text-muted fs-sm">{{ $user['time'] }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted text-truncate">{{ $user['last_message'] }}</span>
                                                @if($user['unread'] > 0)
                                                    <span class="badge bg-primary rounded-pill">{{ $user['unread'] }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="badge bg-{{ $user['role'] === 'Artist' ? 'danger' : ($user['role'] === 'Cover Creator' ? 'success' : ($user['role'] === 'Composer' ? 'info' : 'secondary')) }} text-white fs-sm">
                                                    {{ $user['role'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                    @php
                                        }
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chat content -->
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="card-body d-flex flex-column" style="height: calc(100vh - 200px);">
                            <!-- Chat header -->
                            <div class="chat-header border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        <span class="avatar avatar-md" style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"></span>
                                        <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" style="width: 10px; height: 10px;"></span>
                                    </div>
                                    <div>
                                        <h3 class="mb-0">John Doe</h3>
                                        <div class="text-muted">
                                            <span class="badge bg-danger text-white">Artist</span>
                                            <span class="ms-2">Online</span>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="btn-list">
                                            <a href="#" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="tooltip" title="Voice call">
                                                <i class="ti ti-phone"></i>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="tooltip" title="Video call">
                                                <i class="ti ti-video"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="ti ti-user me-2"></i>View profile
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="ti ti-archive me-2"></i>Archive chat
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="ti ti-bell-off me-2"></i>Mute notifications
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">
                                                        <i class="ti ti-trash me-2"></i>Delete chat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat messages -->
                            <div class="chat-messages p-3 flex-fill" style="overflow-y: auto; background-color: #f8f9fa;">
                                @php
                                    $messages = [
                                        ['sender' => 'other', 'content' => 'Hi there! I just released a new song and wanted to get your feedback.', 'time' => '10:05 AM'],
                                        ['sender' => 'me', 'content' => 'Hey John! That sounds great. What genre is it?', 'time' => '10:07 AM'],
                                        ['sender' => 'other', 'content' => 'It\'s a mix of pop and electronic. I\'ve been experimenting with some new sounds.', 'time' => '10:09 AM'],
                                        ['sender' => 'me', 'content' => 'Awesome! I\'d love to hear it. Can you share a preview?', 'time' => '10:12 AM'],
                                        ['sender' => 'other', 'content' => 'Sure! Here\'s a link to the preview:', 'time' => '10:15 AM'],
                                        ['sender' => 'other', 'content' => 'https://example.com/song-preview', 'time' => '10:15 AM', 'has_attachment' => true, 'attachment_type' => 'audio'],
                                        ['sender' => 'me', 'content' => 'This sounds amazing! The production quality is top-notch. I especially like the bridge section.', 'time' => '10:20 AM'],
                                        ['sender' => 'other', 'content' => 'Thanks! I spent a lot of time on that part. Do you think it\'s ready for release?', 'time' => '10:22 AM'],
                                        ['sender' => 'me', 'content' => 'Absolutely! Your fans will love it. When are you planning to release it?', 'time' => '10:25 AM'],
                                        ['sender' => 'other', 'content' => 'I\'m thinking next Friday. I\'ll be promoting it on social media starting tomorrow.', 'time' => '10:28 AM'],
                                    ];
                                    
                                    foreach ($messages as $message) {
                                        $isMe = $message['sender'] === 'me';
                                        $hasAttachment = isset($message['has_attachment']) && $message['has_attachment'];
                                @endphp
                                <div class="message {{ $isMe ? 'message-out' : '' }} mb-3">
                                    <div class="d-flex {{ $isMe ? 'justify-content-end' : '' }}">
                                        @if(!$isMe)
                                            <span class="avatar avatar-sm me-2" style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"></span>
                                        @endif
                                        <div>
                                            <div class="message-content p-3 rounded-3 {{ $isMe ? 'bg-primary text-white' : 'bg-white border' }}" style="max-width: 80%;">
                                                <div>{{ $message['content'] }}</div>
                                                
                                                @if($hasAttachment)
                                                    <div class="mt-2">
                                                        @if($message['attachment_type'] === 'audio')
                                                            <div class="d-flex align-items-center p-2 rounded bg-{{ $isMe ? 'light text-dark' : 'light' }}">
                                                                <i class="ti ti-music me-2"></i>
                                                                <div class="flex-fill">
                                                                    <div class="fw-bold">New Song Preview.mp3</div>
                                                                    <div class="text-muted small">3:45 • 4.2 MB</div>
                                                                </div>
                                                                <a href="#" class="btn btn-sm btn-icon btn-ghost-{{ $isMe ? 'light' : 'secondary' }}">
                                                                    <i class="ti ti-player-play"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-sm btn-icon btn-ghost-{{ $isMe ? 'light' : 'secondary' }}">
                                                                    <i class="ti ti-download"></i>
                                                                </a>
                                                                                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-muted small {{ $isMe ? 'text-end' : '' }} mt-1">{{ $message['time'] }}</div>
                                        </div>
                                        @if($isMe)
                                            <span class="avatar avatar-sm ms-2" style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff)"></span>
                                        @endif
                                    </div>
                                </div>
                                @php
                                    }
                                @endphp
                                
                                <!-- Typing indicator -->
                                <div class="message mb-3">
                                    <div class="d-flex">
                                        <span class="avatar avatar-sm me-2" style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"></span>
                                        <div class="message-content p-3 rounded-3 bg-white border">
                                            <div class="typing-indicator">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat input -->
                            <div class="chat-input mt-auto pt-3 border-top">
                                <form id="chat-form">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="tooltip" title="Attach file">
                                            <i class="ti ti-paperclip"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="tooltip" title="Record audio">
                                            <i class="ti ti-microphone"></i>
                                        </button>
                                        <input type="text" class="form-control" placeholder="Type a message..." id="message-input">
                                        <button type="button" class="btn btn-icon btn-ghost-secondary" data-bs-toggle="tooltip" title="Emoji">
                                            <i class="ti ti-mood-smile"></i>
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-send me-1"></i>
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<style>
    /* Typing indicator animation */
    .typing-indicator {
        display: flex;
        align-items: center;
    }
    
    .typing-indicator span {
        height: 8px;
        width: 8px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        animation: typing 1.4s infinite ease-in-out both;
    }
    
    .typing-indicator span:nth-child(1) {
        animation-delay: 0s;
    }
    
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes typing {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
    
    /* Chat message styling */
    .message-content {
        display: inline-block;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .message-out .message-content {
        border-bottom-right-radius: 0 !important;
    }
    
    .message:not(.message-out) .message-content {
        border-bottom-left-radius: 0 !important;
    }
    
    /* Chat list hover effect */
    .list-group-item:hover {
        background-color: rgba(var(--tblr-primary-rgb), 0.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll to bottom of chat messages
        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Handle sending new messages
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const messageText = messageInput.value.trim();
            if (messageText) {
                // Create new message element
                const now = new Date();
                const timeString = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();
                
                const messageHtml = `
                    <div class="message message-out mb-3">
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="message-content p-3 rounded-3 bg-primary text-white">
                                    <div>${messageText}</div>
                                </div>
                                <div class="text-muted small text-end mt-1">${timeString}</div>
                            </div>
                            <span class="avatar avatar-sm ms-2" style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff)"></span>
                        </div>
                    </div>
                `;
                
                // Insert message before typing indicator
                const typingIndicator = document.querySelector('.typing-indicator').closest('.message');
                typingIndicator.insertAdjacentHTML('beforebegin', messageHtml);
                
                // Clear input and scroll to bottom
                messageInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Simulate response after 2 seconds
                setTimeout(function() {
                    // Hide typing indicator
                    typingIndicator.style.display = 'none';
                    
                    // Create response message
                    const responseHtml = `
                        <div class="message mb-3">
                            <div class="d-flex">
                                <span class="avatar avatar-sm me-2" style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"></span>
                                <div>
                                    <div class="message-content p-3 rounded-3 bg-white border">
                                        <div>Thanks for your message! I'll get back to you soon.</div>
                                    </div>
                                    <div class="text-muted small mt-1">${timeString}</div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    // Add response and show typing indicator again
                    chatMessages.insertAdjacentHTML('beforeend', responseHtml);
                    typingIndicator.style.display = 'block';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 2000);
            }
        });
        
        // Handle chat list item clicks
        const chatListItems = document.querySelectorAll('.list-group-item');
        chatListItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all items
                chatListItems.forEach(i => i.classList.remove('active', 'bg-light'));
                
                // Add active class to clicked item
                this.classList.add('active', 'bg-light');
                
                // If this were a real app, we would load the conversation here
                // For demo purposes, we'll just show a loading message
                
                Swal.fire({
                    title: 'Loading conversation...',
                    text: 'This would load the conversation with ' + this.querySelector('h4').textContent,
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
        
        // New conversation button
        const newChatBtn = document.getElementById('newChatBtn');
        if (newChatBtn) {
            newChatBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Start New Conversation',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Select User</label>
                            <select id="user-select" class="form-select">
                                <option value="">Select a user...</option>
                                <option value="1">Emma Wilson (Artist)</option>
                                <option value="2">Robert Chen (Cover Creator)</option>
                                <option value="3">Olivia Martinez (Composer)</option>
                                <option value="4">James Taylor (User)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea id="initial-message" class="form-control" rows="3" placeholder="Type your first message..."></textarea>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Start Chat',
                    confirmButtonColor: '#e53935',
                    focusConfirm: false,
                    preConfirm: () => {
                        const user = document.getElementById('user-select').value;
                        const message = document.getElementById('initial-message').value;
                        
                        if (!user) {
                            Swal.showValidationMessage('Please select a user');
                            return false;
                        }
                        
                        if (!message.trim()) {
                            Swal.showValidationMessage('Please enter a message');
                            return false;
                        }
                        
                        return { user, message };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Conversation Started!',
                            text: 'Your message has been sent.',
                            confirmButtonColor: '#e53935',
                        });
                    }
                });
            });
        }
    });
</script>
@endsection

