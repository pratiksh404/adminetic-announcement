<?php

namespace Adminetic\Announcement\Contracts;

use Adminetic\Announcement\Http\Requests\AnnouncementRequest;
use Adminetic\Announcement\Models\Admin\Announcement;

interface AnnouncementRepositoryInterface
{
    public function indexAnnouncement();

    public function createAnnouncement();

    public function storeAnnouncement(AnnouncementRequest $request);

    public function showAnnouncement(Announcement $Announcement);

    public function editAnnouncement(Announcement $Announcement);

    public function updateAnnouncement(AnnouncementRequest $request, Announcement $Announcement);

    public function destroyAnnouncement(Announcement $Announcement);
}
