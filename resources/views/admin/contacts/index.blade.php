<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .unread-row td {
            background: #FFF8F0 !important;
            font-weight: 500;
        }

        .badge-unread {
            background: #B23A48;
            color: #fff;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .badge-read {
            background: #E8F5E9;
            color: #2E7D32;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    @include('layouts.sidebar')

    <main class="main">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h1 class="page-title">Contact Messages</h1>
                <p class="page-sub mb-0">
                    Inbox from the public contact form — @if ($unreadCount)
                        <span style="color:#B23A48;font-weight:600;">{{ $unreadCount }} unread</span>
                    @else
                        all caught up
                    @endif
                </p>
            </div>
            <a href="{{ route('admin.contacts.settings') }}" class="btn-primary-admin">
                <i class="fa-solid fa-gear me-1"></i> Edit Contact Details
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="alert alert-success alert-dismissible d-none" role="alert" id="success-message">
            <span id="success-text"></span>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email / Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ $msg->is_read ? '' : 'unread-row' }}">
                            <td class="index">{{ $messages->firstItem() + $loop->index }}</td>
                            <td style="font-weight:600;">{{ $msg->name }}</td>
                            <td>
                                <div style="font-size:13px;">{{ $msg->email }}</div>
                                @if ($msg->phone)
                                    <div style="font-size:11.5px;color:#8A7460;">{{ $msg->phone }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($msg->subject)
                                    <span
                                        style="background:#FBF3E4;border:1px solid #EDE3D4;padding:3px 8px;border-radius:20px;font-size:12px;text-transform:capitalize;">{{ $msg->subject }}</span>
                                @else
                                    <span style="color:#B8A489;">—</span>
                                @endif
                            </td>
                            <td style="max-width:220px;">
                                <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:13px;color:#3A2519;"
                                    title="{{ $msg->message }}">
                                    {{ \Illuminate\Support\Str::limit($msg->message, 55) }}
                                </div>
                            </td>
                            <td>
                                @if ($msg->is_read)
                                    <span class="badge-read"><i class="fa-solid fa-check me-1"></i> Read</span>
                                @else
                                    <span class="badge-unread"><i class="fa-solid fa-circle me-1"
                                            style="font-size:7px;"></i> New</span>
                                @endif
                            </td>
                            <td style="font-size:12.5px;white-space:nowrap;">
                                {{ $msg->created_at->format('d M Y, h:i A') }}</td>
                            <td style="white-space:nowrap;">
                                <a href="{{ route('admin.contacts.show', $msg) }}" class="action-btn edit"
                                    title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.contacts.toggleRead', $msg) }}"
                                    style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-btn edit"
                                        style="background:{{ $msg->is_read ? '#E8F5E9' : '#FEF3E2' }};color:{{ $msg->is_read ? '#388E3C' : '#C98B2E' }};"
                                        title="{{ $msg->is_read ? 'Mark unread' : 'Mark read' }}">
                                        <i
                                            class="fa-solid {{ $msg->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}"
                                    style="display:inline;" class="delete-form"
                                    onsubmit="return confirm('Delete this message permanently?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;color:#8A7460;padding:36px;">
                                <i class="fa-solid fa-inbox"
                                    style="font-size:22px;display:block;margin-bottom:8px;"></i>
                                No messages yet. Messages from the contact form will appear here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($messages->hasPages())
            <div class="mt-3">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-form').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr("action"),
                    type: "post",
                    data: form.serialize(),
                    success: function(response) {
                        form.closest('tr').remove();
                        $('#success-text').text(response.message);
                        $("#success-message").removeClass("d-none");
                        $('.index').each(function(index) {
                            $(this).text(index + 1);
                        });

                    }
                });
            });
        });
    </script>
</body>

</html>
