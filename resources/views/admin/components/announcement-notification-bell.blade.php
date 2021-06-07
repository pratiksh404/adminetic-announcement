    <li class="onhover-dropdown">
        <div class="notification-box"><i data-feather="bell"> </i><span
                class="badge rounded-pill badge-secondary">{{ $unread_notifications->count() }}
            </span></div>
        <ul class="notification-dropdown onhover-show-div">
            <li><i data-feather="bell"></i>
                <h6 class="f-18 mb-0">Announcements</h6>
            </li>
            @if (isset($unread_notifications))
                @foreach ($unread_notifications as $unread_notification)
                    <li>
                        <a
                            href="{{ adminShowRoute($unread_notification->data['model'], $unread_notification->data['id']) }}">
                            <p><i class="fa fa-circle-o me-3 font-primary"> </i>By
                                <b>{{ $unread_notification->data['announcement_by'] }}</b>
                                <span class="pull-right">{{ $unread_notification->data['date_time'] }}</span>
                            </p>
                        </a>
                    </li>
                @endforeach
            @else
                <li>
                    <p><i class="fa fa-circle-o me-3 font-primary"> </i>No Announcement Yet</p>
                </li>
            @endif
            <li><a class="btn btn-primary" href="{{ adminRedirectRoute('timeline') }}">Check all announcements</a>
            </li>
        </ul>
    </li>
