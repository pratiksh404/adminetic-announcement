<?php

namespace Adminetic\Announcement\Events;

use Adminetic\Announcement\Models\Admin\Announcement;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMadeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $announcement;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }
}
