<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'image', 'level', 'faculty_id', 'user_id'];

    /**
     * The user of the organization.
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The events that are hosted by the organization
     * 
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'organization_id', 'id');
    }

    /**
     * The faculty of the organization
     * 
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
