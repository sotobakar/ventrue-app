<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'banner', 'location', 'meeting_link', 'type', 'registration_start', 'registration_end', 'start', 'end', 'description', 'organization_id', 'event_category_id'];

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
}
