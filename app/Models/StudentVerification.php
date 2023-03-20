<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentVerification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'selfie',
        'student_card',
        'status', 
        'submitted_at',
        'responded_at',
        'response'
    ];

    /**
     * The student that is being verified
     * 
     */
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
