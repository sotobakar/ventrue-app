<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReminder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'student_id', 'remind_at'];

    /**
     * The event of the reminder
     * 
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * The student of the reminder
     * 
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
