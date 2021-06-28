<?php

namespace Adminetic\Announcement\Provider;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Adminetic\Announcement\Events\AnnouncementMadeEvent;
use Adminetic\Announcement\Listeners\AnnouncementMadeListener;


class AnnouncementEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AnnouncementMadeEvent::class => [
            AnnouncementMadeListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
