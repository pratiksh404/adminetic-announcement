<?php

namespace Adminetic\Announcement\Models\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Announcement extends Model
{
    use LogsActivity;

    protected $guarded = [];

    // Forget cache on updating or saving and deleting
    public static function boot()
    {
        parent::boot();

        static::saving(function () {
            self::cacheKey();
        });

        static::deleting(function () {
            self::cacheKey();
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('announcements') ? Cache::forget('announcements') : '';
    }

    // Logs
    protected static $logName = 'announcement';

    // Appends
    protected $appends = ['audience_names', 'color'];

    // Casts
    protected $casts = [
        'medium' => 'array',
        'audience' => 'array'
    ];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessors
    public function getAudienceNamesAttribute()
    {
        return User::find($this->audience)->pluck('name')->toArray();
    }
    public function getColorAttribute()
    {
        $colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'pink', 'grey'];
        return $colors[array_rand($colors, 1)];
    }
    public function mediums()
    {
        if (isset($this->medium)) {
            foreach ($this->medium as $val) {
                $mediums[] =  [
                    1 => 'database',
                    2 => 'mail',
                    3 => 'slack'
                ][$val];
            }
            return $mediums;
        } else {
            return null;
        }
    }
}
