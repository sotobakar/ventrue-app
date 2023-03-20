<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'sid',
        'year',
        'image',
        'faculty_id',
        'user_id'
    ];

    /**
     * The user of the student.
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The faculty of the student.
     * 
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    /**
     * The events the student is registered to.
     * 
     */
    public function registered_events()
    {
        return $this->belongsToMany(Event::class, 'event_registrations', 'student_id', 'event_id');
    }

    /**
     * The verification of the student.
     * 
     */
    public function verification()
    {
        return $this->hasOne(StudentVerification::class, 'student_id');
    }
}
