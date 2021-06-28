<?php

namespace Adminetic\Announcement\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Adminetic\Announcement\Events\AnnouncementMadeEvent;
use Adminetic\Announcement\Notifications\AnnouncementNotification;
use Adminetic\Announcement\Notifications\SlackAnnouncementNotification;

class AnnouncementMadeListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AnnouncementMadeEvent $event)
    {
        if (isset($event->announcement)) {
            $audiences  = User::find($event->announcement->audience);
            Notification::send($audiences, new AnnouncementNotification($event->announcement));
            if ($event->announcement->slack_notify) {
                $audiences->first()->setSlackUrl(env('SLACK_WEBHOOK', null))->notify(new SlackAnnouncementNotification($event->announcement));
            }
        }
    }
}
