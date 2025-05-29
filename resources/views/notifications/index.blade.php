@extends('layouts.master')
@section('title', 'Bildirişlər')

@section('content')
    <div class="dashboard">
        <div class="dashboard-body">
            <div class="notification-container">
                <div class="notification-items">
                    @foreach($notifications as $notification)
                        <button class="notification-item normal-notification "
                                data-id="{{ $notification->id }}"
                                data-title="{{ $notification->title }}"
                                data-description="{{ $notification->description }}"
                                data-link="{{ $notification->link ?? '#' }}"
                                type="button">
                            <div class="notification-left">
                                <h3>{{ $notification->title }}</h3>
                                <p>{{ $notification->description }}</p>
                                <p>{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notification->is_read)
                                <span class="notification_circle"></span>
                            @endif
                        </button>
                    @endforeach
                </div>

                <div class="notificationModal-container" style="display:none;">
                    <div class="notificationModal">
                        <button class="close_notification" type="button">✕</button>
                        <h2 id="modal-title">Bildirişin adı</h2>
                        <div class="notification-text">
                            <p id="modal-description">Bildirişin descriptionu</p>
                            <a href="#" id="modal-link">Daha ətraflı</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $('.notification-item').click(function() {
                // Get notification data from data attributes
                const notificationId = $(this).data('id');
                const notificationTitle = $(this).data('title');
                const notificationDescription = $(this).data('description');
                const notificationLink = $(this).data('link');
                const $button = $(this);

                // Fill and show modal immediately
                $('#modal-title').text(notificationTitle);
                $('#modal-description').text(notificationDescription);
                $('#modal-link').attr('href', notificationLink);
                $('.notificationModal-container').fadeIn();

                // Only send AJAX request if notification isn't read yet
                if (!$button.hasClass('readed')) {
                    $.ajax({
                        url: "{{ route('notifications.markRead') }}",
                        method: 'POST',
                        data: {
                            id: notificationId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            // Mark as read in UI
                            $button.addClass('readed');
                        },
                        error: function() {
                            console.error('Bildiriş oxunmuş kimi qeyd edilərkən xəta baş verdi.');
                        }
                    });
                }
            });

            // Close modal button
            $('.close_notification').click(function() {
                $('.notificationModal-container').fadeOut();
            });
        });
    </script>
@endpush
