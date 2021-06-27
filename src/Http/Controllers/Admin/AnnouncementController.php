<?php

namespace Adminetic\Announcement\Http\Controllers\Admin;

use Adminetic\Announcement\Contracts\AnnouncementRepositoryInterface;
use Adminetic\Announcement\Http\Requests\AnnouncementRequest;
use Adminetic\Announcement\Models\Admin\Announcement;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    protected $announcementRepositoryInterface;

    public function __construct(AnnouncementRepositoryInterface $announcementRepositoryInterface)
    {
        $this->announcementRepositoryInterface = $announcementRepositoryInterface;
        $this->authorizeResource(Announcement::class, 'announcement');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('announcement::admin.announcement.index', $this->announcementRepositoryInterface->indexAnnouncement());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcement::admin.announcement.create', $this->announcementRepositoryInterface->createAnnouncement());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $this->announcementRepositoryInterface->storeAnnouncement($request);

        return redirect(adminRedirectRoute('announcement'))->withSuccess('Announcement Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return view('announcement::admin.announcement.show', $this->announcementRepositoryInterface->showAnnouncement($announcement));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        return view('announcement::admin.announcement.edit', $this->announcementRepositoryInterface->editAnnouncement($announcement));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AnnouncementRequest  $request
     * @param  \App\Models\Admin\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        $this->announcementRepositoryInterface->updateAnnouncement($request, $announcement);

        return redirect(adminRedirectRoute('announcement'))->withInfo('Announcement Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $this->announcementRepositoryInterface->destroyAnnouncement($announcement);

        return redirect(adminRedirectRoute('announcement'))->withFail('Announcement Deleted Successfully.');
    }

    /**
     * Timeline.
     */
    public function timeline()
    {
        $announcements = Announcement::latest()->paginate(6);

        return view('announcement::admin.announcement.timeline', compact('announcements'));
    }
}
