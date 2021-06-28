<?php

namespace Adminetic\Announcement\Notifications;

use Adminetic\Announcement\Mail\AnnouncementMail;
use Adminetic\Announcement\Models\Admin\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AnnouncementNotification extends Notification
{
    use Queueable;

    protected $announcement;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->announcement->mediums();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new AnnouncementMail($this->announcement))
            ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'model' => 'announcement',
            'id' => $this->announcement->id,
            'date_time' => $this->announcement->created_at->diffForHumans(),
            'announcement_by' => $this->announcement->user->name ?? 'N/A',
            'announcement' => $this->announcement->body,
        ];
    }
}
