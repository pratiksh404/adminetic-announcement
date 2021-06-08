<?php

namespace Adminetic\Announcement\Repositories;

use Adminetic\Announcement\Contracts\AnnouncementRepositoryInterface;
use Adminetic\Announcement\Http\Requests\AnnouncementRequest;
use Adminetic\Announcement\Models\Admin\Announcement;
use Adminetic\Announcement\Notifications\AnnouncementNotification;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    // Announcement Index
    public function indexAnnouncement()
    {
        $announcements = config('coderz.caching', true)
            ? (Cache::has('announcements') ? Cache::get('announcements') : Cache::rememberForever('announcements', function () {
                return Announcement::latest()->get();
            }))
            : Announcement::latest()->get();

        return compact('announcements');
    }

    // Announcement Create
    public function createAnnouncement()
    {
        $users = User::all();

        return compact('users');
    }

    // Announcement Store
    public function storeAnnouncement(AnnouncementRequest $request)
    {
        $announcement = Announcement::create($request->validated());
        // Sending Notification
        $audiences = User::find($announcement->audience);
        Notification::send($audiences, new AnnouncementNotification($announcement));
    }

    // Announcement Show
    public function showAnnouncement(Announcement $announcement)
    {
        $this->markAsRead($announcement);

        return compact('announcement');
    }

    // Announcement Edit
    public function editAnnouncement(Announcement $announcement)
    {
        $users = User::all();

        return compact('announcement', 'users');
    }

    // Announcement Update
    public function updateAnnouncement(AnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->validated());
        // Sending Notification
        $audiences = User::find($announcement->audience);
        Notification::send($audiences, new AnnouncementNotification($announcement));
    }

    // Announcement Destroy
    public function destroyAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
    }

    // Mark As Read
    public function markAsRead(Announcement $announcement)
    {
        foreach (auth()->user()->unreadNotifications as $unread_notification) {
            if ($unread_notification->data['id'] != null) {
                if ($unread_notification->data['id'] == $announcement->id) {
                    $unread_notification->markAsRead();
                    $unread_notification->update(['read_at' => now()]);
                }
            }
        }
    }
}
