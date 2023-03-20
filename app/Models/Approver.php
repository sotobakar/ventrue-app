<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'faculty_id'];

    /**
     * The faculty of the approver
     * 
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
