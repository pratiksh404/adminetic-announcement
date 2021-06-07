<?php

namespace Adminetic\Announcement\Adapter;

use Adminetic\Announcement\View\Components\AnnouncementNotificationBell;
use Pratiksh\Adminetic\Contracts\PluginInterface;
use Pratiksh\Adminetic\Services\Helper\Adapter;
use Pratiksh\Adminetic\Traits\SidebarHelper;

class AnnouncementAdapter implements PluginInterface
{
    use SidebarHelper;
    public function assets(): array
    {
        return  array(
            [
                'name' => 'Timeline',
                'active' => true,
                'files' => [
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/timeline/timeline-v-1/main.js',
                    ],
                    [
                        'type' => 'js',
                        'active' => true,
                        'location' => 'adminetic/assets/js/modernizr.js',
                    ],
                ],
            ]
        );
    }

    public function myMenu(): array
    {
        return  array(
            [
                'type' => 'menu',
                'name' => 'Announcement',
                'icon' => 'fa fa-bullhorn',
                'is_active' => request()->routeIs('announcement*') ? 'active' : '',
                'pill' => [
                    'class' => 'badge badge-info badge-air-info',
                    'value' => "plugin",
                ],
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Announcement::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Announcement::class),
                    ],
                ],
                'children' => array_merge(
                    array([
                        'type' => 'submenu',
                        'name' => 'Timeline',
                        'is_active' => request()->routeIs('timeline') ? 'active' : '',
                        'link' => adminRedirectRoute('timeline'),
                        'conditions' => [
                            [
                                'type' => 'or',
                                'condition' => auth()->user()->can('view-any', Announcement::class),
                            ],
                        ],
                    ]),
                    $this->indexCreateChildren('announcement', Announcement::class)
                )
            ]
        );
    }

    public function headerComponents(): array
    {
        return [
            '<x-announcement-announcement-notification-bell />'
        ];
    }
}
