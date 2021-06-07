<?php

namespace Adminetic\Announcement\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class AnnouncementNotificationBell extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $unread_notifications = Auth::user()->unreadNotifications;
        return view('announcement::admin.components.announcement-notification-bell', compact('unread_notifications'));
    }
}
