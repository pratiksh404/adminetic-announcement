# Announcement Module for Adminetic Admin Panel

![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-announcement/blob/main/screenshots/banner.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adminetic/announcement.svg?style=flat-square)](https://packagist.org/packages/adminetic/announcement)
[![Stars](https://img.shields.io/github/stars/pratiksh404/adminetic-announcement)](https://github.com/pratiksh404/adminetic-announcement/stargazers) [![Downloads](https://img.shields.io/packagist/dt/pratiksh/adminetic.svg?style=flat-square)](https://packagist.org/packages/pratiksh/adminetic-announcement) [![StyleCI](https://github.styleci.io/repos/372560942/shield?branch=main)](https://github.styleci.io/repos/372560942?branch=main) [![Build Status](https://scrutinizer-ci.com/g/pratiksh404/adminetic-announcement/badges/build.png?b=main)](https://scrutinizer-ci.com/g/pratiksh404/adminetic-announcement/build-status/main) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pratiksh404/adminetic-announcement/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/pratiksh404/adminetic-announcement/?branch=main) [![CodeFactor](https://www.codefactor.io/repository/github/pratiksh404/adminetic-announcement/badge)](https://www.codefactor.io/repository/github/pratiksh404/adminetic-announcement) [![License](https://img.shields.io/github/license/pratiksh404/adminetic-announcement)](//packagist.org/packages/pratiksh/adminetic)

Announcement module for Adminetic Admin Panel

For detailed documentaion visit [Adminetic Announcement Module Documentation](https://app.gitbook.com/@pratikdai404/s/adminetic/addons/announcement)

#### Contains : -

- Global/Selective Announcement
- Email Notification
- Slack Notification
- Database Notification
- Announcement Timeline

## Installation

You can install the package via composer:

```bash
composer require adminetic/announcement
```

### Note

For slack notification
Add AnnouncementUser Trait in your User Model

```php
use Adminetic\Announcement\Traits\AnnouncementUser;
```

and slack webhook link in you env file

```php
SLACK_WEBHOOK=your_slack_webhook_link
```

for more information visit [Laravel Slack Routing](https://laravel.com/docs/8.x/notifications#routing-slack-notifications)

### Announcement Notification widget

If you wish to add announcement notification widget on your header located in views/admin/layouts/components/header.blade.php add

```sh
 <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <x-announcement-announcement-notification-bell />
            // Other Items
            </ul>
</div>
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email pratikdai404@gmail.com instead of using the issue tracker.

## Credits

- [Pratik Shrestha](https://github.com/adminetic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Screenshots

![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-announcement/blob/main/screenshots/banner.png)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-announcement/blob/main/screenshots/index.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-announcement/blob/main/screenshots/create.jpg)
![Adminetic Announcemment Module](https://github.com/pratiksh404/adminetic-announcement/blob/main/screenshots/timeline.jpg)
