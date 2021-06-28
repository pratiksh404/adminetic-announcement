<?php

namespace Adminetic\Announcement\Notifications;

use Illuminate\Bus\Queueable;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Adminetic\Announcement\Models\Admin\Announcement;

class SlackAnnouncementNotification extends Notification
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
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from(setting('title', config('adminetic.title', 'Adminetic')) . ' - ' . $this->announcement->user->name ?? 'N/A')
            ->image(getLogo())
            ->content((new HtmlConverter())->convert($this->announcement->body));
    }
}
