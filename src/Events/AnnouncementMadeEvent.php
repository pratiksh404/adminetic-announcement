<?php

namespace Adminetic\Announcement\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Adminetic\Announcement\Models\Admin\Announcement;

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
