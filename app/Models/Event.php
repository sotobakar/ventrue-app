<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Builder\Stub;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'banner', 'location', 'meeting_link', 'type', 'registration_start', 'registration_end', 'start', 'end', 'description', 'organization_id', 'event_category_id', 'attendance_open', 'certificate_link'];

    /**
     * Get the event's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if (Carbon::now()->greaterThan(Carbon::parse($attributes['end']))) {
                    return config('constants.EVENT.STATUS.2');
                }

                if (Carbon::now()->greaterThan(Carbon::parse($attributes['start']))) {
                    return config('constants.EVENT.STATUS.1');
                }

                return config('constants.EVENT.STATUS.0');
            },
        );
    }

    /**
     * Get status of event based on date
     * 
     */
    public static function getStatus($start, $end) {
        if (Carbon::now()->greaterThan(Carbon::parse($end))) {
            return config('constants.EVENT.STATUS.2');
        }

        if (Carbon::now()->greaterThan(Carbon::parse($start))) {
            return config('constants.EVENT.STATUS.1');
        }

        return config('constants.EVENT.STATUS.0');
    }

    /**
     * Check if the event is verified.
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function verified(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if ($this->approval && $this->approval->status == config('constants.EVENT.APPROVAL.STATUS.1')) {
                    return true;
                } else {
                    return false;
                }
            },
        );
    }

    /**
     * The organization that owns the event.
     * 
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * The participants (students) of the event
     * 
     */
    public function participants()
    {
        return $this->belongsToMany(Student::class, 'event_registrations', 'event_id', 'student_id')->withPivot('registered_at')->withTimestamps();
    }

    /**
     * The category of the event.
     * 
     */
    public function event_category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id', 'id');
    }

    /**
     * The materials of the event 
     * 
     */
    public function materials()
    {
        return $this->hasMany(EventMaterial::class, 'event_id', 'id');
    }

    /**
     * The feedbacks of the event 
     * 
     */
    public function feedbacks()
    {
        return $this->hasMany(EventFeedback::class, 'event_id', 'id');
    }

    /**
     * The people who attend the event
     * 
     */
    public function attendees()
    {
        return $this->belongsToMany(Student::class, 'event_attendances', 'event_id', 'student_id')->withTimestamps();
    }

    /**
     * The reminders of the event
     * 
     */
    public function reminders()
    {
        return $this->hasMany(EventReminder::class, 'event_id');
    }

    /**
     * The approval of the event
     * 
     */
    public function approval()
    {
        return $this->hasOne(EventApproval::class, 'event_id');
    }

    /**
     * Filter scope for event start datetime
     * 
     */
    public function scopeFrom(Builder $query, $date): Builder
    {
        return $query->where('start', '>=', Carbon::parse($date));
    }

    /**
     * Filter scope for event end datetime
     * 
     */
    public function scopeTo(Builder $query, $date): Builder
    {
        return $query->where('end', '<=', Carbon::parse($date));
    }
}
