<?php

namespace Adminetic\Announcement\Traits;

trait AnnouncementUser
{
    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('announcement.slack_webhook');
    }
}